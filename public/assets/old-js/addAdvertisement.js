

// Creating Feed Advertisement media block
/* document.getElementById("addInputFeedField").addEventListener("click", function (e) {
    const imageSectionFeedWrapper = document.getElementById("imageSectionFeed");
    // let imgFeedBlockLength = document.getElementsByClassName("nativeAdBlock").length;
    // var length = Number($('.nativeAdBlock').length) + 1;

    var length = Number($('.nativeAdBlock').length);

    if ($('#native_ad_type' + (length - 1)).val() == "") {
        Swal.fire({
            'icon': 'warning',
            'title': "Warning",
            'text': "Please select ad type before adding new row."
        });
        return;
    }

    // length += 1;


    var imgFeedBlock = document.createElement("div");
    imgFeedBlock.className = "form-row nativeAdBlock";
    imgFeedBlock.innerHTML = `
        <div class="col-md-3" style="padding-left: 20px;">
            <div class="custom-file">
                <div id="imageSection">
                    <input
                        type="file" class="custom-file-input native_ad_img"
                        id="native_ad_img${length}" name="nativeAdImg[]" accept="image/*"
                        onchange="loadFile('nativeImgLoad${length}')">
                    <label class="custom-file-label" for="native_ad_img">Choose file</label>
                </div>
            </div>
        </div>
        <div class="col-md-1 pl-0 pr-0 text-center">
            <a href="javascript:void(0)" type="button" class="btn btn-outline-primary" onclick="fnPreviewNativeAd(${length})"><i class="fe fe-smartphone"></i></a>
        </div>
        <div class="col-md-2">
            <div class="controls">
                <select class="form-control nativeAdType native_ad_type" name="native_ad_type[]" id="native_ad_type${length}" onchange="percentCheckByAdTypeNative(${length}, this.value)">
                    <option value="">Select Type</option>
                    <option value="1">Promotions</option>
                    <option value="2">Bons Plans</option>
                    <option value="3">Codes Promo</option>
                </select>
            </div>
        </div>
        <div class="col-md-2">
            <input type="url" id="nativeAdRefLink${length}" name="nativeAdRefLink[]" placeholder="Enter Referal Link" class="form-control" value="">
        </div>
        <div class="col-md-2">
            <input type="number" id="nativeAdPercent${length}" name="nativeAdPercent[]" placeholder="Enter time percent" class="form-control inputAdvFeedShowTime nativeAdPercent" min="1" value="" onkeyup="nativeAdPercentCalculation(this, ${length})" onkeyup="nativeAdPercentCalculation(this, ${length})">
        </div>
        <div class="col-md-2">
            <input type="number" id="adv_position_slot${length}" name="nativeAdPosition[]" placeholder="Ad position" class="form-control nativeAdPosition" min="1" value="" onkeyup="fnCheckNativeAdPosition(${length})">
            <span class="mt-1 text-danger" id="positionError${length}"></span>
        </div>
        <span id="removedFeed_${length}" class="removedfeed" style="cursor: pointer;margin-top: 8px;position:absolute;" onclick="fnRemoveNative(${length})">
            <i class="fa fa-close"></i>
        </span>
        <img src="" id="nativeImgLoad${length}" width="10%" height="auto">
    `
    imageSectionFeedWrapper.appendChild(imgFeedBlock);
    var removed = document.getElementsByClassName("removedfeed");
    removeLinks(removed);

    // let showTimeElm = document.getElementsByClassName('inputAdvFeedShowTime');
    // checkShowPercentage(showTimeElm);
}); */

