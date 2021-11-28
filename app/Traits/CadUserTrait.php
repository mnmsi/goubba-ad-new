<?php

namespace App\Traits;


use App\Models\CadUser;
use Illuminate\Support\Facades\Auth;

trait CadUserTrait{


    public function getUser($id = null)
    {
        if (Auth::user()->isAdmin() && $id)
            return CadUser::findOrFail( $id);

        return Auth::user();
    }


}

