function fnCategoryClick (that) {

    if (that.value == 1) {
        $('#feedMediaParent').slideToggle();
        $('#previewLoaderNative').css('display', 'block')

        setTimeout(() => {
            $('#previewLoaderNative').css('display', 'none')
            if (!$('#phone-iframe-native-ad').prop('src')) {
                $('#phone-iframe-native-ad').attr('src', BASE_URL + 'previewShow');
            }
        }, 1000);

    } else if (that.value == 2) {

        $('#storyMediaParent').slideToggle()
        $('#previewLoaderStory').css('display', 'block')


        setTimeout(() => {
            $('#previewLoaderStory').css('display', 'none')
            if (!$('#phone-iframe-story-ad').prop('src')) {
                $('#phone-iframe-story-ad').attr('src', BASE_URL + 'previewShow');
            }
        }, 1000);

    } else if (that.value == 3) {

        $('#bannerMediaParent').slideToggle();
        $('#previewLoaderBanner').css('display', 'block')

        setTimeout(() => {
            $('#previewLoaderBanner').css('display', 'none')
            if (!$('#phone-iframe-banner-ad').prop('src')) {
                $('#phone-iframe-banner-ad').attr('src', BASE_URL + 'previewShow');
            }
        }, 1000);

    } else if (that.value == 5) {

        $('#homeBannerParent').slideToggle()
        $('#previewLoaderHomeBanner').css('display', 'block')

        setTimeout(() => {
            $('#previewLoaderHomeBanner').css('display', 'none')
            if (!$('#phone-iframe-homeBanner-ad').prop('src')) {
                $('#phone-iframe-homeBanner-ad').attr('src', BASE_URL + 'previewShow');
            }
        }, 1000);

    } else if (that.value == 4) {
        $('#rewardMediaParent').slideToggle()
    }
}

function fnCategoryShow (id) {

    if (id == 1) {
        $('#feedMediaParent').slideToggle();
        $('#previewLoaderNative').css('display', 'block')

        setTimeout(() => {
            $('#previewLoaderNative').css('display', 'none')
            if (!$('#phone-iframe-native-ad').prop('src')) {
                $('#phone-iframe-native-ad').attr('src', BASE_URL + 'previewShow');
            }
        }, 1000);

    } else if (id == 2) {

        $('#storyMediaParent').slideToggle()
        $('#previewLoaderStory').css('display', 'block')


        setTimeout(() => {
            $('#previewLoaderStory').css('display', 'none')
            if (!$('#phone-iframe-story-ad').prop('src')) {
                $('#phone-iframe-story-ad').attr('src', BASE_URL + 'previewShow');
            }
        }, 1000);

    } else if (id == 3) {

        $('#bannerMediaParent').slideToggle();
        $('#previewLoaderBanner').css('display', 'block')

        setTimeout(() => {
            $('#previewLoaderBanner').css('display', 'none')
            if (!$('#phone-iframe-banner-ad').prop('src')) {
                $('#phone-iframe-banner-ad').attr('src', BASE_URL + 'previewShow');
            }
        }, 1000);

    } else if (id == 5) {

        $('#homeBannerParent').slideToggle()
        $('#previewLoaderHomeBanner').css('display', 'block')

        setTimeout(() => {
            $('#previewLoaderHomeBanner').css('display', 'none')
            if (!$('#phone-iframe-homeBanner-ad').prop('src')) {
                $('#phone-iframe-homeBanner-ad').attr('src', BASE_URL + 'previewShow');
            }
        }, 1000);

    } else if (id == 4) {
        $('#rewardMediaParent').slideToggle()
    }
}

function toogleRewardsInput(val) {
    return val.includes("2") || val.includes("3") ?
        $('#rewardPoint').show() :
        $('#rewardPoint').hide()
}