//new native ad section 23-jun-21
$('#addInputFeedField').click(function () {

    var length = Number($('.count_native_ads').length);
    var prviousAd = (length - 1);

    if ($('#native_ad_type' + prviousAd).val() == "") {
        Swal.fire({
            'icon': 'warning',
            'title': "Warning",
            'text': "Please select ad type before adding new row."
        });
        return;
    }

    if ($('#native_ad_img' + prviousAd).val() == '') {
        Swal.fire({
            'icon': 'warning',
            'title': "Warning",
            'text': "Please select image."
        });
        return;
    }
    else if ($('#native_ad_type' + prviousAd).val() == '') {
        Swal.fire({
            'icon': 'warning',
            'title': "Warning",
            'text': "Please select ad type."
        });
        return;
    }
    else if ($('#nativeAdPercent' + prviousAd).val() == '') {
        Swal.fire({
            'icon': 'warning',
            'title': "Warning",
            'text': "Please enter percent."
        });
        return;
    }
    else if ($('#adv_position_slot' + prviousAd).val() == '') {
        Swal.fire({
            'icon': 'warning',
            'title': "Warning",
            'text': "Please enter position."
        });
        return;
    }
    /* else if ($('#nativeStartTime' + prviousAd).val() == '') {
        Swal.fire({
            'icon': 'warning',
            'title': "Warning",
            'text': "Please select start time."
        });
        return;
    }
    else if ($('#nativeEndTime' + prviousAd).val() == '') {
        Swal.fire({
            'icon': 'warning',
            'title': "Warning",
            'text': "Please select end time."
        });
        return;
    } */

    // btn remove show
    $('.native_remove_btn').show();

    $('#native_ads').append(
        `<div class="count_native_ads p-md-2 p-sm-1" style="border: 1px solid rgba(83, 16, 240, 0.57)" id="nativeAd_${length}">

            <a href="javascript:void(0)" class="native_remove_btn float-right" onclick="fnRemoveNativeAd(${length})"><i class="fa fa-close"></i></a>

            <div class="form-group">
                <label class="control-label">Upload Image</label>
                <input type="file" class="form-control" data-height="185" accept="image/*" id="native_ad_img${length}" name="nativeAdImg[]" onchange="validateNative(${length})">
            </div>

            <div class="form-row">
                <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                        <label class="control-label">Ad Type</label>
                        <div class="controls">
                            <select class="form-control nativeAdType native_ad_type" name="native_ad_type[]" id="native_ad_type${length}" onchange="percentCheckByAdTypeNative(${length}, this.value);validateNative(${length});">
                                <option value="">Select Type</option>
                                <option value="1" {{ old('native_ad_type') == 1 ? 'selected' : '' }}>Promotions</option>
                                <option value="2" {{ old('native_ad_type') == 2 ? 'selected' : '' }}>Bons Plans</option>
                                <option value="3" {{ old('native_ad_type') == 3 ? 'selected' : '' }}>Codes Promo</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                        <label for="">Reference Url</label>
                        <input type="text" id="nativeAdRefLink${length}" name="nativeAdRefLink[]" placeholder="Enter Referal Link" class="form-control" value="" onblur="validateNative(${length})">
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="">Percent</label>
                        <input type="number" id="nativeAdPercent${length}" name="nativeAdPercent[]" placeholder="Enter time percent" class="form-control inputAdvFeedShowTime nativeAdPercent" min="1" value="" onkeyup="nativeAdPercentCalculation(this, ${length});validateNative(${length});" required>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label class="control-label">Position</label>
                        <div class="controls">
                            <input type="number" id="adv_position_slot${length}" name="nativeAdPosition[]" class="form-control nativeAdPosition" min="1" placeholder="Ad position" onkeyup="validateNative(${length});">
                        </div>
                        <span class="mt-1 text-danger" id="positionError${length}"></span>
                    </div>
                </div>
            </div>
        </div>`
    );

    // fnCheckNativeAdPosition(${length});

    $('#native_ad_img' + length).addClass('dropify');
    $('.dropify').dropify();

    //start and end time
    /* <div class="form-row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="label-control">Start Time</label>
                <input type="text" id="nativeStartTime${length}" name="start_time_native[]" class="form-control timepicker timeKeydown" value="" placeholder="Please select start time">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">End Time</label>
                <input type="text" id="nativeEndTime${length}" name="end_time_native[]" class="form-control  timepicker timeKeydown" value="" placeholder="Please select start time">
            </div>
        </div>
    </div> */
})

function fnRemoveNative(row) {
    $("#inputAdvFeedShowTime0").val(Number($("#inputAdvFeedShowTime0").val()) + Number($("#inputAdvFeedShowTime" + row).val()));
}

function fnRemoveNativeAd(row) {
    $('#nativeAd_' + row).remove();

    var length = Number($('.count_native_ads').length);
    if (length == 1) {
        $('.native_remove_btn').hide();
    }
}

