<?php

namespace App\Http\Controllers;

use App\Http\Requests\CadUserRequest;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Models\CadUser;
use App\Models\CadUserDetails;
use App\Models\CadUserRole;
use App\Traits\CadUserTrait;
use App\Traits\GeneralTrait;
use DB;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class UsersController extends Controller
{
    use GeneralTrait, CadUserTrait;

    public function index()
    {
        $users = CadUser::with('details', 'role')->paginate(10);

        return view('pages.users.index', compact('users'));
    }

    public function create()
    {
        $userRoles  = CadUserRole::getAll();

        return view('pages.users.create', compact('userRoles'));
    }

    public function store(CadUserRequest $request, CadUser $user, CadUserDetails $userDetails)
    {
        $reqData = $request->all();

        if (!empty($reqData['password'])) {
            $reqData['password'] = Hash::make($reqData['password']);
        } else {
            $reqData['password'] = Hash::make(rand(1, 1000));
        }

        DB::beginTransaction();
        try {
            $isCreate = $user->create($reqData);

            $reqData['user_id'] = $isCreate->id;

            $userDetails->create($reqData);

            if (!empty($reqData['saveAndSend'])) {
                if ($reqData['saveAndSend'] == 'Save & Send Mail') {
                    Password::sendResetLink(['email' => $isCreate->email]);
                }
            }

        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with([
                'alertType' => 'error',
                'message'   => 'Unsuccessful to add advertiser!',
            ]);
        }

        DB::commit();
        return redirect('/advertiser')->with([
            'alertType' => 'success',
            'message'   => 'Advertiser Created Successfully!',
        ]);
    }

    public function show($id)
    {
        $user = $this->getUser($id);

        $user_info = $user->getDetails();

        return view('pages.users.details', compact('user', 'user_info'));
    }

    public function edit($id)
    {
        $user = $this->getUser($id);

        $data['roles'] = CadUserRole::all();
        $user_info     = $user->getDetails();

        return view('pages.users.edit', compact('user', 'user_info', 'data'));
    }

    public function update(CadUserRequest $request, $id)
    {
        $reqData = $request->all();
        $cadUser = CadUser::find($id);

        DB::beginTransaction();
        try {

            $isUpdate = $cadUser->update($reqData);
            CadUserDetails::where('user_id', $id)->first()->update($reqData);

        } catch (\Throwable $th) {
            DB::rollback();
            // return redirect('advertiser')->with('error', $th->getMessage());
            return redirect()->back()->with([
                'alertType' => 'error',
                'message'   => 'Unsuccessful to update advertiser!',
            ]);
        }

        DB::commit();
        // return redirect('advertiser')->with('success', 'Advertiser Updated Successfully!');
        return redirect('advertiser')->with([
            'alertType' => 'success',
            'message'   => 'Advertiser updated successfully!',
        ]);
    }

    public function delete($id)
    {
        DB::beginTransaction();
        try {

            CadUser::where('id', $id)->delete();
            CadUserDetails::where('user_id', $id)->delete();

        } catch (\Throwable $th) {
            DB::rollback();
            return redirect('advertiser')->with('error', $th->getMessage());
        }

        DB::commit();
        return redirect('advertiser')->with('success', 'Advertiser Deleted Successfully!');
    }

    public function changePasswordForm()
    {
        return view('pages.auth.change-password');
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $user     = Auth::user();
        $is_valid = Hash::check($request->password, $user->password);

        if ($is_valid) {
            $user->password = Hash::make($request->password);
            $user->save();
            return redirect('/')->with('success', 'Password changed successfully!');
        }

        return redirect()->route('users.changePassword')->with('error', 'Wrong password!');

    }

    public function forgotPassword()
    {
        return view('pages.auth.forgot-password');

    }

    public function postForgotPassword(Request $request)
    {
        $request->validate(['email' => 'required|email|string|max:255']);

        $response = Password::sendResetLink(['email' => $request->email]);

        switch ($response) {
            case Password::INVALID_USER:
                return redirect("forgot-password?email={$request->email}")->with('error', 'Invalid Email');

            case Password::RESET_LINK_SENT:
                return redirect()->back()->with('success', 'Reset link sent successfully. Please check your email');

            default:
                return redirect("forgot-password?email={$request->email}")->with('error', 'Sorry! Email couldn\'t be sent. Please try again later');
        }
    }

    public function resetPasswordForm($token)
    {
        $email = request('email');
        return view('pages.auth.reset-password', compact('token', 'email'));
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        $data = $request->only('email', 'password', 'password_confirmation', 'token');

        $response = Password::reset($data, function ($user, $password) {
            $user->password = Hash::make($password);
            $user->save();
            $user->setRememberToken(Str::random(60));
            event(new PasswordReset($user));
        }
        );

        switch ($response) {

            case Password::INVALID_TOKEN:
                return redirect()->back()->withErrors('Token is not valid');

            case Password::INVALID_USER:
                return redirect()->back()->withErrors('EMail not found');

            case Password::PASSWORD_RESET:
                return redirect("login?email={$request->email}")->with('success', 'Password reset successful. Please login to continue');

        }

        return [
            'response'      => $response,
            'inavlid_user'  => Password::INVALID_USER,
            'inavlid_token' => Password::INVALID_TOKEN,
            'reste'         => Password::PASSWORD_RESET,
        ];
    }
}
