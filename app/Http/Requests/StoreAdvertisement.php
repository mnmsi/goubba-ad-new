<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreAdvertisement extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $method = request()->method();

        if ($method == 'PATCH') {
            return [

            ];
        } else {
            return [
                'inputBrandName'         => 'required',
                'inputBrandLogo'         => 'required|mimes:jpg,jpeg,png',

                'inputCampaignName'      => 'required',
                'adv_campaign'           => 'required',

                'inputAdvTitle'          => 'required',
                'inputAdvDesc'           => 'required',
                'adv_user'               => 'required',
                'adv_cat'                => 'required',
                // 'adv_type'                      => 'required',
                'inputStartEndDateRange' => 'required',

                'inputStartTime'         => 'required',
                'inputEndTime'           => 'required|after:inputStartTime',

                'inputAdvFeedimage'      => 'mimes:jpg,jpeg,png',
                // 'inputAdvStoryVideo'     => 'max:1024',

                // 'inputAdvimageFile'               => 'required_without:inputAdvimageFileNative',
                // 'inputAdvimageFileNative'       => 'required_without:inputAdvimageFile|mimes:jpg,jpeg,png',

                'inputAgeMin'            => 'required',
                'inputAgeMax'            => 'required|gt:inputAgeMin',
                'adv_country'            => 'required',
                'adv_city'               => 'required',
                'adv_state'              => 'required',
                'adv_active_status'      => 'required',
            ];
        }

    }

    public function messages()
    {
        return [
            'inputBrandName.required'            => 'A Brand name is required',

            'inputBrandLogo.required'            => 'A Brand logo is required',
            'inputBrandLogo.mimes'               => 'Only jpg,jpeg,png format support',

            'inputCampaignName'                  => 'Campaign name is required',
            'adv_campaign'                       => 'Please select a Campaign',

            'inputAdvTitle.required'             => 'A title is required',
            'inputAdvDesc.required'              => 'A description is required',
            'adv_user.required'                  => 'Please select a user',
            'adv_cat.required'                   => 'Please select a Category',
            'adv_type.required'                  => 'Please select a Type',
            'inputStartEndDateRange.required'    => 'Please select Date',

            'inputStartTime.required'            => 'Please select a Start Time',

            'inputEndTime.required'              => 'Please select a End Time',
            'inputEndTime.after'                 => 'Please select a End Time before start time',

            'inputAdvimageFile.required_without' => 'Image Field is required',
            'inputAdvimageFile.mimes'            => 'Only jpg,jpeg,png format support',

            'inputAdvimageFileNative.required'   => 'Image Field is required',
            'inputAdvimageFileNative.mimes'      => 'Only JPEG,JPG, PNG format support',

            // 'inputAdvStoryVideo.size'            => "Video must be less than or equal 30 mb",
            // 'inputAdvStoryVideo.max'            => "Video must be less than or equal 30 mb max",

            'inputAgeMin.required'               => 'Min Age is required',
            'inputAgeMin.min'                    => 'Minimum age is 13',
            'inputAgeMax.required'               => 'Max age is required',
            'inputAgeMax.gt'                     => 'Max age can not be lower than Min age',

            'adv_country'                        => 'Please Select a country',
            'adv_city'                           => 'Please Select a City',
            'adv_state'                          => 'Please Select a State',
            'adv_active_status.required'         => 'Please select The Status',
        ];
    }
}