// old
/* $('#addInputStoryField').click(function () {
    var length = Number($('.storyBlock').length) + 1;

    $('#imageSectionStory').append(
        `<div class="form-row storyBlock mt-3" id="storyBlock_${length}">
            <div class="col-md-7" style="padding-left: 20px;">
                <div class="custom-file">
                    <div id="imageSection">
                        <input
                            type="file" class="custom-file-input story_ad_img"
                            id="story_ad_img${length}" name="storyAdMedia[]" accept="video/*,image/*"
                            onchange="loadFile('storyImgLoad${length}')">
                        <label class="custom-file-label" for="story_ad_img">Choose file</label>
                    </div>
                </div>
            </div>
            <div class="col-md-1 pl-0 pr-0 text-center">
                <div>
                    <a href="javascript:void(0)" type="button" class="btn btn-outline-primary" id="previewStoryButton${length}" onclick="fnPreviewStoryAd(${length})"><i class="fe fe-smartphone"></i></a>
                </div>
            </div>
            <div class="col-md-4">
                <input type="url" id="storyLinkId${length}" name="storyAdRefLink[]" placeholder="Enter Referal Link" class="form-control" value="">
            </div>
            <span style="cursor: pointer;margin-top: 8px;position:absolute;" onclick="fnRemoveStory(${length})">
                <i class="fa fa-close"></i>
            </span>
            <img src="" id="storyImgLoad${length}" width="10%" height="auto">
        </div>`
    );
}) */

$('#addInputStoryField').click(function() {

    var length = Number($('.count_story_ads').length);
    var prviousAd = (length - 1);

    if ($('#story_ad_img' + prviousAd).val() == '') {
        Swal.fire({
            'icon': 'warning',
            'title': "Warning",
            'text': "Please select image."
        });
        return;
    }
    else if ($('#storyLinkId' + prviousAd).val() == '') {
        Swal.fire({
            'icon': 'warning',
            'title': "Warning",
            'text': "Please enter ref link."
        });
        return;
    }
    /* else if ($('#nativeStartTime' + prviousAd).val() == '') {
        Swal.fire({
            'icon': 'warning',
            'title': "Warning",
            'text': "Please select start time."
        });
        return;
    }
    else if ($('#nativeEndTime' + prviousAd).val() == '') {
        Swal.fire({
            'icon': 'warning',
            'title': "Warning",
            'text': "Please select end time."
        });
        return;
    } */

    $('.story_remove_btn').show();

    $('#story_ads').append(
        `<div class="count_story_ads p-md-2 p-sm-1" id="storyBlock_${length}" style="border: 1px solid rgba(83, 16, 240, 0.57)">

            <a href="javascript:void(0)" class="story_remove_btn float-right" onclick="fnRemoveStory(${length})"><i class="fa fa-close"></i></a>

            <div class="form-group">
                <label class="control-label">Upload Image/Video</label>
                <input type="file" class="form-control" data-height="185" accept="image/*" value="" id="story_ad_img${length}" name="storyAdMedia[]" onchange="validateStory(${length})">
            </div>

            <div class="form-group">
                <label for="">Reference Url</label>
                <input type="text" id="storyLinkId${length}" name="storyAdRefLink[]" placeholder="Enter Referal Link" class="form-control" onkeyup="validateStory(${length})">
            </div>


        </div>`
    );

    $('#story_ad_img' + length).addClass('dropify');
    $('.dropify').dropify();

    // staart time end time html
   /*  <div class="form-row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="label-control">Start Time</label>
                <input type="text" id="inputStartTime${length}" name="start_time_story[]" class="form-control timepicker timeKeydown" value="" placeholder="Please select start time">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">End Time</label>
                <input type="text" id="inputEndTime${length}" name="end_time_story[]" class="form-control  timepicker timeKeydown" value="" placeholder="Please select start time">
            </div>
        </div>
    </div> */
});

function fnRemoveStory(row) {
    $('#storyBlock_' + row).remove();

    var length = Number($('.count_story_ads').length);
    if (length == 1) {
        $('.story_remove_btn').hide();
    }
}