function toogleMediaSection(val) {
    if (Array.isArray(val)) {
        val.forEach(function (item) {
            if (item == 1) {
                $('#feedMediaParent').toggle()
            } else if (item == 2) {
                $('#storyMediaParent').toggle()
            } else if (item == 3) {
                $('#bannerMediaParent').toggle();
            } else if (item == 5) {
                $('#homeBannerParent').toggle()
            } else if (item == 4) {
                $('#rewardMediaParent').toggle()
            }
        });

    } else {
        if (val == 1) {
            $('#feedMediaParent').toggle()

            // if (document.getElementById('feedMediaParent').style.display == 'block') {
            //     if (document.getElementById('btnSubmitCampaign') != undefined) {
            //         document.getElementById('btnSubmitCampaign').disabled = true
            //     }
            // }
            // document.getElementById('inputAdvFeedLink').required = document.getElementById('feedMediaParent').style.display == 'block' ? true : false;
        } else if (val == 2) {
            $('#storyMediaParent').toggle()
            // document.getElementById('inputAdvStoryImgLink').required = document.getElementById('storyMediaParent').style.display == 'block' ? true : false;
            // document.getElementById('inputAdvStoryVideoLink').required = document.getElementById('storyMediaParent').style.display == 'block' ? true : false;
        } else if (val == 3) {
            $('#bannerMediaParent').toggle();
            // $('#rewardMediaParent').toggle();
            // document.getElementById('inputAdvBannerImageLink').required = document.getElementById('bannerMediaParent').style.display == 'block' ? true : false;
        } else if (val == 4) {
            $('#rewardMediaParent').toggle()
            // document.getElementById('inputAdvRewardImgLink').required = document.getElementById('rewardMediaParent').style.display == 'block' ? true : false;
            // document.getElementById('inputAdvRewardVideoLink').required = document.getElementById('rewardMediaParent').style.display == 'block' ? true : false;
        }
        else if (val == 5) {
            $('#homeBannerParent').toggle()
            // document.getElementById('inputAdvRewardImgLink').required = document.getElementById('rewardMediaParent').style.display == 'block' ? true : false;
            // document.getElementById('inputAdvRewardVideoLink').required = document.getElementById('rewardMediaParent').style.display == 'block' ? true : false;
        }
        return
    }
}

$('form').submit(function (ev, picker) {
    // [startDate, endDate] = $('.inputStartEndDateRange').val().split(' - ');
    // $(this).find('input[name="inputStartDate"]').val(startDate);
    // $(this).find('input[name="inputEndDate"]').val(endDate);
});

// $(document).ready(function () {
//     let selectedVal = $('#adv_cat').val();
//     console.log(selectedVal)
//     toogleMediaSection(selectedVal)

//     $('#adv_cat').multiselect({
//         nonSelectedText: 'Select Advertisement Category',
//         enableFiltering: true,
//         enableCaseInsensitiveFiltering: true,
//         buttonWidth: '99%',
//         onChange: function (option, checked, select) {
//             let selectedVal = $(option).val();
//             console.log(selectedVal)
//             toogleMediaSection(selectedVal)

//             // for update form
//             /*
//                 getting the advertisement id based on advertisement category
//             */
//             if (document.getElementById('inputDeletdeAdvertisementId') != undefined) {
//                 let dltAdvId = document.getElementById('inputDeletdeAdvertisementId');
//                 let valArr = [];

//                 if (dltAdvId.value != '') valArr.push(dltAdvId.value);

//                 if (selectedVal == 1) {
//                     valArr.push(document.getElementById('feedAdvertisementId').value)
//                 }

//                 if (selectedVal == 2) {
//                     valArr.push(document.getElementById('StoryAdvertisementId').value)
//                 }

//                 if (selectedVal == 3) {
//                     valArr.push(document.getElementById('rewardAdvertisementId').value)
//                 }

//                 if (selectedVal == 4) {
//                     valArr.push(document.getElementById('bannerAdvertisementId').value)
//                 }

//                 dltAdvId.value = valArr
//             }
//         },
//     });

//     // $('#advCity').multiselect({
//     //     nonSelectedText: 'Select City',
//     //     enableFiltering: true,
//     //     enableCaseInsensitiveFiltering: true,
//     //     buttonWidth:'99%',
//     // });

//     // $('#advCity').multiselect({
//     //     nonSelectedText: 'Select City',
//     //     enableFiltering: true,
//     //     includeSelectAllOption: true,
//     //     enableCaseInsensitiveFiltering: true,
//     //     buttonWidth: '99%',
//     // });
//     // $('#advState').multiselect({
//     //     nonSelectedText: 'Select State',
//     //     enableFiltering: true,
//     //     includeSelectAllOption: true,
//     //     enableCaseInsensitiveFiltering: true,
//     //     buttonWidth: '99%',
//     // });

//     $('#adv_campaign').multiselect({
//         nonSelectedText: 'Select Campaign',
//         enableFiltering: true,
//         enableCaseInsensitiveFiltering: true,
//         buttonWidth: '99%',
//         onChange: function (option, checked, select) {
//             let totalVal = $('#adv_campaign').val();
//             toogleRewardsInput(totalVal);
//         },
//     });

//     // $('#favorite_store').multiselect({
//     //     nonSelectedText: 'Select favorite store',
//     //     includeSelectAllOption: true,
//     //     enableFiltering: true,
//     //     enableCaseInsensitiveFiltering: true,
//     //     buttonWidth: '99%',
//     // });

//     // $('#favorite_category').multiselect({
//     //     nonSelectedText: 'Select favorite category',
//     //     includeSelectAllOption: true,
//     //     enableFiltering: true,
//     //     enableCaseInsensitiveFiltering: true,
//     //     buttonWidth: '99%',
//     // });
// });

