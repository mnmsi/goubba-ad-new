<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Library\DateTimeFormatter;
use App\Library\FIleHandler;

//Custom Library
use App\Models\CadAdvertisement;
use App\Models\CadAdvertisementCampaignType;
use App\Models\CadAdvertisementCategories;

//Custom Request
use App\Models\CadAdvertisementDetails;

//Models
use App\Models\CadAdvertisementImage;
use App\Models\CadAdvertisementType;
use App\Models\CadAdvertisementVideo;
use App\Models\CadAdvertismentCampaign;
use App\Models\CadImpression;
use App\Models\CadTimeSlot;
use App\Models\CadUser;
use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdvertisementController_old extends Controller
{
    public function index()
    {
        $userId        = Auth::user()->role_id;
        $campaignLists = CadAdvertismentCampaign::getAll($userId);
        return view('pages.advertisement.index', ['campaignLists' => $campaignLists]);
    }

    public function create()
    {
        $data = $this->advertisementModelGroup();
        return view('pages.advertisement.create', $data);
    }

    public function store(Request $request)
    {
        $startDate = $request->inputStartDate;
        $endDate   = $request->inputEndDate;

        $startTime = $request->inputStartTime;
        $endTime   = $request->inputEndTime;

        $campaignName    = $request->inputCampaignName;
        $campaignsTypeId = $request->adv_campaign;

        // Uploading Brand Logo File
        if ($request->hasfile('inputBrandLogo')) {
            $brandImageUrl = FIleHandler::uploadFiles($request->inputBrandLogo);
        }
        if (empty($campaignsTypeId)) {
            return redirect()->back()->with('failed', 'Advertisement Creation Failed');
        }
        DB::beginTransaction();
        try {

            foreach ($campaignsTypeId as $campaignId) {
                // adding campaign
                $CadAdvertismentCampaign                   = new CadAdvertismentCampaign();
                $CadAdvertismentCampaign->user_id          = $request->adv_user;
                $CadAdvertismentCampaign->campaign_name    = $campaignName;
                $CadAdvertismentCampaign->campaign_type_id = $campaignId;

                $CadAdvertismentCampaign->save();

                $lastCampaignInsertId = $CadAdvertismentCampaign->id;

                //adding advertisement
                $advCatagories = $request->adv_cat;
                foreach ($advCatagories as $categoryId) {
                    $CadAdvertisement = new CadAdvertisement();
                    $advObj           = $this->advertisementData(
                        $CadAdvertisement, $request->inputBrandName, $brandImageUrl, $lastCampaignInsertId,
                        $categoryId, 1, $request->adv_user, $request->inputAdvTitle, $request->inputAdvDesc, $request->adv_feed_type,
                        $request->adv_position_slot, $startDate, $endDate,
                        $request->inputRewardPoints, $request->inputBudget, $request->adv_active_status
                    );

                    $advObj->save();
                    $lastAdvertisementInsertId = $advObj->id;

                    // adding time slot data
                    $CadTimeSlot = new CadTimeSlot();
                    $timeSlotObj = $this->timeSlotData($CadTimeSlot, $startTime, $endTime, $lastAdvertisementInsertId);
                    $timeSlotObj->save();

                    //Adding advertisement details
                    $ageRange                = $request->inputAgeMin . "-" . $request->inputAgeMax;
                    $CadAdvertisementDetails = new CadAdvertisementDetails();
                    $detailsObj              = $this->advDetailsData(
                        $CadAdvertisementDetails, $request->inputAgeMin, $request->inputAgeMax,
                        $request->adv_country, $request->adv_city, $request->adv_state,
                        $lastAdvertisementInsertId
                    );
                    $detailsObj->save();

                    //Adding impression details
                    $CadImpression = new CadImpression();
                    $impressionObj = $this->impressionData($CadImpression, $request->inputDailyImpression, $request->inputLifetimeImpression, $lastAdvertisementInsertId);
                    $impressionObj->save();

                    //uploading media file and insert in database
                    if ($categoryId == 1) {
                        // Uploading Multiple Image File
                        // if($request->hasfile('inputAdvFeedimage'))
                        // {
                        $timeToStaring = DateTimeFormatter::getTimeDifference($startDate, $endDate, $startTime, $endTime);
                        $feedDataArr   = $request->inputAdvFeed;
                        foreach ($feedDataArr as $feedItems) {
                            if (isset($feedItems['feedImage']) && $feedItems['feedImage'] != '') {
                                $feedTimePercent = $feedItems['feedTime'] != '' ? $feedItems['feedTime'] : 1;
                                $individualTime  = ($timeToStaring / 100) * $feedTimePercent;

                                $CadAdvertisementFeedImage = new CadAdvertisementImage();
                                $feedImageUpload           = $this->imagefileUpload(
                                    $CadAdvertisementFeedImage, $feedItems['feedImage'], $feedItems['feedReferalLink'],
                                    $feedTimePercent, $individualTime,
                                    $lastAdvertisementInsertId
                                );
                                $feedImageUpload->save();
                            }
                        }
                        // $feedLink = $request->inputAdvFeedLink;
                        // foreach($request->inputAdvFeedimage as $feedImageFile) {
                        //     $CadAdvertisementFeedImage = new CadAdvertisementImage();
                        //     $feedImageUpload = $this->imagefileUpload($CadAdvertisementFeedImage,$feedImageFile,$feedLink,$lastAdvertisementInsertId);
                        //     $feedImageUpload->save();
                        // }
                        // }
                    } else if ($categoryId == 2) {
                        // Uploading Image File
                        if ($request->hasfile('inputAdvStoryimage')) {
                            $storyImgLink = $request->inputAdvStoryImgLink;
                            foreach ($request->inputAdvStoryimage as $storyImageFile) {
                                $CadAdvertisementStoryImage = new CadAdvertisementImage();
                                $storyImageUpload           = $this->imagefileUpload($CadAdvertisementStoryImage, $storyImageFile, $storyImgLink, null, null, $lastAdvertisementInsertId);
                                $storyImageUpload->save();
                            }
                        }

                        // Uploading Video File
                        if ($request->hasfile('inputAdvStoryVideo')) {
                            $storyVdoLink = $request->inputAdvStoryVideoLink;
                            foreach ($request->inputAdvStoryVideo as $storyVideoFile) {
                                $CadAdvertisementStoryVideo = new CadAdvertisementVideo();
                                $storyVideoUpload           = $this->videofileUpload($CadAdvertisementStoryVideo, $storyVideoFile, $storyVdoLink, $lastAdvertisementInsertId);
                                $storyVideoUpload->save();
                            }
                        }
                    } else if ($categoryId == 3) {
                        // Uploading Multiple Image File
                        if ($request->hasfile('inputAdvBannerimage')) {
                            $bannerImgLink = $request->inputAdvBannerImageLink;
                            foreach ($request->inputAdvBannerimage as $bannerImageFile) {
                                $CadAdvertisementBannerImage = new CadAdvertisementImage();
                                $bannerImageUpload           = $this->imagefileUpload($CadAdvertisementBannerImage, $bannerImageFile, $bannerImgLink, null, null, $lastAdvertisementInsertId);
                                $bannerImageUpload->save();
                            }
                        }
                    } else if ($categoryId == 4) {
                        // Uploading Image File
                        if ($request->hasfile('inputAdvRewardimage')) {
                            $CadAdvertisementRewardImage = new CadAdvertisementImage();
                            $rewardImageUpload           = $this->imagefileUpload($CadAdvertisementRewardImage, $request->inputAdvRewardimage, $request->inputAdvRewardImgLink, null, null, $lastAdvertisementInsertId);
                            $rewardImageUpload->save();
                        }

                        // Uploading video File
                        if ($request->hasfile('inputAdvRewardVideo')) {
                            $CadAdvertisementRewardVideo = new CadAdvertisementVideo();
                            $rewardVideoUpload           = $this->videofileUpload($CadAdvertisementRewardVideo, $request->inputAdvRewardVideo, $request->inputAdvRewardVideoLink, $lastAdvertisementInsertId);
                            $rewardVideoUpload->save();
                        }
                    }
                }
            }
        } catch (\Exception $e) {
            echo $e;
            die;
            DB::rollback();
            return redirect()->back()->with('failed', 'Advertisement Creation Failed');
        }
        DB::commit();
        return redirect()->back()->with('success', 'Advertisement Created Successfully!');
    }

    public function show($id)
    {
        $userId = Auth::user()->role_id;

        $cadCampaign = CadAdvertismentCampaign::getById($id, $userId);
        $City        = City::getAll();
        $State       = State::getAll();
        $Country     = Country::getAll();
        return view('pages.advertisement.details',
            [
                'cadCampaign' => $cadCampaign,
                'Cities'      => $City,
                'States'      => $State,
                'Countries'   => $Country,
            ]
        );
    }

    public function edit($id)
    {
        $userId = Auth::user()->role_id;
        $data   = $this->advertisementModelGroup($id, $userId);
        // return     $campaign = CadAdvertismentCampaign::getById($id,$userId);
        return view('pages.advertisement.update', $data);
    }
    
    public function update(Request $request)
    {

        $startDate = $request->inputStartDate;
        $endDate   = $request->inputEndDate;

        $startTime = $request->inputStartTime;
        $endTime   = $request->inputEndTime;

        // GETTING CAMPAIGN
        $campaignId = $request->inputCampaignUpdateId;
        $campaign   = CadAdvertismentCampaign::find($campaignId);

        // Uploading Brand Logo File
        $brandImageUrl = null;
        if ($request->hasfile('inputBrandLogo')) {
            $brandImageUrl = $this->uploadFiles($request->inputBrandLogo);
        }

        // PREPERING CAMPAIGN DATA TO UPDATE
        $campaign->user_id       = $request->adv_user;
        $campaign->campaign_name = $request->inputCampaignName;

        DB::beginTransaction();
        try {
            //SAVING CAMPAIGN DATA
            $campaign->save();

            $deleteAdvIds = [];
            if ($request->inputDeletdeAdvertisementId != '') {
                $deleteAdvIds = explode(",", $request->inputDeletdeAdvertisementId);
                $this->advertisementDelete($deleteAdvIds);
            }

            $advertisements = CadAdvertisement::where('campaign_id', $campaignId)->get();
            foreach ($advertisements as $advertisement) {
                if (!in_array($advertisement->id, $deleteAdvIds)) {
                    $advertisement->brand_title = $request->inputBrandName;
                    if ($brandImageUrl != null) {
                        $advertisement->brand_logo = $brandImageUrl;
                    }
                    $advertisement->user_id        = $request->adv_user;
                    $advertisement->title          = $request->inputAdvTitle;
                    $advertisement->desc           = $request->inputAdvDesc;
                    $advertisement->adv_position   = $request->adv_position_slot;
                    $advertisement->feed_adv_type  = $request->adv_feed_type;
                    $advertisement->start_date     = $startDate;
                    $advertisement->end_date       = $endDate;
                    $advertisement->rewards_amount = $request->inputRewardPoints;
                    $advertisement->budget         = $request->inputBudget;
                    $advertisement->is_active      = $request->adv_active_status;

                    $advertisement->save();

                    // updating time slot data
                    $CadTimeSlot = CadTimeSlot::where('advertisement_id', $advertisement->id)->first();
                    $timeSlotObj = $this->timeSlotData($CadTimeSlot, $startTime, $endTime, $advertisement->id);
                    $timeSlotObj->save();

                    //updating advertisement details
                    $CadAdvertisementDetails = CadAdvertisementDetails::where('advertisement_id', $advertisement->id)->first();
                    $detailsObj              = $this->advDetailsData(
                        $CadAdvertisementDetails, $request->inputAgeMin, $request->inputAgeMax,
                        $request->adv_country, $request->adv_city, $request->adv_state,
                        $advertisement->id
                    );
                    $detailsObj->save();

                    // update impression
                    $CadImpression = CadImpression::where('advertisement_id', $advertisement->id)->first();
                    $impressionObj = $this->impressionData($CadImpression, $request->inputDailyImpression, $request->inputLifetimeImpression, $advertisement->id);
                    $impressionObj->save();

                    //media update

                    // Feed media
                    if ($advertisement->category_id == 1) {
                        // removing feed media if exists
                        if ($request->inputRemoveFeedImg != '') {
                            $fileNames = explode(",", $request->inputRemoveFeedImg);
                            $this->deleteFile($fileNames, $advertisement->id);
                        }

                        $timeToStaring = DateTimeFormatter::getTimeDifference($startDate, $endDate, $startTime, $endTime);
                        if (!empty($request->inputAdvFeedUpdate)) {
                            $updatedFeed = $request->inputAdvFeedUpdate;

                            foreach ($updatedFeed as $value) {
                                $cadAdvFeedUpdateImage = CadAdvertisementImage::where('id', $value['feedImage'])->first();

                                if ($cadAdvFeedUpdateImage) {
                                    $updatedFeedTimePercent = $value['feedTime'] != '' ? $value['feedTime'] : 1;
                                    $updatedIndividualTime  = ($timeToStaring / 100) * $updatedFeedTimePercent;

                                    $feedUpdateImage = $this->imagefileUpload(
                                        $cadAdvFeedUpdateImage, null, $value['feedReferalLink'],
                                        $updatedFeedTimePercent, $updatedIndividualTime,
                                        $advertisement->id
                                    );
                                    $feedUpdateImage->save();
                                }
                            }
                        }

                        $feedDataArr = $request->inputAdvFeed;
                        foreach ($feedDataArr as $feedItems) {
                            if (isset($feedItems['feedImage']) && $feedItems['feedImage'] != '') {

                                $feedReferalLink = $feedItems['feedReferalLink'];
                                $feedTimePercent = $feedItems['feedTime'];
                                $individualTime  = ($timeToStaring / 100) * $feedTimePercent;
                                $feedImageUrl    = $feedItems['feedImage'];

                                $CadAdvertisementFeedImage = new CadAdvertisementImage();

                                $feedImageUpload = $this->imagefileUpload(
                                    $CadAdvertisementFeedImage, $feedImageUrl, $feedReferalLink,
                                    $feedTimePercent, $individualTime,
                                    $advertisement->id
                                );
                                $feedImageUpload->save();
                            }
                        }
                    }

                    // Story Media
                    if ($request->inputRemoveStoryImg != '') {
                        $fileNames = explode(",", $request->inputRemoveStoryImg);
                        $this->deleteFile($fileNames, $advertisement->id);
                    }
                    // adding story category media
                    if ($advertisement->category_id == 2) {
                        // Uploading Image File
                        if ($request->hasfile('inputAdvStoryimage')) {
                            $storyImgLink = $request->inputAdvStoryImgLink;
                            foreach ($request->inputAdvStoryimage as $storyImageFile) {
                                $CadAdvertisementStoryImage = new CadAdvertisementImage();
                                $storyImageUpload           = $this->imagefileUpload($CadAdvertisementStoryImage, $storyImageFile, $storyImgLink, null, null, $advertisement->id);
                                $storyImageUpload->save();
                            }
                        }

                        // Uploading Video File
                        if ($request->hasfile('inputAdvStoryVideo')) {
                            $storyVdoLink = $request->inputAdvStoryVideoLink;
                            foreach ($request->inputAdvStoryVideo as $storyVideoFile) {
                                $CadAdvertisementStoryVideo = new CadAdvertisementVideo();
                                $storyVideoUpload           = $this->videofileUpload($CadAdvertisementStoryVideo, $storyVideoFile, $storyVdoLink, $advertisement->id);
                                $storyVideoUpload->save();
                            }
                        }
                    }

                    // Banner Media
                    if ($request->inputRemoveBannerImg != '') {
                        $fileNames = explode(",", $request->inputRemoveBannerImg);
                        $this->deleteFile($fileNames, $advertisement->id);
                    }
                    // adding banner media
                    if ($advertisement->category_id == 3) {
                        // Uploading Multiple Image File
                        if ($request->hasfile('inputAdvBannerimage')) {
                            $bannerImgLink = $request->inputAdvBannerImageLink;
                            foreach ($request->inputAdvBannerimage as $bannerImageFile) {
                                $CadAdvertisementBannerImage = new CadAdvertisementImage();
                                $bannerImageUpload           = $this->imagefileUpload($CadAdvertisementBannerImage, $bannerImageFile, $bannerImgLink, null, null, $advertisement->id);
                                $bannerImageUpload->save();
                            }
                        }
                    }

                    // Reward Media
                    if ($advertisement->category_id == 4) {
                        // Uploading Image File
                        if ($request->hasfile('inputAdvRewardimage')) {
                            // delete only if they upload a photo
                            if ($request->inputRemoveRewardImg != '') {
                                $fileNames = explode(",", $request->inputRemoveRewardImg);
                                $this->deleteFile($fileNames, $advertisement->id);
                            }

                            $CadAdvertisementRewardImage = new CadAdvertisementImage();
                            $rewardImageUpload           = $this->imagefileUpload($CadAdvertisementRewardImage, $request->inputAdvRewardimage, $request->inputAdvRewardImgLink, null, null, $advertisement->id);
                            $rewardImageUpload->save();
                        }

                        // Uploading video File
                        if ($request->hasfile('inputAdvRewardVideo')) {
                            $CadAdvertisementRewardVideo = new CadAdvertisementVideo();
                            $rewardVideoUpload           = $this->videofileUpload($CadAdvertisementRewardVideo, $request->inputAdvRewardVideo, $request->inputAdvRewardVideoLink, $advertisement->id);
                            $rewardVideoUpload->save();
                        }
                    }
                }
            }

        } catch (\Exception $e) {
            echo $e;
            die;
            DB::rollback();
            return redirect()->back()->with('failed', 'Unable to update');
        }
        DB::commit();
        return redirect()->back()->with('success', 'Advertisement Updated Successfully!');
    }

    public function delete($id)
    {
        $userId   = Auth::user()->role_id;
        $campaign = CadAdvertismentCampaign::getById($id, $userId);

        $advArr = [];
        foreach ($campaign->advertisement as $adv) {
            array_push($advArr, $adv->id);
        }
        DB::beginTransaction();
        try {
            CadAdvertismentCampaign::where('id', $id)->delete();

            $this->advertisementDelete($advArr);
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('failed', 'Unable to Delete');
        }
        DB::commit();
        return redirect()->back()->with('success', 'Advertisement Deleted Successfully!');

    }

    public function advertisementDelete($advIds)
    {
        foreach ($advIds as $advId) {
            $userId           = Auth::user()->role_id;
            $cadAdvertisement = CadAdvertisement::getById($advId, $userId);

            CadAdvertisement::where('id', $advId)->delete();
            CadAdvertisementDetails::where('advertisement_id', $advId)->delete();
            CadTimeSlot::where('advertisement_id', $advId)->delete();
            CadImpression::where('advertisement_id', $advId)->delete();

            if ($cadAdvertisement->category_id == 1) {
                foreach ($cadAdvertisement->advertisementImage as $images) {
                    $this->deleteFile($images->image_link, $advId);
                }
            }

            if ($cadAdvertisement->category_id == 2) {
                foreach ($cadAdvertisement->advertisementImage as $images) {
                    $this->deleteFile($images->image_link, $advId);
                }
            }

            if ($cadAdvertisement->category_id == 3) {
                foreach ($cadAdvertisement->advertisementImage as $images) {
                    $this->deleteFile($images->image_link, $advId);
                }
            }

            if ($cadAdvertisement->category_id == 4) {
                foreach ($cadAdvertisement->advertisementImage as $images) {
                    $this->deleteFile($images->image_link, $advId);
                }
            }
        }
    }

    // helper method

    public function deleteFile($fileNames, $advIid)
    {
        if (is_array($fileNames)) {
            foreach ($fileNames as $key => $value) {
                CadAdvertisementImage::where('advertisement_id', $advIid)
                    ->where('image_link', $value)
                    ->delete();
                $fileBaseName = FIleHandler::getFileBaseName($value);
            }
        } else {
            CadAdvertisementImage::where('advertisement_id', $advIid)
                ->where('image_link', $fileNames)
                ->delete();
            $fileBaseName = FIleHandler::getFileBaseName($fileNames);
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
        $CadUser      = CadUser::getAllUserForAdv();
        $campaignType = CadAdvertisementCampaignType::getAll();
        $City         = City::getAll();
        // $coupons         = Coupon::getAll();
        $Country           = Country::getAll();
        $State             = State::getAll();
        $CadAdvCategories  = CadAdvertisementCategories::getAll();
        $CadAdvType        = CadAdvertisementType::getAll();
        $getNativePosition = $this->creatingPostionArray(CadAdvertisement::getNativePosition());

        if ($advId && $userId != null) {
            $campaign = CadAdvertismentCampaign::getById($advId, $userId);
        } else {
            $campaign = '';
        }
        return [
            'campaign'                   => $campaign,
            'CadAdvertisementCategories' => $CadAdvCategories,
            'CadAdvertisementTypes'      => $CadAdvType,
            'CadUsers'                   => $CadUser,
            'CampaignType'               => $campaignType,
            'Countries'                  => $Country,
            'Cities'                     => $City,
            // 'coupons'                    => $coupons,
            'States'                     => $State,
            'getNativePosition'          => $getNativePosition,
        ];
    }

    /**
     * Advertisement table Data
     * @param
     *      @table object
     *      @brandName
     *      @brandLogoUrl
     *      @campaignId
     *      @categoryId
     *      @typeId
     *      @userId
     *      @title
     *      @desc
     *      @positionSlot
     *      @startDate
     *      @endDate
     *      @rewardAmount
     *      @budget
     *      @activeStatus
     *      @advertisementID
     */
    public function advertisementData(
        $advObj, $brandName, $brandLogoUrl = null,
        $campaignId, $categoryId, $typeId, $userId,
        $title, $desc, $feedType, $positionSlot, $startDate,
        $endDate, $rewardAmount, $budget, $activeStatus
    ) {
        $advObj->brand_title = $brandName;
        if ($brandLogoUrl != null) {
            $advObj->brand_logo = $brandLogoUrl;
        }

        $advObj->campaign_id    = $campaignId;
        $advObj->category_id    = $categoryId;
        $advObj->type_id        = $typeId;
        $advObj->user_id        = $userId;
        $advObj->title          = $title;
        $advObj->desc           = $desc;
        $advObj->adv_position   = $positionSlot;
        $advObj->feed_adv_type  = $feedType;
        $advObj->start_date     = $startDate;
        $advObj->end_date       = $endDate;
        $advObj->rewards_amount = $rewardAmount;
        $advObj->budget         = $budget;
        $advObj->is_active      = $activeStatus;

        return $advObj;
    }

    /**
     *
     * Time Slot table Data
     * @param
     *      @table object
     *      @startTime
     *      @endTime
     *      @advertisementID (FK)
     */
    public function timeSlotData($timeSlotObj, $startTime, $endTime, $advertisementId)
    {
        $timeSlotObj->advertisement_id = $advertisementId;
        $timeSlotObj->start_time       = $startTime;
        $timeSlotObj->end_time         = $endTime;

        return $timeSlotObj;
    }

    /**
     *
     * Advertisement Details table Data
     * @param
     *      @table object
     *      @minAge
     *      @maxAge
     *      @country
     *      @country
     *      @state
     *      @advertisementID (FK)
     */
    public function advDetailsData(
        $detailsObj, $minAge, $maxAge, $country, $city, $state, $advertisementId
    ) {
        $ageRange = $minAge . "-" . $maxAge;

        $detailsObj->advertisement_id = $advertisementId;
        $detailsObj->age_range        = $ageRange;
        $detailsObj->country_id       = $country;
        $detailsObj->city_id          = json_encode($city);
        $detailsObj->state_id         = json_encode($state);

        return $detailsObj;
    }

    /**
     *
     * Impression table Data
     * @param
     *      @table object
     *      @dailyImpression
     *      @totalImpression
     *      @advertisementID (FK)
     */
    public function impressionData($impressionObj, $dailyImpression, $totalImpression, $advertisementId)
    {
        $impressionObj->advertisement_id    = $advertisementId;
        $impressionObj->daily_impression    = $dailyImpression;
        $impressionObj->lifetime_impression = $totalImpression;
        return $impressionObj;
    }

    /**
     *
     * Image table Data
     * @param
     *      @table object
     *      @file
     *      @referalLink
     *      @advertisementID (FK)
     */
    public function imagefileUpload($imgObject, $imageFile = null, $referalLink, $timeInPercent = null, $time = null, $advertisementId)
    {
        $imgObject->advertisement_id = $advertisementId;
        if ($imageFile != null) {
            $rewardImageUrl        = FIleHandler::uploadFiles($imageFile);
            $imgObject->image_link = $rewardImageUrl;
        }
        $imgObject->referal_link = $referalLink == '' ? '' : $referalLink;
        $imgObject->time_percent = $timeInPercent;
        $imgObject->time_second  = $time;
        return $imgObject;
    }

    /**
     *
     * Video table Data
     * @param
     *      @table object
     *      @file
     *      @referalLink
     *      @advertisementID (FK)
     */
    public function videofileUpload($videoObject, $videoFile, $referalLink, $advertisementId)
    {
        $rewardVideoUrl                = FIleHandler::uploadFiles($videoFile);
        $videoObject->advertisement_id = $advertisementId;
        $videoObject->video_link       = $rewardVideoUrl;
        $videoObject->referal_link     = $referalLink == '' ? '' : $referalLink;
        return $videoObject;
    }
}
