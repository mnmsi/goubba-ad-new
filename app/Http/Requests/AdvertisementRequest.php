<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class AdvertisementRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "brand_title"         => 'required',
            "brand_logo"          => 'mimes:jpeg,jpg,png,gif|required|max:10000',
            "campaign_name"       => 'required',
            "adv_campaign"        => 'required',
            "title"               => 'required',
            "desc"                => 'required',
            "user_id"             => 'required',
            "adv_cat"             => 'required',
            "adv_type"            => 'required',
            // "feed_adv_type"        => 'required',
            // "nativeAdRefLink"     => 'required_if:adv_cat,1',
            // "nativeAdPercent.*"    => 'required',
            // "nativeAdPosition.*"   => 'required',
            // "storyAdRefLink.*"     => 'required',
            // "bannerAdRefLink.*"    => 'required',
            // "bannerAdPosition.*"   => 'required',
            // "rewardAdRefLink.*"    => 'required',
            // "adv_position_slot"    => 'required',
            "start_date"          => 'required',
            "end_date"            => 'required',
            "start_time"          => 'required',
            "end_time"            => 'required',
            // |after:start_time
            "daily_impression"    => 'required',
            "lifetime_impression" => 'required|different:daily_impression',
            // "rewards_amount"       => 'required',
            "budget"              => 'required',
            // "favorite_store_ids"    => 'required',
            // "favorite_category_ids" => 'required',
            "min_age"             => 'required',
            "max_age"             => 'required|gt:min_age',
            "country_id"          => 'required',
            "city_id"             => 'required',
            "state_id"            => 'required',
            "is_active"           => 'required_if:user_id,1',
        ];
    }

    public function messages()
    {
        return [
            'end_time.after'                => "End time must be after Start time.",
            'lifetime_impression.different' => "Daily impression and lifetime impression can't be equal.",
            'max_age.gt'                    => "Max age must be greater then min age.",
        ];
    }

    // protected function failedValidation(Validator $validator)
    // {
    //     $errors = (new ValidationException($validator))->errors();

    //     // dd($errors);
    //     // throw new HttpResponseException(response()->json(['status' => 0, 'errors'=> $errors]));

    //     //parent::failedValidation($validator); // TODO: Change the autogenerated stub
    // }
}