// remove media blocks
const removeLinks = (elm) => {
    for (var i = 0; i < elm.length; i++) {
        elm[i].addEventListener("click", (e) => e.currentTarget.parentNode.remove(), false);
    }
}

// let showTimeElm = document.getElementsByClassName('inputAdvFeedShowTime')
// if (showTimeElm != undefined) {
//     checkShowPercentage(showTimeElm);
// }

// function checkShowPercentage(elm) {
//     for (let i = 0; i < elm.length; i++) {

//         elm[i].addEventListener("change", function (e) {
//             let count = 0;
//             for (let j = 0; j < elm.length; j++) {
//                 count += parseInt(elm[j].value);
//             }

//             if (count == 100) {
//                 document.getElementById('btnSubmitCampaign').disabled = false
//                 document.getElementById('percentageError').style.display = 'none'
//             } else if (count != 100) {
//                 document.getElementById('btnSubmitCampaign').disabled = true
//                 document.getElementById('percentageError').style.display = 'block'
//             }
//         })
//     }
// }


// if (document.getElementById("adv_position_slot") != undefined) {
//     document.getElementById("adv_position_slot").addEventListener("change", function (e) {
//         const feedTypeVal = document.getElementById('adv_feed_type').value;
//         let feedPositionVal = document.getElementById("adv_position_slot")
//         if (feedTypeVal == '') {
//             alert("please Select Feed Type");
//             feedPositionVal.value = ''
//         } else if (feedTypeVal == 3) {
//             if (feedPositionVal.value % 4 == 0) {
//                 feedPositionVal.value = ''
//                 alert("please Select different value")
//             }
//         }
//     });
// }

// $('#inputBrandLogo').change(function(e) {
//     $(this).next().text(e.target.files[0].name);
// });

// $('#customFile_inputAdvStoryimage').change(function(e) {
//     $(this).next().text(e.target.files[0].name);
// });

// $('#customFile_inputAdvFeedimage').change(function(e) {
//     $(this).next().text(e.target.files[0].name);
// });

// $('#customFile_inputAdvBannerimage').change(function(e) {
//     $(this).next().text(e.target.files[0].name);
// });

// $('#customFile_inputAdvStoryVideo').change(function(e) {
//     $(this).next().text(e.target.files[0].name);
//     checkFileDuration();
// });

$('input[type="file"]').change(function (e) {
    // inputBrandLogo
    $(this).next().text(e.target.files[0].name);

    if (e.target.id == 'inputBrandLogo') {
        var file = $("input[type=file]").get(0).files[0];

        var reader = new FileReader();
        reader.onload = function () {
            $("#brand-img-preview").attr("src", reader.result);
        }
        reader.readAsDataURL(file);
    }
});



var videoMaxTime = "01:00"; //minutes:seconds   //video
var uploadMax = 31457280; //bytes  //30MB

//for seconds to time
function secondsToTime(in_seconds) {

    var time = '';
    in_seconds = parseFloat(in_seconds.toFixed(2));

    var hours = Math.floor(in_seconds / 3600);
    var minutes = Math.floor((in_seconds - (hours * 3600)) / 60);
    var seconds = in_seconds - (hours * 3600) - (minutes * 60);
    //seconds = Math.floor( seconds );
    seconds = seconds.toFixed(0);

    if (hours < 10) {
        hours = "0" + hours;
    }
    if (minutes < 10) {
        minutes = "0" + minutes;
    }
    if (seconds < 10) {
        seconds = "0" + seconds;
    }
    var time = minutes + ':' + seconds;

    return time;
}

function checkFileDuration() {

    var file = document.getElementById('customFile_inputAdvStoryVideo').files[0];
    var reader = new FileReader();
    var fileSize = file.size;

    if (fileSize > uploadMax) {
        alert('file too large');
        $('#customFile_inputAdvStoryVideo').val("");
    } else {

        reader.onload = function (e) {
            // file.type == "video/mp4" || file.type == "video/ogg" || file.type == "video/webm"
            if (file.type) {
                var videoElement = document.createElement('video');
                videoElement.src = e.target.result;

                var timer = setInterval(function () {
                    if (videoElement.readyState === 4) {
                        getTime = secondsToTime(videoElement.duration);
                        console.log(getTime, 333)
                        if (getTime > videoMaxTime) {
                            alert('1 minutes video only');
                            $('#customFile_inputAdvStoryVideo').val("");
                            $('#customFile_inputAdvStoryVideo').next().text("Choose file");
                        }
                        clearInterval(timer);
                    }
                }, 500)

            } else {
                var timer = setInterval(function () {
                    if (file) {
                        alert('invaild File')
                        clearInterval(timer);
                        $('#customFile_inputAdvStoryVideo').val("");
                        $('#customFile_inputAdvStoryVideo').next().text("Choose file");
                    }
                }, 500)
            }
        };

        if (file) {
            reader.readAsDataURL(file);
        } else {
            alert('nofile');
            $('#customFile_inputAdvStoryVideo').val("");
        }

    }
}