/* $('#addInputBannerField').click(function () {

    var length = Number($('.bannerItems').length);

    if ($('#banner_ad_type' + (length - 1)).val() == "") {
        Swal.fire({
            'icon': 'warning',
            'title': "Warning",
            'text': "Please select ad type before adding new row."
        });
        return;
    }

    // length += 1;

    $('#bannerSection').append(
        `<div class="form-row bannerItems mt-3" id="bannerBlock_${length}">
            <div class="col-md-4" style="padding-left: 20px;">
                <div class="custom-file">
                    <div id="imageSection">
                        <input
                            type="file" class="custom-file-input banner_ad_img"
                            id="banner_ad_img${length}" name="bannerAdImg[]" accept="image/*"
                            onchange="loadFile('bannerImgLoad${length}')">
                        <label class="custom-file-label" for="banner_ad_img${length}">Choose file</label>
                    </div>
                </div>
            </div>
            <div class="col-md-1 pl-0 pr-0 text-center">
                <div>
                    <a href="javascript:void(0)" type="button" class="btn btn-outline-primary" id="previewBannerButton${length}" onclick="fnPreviewBannerAd(${length})"><i class="fe fe-smartphone"></i></a>
                </div>
            </div>
            <div class="col-md-2">
                <div class="controls">
                    <select class="form-control bannerAdType banner_ad_type" name="banner_ad_type[]" id="banner_ad_type${length}" onChange="percentCheckByAdType(${length}, this.value)">
                        <option value="">Select Type</option>
                        <option value="1">Promotions</option>
                        <option value="2">Bons Plans</option>
                        <option value="3">Codes Promo</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <input type="url" id="bannerAdRefLink${length}" name="bannerAdRefLink[]" placeholder="Enter Referal Link" class="form-control" value="">
            </div>
            <div class="col-md-2">
                <input type="number" id="bannerAdPercent${length}" name="bannerAdPercent[]" placeholder="Enter time percent" class="form-control inputAdvFeedShowTime bannerAdPercent" min="1" value="" onkeyup="bannerAdPercentCalculation(this, ${length})">
            </div>
            <span style="cursor: pointer;margin-top: 8px;position:absolute;" onclick="fnRemoveBanner(${length})">
                <i class="fa fa-close"></i>
            </span>
            <img src="" id="bannerImgLoad${length}" width="10%" height="auto">
        </div>`
    );
}) */

$('#addInputBannerField').click(function() {

    var length = Number($('.count_banner_ads').length);
    var prviousAd = (length - 1);

    if ($('#banner_ad_img' + prviousAd).val() == '') {
        Swal.fire({
            'icon': 'warning',
            'title': "Warning",
            'text': "Please select image."
        });
        return;
    }
    else if ($('#bannerAdRefLink' + prviousAd).val() == '') {
        Swal.fire({
            'icon': 'warning',
            'title': "Warning",
            'text': "Please enter ref link."
        });
        return;
    }
    else if ($('#banner_ad_type' + prviousAd).val() == '') {
        Swal.fire({
            'icon': 'warning',
            'title': "Warning",
            'text': "Please select ad type."
        });
        return;
    }
    else if ($('#bannerAdPercent' + prviousAd).val() == '') {
        Swal.fire({
            'icon': 'warning',
            'title': "Warning",
            'text': "Please enter ad percentage."
        });
        return;
    }

    $('.banner_remove_btn').show();

    $("#banner_ads").append(
        `<div class="count_banner_ads p-md-2 p-sm-1" style="border: 1px solid rgba(83, 16, 240, 0.57)" id="bannerBlock_${length}">

            <a href="javascript:void(0)" class="banner_remove_btn float-right" onclick="fnRemoveBanner(${length})"><i class="fa fa-close"></i></a>

            <div class="form-group">
                <label class="control-label">Upload Image</label>
                <input type="file" class="dropify banner_ad_img" data-height="185" accept="image/*" value="" id="banner_ad_img${length}" name="bannerAdImg[]" onchange="validateBanner(${length})" />
            </div>

            <div class="form-group">
                <label for="">Reference Url</label>
                <input type="text" id="bannerAdRefLink${length}" name="bannerAdRefLink[]" placeholder="Enter Referal Link" class="form-control" value="" onblur="validateBanner(${length})">
            </div>

            <div class="form-row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Ad Type</label>
                        <div class="controls">
                            <select class="form-control bannerAdType banner_ad_type" name="banner_ad_type[]" id="banner_ad_type${length}" onchange="percentCheckByAdType(${length}, this.value);validateBanner(0);">
                                <option value="">Select Type</option>
                                <option value="1" {{ old('banner_ad_type') == 1 ? 'selected' : '' }}>Promotions</option>
                                <option value="2" {{ old('banner_ad_type') == 2 ? 'selected' : '' }}>Bons Plans</option>
                                <option value="3" {{ old('banner_ad_type') == 3 ? 'selected' : '' }}>Codes Promo</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Percent</label>
                        <input type="number" id="bannerAdPercent${length}" name="bannerAdPercent[]" placeholder="Enter time percent" class="form-control bannerAdPercent" min="1" value="" onkeyup="bannerAdPercentCalculation(this, ${length});validateBanner(${length});">
                    </div>
                </div>
            </div>


        </div>`
    );

    $('#banner_ad_img' + length).addClass('dropify');
    $('.dropify').dropify();

    /* <div class="form-row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="label-control">Start Time</label>
                <input type="text" id="inputStartTime${length}" name="start_time_banner[]" class="form-control timepicker timeKeydown" value="" placeholder="Please select start time">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">End Time</label>
                <input type="text" id="inputEndTime${length}" name="end_time_banner[]" class="form-control  timepicker timeKeydown" value="" placeholder="Please select start time">
            </div>
        </div>
    </div> */
});


