<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdvertisementRequest;
use App\Http\Requests\AdvertisementUpdateRequest;
use App\Library\DateTimeFormatter;
use App\Library\FIleHandler;
use App\Models\CadAdvertisement;
use App\Models\CadAdvertisementCampaignType;

//Custom Library
use App\Models\CadAdvertisementCategories;
use App\Models\CadAdvertisementDetails;
use App\Models\CadAdvertisementMedia;

//Custom Request
use App\Models\CadAdvertisementType;

//Models
use App\Models\CadAdvertismentCampaign;
use App\Models\CadImpression;
use App\Models\CadTimeSlot;
use App\Models\CadUser;
use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\State;
use App\Models\Store;
use App\Models\Users;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AdvertisementController extends Controller
{
    public function index()
    {
        $userId        = Auth::user()->id;
        $campaignLists = CadAdvertismentCampaign::getAll($userId, true);

        return view('pages.advertisement.index', ['campaignLists' => $campaignLists]);
    }

    public function create()
    {
        $data = $this->advertisementModelGroup();
        // return view('pages.advertisement.create', $data);
        return view('pages.new_advertisement.create', $data);
    }

    public function store(AdvertisementRequest $request)
    {
        $reqData = $request->all();

        $campaign = isset($reqData['adv_campaign']) ? $reqData['adv_campaign'] : array();
        $category = isset($reqData['adv_cat']) ? $reqData['adv_cat'] : array();

        $nativeAdImg     = isset($reqData['nativeAdImg']) ? $reqData['nativeAdImg'] : array();
        $nativeAdType    = isset($reqData['native_ad_type']) ? $reqData['native_ad_type'] : array();
        $nativeRefLink   = isset($reqData['nativeAdRefLink']) ? $reqData['nativeAdRefLink'] : array();
        $nativeAdPercent = isset($reqData['nativeAdPercent']) ? $reqData['nativeAdPercent'] : array();
        $nativePosition  = isset($reqData['nativeAdPosition']) ? $reqData['nativeAdPosition'] : array();

        $storyAdMedia   = isset($reqData['storyAdMedia']) ? $reqData['storyAdMedia'] : array();
        $storyAdRefLink = isset($reqData['storyAdRefLink']) ? $reqData['storyAdRefLink'] : array();

        $bannerAdImg      = isset($reqData['bannerAdImg']) ? $reqData['bannerAdImg'] : array();
        $bannerAdType     = isset($reqData['banner_ad_type']) ? $reqData['banner_ad_type'] : array();
        $bannerAdRefLink  = isset($reqData['bannerAdRefLink']) ? $reqData['bannerAdRefLink'] : array();
        $bannerAdPercent  = isset($reqData['bannerAdPercent']) ? $reqData['bannerAdPercent'] : array();
        $bannerAdPosition = isset($reqData['bannerAdPosition']) ? $reqData['bannerAdPosition'] : array();

        $rewardAdMedia   = isset($reqData['rewardAdMedia']) ? $reqData['rewardAdMedia'] : array();
        $rewardAdRefLink = isset($reqData['rewardAdRefLink']) ? $reqData['rewardAdRefLink'] : array();
        $rewardAdReward  = isset($reqData['rewardAdReward']) ? $reqData['rewardAdReward'] : array();

        $homeBannerMedia      = isset($reqData['homeBannerMedia']) ? $reqData['homeBannerMedia'] : array();
        $homeBannerRefLink    = isset($reqData['homeBannerRefLink']) ? $reqData['homeBannerRefLink'] : array();
        $homeBannerAdPosition = isset($reqData['homeBannerAdPosition']) ? $reqData['homeBannerAdPosition'] : array();

        // Uploading Brand Logo File
        if ($request->hasfile('brand_logo')) {
            $reqData['brand_logo'] = FIleHandler::uploadFiles($request->brand_logo);
        }

        $reqData['start_date'] = Carbon::createFromFormat('d-m-Y', $request->start_date)->format('Y-m-d');
        $reqData['end_date']   = Carbon::createFromFormat('d-m-Y', $request->end_date)->format('Y-m-d');

        $reqData['start_time'] = date("H:i", strtotime($request->start_time));
        $reqData['end_time']   = date("H:i", strtotime($request->end_time));

        $reqData['age_range']             = $request->min_age . "-" . $request->max_age;
        $reqData['city_id']               = json_encode($request->city_id);
        $reqData['state_id']              = json_encode($request->state_id);
        $reqData['favorite_store_ids']    = json_encode($request->favorite_store_ids);
        $reqData['favorite_category_ids'] = json_encode($request->favorite_category_ids);

        DB::beginTransaction();
        try {
            foreach ($campaign as $key => $campaign) {

                $reqData['campaign_type_id'] = $campaign;
                $createCampaign              = CadAdvertismentCampaign::create($reqData);

                foreach ($category as $key => $advCategory) {

                    $reqData['campaign_id'] = $createCampaign->id;
                    $reqData['category_id'] = $advCategory;

                    //need to change
                    $reqData['adv_position_slot'] = 0;
                    $reqData['inputRewardPoints'] = 0;
                    // end need to change

                    $creteAdv = CadAdvertisement::create($reqData);

                    $reqData['advertisement_id'] = $creteAdv->id;
                    $createAdvDetails            = CadAdvertisementDetails::create($reqData);
                    $createTimeSlot              = CadTimeSlot::create($reqData);
                    $createImpression            = CadImpression::create($reqData);

                    if ($advCategory == 1) {

                        $timeToStaring = DateTimeFormatter::getTimeDifference($reqData['start_date'], $reqData['end_date'], $reqData['start_time'], $reqData['end_time']);

                        $this->insertAdvertisementMedia($reqData['advertisement_id'], $nativeAdImg, $nativeAdType, $nativeRefLink, $nativeAdPercent, $timeToStaring, $nativePosition);

                    } else if ($advCategory == 2) {

                        $this->insertAdvertisementMedia($reqData['advertisement_id'], $storyAdMedia, null, $storyAdRefLink);

                    } elseif ($advCategory == 3) {

                        $timeToStaring = DateTimeFormatter::getTimeDifference($reqData['start_date'], $reqData['end_date'], $reqData['start_time'], $reqData['end_time']);

                        $this->insertAdvertisementMedia($reqData['advertisement_id'], $bannerAdImg, $bannerAdType, $bannerAdRefLink, $bannerAdPercent, $timeToStaring, null);

                    } elseif ($advCategory == 4) {

                        $this->insertAdvertisementMedia($reqData['advertisement_id'], $rewardAdMedia, null, $rewardAdRefLink, null, null, null, $rewardAdReward);

                    } else if ($advCategory == 5) {

                        $this->insertAdvertisementMedia($reqData['advertisement_id'], $homeBannerMedia, null, $homeBannerRefLink, null, null, $homeBannerAdPosition);

                    }
                }
            }

        } catch (\Throwable $th) {
            DB::rollback();
            // dd($th);
            return redirect()->back()->with([
                'alertType' => 'error',
                'message'   => 'Unsuccessful to create advertisement!',
            ]);
        }

        if (storage_path('app/public/temp/' . Auth::user()->id)) {
            $isDelete = Storage::deleteDirectory('public/temp/' . Auth::user()->id);
        }

        DB::commit();
        return redirect('adv')->with([
            'alertType' => 'success',
            'message'   => 'Advertisement Created Successfully!',
        ]);
    }

    public function show($id)
    {
        $userId = Auth::user()->role_id;
        $data   = $this->getAdvData($id, $userId);

        return view('pages.advertisement.details', $data);
    }

    public function edit($id)
    {
        $userId = Auth::user()->role_id;
        $data   = $this->getAdvData($id, $userId, true);

        // return view('pages.advertisement.update', $data);
        return view('pages.new_advertisement.update', $data);
    }

    public function update(AdvertisementUpdateRequest $request)
    {
        $reqData = $request->all();

        $category = isset($reqData['adv_cat']) ? $reqData['adv_cat'] : array();

        $nativeAdImg     = isset($reqData['nativeAdImg']) ? $reqData['nativeAdImg'] : array();
        $nativeAdType    = isset($reqData['native_ad_type']) ? $reqData['native_ad_type'] : array();
        $nativeRefLink   = isset($reqData['nativeAdRefLink']) ? $reqData['nativeAdRefLink'] : array();
        $nativeAdPercent = isset($reqData['nativeAdPercent']) ? $reqData['nativeAdPercent'] : array();
        $nativePosition  = isset($reqData['nativeAdPosition']) ? $reqData['nativeAdPosition'] : array();

        $storyAdMedia   = isset($reqData['storyAdMedia']) ? $reqData['storyAdMedia'] : array();
        $storyAdRefLink = isset($reqData['storyAdRefLink']) ? $reqData['storyAdRefLink'] : array();

        $bannerAdImg      = isset($reqData['bannerAdImg']) ? $reqData['bannerAdImg'] : array();
        $bannerAdType     = isset($reqData['banner_ad_type']) ? $reqData['banner_ad_type'] : array();
        $bannerAdRefLink  = isset($reqData['bannerAdRefLink']) ? $reqData['bannerAdRefLink'] : array();
        $bannerAdPercent  = isset($reqData['bannerAdPercent']) ? $reqData['bannerAdPercent'] : array();
        $bannerAdPosition = isset($reqData['bannerAdPosition']) ? $reqData['bannerAdPosition'] : array();

        $rewardAdMedia   = isset($reqData['rewardAdMedia']) ? $reqData['rewardAdMedia'] : array();
        $rewardAdRefLink = isset($reqData['rewardAdRefLink']) ? $reqData['rewardAdRefLink'] : array();
        $rewardAdReward  = isset($reqData['rewardAdReward']) ? $reqData['rewardAdReward'] : array();

        $homeBannerMedia      = isset($reqData['homeBannerMedia']) ? $reqData['homeBannerMedia'] : array();
        $homeBannerRefLink    = isset($reqData['homeBannerRefLink']) ? $reqData['homeBannerRefLink'] : array();
        $homeBannerAdPosition = isset($reqData['homeBannerAdPosition']) ? $reqData['homeBannerAdPosition'] : array();

        // Uploading Brand Logo File
        if ($request->hasfile('brand_logo')) {
            $reqData['brand_logo'] = FIleHandler::uploadFiles($request->brand_logo);
        } else {
            $reqData['brand_logo'] = $reqData['brand_logo_old'];
        }

        try {
            $reqData['start_date'] = Carbon::createFromFormat('d-m-Y', $request->start_date)->format('Y-m-d');
        } catch (\Throwable $th) {
            $reqData['start_date'] = Carbon::parse($request->start_date)->format('Y-m-d');
        }

        try {
            $reqData['end_date'] = Carbon::createFromFormat('d-m-Y', $request->end_date)->format('Y-m-d');
        } catch (\Throwable $th) {
            $reqData['end_date'] = Carbon::parse($request->end_date)->format('Y-m-d');
        }

        $reqData['start_time'] = date("H:i", strtotime($request->start_time));
        $reqData['end_time']   = date("H:i", strtotime($request->end_time));

        $reqData['age_range']             = $request->min_age . "-" . $request->max_age;
        $reqData['city_id']               = json_encode($request->city_id);
        $reqData['state_id']              = json_encode($request->state_id);
        $reqData['favorite_store_ids']    = json_encode($request->favorite_store_ids);
        $reqData['favorite_category_ids'] = json_encode($request->favorite_category_ids);

        $campaign        = CadAdvertismentCampaign::find($request->campaign_id);
        $advData         = CadAdvertisement::where('campaign_id', $campaign->id);
        $advIds          = $advData->pluck('id')->all();
        $advCatIds       = $advData->pluck('category_id')->all();
        $deletedCategory = array_diff($advCatIds, $category);

        DB::beginTransaction();
        try {
            $reqData['campaign_id'] = $campaign->id;
            $campaign->update($reqData);

            foreach ($category as $key => $advCategory) {

                $reqData['category_id'] = $advCategory;
                //need to change
                $reqData['adv_position_slot'] = 0;
                $reqData['inputRewardPoints'] = 0;
                // end need to change

                if (in_array($advCategory, $advCatIds)) {

                    $adv = CadAdvertisement::where([['campaign_id', $campaign->id], ['category_id', $advCategory]])->first();

                    $adv->update($reqData);
                    $reqData['advertisement_id'] = $adv->id;
                    $advDetailsUpdate            = CadAdvertisementDetails::where('advertisement_id', $adv->id)->first()->update($reqData);
                    $advTimeSlotUpdate           = CadTimeSlot::where('advertisement_id', $adv->id)->first()->update($reqData);
                    $advImpressionUpdate         = CadImpression::where('advertisement_id', $adv->id)->first()->update($reqData);

                    $advMediaIds = CadAdvertisementMedia::where('advertisement_id', $adv->id)->pluck('id')->all();

                    // ($advId, $adMedia, $adType = null, $adRefLink, $percent = null, $percent_to_time = null, $position = null, $reward = null, $time = null, $advMediaIds = null)

                    if ($advCategory == 1) {

                        $timeToStaring = DateTimeFormatter::getTimeDifference($reqData['start_date'], $reqData['end_date'], $reqData['start_time'], $reqData['end_time']);

                        $this->updateAdvertisementMedia($adv->id, $nativeAdImg, $nativeAdType, $nativeRefLink, $nativeAdPercent, $timeToStaring, $nativePosition, null, null, $advMediaIds);

                    } else if ($advCategory == 2) {

                        $this->updateAdvertisementMedia($adv->id, $storyAdMedia, null, $storyAdRefLink, null, null, null, null, null, $advMediaIds);

                    } elseif ($advCategory == 3) {

                        $timeToStaring = DateTimeFormatter::getTimeDifference($reqData['start_date'], $reqData['end_date'], $reqData['start_time'], $reqData['end_time']);

                        $this->updateAdvertisementMedia($adv->id, $bannerAdImg, $bannerAdType, $bannerAdRefLink, $bannerAdPercent, $timeToStaring, null, null, null, $advMediaIds);

                    } elseif ($advCategory == 4) {

                        $this->updateAdvertisementMedia($adv->id, $rewardAdMedia, null, $rewardAdRefLink, null, null, null, $rewardAdReward, null, $advMediaIds);

                    } else if ($advCategory == 5) {

                        $this->updateAdvertisementMedia($adv->id, $homeBannerMedia, null, $homeBannerRefLink, null, null, $homeBannerAdPosition, null, null, $advMediaIds);

                    }

                } else {

                    $adv = CadAdvertisement::where([['campaign_id', $campaign->id], ['category_id', $advCategory]]);

                    if ($adv->exists()) {
                        $adv->delete();
                    } else {

                        $creteAdv = CadAdvertisement::create($reqData);

                        $reqData['advertisement_id'] = $creteAdv->id;
                        $createAdvDetails            = CadAdvertisementDetails::create($reqData);
                        $createTimeSlot              = CadTimeSlot::create($reqData);
                        $createImpression            = CadImpression::create($reqData);

                        if ($advCategory == 1) {

                            $timeToStaring = DateTimeFormatter::getTimeDifference($reqData['start_date'], $reqData['end_date'], $reqData['start_time'], $reqData['end_time']);

                            $this->insertAdvertisementMedia($reqData['advertisement_id'], $nativeAdImg, $nativeAdType, $nativeRefLink, $nativeAdPercent, $timeToStaring, $nativePosition);

                        } else if ($advCategory == 2) {

                            $this->insertAdvertisementMedia($reqData['advertisement_id'], $storyAdMedia, null, $storyAdRefLink);

                        } elseif ($advCategory == 3) {

                            $timeToStaring = DateTimeFormatter::getTimeDifference($reqData['start_date'], $reqData['end_date'], $reqData['start_time'], $reqData['end_time']);

                            $this->insertAdvertisementMedia($reqData['advertisement_id'], $bannerAdImg, $bannerAdType, $bannerAdRefLink, $bannerAdPercent, $timeToStaring, null);

                        } elseif ($advCategory == 4) {

                            $this->insertAdvertisementMedia($reqData['advertisement_id'], $rewardAdMedia, null, $rewardAdRefLink, null, null, null, $rewardAdReward);

                        } else if ($advCategory == 5) {

                            $this->insertAdvertisementMedia($reqData['advertisement_id'], $homeBannerMedia, null, $homeBannerRefLink, null, null, $homeBannerAdPosition);

                        }
                    }
                }
            }

            if (count($deletedCategory)) {
                $advIdsArr = CadAdvertisement::where('campaign_id', $campaign->id)
                    ->whereIn('category_id', $deletedCategory)
                    ->pluck('id')
                    ->all();

                $isDelete = CadAdvertisement::where('campaign_id', $campaign->id)
                    ->whereIn('category_id', $deletedCategory)
                    ->delete();

                $advMediaLink = CadAdvertisementMedia::whereIn('advertisement_id', $advIdsArr)
                    ->pluck('media_link')
                    ->all();

                $this->deleteFile($advMediaLink);
                $isDel = CadAdvertisementMedia::whereIn('advertisement_id', $advIdsArr)->delete();
                // dd($isDel, $advIds);
            }

        } catch (\Throwable $th) {
            DB::rollback();
            // dd($th);
            return redirect()->back()->with([
                'alertType' => 'error',
                'message'   => 'Unsuccessful to update advertisement!',
            ]);
        }

        if (storage_path('app/public/temp/' . Auth::user()->id)) {
            $isDelete = Storage::deleteDirectory('public/temp/' . Auth::user()->id);
        }

        DB::commit();
        return redirect('adv')->with([
            'alertType' => 'success',
            'message'   => 'Advertisement Updated Successfully!',
        ]);
    }

    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $advCamp   = CadAdvertismentCampaign::where('id', $id)->delete();
            $advIdsArr = CadAdvertisement::where('campaign_id', $id)->pluck('id')->all();

            $this->advertisementDelete($id, $advIdsArr);

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('failed', 'Unable to Delete');
        }
        DB::commit();
        return redirect()->back()->with('success', 'Advertisement Deleted Successfully!');

    }

    public function advertisementDelete($campaignId, $advIds)
    {
        CadAdvertisement::where('campaign_id', $campaignId)->delete();

        CadAdvertisementDetails::whereIn('advertisement_id', $advIds)->delete();
        CadTimeSlot::whereIn('advertisement_id', $advIds)->delete();
        CadImpression::whereIn('advertisement_id', $advIds)->delete();

        $advMedia = CadAdvertisementMedia::whereIn('advertisement_id', $advIds)->pluck('media_link')->all();

        $this->deleteFile($advMedia);
        CadAdvertisementMedia::whereIn('advertisement_id', $advIds)->delete();
    }

    public function deleteFile($mediaLink)
    {
        foreach ($mediaLink as $key => $link) {
            if (file_exists($link)) {
                FIleHandler::deleteFile($link);
            }
        }
    }

    public function insertAdvertisementMedia($advId, $adMedia, $adType = null, $adRefLink, $percent = null, $percent_to_time = null, $position = null, $reward = null, $time = null)
    {
        $insertData['advertisement_id'] = $advId;

        foreach ($adMedia as $key => $ad) {

            $mime = $ad->getClientMimeType();
            if (strstr($mime, "video/")) {
                $insertData['media_type'] = 'video';
            } else if (strstr($mime, "image/")) {
                $insertData['media_type'] = 'image';
            }

            $insertData['media_link']   = FIleHandler::uploadFiles($ad);
            $insertData['referal_link'] = $adRefLink[$key];

            if (!empty($percent[$key])) {
                $insertData['time_percent']           = $percent[$key];
                $percentRate                          = $percent[$key] != '' ? $percent[$key] : 1;
                $insertData['time_percent_to_second'] = ($percent_to_time / 100) * $percentRate;
            }

            if (!empty($position[$key])) {
                $insertData['position'] = $position[$key];
            }

            if (!empty($reward[$key])) {
                $insertData['reward'] = $reward[$key];
            }

            if (!empty($time[$key])) {
                $insertData['play_time'] = $time[$key];
            }

            if (!empty($adType[$key])) {
                $insertData['ad_type'] = $adType[$key];
            }

            $isCreate = CadAdvertisementMedia::create($insertData);
        }
    }

    public function updateAdvertisementMedia($advId, $adMedia, $adType = null, $adRefLink, $percent = null, $percent_to_time = null, $position = null, $reward = null, $time = null, $advMediaIds = null)
    {
        $updateData['advertisement_id'] = $advId;
        $deletedKeys                    = array_diff($advMediaIds, array_keys($adMedia));

        foreach ($adMedia as $key => $ad) {

            $updateData['referal_link'] = $adRefLink[$key];

            if (!empty($percent[$key])) {
                $updateData['time_percent']           = $percent[$key];
                $percentRate                          = $percent[$key] != '' ? $percent[$key] : 1;
                $updateData['time_percent_to_second'] = ($percent_to_time / 100) * $percentRate;
            }

            if (!empty($position[$key])) {
                $updateData['position'] = $position[$key];
            }

            if (!empty($reward[$key])) {
                $updateData['reward'] = $reward[$key];
            }

            if (!empty($time[$key])) {
                $updateData['play_time'] = $time[$key];
            }

            if (!empty($adType[$key])) {
                $updateData['ad_type'] = $adType[$key];
            }

            if (is_string($ad)) {

                $updateData['media_link'] = $ad;
                $mime                     = mime_content_type($ad);

                if (strstr($mime, "video/")) {
                    $updateData['media_type'] = 'video';
                } else if (strstr($mime, "image/")) {
                    $updateData['media_type'] = 'image';
                }

            } else {
                $mime = $ad->getClientMimeType();
                if (strstr($mime, "video/")) {
                    $updateData['media_type'] = 'video';
                } else if (strstr($mime, "image/")) {
                    $updateData['media_type'] = 'image';
                }

                $updateData['media_link'] = FIleHandler::uploadFiles($ad);
            }

            CadAdvertisementMedia::updateOrCreate(['id' => $key, 'advertisement_id' => $advId], $updateData);
        }

        if (count($deletedKeys)) {
            foreach ($deletedKeys as $mediaId) {
                $advMediaInfo = CadAdvertisementMedia::where(['id' => $mediaId, 'advertisement_id' => $advId])->first();
                FIleHandler::deleteFile($advMediaInfo->media_link);
                $isDelete = $advMediaInfo->delete();
            }
        }
    }

    public function creatingPostionArray($positionSlot, $currentPosition = null)
    {
        $data = [];
        foreach ($positionSlot as $key => $value) {
            if ($currentPosition !== null && $value->adv_position != $currentPosition) {
                array_push($data, $value->adv_position);
            } else if ($currentPosition == null) {
                array_push($data, $value->adv_position);
            }
        }
        return $data;
    }

    public function getAdvData($id, $userId, $forEdit = false)
    {
        $cadCampaign   = CadAdvertismentCampaign::getById($id, $userId);
        $City          = City::getAll();
        $State         = State::getAll();
        $Country       = Country::getAll();
        $advertisement = $cadCampaign->advertisement->first();
        $totalUsers    = Users::count();

        $cat_ids = array();
        foreach ($cadCampaign->advertisement as $key => $adv) {

            array_push($cat_ids, $adv->advertisementCategory->advertisement_category_id);
            $cat_name = $adv->advertisementCategory->advertisement_categories_name;

            foreach ($adv->advertisementMedia as $index => $advMedia) {

                $advMediaData[$cat_name][$index]['media_id']     = $advMedia->id;
                $advMediaData[$cat_name][$index]['media_name']   = FileHandler::getFileBaseName($advMedia->media_link);
                $advMediaData[$cat_name][$index]['ad_type']      = $advMedia->ad_type;
                $advMediaData[$cat_name][$index]['media_link']   = $advMedia->media_link;
                $advMediaData[$cat_name][$index]['referal_link'] = $advMedia->referal_link;
                $advMediaData[$cat_name][$index]['time_percent'] = $advMedia->time_percent;
                $advMediaData[$cat_name][$index]['position']     = $advMedia->position;
                $advMediaData[$cat_name][$index]['reward']       = $advMedia->reward;
            }
        }

        $data = array(
            'campaign_id'        => $cadCampaign->id,
            'adv_id'             => $advertisement->id,
            'campaign_name'      => $cadCampaign->campaign_name,
            'campaign_type_name' => $cadCampaign->campaign_type->campaign_type_name,
            'campaign_type_id'   => $cadCampaign->campaign_type->campaign_type_id,
            'brand_title'        => $advertisement->brand_title,
            'brand_logo'         => $advertisement->brand_logo,
            'user_id'            => $advertisement->user_id,
            'adv_type'           => $advertisement->adv_type,
            'cat_ids'            => $cat_ids,
            'feed_adv_type'      => $advertisement->feed_adv_type,
            'start_date'         => Carbon::parse($advertisement->start_date)->format('d-m-Y'),
            'end_date'           => Carbon::parse($advertisement->end_date)->format('d-m-Y'),
            'start_time'         => $advertisement->timeSlot->start_time,
            'end_time'           => $advertisement->timeSlot->end_time,
            'budget'             => $advertisement->budget,
            'rewards_amount'     => $advertisement->rewards_amount,
            'is_active'          => $advertisement->is_active,
            'title'              => $advertisement->title,
            'desc'               => $advertisement->desc,
            'min_age'            => $advertisement->advertisementDetails->min_age,
            'max_age'            => $advertisement->advertisementDetails->max_age,
            'age_range'          => $advertisement->advertisementDetails->age_range,
            'country_id'         => $advertisement->advertisementDetails->country_id,
            'state_id'           => $advertisement->advertisementDetails->state_id,
            'city_id'            => $advertisement->advertisementDetails->city_id,
            'advertisement'      => !empty($advMediaData) ? $advMediaData : array(),
            'Cities'             => $City,
            'States'             => $State,
            'Countries'          => $Country,
            'totalUsers'         => number_format($totalUsers),
        );

        if ($forEdit == true) {
            $campaignType     = CadAdvertisementCampaignType::getAll();
            $cadUser          = CadUser::getAllUserForAdv();
            $cadAdvCategories = CadAdvertisementCategories::getAll();
            $cadAdvType       = CadAdvertisementType::getAll();
            $favoriteStores   = Store::get();
            $favoriteCategory = Category::get();

            $data['favorite_store_ids']         = $advertisement->favorite_store_ids;
            $data['favorite_category_ids']      = $advertisement->favorite_category_ids;
            $data['daily_impression']           = $advertisement->impression->daily_impression;
            $data['lifetime_impression']        = $advertisement->impression->lifetime_impression;
            $data['CampaignType']               = $campaignType;
            $data['CadUsers']                   = $cadUser;
            $data['CadAdvertisementCategories'] = $cadAdvCategories;
            $data['cadAdvertisementTypes']      = $cadAdvType;
            $data['favoriteStores']             = $favoriteStores;
            $data['favoriteCategory']           = $favoriteCategory;
        }

        // dd($data['city_id'], unserialize($data['city_id']));

        return $data;
    }

    /**
     *
     * Loading all dependency data of create and update page
     *
     * @param
     *  $advId
     *  $userId
     *
     */
    public function advertisementModelGroup($advId = null, $userId = null)
    {
        $campaignType     = CadAdvertisementCampaignType::getAll();
        $City             = City::getAll();
        $Country          = Country::getAll();
        $State            = State::getAll();
        $CadUser          = CadUser::getAllUserForAdv();
        $CadAdvCategories = CadAdvertisementCategories::getAll();
        $CadAdvType       = CadAdvertisementType::getAll();
        $favoriteStores   = Store::get();
        $favoriteCategory = Category::get();
        $totalUsers       = Users::count();

        // $getNativePosition = $this->creatingPostionArray(CadAdvertisement::getNativePosition());
        // $coupons         = Coupon::getAll();

        if ($advId && $userId != null) {
            $campaign = CadAdvertismentCampaign::getById($advId, $userId);
        } else {
            $campaign = '';
        }

        return [
            'campaign'                   => $campaign,
            'CampaignType'               => $campaignType,
            'Countries'                  => $Country,
            'Cities'                     => $City,
            'States'                     => $State,
            'CadUsers'                   => $CadUser,
            'CadAdvertisementCategories' => $CadAdvCategories,
            'CadAdvertisementTypes'      => $CadAdvType,
            'favoriteStores'             => $favoriteStores,
            'favoriteCategory'           => $favoriteCategory,
            'totalUsers'                 => number_format($totalUsers, 0, '', ','),
            // 'coupons'                    => $coupons,
            // 'getNativePosition'          => $getNativePosition,
        ];
    }

    public function checkTimeSlot(Request $request)
    {
        $start_time = date("H:i:s", strtotime($request->startTime));
        $end_time   = date("H:i:s", strtotime($request->endTime));

        $startDate = date('Y-m-d', strtotime($request->startDate));
        $endDate   = date('Y-m-d', strtotime($request->endDate));

        $forUpdate = $request->forUpdate;

        $timeslots = CadAdvertisement::with('timeslot', 'advertisementMedia')
            ->where('start_date', '>=', $startDate)
            ->where('start_date', '<=', $endDate)
            ->where(function ($q) use ($forUpdate) {
                if (!is_null($forUpdate)) {
                    $q->where('campaign_id', '!=', $forUpdate);
                }
            })
            ->get();

        $reserveSlot      = array();
        $advMediaPosition = array();
        foreach ($timeslots as $timeslot) {

            foreach ($timeslot->advertisementMedia as $media) {
                $advMediaPosition["key_" . $timeslot->category_id][] = [
                    'position' => $media->position,
                    'ad_type'  => $media->ad_type,
                ];
            }

            array_push($reserveSlot, [
                'date'       => $timeslot->start_date,
                'start_time' => $timeslot->timeslot->start_time,
                'end_time'   => $timeslot->timeslot->end_time,
            ]);
        }

        $isAvailable = true;
        sort($reserveSlot);
        foreach ($reserveSlot as $key => $slot) {

            if ($start_time >= $slot['start_time'] && $start_time <= $slot['end_time']) {
                $isAvailable = false;
            } elseif ($end_time >= $slot['start_time'] && $end_time <= $slot['end_time']) {
                $isAvailable = false;
            } elseif ($start_time <= $slot['start_time'] && $end_time >= $slot['end_time']) {
                $isAvailable = false;
            }
        }

        if (!$isAvailable) {

            foreach ($reserveSlot as $key => $value) {
                $reserveSlot[$key]['date']       = date("d-m-Y", strtotime($value['date']));
                $reserveSlot[$key]['start_time'] = date("g:i a", strtotime($value['start_time']));
                $reserveSlot[$key]['end_time']   = date("g:i a", strtotime($value['end_time']));
            }

            return [
                'status'       => false,
                'reserveSlot'  => $reserveSlot,
                'adv_position' => $advMediaPosition,
            ];

        } else {
            return ['status' => true];
        }
    }
}