// start time validation
$('#inputStartTime').blur(function () {
    if ($('#inputEndTime').val() != '') {
        validateTime();
    }
});

$('#inputEndTime').blur(function () {
    if ($('#inputStartTime').val() != '') {
        validateTime();
    }
})

function validateTime() {
    var startTime = moment($('#inputStartTime').val(), 'hh:mm A').format('HH:mm');
    var endTime = moment($('#inputEndTime').val(), 'hh:mm A').format('HH:mm');

    if (startTime > endTime) {
        $('#timeValidation').show('fast');
        $('.btnValidation').prop('disabled', true)
    } else {
        $('#timeValidation').hide('fast');
        $('.btnValidation').prop('disabled', false)
    }
}
// end time validation

// start check time slot
function checkTimeSlot(url, forUpdate = null) {

    const startDate = $('#inputStartDate').val();
    const endDate = $('#inputEndDate').val();
    const startTime = $('#inputStartTime').val();
    const endTime = $('#inputEndTime').val();

    if (startDate == '') {
        Swal.fire({
            'icon': 'warning',
            'title': 'Warning',
            'text': 'Please select start date.'
        })

        return;
    }
    else if (endDate == '') {
        Swal.fire({
            'icon': 'warning',
            'title': 'Warning',
            'text': 'Please select end date.'
        })

        return;
    }
    else if (startTime == '') {
        Swal.fire({
            'icon': 'warning',
            'title': 'Warning',
            'text': 'Please select start time.'
        })

        return;
    }
    else if (endTime == '') {
        // Swal.fire({
        //     'icon': 'warning',
        //     'title': 'Warning',
        //     'text': 'Please select end time.'
        // })

        return;
    }

    $.ajax({
        url: url,
        type: 'POST',
        dataType: 'json',
        data: {
            startDate: startDate,
            endDate: endDate,
            startTime: startTime,
            endTime: endTime,
            forUpdate: forUpdate,
        },
    })
        .done(function (response) {

            if (!response.status) {

                localStorage.setItem('positions', JSON.stringify(response.adv_position));

                // var slots = '';
                // var date = '';

                // response.reserveSlot.forEach((value, index) => {

                //     var tempDate = '';
                //     if (date == value.date) {
                //         tempDate = '';
                //     } else {
                //         date = value.date;
                //         tempDate = date;
                //     }

                //     slots += tempDate + " (" + value.start_time + " to " + value.end_time + "), ";
                // })

                // $('#timeValidation').text("Slot isn't available. Reserve slot are for date: " + slots.slice(0, -2));
                // $('#timeValidation').show('fast');
                // $('.btnValidation').prop('disabled', true)
            }
            // else {

            //     var isError = $('#timeValidation').text();
            //     if (isError.indexOf("Slot isn't available") > 0) {
            //         $('#timeValidation').hide('fast');
            //         $('.btnValidation').prop('disabled', false)
            //     }
            // }
        })
        .fail(function () {
            console.log("error");
        })
        .always(function () {
            console.log("complete");
        });

}
// end check time slot

// start impression validation
$('#inputDailyImpression').keyup(function () {
    if ($('#inputLifetimeImpression').val() != '') {
        vlidateImpression();
    }
})

$('#inputLifetimeImpression').keyup(function () {
    if ($('#inputDailyImpression').val() != '') {
        vlidateImpression();
    }
})

function vlidateImpression() {
    if (Number($('#inputDailyImpression').val()) == Number($('#inputLifetimeImpression').val())) {
        $('#impressionValidation').show('fast');
        $('.btnValidation').prop('disabled', true)
    } else {
        $('#impressionValidation').hide('fast');
        $('.btnValidation').prop('disabled', false)
    }
}
// end impression validation

// start age validation
$('#inputAgeMin').keyup(function () {
    if ($('#inputAgeMax').val() != '') {
        vlidateAge();
    }
})

$('#inputAgeMax').keyup(function () {
    if ($('#inputAgeMin').val() != '') {
        vlidateAge();
    }
})

function vlidateAge() {
    if (Number($('#inputAgeMin').val()) > Number($('#inputAgeMax').val())) {
        $('#ageValidation').show('fast');
        $('.btnValidation').prop('disabled', true)
    } else {
        $('#ageValidation').hide('fast');
        $('.btnValidation').prop('disabled', false)
    }
}
// end age validation

$('.timeKeydown').keydown(function () {
    return false;
})