function fnRemoveBanner(row) {
    $("#bannerAdPercent0").val(Number($("#bannerAdPercent0").val()) + Number($("#bannerAdPercent" + row).val()));
    $('#bannerBlock_' + row).remove();

    var length = Number($('.count_banner_ads').length);
    if (length == 1) {
        $('.banner_remove_btn').hide();
    }
}

/* $('#addInputHomeBannerField').click(function () {
    var length = Number($('.homeBannerBlock').length);

    if (length == 1) {
        $('#homeBannerAddButton').hide();
    }

    if (length == 2) {
        Swal.fire({
            'icon': 'warning',
            'title': "Warning",
            'text': "You can't add more than two home banners."
        });
        return;
    }

    length += 1;

    $('#imageSectionHomeBanner').append(
        `<div class="form-row homeBannerBlock mt-3" id="homeBannerBlock_${length}">
            <div class="col-md-6" style="padding-left: 20px;">
                <div class="custom-file">
                    <div id="imageSection">
                        <input  type="file" class="custom-file-input home_banner_img"
                            id="home_banner_img${length}" name="homeBannerMedia[]" accept="image/*"
                            onchange="loadFile('homeBannerImgLoad${length}')">
                        <label class="custom-file-label" for="story_ad_img">Choose file</label>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <input type="url" id="homeBannerId${length}" name="homeBannerRefLink[]" placeholder="Enter Referal Link" class="form-control" value="">
            </div>
            <div class="col-md-2">
                <input type="number" id="homeBannerAdPosition${length}" name="homeBannerAdPosition[]" class="form-control homeBannerAdPosition" min="1" placeholder="Ad position">
            </div>
            <span style="cursor: pointer;margin-top: 8px;position:absolute;" onclick="fnRemoveHomeBanner(${length})">
                <i class="fa fa-close"></i>
            </span>
            <img src="" id="homeBannerImgLoad${length}" width="10%" height="auto">
        </div>`
    );
}) */

