<?php

namespace App\Traits;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

trait GeneralTrait{

    public function storeImage(Request $request, $field_name, $old_image = null, $directory = 'uploads', $disk = 'public')
    {
        if ($request->hasFile( $field_name)){
            Storage::disk( $disk)->delete( $old_image);
            return $request->file( $field_name)->store( $directory, $disk);
        }

        return $old_image;
    }



}