$('input[type=number]').on('mousewheel', function (e) {
    $(e.target).blur();
});

//new fn
function fnRemoveOldNativeAd(row) {
    console.log($('.nativeAdBlock').length);
    if (Number($('.nativeAdBlock').length) <= 1) {
        alert("At least one ad must be required.");
        return false;
    }

    $('#nativeAdOld_' + row).remove();
}

function fnPreviewNativeAd(row) {

    if ($('#native_ad_img' + row).get(0).files.length === 0) {
        Swal.fire({
            'icon': 'warning',
            'title': 'Warning',
            'text': 'Please import image.'
        });
    }
    else if ($('#brand_logo').get(0).files.length === 0) {
        Swal.fire({
            'icon': 'warning',
            'title': 'Warning',
            'text': 'Please import logo.'
        });
    }
    else if ($('#title').val() === '') {
        Swal.fire({
            'icon': 'warning',
            'title': 'Warning',
            'text': 'Please enter title.'
        });
    }
    else if ($('#nativeAdRefLink' + row).val() === '') {
        Swal.fire({
            'icon': 'warning',
            'title': 'Warning',
            'text': 'Please enter Ref Link.'
        });
    }
    else if ($('#adv_position_slot' + row).val() === '') {
        Swal.fire({
            'icon': 'warning',
            'title': 'Warning',
            'text': 'Please enter ad position.'
        });
    }
    else {
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

        sendDataForPreview(fd)
    }
}

function fnPreviewStoryAd(row) {

    if ($('#story_ad_img' + row).get(0).files.length === 0) {
        Swal.fire({
            'icon': 'warning',
            'title': 'Warning',
            'text': 'Please import image.'
        });
    }
    else if ($('#title').val() === '') {
        Swal.fire({
            'icon': 'warning',
            'title': 'Warning',
            'text': 'Please enter title.'
        });
    }
    else if ($('#storyLinkId' + row).val() === '') {
        Swal.fire({
            'icon': 'warning',
            'title': 'Warning',
            'text': 'Please enter Ref Link.'
        });
    }
    else {
        var fd = new FormData();

        var file = $('#story_ad_img' + row).get(0).files;
        var type = 'story';
        var link = $('#storyLinkId' + row).val();
        var title = $('#title').val();

        fd.append('file', file[0])
        fd.append('type', type)
        fd.append('link', link)
        fd.append('title', title)

        sendDataForPreview(fd)
    }
}

function fnPreviewBannerAd(row) {

    if ($('#banner_ad_img' + row).get(0).files.length === 0) {
        Swal.fire({
            'icon': 'warning',
            'title': 'Warning',
            'text': 'Please import image.'
        });
    }
    else if ($('#bannerAdRefLink' + row).val() === '') {
        Swal.fire({
            'icon': 'warning',
            'title': 'Warning',
            'text': 'Please enter Ref Link.'
        });
    }
    else if ($('#bannerAdPosition' + row).val() === '') {
        Swal.fire({
            'icon': 'warning',
            'title': 'Warning',
            'text': 'Please enter ad position.'
        });
    }
    else {
        var fd = new FormData();

        var type = 'banner';
        var file = $('#banner_ad_img' + row).get(0).files;
        var position = $('#bannerAdPosition' + row).val();
        var link = $('#bannerAdRefLink' + row).val();

        fd.append('type', type)
        fd.append('file', file[0])
        fd.append('position', position)
        fd.append('link', link)

        sendDataForPreview(fd)
    }
}

function sendDataForPreview(fd) {

    $('#previewLoader').css('display', 'block')

    $.ajax({
        type: "post",
        url: BASE_URL + 'preview',
        data: fd,
        contentType: false,
        processData: false,
        success: function (data) {
            $('#previewLoader').css('display', 'none')
            if (data.alert == 'success') {
                $('#phone-iframe').attr('src', BASE_URL + 'previewShow');
                $('#previewModal').modal('show');
            }
        },
        error: function (error) {
            $('#previewLoader').css('display', 'none')
            console.log('error');
        }
    });
}
//end old fn



/* function nativeAdPercentCalculation(e) {

    let nativePercent = [];
    let nativeTotalPercent = 0;

    $('.nativeAdPercent').each(function () {
        nativePercent.push($(this).val())
    })

    for (let index = 0; index < nativePercent.length; index++) {
        if (index != 0) {
            nativeTotalPercent += Number(nativePercent[index]);
        }
    }

    let substruct = 100 - nativeTotalPercent;
    if (substruct < 0) {

        $('#inputAdvFeedShowTime0').val(100 - (nativeTotalPercent - Number($("#" + e.id).val())))
        $("#" + e.id).val(0);

        Swal.fire({
            'icon': 'warning',
            'title': "Warning",
            'text': "Native total percent (time) must be equal 100."
        });

        return;
    }

    if (nativeTotalPercent == 0) {
        $('#inputAdvFeedShowTime0').val(100)
    }

    $('#inputAdvFeedShowTime0').val(substruct)
} */