$('#addInputHomeBannerField').click(function () {

    var length = Number($('.count_homeBanner_ads').length);
    var prviousAd = length - 1;

    if ($('#home_banner_img' + prviousAd).val() == '') {
        Swal.fire({
            'icon': 'warning',
            'title': "Warning",
            'text': "Please select image."
        });
        return;
    }
    else if ($('#homeBannerRefLinkId' + prviousAd).val() == '') {
        Swal.fire({
            'icon': 'warning',
            'title': "Warning",
            'text': "Please enter ref link."
        });
        return;
    }
    else if ($('#homeBannerAdPosition' + prviousAd).val() == '') {
        Swal.fire({
            'icon': 'warning',
            'title': "Warning",
            'text': "Please enter ref link."
        });
        return;
    }

    if (length == 1) {
        $('#homeBannerAddButton').hide();
    }

    if (length == 2) {
        Swal.fire({
            'icon': 'warning',
            'title': "Warning",
            'text': "You can't add more than two home banners."
        });
        return;
    }

    $('.home_banner_remove_btn').show();

    $('#homeBanner_ads').append(
        `<div class="count_homeBanner_ads p-md-2 p-sm-1" style="border: 1px solid rgba(83, 16, 240, 0.57)" id="homeBannerBlock_${length}">

            <a href="javascript:void(0)" class="home_banner_remove_btn float-right" onclick="fnRemoveHomeBanner(${length})"><i class="fa fa-close"></i></a>

            <div class="form-group">
                <label class="control-label">Upload Image</label>
                <input type="file" class="dropify form-control" data-height="185" accept="image/*" value="" id="home_banner_img${length}" name="homeBannerMedia[]" onchange="validateHomeBanner(${length})" />
            </div>

            <div class="form-row">
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="form-group">
                            <label for="">Reference Url</label>
                            <input type="text" id="homeBannerRefLinkId${length}" name="homeBannerRefLink[]" placeholder="Enter Referal Link" class="form-control" value=""
                            onblur="validateHomeBanner(${length})">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Position</label>
                        <input type="number" id="homeBannerAdPosition${length}" name="homeBannerAdPosition[]" class="form-control homeBannerAdPosition" min="1" placeholder="Ad position"
                        onkeyup="validateHomeBanner(${length})">
                    </div>
                </div>
            </div>


        </div>`


    );

    $('#home_banner_img' + length).addClass('dropify');
    $('.dropify').dropify();

    /* <div class="form-row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="label-control">Start Time</label>
                <input type="text" id="inputStartTime${length}" name="start_time" class="form-control timepicker timeKeydown" value="" placeholder="Please select start time">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">End Time</label>
                <input type="text" id="inputEndTime${length}" name="end_time" class="form-control  timepicker timeKeydown" value="" placeholder="Please select start time">
            </div>
        </div>
    </div> */
})

function fnRemoveHomeBanner(row) {

    $('#homeBannerBlock_' + row).remove();

    if (Number($('.count_homeBanner_ads').length) < 2) {
        $('#homeBannerAddButton').show('fast');
        $('.home_banner_remove_btn').hide();
    }
}

// chack all field is filled in native for preview
function validateNative(id) {

    var isValidateAll = true;

    if ($('#native_ad_type' + id).val() == "") {
        isValidateAll = false;
    }

    if ($('#native_ad_img' + id).val() == '') {
        isValidateAll = false;
    }

    if ($('#native_ad_type' + id).val() == '') {
        isValidateAll = false;
    }

    if ($('#nativeAdPercent' + id).val() == '') {
        isValidateAll = false;
    }

    if ($('#adv_position_slot' + id).val() == '') {
        isValidateAll = false;
    }

    //previewShow
    if (isValidateAll) {
        fnPreviewNativeAdNew(id)
    }
}

// chack all field is filled in story for preview
function validateStory(id) {

    var isValidateAll = true;

    if ($('#story_ad_img' + id).val() == '') {
        isValidateAll = false;
    }
    else if ($('#storyLinkId' + id).val() == '') {
        isValidateAll = false;
    }

    //previewShow
    if (isValidateAll) {
        fnPreviewStoryAdNew(id)
    }
}

// chack all field is filled in banner for preview
function validateBanner(id) {

    var isValidateAll = true;

    if ($('#banner_ad_img' + id).val() == '') {
        isValidateAll = false;
    }
    else if ($('#bannerAdRefLink' + id).val() == '') {
        isValidateAll = false;
    }
    else if ($('#banner_ad_type' + id).val() == '') {
        isValidateAll = false;
    }
    else if ($('#bannerAdPercent' + id).val() == '') {
        isValidateAll = false;
    }

    //previewShow
    if (isValidateAll) {
        fnPreviewBannerAdNew(id)
    }
}

// chack all field is filled in home banner for preview
function validateHomeBanner(id) {

    var isValidateAll = true;

    if ($('#home_banner_img' + id).val() == '') {
        isValidateAll = false;
    }
    else if ($('#homeBannerRefLinkId' + id).val() == '') {
        isValidateAll = false;
    }
    else if ($('#homeBannerAdPosition' + id).val() == '') {
        isValidateAll = false;
    }

    //previewShow
    if (isValidateAll) {
        fnPreviewHomeBannerAdNew(id)
    }
}

