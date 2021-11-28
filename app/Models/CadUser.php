<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use App\Http\Resources\CampainRecource;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Auth\Passwords\CanResetPassword;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class CadUser extends Authenticatable
{
    use HasFactory, SoftDeletes, Notifiable, CanResetPassword;

    protected $table = 'cad_users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'business_name',
        'email',
        'email_verified_at',
        'password',
        'two_factor_secret',
        'two_factor_recovery_codes',
        'remember_token',
        'role_id',
        'is_approved',
        'is_active',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function getById($id)
    {
        return DB::table('cad_users')

            ->join('cad_user_role', 'cad_users.role_id', '=', 'cad_user_role.role_id')
            ->join('cad_user_details', 'cad_users.id', '=', 'cad_user_details.user_id')
            ->select(
                'cad_users.*',
                'cad_user_role.role_name',
                'cad_user_details.phone',
                'cad_user_details.gender',
                'cad_user_details.image',
                'cad_user_details.country',
                'cad_user_details.city',
                'cad_user_details.state',
                'cad_user_details.birthday',
            )
            ->where('cad_users.id', $id)
            ->get();
    }

    public static function getAllUserForAdv()
    {
        return CadUser::where('is_active', 1)
            ->where('is_approved', 1)
            ->get();
    }

    public static function getAll()
    {
        return DB::table('cad_users')
            ->join('cad_user_role', 'cad_users.role_id', '=', 'cad_user_role.id')
            ->join('cad_user_details', 'cad_users.id', '=', 'cad_user_details.user_id')
            ->select(
                'cad_users.*',
                'cad_user_role.role_name',
                'cad_user_details.phone',
                'cad_user_details.country',
            )
            ->get();

        // return CadUser::all();
    }

    public function details()
    {
        return $this->hasOne(CadUserDetails::class, 'user_id', 'id');
    }

    public function role()
    {
        return $this->belongsTo(CadUserRole::class, 'role_id', 'role_id');
    }

    public function campain()
    {
        return $this->hasMany(CadAdvertismentCampaign::class, 'user_id', 'id')
            ->with('campaign_type', 'advertisement');
    }

    public function getRole()
    {
        $role_name = $this->role ? $this->role->role_name : null;
        return ucfirst($role_name);
    }

    public function getDetails()
    {
        $this->load('details');

        $campainData = array();
        if ($this->campain) {
            foreach ($this->campain as $row) {
                array_push($campainData, [
                    'campaign_name'      => $row->campaign_name,
                    'campaign_type_name' => $row->campaign_type ? $row->campaign_type->campaign_type_name : null,
                    'campaign_active'    => $row->campaign_type ? $row->campaign_type->is_active == 1 ? 'Active' : 'Not Active' : null,
                    'total_ad'      => $row->advertisement ? $row->advertisement->count() : null,
                    'total_publish_ad'      => $row->advertisement ? $row->advertisement->where('is_active', 'publish')->count() : null,
                    'total_pending_ad'      => $row->advertisement ? $row->advertisement->where('is_active', 'pending')->count() : null,
                ]);
            }
        }

        // dd(new CampainRecource($this->campain));

        return [
            'user_id'             => $this->id,
            'role_name'           => $this->role->role_name,
            'business_name'       => $this->business_name,
            'email'               => $this->email,
            'role_id'             => $this->role_id,
            'is_approved'         => $this->is_approved,
            'is_active'           => $this->is_active,
            'phone'               => $this->details ? $this->details->phone : null,
            'website'             => $this->details ? $this->details->website : null,
            'address'             => $this->details ? $this->details->address : null,
            'bank_details'        => $this->details ? $this->details->bank_details : null,
            'key_contact_name'    => $this->details ? $this->details->key_contact_name : null,
            'key_contact_address' => $this->details ? $this->details->key_contact_address : null,
            'key_contact_phone'   => $this->details ? $this->details->key_contact_phone : null,
            'image'               => $this->details ? $this->details->image : null,
            'campains'            => $campainData,
            // 'campains'            => new CampainRecource($this->campain),
        ];

    }

    public function sendPasswordResetNotification($token)
    {
        $reset_link = url("setup-password/{$token}?email={$this->email}");

        $this->notify(new ResetPasswordNotification($token, $reset_link));
    }

    public function isAdmin()
    {
        if ($this->role->role_id == 1) {
            return true;
        }

    }

    public function isUser()
    {
        if ($this->role->role_id == 2) {
            return true;
        }

    }

    public function advertisement()
    {
        return $this->hasMany(CadUser::class);
    }

}