function nativeAdPercentCalculation(e, row) {

    var totalPercentArr = [];
    var totalPercent = 0;
    let isFirst = false;
    let isRow = "";

    $('.native_ad_type').each(function () {

        if ($(this).val() == $('#native_ad_type' + row).val()) {

            var thisId = $(this).prop('id');
            var thisRow = thisId.replace(/[^0-9]/g, '');

            if (!isFirst) {
                isFirst = true;
                isRow = thisRow;
            }

            totalPercentArr.push($("#nativeAdPercent" + thisRow).val())
        }
    });

    for (let index = 0; index < totalPercentArr.length; index++) {
        if (index != 0) {
            totalPercent += Number(totalPercentArr[index]);
        }
    }

    let substructFromTotal = 100 - totalPercent;
    if (substructFromTotal < 0) {

        $('#nativeAdPercent' + isRow).val(100 - (totalPercent - Number($("#" + e.id).val())))
        $("#" + e.id).val(0);

        Swal.fire({
            'icon': 'warning',
            'title': "Warning",
            'text': "Native total percent (time) must be equal 100."
        });

        return;
    }

    if (totalPercent == 0) {
        $('#nativeAdPercent' + isRow).val(100)
    } else {
        $('#nativeAdPercent' + isRow).val(substructFromTotal)
    }
}

/* function bannerAdPercentCalculation(e) {

    let bannerPercent = [];
    let bannerTotalPercent = 0;

    $('.bannerAdPercent').each(function () {
        bannerPercent.push($(this).val())
    })

    for (let index = 0; index < bannerPercent.length; index++) {
        if (index != 0) {
            bannerTotalPercent += Number(bannerPercent[index]);
        }
    }

    let substruct = 100 - bannerTotalPercent;
    if (substruct < 0) {

        $('#bannerAdPercent0').val(100 - (bannerTotalPercent - Number($("#" + e.id).val())))
        $("#" + e.id).val(0);

        Swal.fire({
            'icon': 'warning',
            'title': "Warning",
            'text': "Banner total percent (time) must be equal 100."
        });

        return;
    }

    if (bannerTotalPercent == 0) {
        $('#bannerAdPercent0').val(100)
    }

    $('#bannerAdPercent0').val(substruct)
} */

/* function bannerAdPercentCalculation(e) {

    var totalPromotionPercentArr = [];
    var totalBonsPercentArr = [];
    var totalCodesPromoPercentArr = [];

    var totalPromotionPercent = 0;
    var totalBonsPercent = 0;
    var totalCodesPromoPercent = 0;

    let isPromo = false;
    let isBones = false;
    let isCodes = false;

    let isPromoRow = "";
    let isBonesRow = "";
    let isCodesRow = "";

    $('.banner_ad_type').each(function () {
        if ($(this).val() == 1) {

            var thisId = $(this).prop('id');
            var thisRow = thisId.replace(/[^0-9]/g, '');

            if (!isPromo) {
                isPromo = true;
                isPromoRow = thisRow;
            }

            totalPromotionPercentArr.push($("#bannerAdPercent" + thisRow).val())
        }
        else if ($(this).val() == 2) {

            var thisId = $(this).prop('id');
            var thisRow = thisId.replace(/[^0-9]/g, '');

            if (!isBones) {
                isBones = true;
                isBonesRow = thisRow;
            }

            totalBonsPercentArr.push($("#bannerAdPercent" + thisRow).val())

        } else if ($(this).val() == 3) {

            var thisId = $(this).prop('id');
            var thisRow = thisId.replace(/[^0-9]/g, '');

            if (!isCodes) {
                isCodes = true;
                isCodesRow = thisRow;
            }

            totalCodesPromoPercentArr.push($("#bannerAdPercent" + thisRow).val())
        }
    });

    console.log(totalPromotionPercentArr,
        totalBonsPercentArr,
        totalCodesPromoPercentArr);

    for (let index = 0; index < totalPromotionPercentArr.length; index++) {
        if (index != 0) {
            totalPromotionPercent += Number(totalPromotionPercentArr[index]);
        }
    }

    for (let index = 0; index < totalBonsPercentArr.length; index++) {
        if (index != 0) {
            totalBonsPercent += Number(totalBonsPercentArr[index]);
        }
    }

    for (let index = 0; index < totalCodesPromoPercentArr.length; index++) {
        if (index != 0) {
            totalCodesPromoPercent += Number(totalCodesPromoPercentArr[index]);
        }
    }

    console.log(totalPromotionPercent,
        totalBonsPercent,
        totalCodesPromoPercent);

    let substructPromo = 100 - totalPromotionPercent;
    let substructBones = 100 - totalBonsPercent;
    let substructCodes = 100 - totalCodesPromoPercent;

    if (substructPromo < 0) {

        $('#bannerAdPercent' + isPromoRow).val(100 - (totalPromotionPercent - Number($("#" + e.id).val())))
        $("#" + e.id).val(0);

        Swal.fire({
            'icon': 'warning',
            'title': "Warning",
            'text': "Banner total percent (time) must be equal 100."
        });

        return;
    }

    if (substructBones < 0) {

        $('#bannerAdPercent' + isPromoRow).val(100 - (totalBonsPercent - Number($("#" + e.id).val())))
        $("#" + e.id).val(0);

        Swal.fire({
            'icon': 'warning',
            'title': "Warning",
            'text': "Banner total percent (time) must be equal 100."
        });

        return;
    }

    if (substructCodes < 0) {

        $('#bannerAdPercent' + isPromoRow).val(100 - (totalCodesPromoPercent - Number($("#" + e.id).val())))
        $("#" + e.id).val(0);

        Swal.fire({
            'icon': 'warning',
            'title': "Warning",
            'text': "Banner total percent (time) must be equal 100."
        });

        return;
    }

    if (totalPromotionPercent == 0) {
        $('#bannerAdPercent' + isPromoRow).val(100)
    } else {
        $('#bannerAdPercent' + isPromoRow).val(substructPromo)
    }

    if (totalBonsPercent == 0) {
        $('#bannerAdPercent' + isBonesRow).val(100)
    } else {
        $('#bannerAdPercent' + isBonesRow).val(substructBones)
    }

    if (totalCodesPromoPercent == 0) {
        $('#bannerAdPercent' + isCodesRow).val(100)
    } else {
        $('#bannerAdPercent' + isCodesRow).val(substructCodes)
    }
} */