//new preview fn
function fnPreviewNativeAdNew(row) {

    if ($('#brand_logo').val() == '') {
        Swal.fire({
            'icon': 'warning',
            'title': "Warning",
            'text': "Please select brand logo."
        });
        return false;
    }
    else if ($('#title').val() == '') {
        Swal.fire({
            'icon': 'warning',
            'title': "Warning",
            'text': "Please enter title."
        });
        return false;
    }

    var fd = new FormData();
    var file = $('#native_ad_img' + row).get(0).files;
    var logo = $('#brand_logo').get(0).files;
    var type = 'native';
    var position = $('#adv_position_slot' + row).val();
    var link = $('#nativeAdRefLink' + row).val();
    var title = $('#title').val();

    fd.append('file', file[0])
    fd.append('logo', logo[0])
    fd.append('type', type)
    fd.append('position', position)
    fd.append('link', link)
    fd.append('title', title)

    sendDataForPreviewNew(fd, 'previewLoaderNative', 'phone-iframe-native-ad')

    return true;
}

function fnPreviewStoryAdNew(row) {

    if ($('#title').val() === '') {
        Swal.fire({
            'icon': 'warning',
            'title': 'Warning',
            'text': 'Please enter title.'
        });

        return false;
    }

    var fd = new FormData();

    var file = $('#story_ad_img' + row).get(0).files;
    var type = 'story';
    var link = $('#storyLinkId' + row).val();
    var title = $('#title').val();

    fd.append('file', file[0])
    fd.append('type', type)
    fd.append('link', link)
    fd.append('title', title)

    sendDataForPreviewNew(fd, 'previewLoaderStory', 'phone-iframe-story-ad')

    return true;
}

function fnPreviewBannerAdNew(row) {

    var fd = new FormData();

    var type = 'banner';
    var file = $('#banner_ad_img' + row).get(0).files;
    var position = $('#bannerAdPosition' + row).val();
    var link = $('#bannerAdRefLink' + row).val();

    fd.append('type', type)
    fd.append('file', file[0])
    fd.append('position', position)
    fd.append('link', link)

    sendDataForPreviewNew(fd, 'previewLoaderBanner', 'phone-iframe-banner-ad')

    return true;
}

function fnPreviewHomeBannerAdNew(row) {

    var fd = new FormData();

    var type = 'home_banner';
    var file = $('#home_banner_img' + row).get(0).files;
    var position = $('#homeBannerAdPosition' + row).val();
    var link = $('#homeBannerRefLinkId' + row).val();

    fd.append('type', type)
    fd.append('file', file[0])
    fd.append('position', position)
    fd.append('link', link)

    sendDataForPreviewNew(fd, 'previewLoaderHomeBanner', 'phone-iframe-homeBanner-ad')

    return true;
}

function sendDataForPreviewNew(fd, loader, phonFrame) {

    $('#' + loader).css('display', 'block')

    $.ajax({
        type: "post",
        url: BASE_URL + 'preview',
        data: fd,
        contentType: false,
        processData: false,
        success: function (data) {

            $('#' + loader).css('display', 'none')
            if (data.alert == 'success') {

                if ($('#' + phonFrame).prop('src')) {
                    $('#' + phonFrame).removeAttr('src')
                }

                $('#' + phonFrame).attr('src', BASE_URL + 'previewShow');
            }
        },
        error: function (error) {
            $('#' + loader).css('display', 'none')
            console.log('error');
        }
    });
}



$('#addInputRewardField').click(function () {

    var length = $('.rewardBlock').length;

    $('#rewardSection').append(
        `<div class="form-row rewardBlock mt-3" id="rewardBlock_${length}">
            <div class="col-md-5" style="padding-left: 20px;">
                <div class="custom-file">
                    <div id="imageSection">
                        <input
                            type="file" class="custom-file-input reward_ad_media"
                            id="reward_ad_media" name="rewardAdMedia[]" accept="video/*,image/*">
                        <label class="custom-file-label" for="reward_ad_media">Choose file</label>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <input type="text" id="inputAdvFeedLink" name="rewardAdRefLink[]" placeholder="Enter Referal Link" class="form-control" value="">
            </div>
            <div class="col-md-3">
                <input type="number" id="adv_position_slot${length}" name="rewardAdReward[]" class="form-control" min="1" placeholder="Reward">
            </div>
            <span style="cursor: pointer;margin-top: 8px;position:absolute;" onclick="fnRemoveReward(${length})">
                <i class="fas fa-fw fa-times"></i>
            </span>
        </div>`
    );
})

function fnRemoveReward(row) {
    $('#rewardBlock_' + row).remove();
}