function bannerAdPercentCalculation(e, row) {

    var totalPercentArr = [];
    var totalPercent = 0;
    let isFirst = false;
    let isRow = "";

    $('.banner_ad_type').each(function () {

        if ($(this).val() == $('#banner_ad_type' + row).val()) {

            var thisId = $(this).prop('id');
            var thisRow = thisId.replace(/[^0-9]/g, '');

            if (!isFirst) {
                isFirst = true;
                isRow = thisRow;
            }

            totalPercentArr.push($("#bannerAdPercent" + thisRow).val())
        }
    });

    for (let index = 0; index < totalPercentArr.length; index++) {
        if (index != 0) {
            totalPercent += Number(totalPercentArr[index]);
        }
    }

    let substructFromTotal = 100 - totalPercent;
    if (substructFromTotal < 0) {

        $('#bannerAdPercent' + isRow).val(100 - (totalPercent - Number($("#" + e.id).val())))
        $("#" + e.id).val(0);

        Swal.fire({
            'icon': 'warning',
            'title': "Warning",
            'text': "Banner total percent (time) must be equal 100."
        });

        return;
    }

    if (totalPercent == 0) {
        $('#bannerAdPercent' + isRow).val(100)
    } else {
        $('#bannerAdPercent' + isRow).val(substructFromTotal)
    }
}

function percentCheckByAdType(row, adTypeValue) {

    var selectedAdTypeArr = [];
    $('.banner_ad_type').each(function () {
        if ($(this).prop('id') != "banner_ad_type" + row) {
            selectedAdTypeArr.push($(this).val());
        }
    });

    if (jQuery.inArray(adTypeValue, selectedAdTypeArr) == -1) {
        $('#bannerAdPercent' + row).val(100);
    } else {
        $("#bannerAdPercent" + row).val("");
    }
}

function percentCheckByAdTypeNative(row, adTypeValue) {

    var selectedAdTypeArr = [];
    $('.native_ad_type').each(function () {
        if ($(this).prop('id') != "native_ad_type" + row) {
            selectedAdTypeArr.push($(this).val());
        }
    });

    if (jQuery.inArray(adTypeValue, selectedAdTypeArr) == -1) {
        $('#nativeAdPercent' + row).val(100);
    } else {
        $("#nativeAdPercent" + row).val("");
    }
}

function display_server() {
    var refresh = 100;
    mytime = setTimeout('display_serverTime()', refresh)
}

function display_serverTime() {
    var x = srvTime();
    document.getElementById('ct').innerHTML = x;
    // display_server();
}

function srvTime() {
    var xmlHttp;
    try {
        //FF, Opera, Safari, Chrome
        xmlHttp = new XMLHttpRequest();
    }
    catch (err1) {
        //IE
        try {
            xmlHttp = new ActiveXObject('Msxml2.XMLHTTP');
        }
        catch (err2) {
            try {
                xmlHttp = new ActiveXObject('Microsoft.XMLHTTP');
            }
            catch (eerr3) {
                //AJAX not supported, use CPU time.
                alert("AJAX not supported");
            }
        }
    }
    xmlHttp.open('HEAD', window.location.href.toString(), false);
    xmlHttp.setRequestHeader("Content-Type", "text/html");
    xmlHttp.send('');
    return xmlHttp.getResponseHeader("Date");
}

$('#inputLifetimeImpression').keyup(function () {
    $('#inputBudget').val($(this).val());
});

$('#inputBudget').keyup(function () {
    $('#inputLifetimeImpression').val($(this).val());
});

function fnCheckNativeAdPosition(id) {

    $('.btnValidation').prop('disabled', true)
    const startDate = $('#inputStartDate').val();
    const endDate = $('#inputEndDate').val();
    const startTime = $('#inputStartTime').val();
    const endTime = $('#inputEndTime').val();

    if (startDate == '') {
        Swal.fire({
            'icon': 'warning',
            'title': 'Warning',
            'text': 'Please select start date.'
        })

        return;
    }
    else if (endDate == '') {
        Swal.fire({
            'icon': 'warning',
            'title': 'Warning',
            'text': 'Please select end date.'
        })

        return;
    }
    else if (startTime == '') {
        Swal.fire({
            'icon': 'warning',
            'title': 'Warning',
            'text': 'Please select start time.'
        })

        return;
    }
    else if (endTime == '') {
        Swal.fire({
            'icon': 'warning',
            'title': 'Warning',
            'text': 'Please select end time.'
        })

        return;
    }

    $('.btnValidation').prop('disabled', false)
    let positions = localStorage.getItem('positions');
    var currentPos = $('#adv_position_slot' + id).val();

    if (positions != null) {
        positions = JSON.parse(positions);

        var pos = "";
        var prevPos = -1;
        positions.key_1.forEach((value, index) => {
            if (value.position != prevPos) {
                pos += value.position + ", ";
                prevPos = value.position;
            }
        });
        pos = pos.slice(0, -2);

        var isAvailable = false;
        positions.key_1.forEach((value, index) => {
            if (value.position == currentPos) {
                isAvailable = true;
            }
        });

        if (isAvailable) {
            $("#positionError" + id).text("Unavailable positions are: " + pos);
            $('#positionError' + id).show('fast');
            $('.btnValidation').prop('disabled', true)
        } else {
            $('#positionError' + id).hide('fast');
            $("#positionError" + id).text("");
            $('.btnValidation').prop('disabled', false)
        }
    }
}

function fnCheckBannerAdPosition(id) {

    $('.btnValidation').prop('disabled', true)
    const startDate = $('#inputStartDate').val();
    const endDate = $('#inputEndDate').val();
    const startTime = $('#inputStartTime').val();
    const endTime = $('#inputEndTime').val();

    if (startDate == '') {
        Swal.fire({
            'icon': 'warning',
            'title': 'Warning',
            'text': 'Please select start date.'
        })

        return;
    }
    else if (endDate == '') {
        Swal.fire({
            'icon': 'warning',
            'title': 'Warning',
            'text': 'Please select end date.'
        })

        return;
    }
    else if (startTime == '') {
        Swal.fire({
            'icon': 'warning',
            'title': 'Warning',
            'text': 'Please select start time.'
        })

        return;
    }
    else if (endTime == '') {
        Swal.fire({
            'icon': 'warning',
            'title': 'Warning',
            'text': 'Please select end time.'
        })

        return;
    }

    $('.btnValidation').prop('disabled', false)
    let positions = localStorage.getItem('positions');
    var currentPos = $('#bannerAdPosition' + id).val();

    if (positions != null) {
        positions = JSON.parse(positions);

        console.log(positions);

        var pos = "";
        var prevPos = -1;
        positions.key_3.forEach((value, index) => {
            if (value.position != prevPos) {
                pos += value.position + ", ";
                prevPos = value.position;
            }
        });
        pos = pos.slice(0, -2);

        var isAvailable = false;
        positions.key_3.forEach((value, index) => {
            if (value.position == currentPos) {
                isAvailable = true;
            }
        });

        if (isAvailable) {
            $("#bannerPosError" + id).text("Unavailable positions are: " + pos);
            $('#bannerPosError' + id).show('fast');
            $('.btnValidation').prop('disabled', true)
        } else {
            $('#bannerPosError' + id).hide('fast');
            $("#bannerPosError" + id).text("");
            $('.btnValidation').prop('disabled', false)
        }
    }
}

function loadFile(id) {
    $("#" + id).prop('src', URL.createObjectURL(event.target.files[0]))
}