function fnCheckPercentageForAdType(row) {
    $(".banner_ad_type").each(function () {
        if ($(this).val() != $('#banner_ad_type' + row).val()) {
            $("#bannerAdPercent" + row).val(100);
            console.log('if');
        }
    })
    if ($('#banner_ad_type' + row).hasClass('banner_ad_type_' + $('#banner_ad_type' + row).val())) {
        $(this).addClass('banner_ad_type_' + $('#banner_ad_type' + row).val())
    }
}

//submit button validation
$('#btnSubmitCampaign').click(function () {

    var selectedCat = $('#adv_cat').val();
    var mediaArr = [];
    var validation = true;
    var msg = '';

    var nativeTotalPercent = 0;
    var bannerTotalPercent = 0;

    if (selectedCat.length > 0) {

        for (let i = 0; i < selectedCat.length; i++) {

            if (selectedCat[i] == 1) {

                $('.native_ad_img').each(function () {
                    if (!$(this).val()) {
                        validation = false;
                        mediaArr.push("native ad media")
                    }
                });

                // $('.nativeAdPercent').each(function () {
                //     nativeTotalPercent += Number($(this).val());
                // })

                // if (nativeTotalPercent != 0 && nativeTotalPercent != 100) {
                //     msg = "Native total percent (time) must be equal 100.";
                // }

                var nativeAdType = [];
                var nativeAdPos = [];

                $('.nativeAdType').each(function () {
                    nativeAdType.push($(this).val())
                });

                $('.nativeAdPosition').each(function () {
                    nativeAdPos.push($(this).val())
                });

                for (let i = 0; i < nativeAdType.length; i++) {
                    if (nativeAdType[i] == 3 && (Number(nativeAdPos[i]) % 4) == 0) {
                        msg = "Native ad type codes promo position can't be multiples of 4. So, the value of " + nativeAdPos[i] + " need to chanage.";
                    }
                }
            }
            else if (selectedCat[i] == 2) {
                var arr = [];
                $('.story_ad_img').each(function () {
                    console.log(!$(this).val());
                    arr.push($(this).val())
                    if ($(this).val() !== "" && !$(this).val()) {
                        validation = false;
                        mediaArr.push("story ad media")
                    }
                });
                console.log(arr);

            }
            else if (selectedCat[i] == 3) {
                $('.banner_ad_img').each(function () {
                    if (!$(this).val()) {
                        validation = false;
                        mediaArr.push("banner ad media")
                    }
                });

                // $('.bannerAdPercent').each(function () {
                //     bannerTotalPercent += Number($(this).val());
                // })

                // if (bannerTotalPercent != 0 && bannerTotalPercent != 100) {
                //     msg = "Banner total percent (time) must be equal 100.";
                // }

                var bannerAdType = [];
                var bannerAdPos = [];

                $('.bannerAdType').each(function () {
                    bannerAdType.push($(this).val())
                });

                $('.bannerAdPosition').each(function () {
                    bannerAdPos.push($(this).val())
                });

                for (let i = 0; i < bannerAdType.length; i++) {
                    if (bannerAdType[i] == 3 && (Number(bannerAdPos[i]) % 4) == 0) {
                        msg = "Banner ad type codes promo position can't be multiples of 4. So, the value of " + bannerAdPos[i] + " need to chanage.";
                    }
                }

                for (let i = 0; i < bannerAdPos.length; i++) {
                    if (bannerAdPos[i] > 3) {
                        msg = "There are only (1-3) position for banner ad.";
                    }
                }
            }
            else if (selectedCat[i] == 4) {
                $('.reward_ad_media').each(function () {
                    if (!$(this).val()) {
                        validation = false;
                        mediaArr.push("reward ad media")
                    }
                });
            }
            else {
                if (!$('#brand_logo').val()) {
                    validation = false;
                    mediaArr.push("brand logo")
                }
            }
        }

        if (!validation) {
            msg = "Please select " + mediaArr.join(', ');
        }

        if ($('#adv_type').val() == '') {
            msg = "Please select advertisement type!"
        }

        if (msg == '') {
            localStorage.removeItem('positions');
            $('#advForm').submit();
        } else {
            Swal.fire({
                'icon': 'warning',
                'title': "Warning",
                'text': msg
            });
        }

    } else {
        Swal.fire({
            'icon': 'warning',
            'title': "Warning",
            'text': 'Please select advertisement category'
        });
    }
})
//end submit button validation
