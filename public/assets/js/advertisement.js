// window.addEventListener("load", (event) => {
//     const typeVal = document.getElementById("adv_type") != undefined ? document.getElementById("adv_type").value : '';
//     toogleUploadField(typeVal);
//     let catVal = document.getElementById("adv_cat").value;
//     nativeAdvToogle(catVal)
// });

// function toogleUploadField(val) {
//     if (val == 1) {
//         document.getElementById("videoSectionParent").style.display = "none";
//         document.getElementById("imageSectionParent").style.display = "block";
//         document.getElementById("basicLink").style.display = "block";
//     } else if (val == 2) {
//         document.getElementById("videoSectionParent").style.display = "block";
//         document.getElementById("imageSectionParent").style.display = "none";
//         document.getElementById("basicLink")
//             ? (document.getElementById("basicLink").style.display = "none")
//             : "";
//     }
// }

// // Configuring the image or video section of create form
// if (document.getElementById("adv_type") != undefined) {
//     document.getElementById("adv_type").addEventListener("change", function (e) {
//         const imgType = e.target.value;
//         toogleUploadField(imgType);
//     });
// }

// // remove video links input
// function removeLinks(elm) {
//     let deletedLink = [];
//     for (var i = 0; i < elm.length; i++) {
//         elm[i].addEventListener(
//             "click",
//             function (e) {
//                 e.currentTarget.parentNode.remove();
//             },
//             false
//         );
//     }
// }

// // creating video links input and create event of removing input
// document.getElementById("addInputField").addEventListener("click", function (e) {
//     const videoInputWrapper = document.getElementById("videoSection");
//     let videoInputLength = document.getElementsByClassName("inputParent").length;
//     var inputParentDiv = document.createElement("div");
//     inputParentDiv.className = "inputParent";

//     inputParentDiv.innerHTML = `
//         <div class="form-row">
//             <div class="col-md-5 mb-3">
//                 <input type="text" name="video[${videoInputLength}][videoLink]" placeholder="Enter Video Link" class="inputAdvLinks form-control">            
//             </div>
//             <div class="col-md-5 mb-3">
//                 <input type="text" name="video[${videoInputLength}][referalLink]" placeholder="Enter Referal Link" class="inputReferalLinks form-control">        
//             </div>
//             <span class="removed">
//                 <i class="fas fa-fw fa-times"></i>        
//             </span>
//         </div>
//     `;
//     videoInputWrapper.appendChild(inputParentDiv);
//     var removed = document.getElementsByClassName("removed");
//     removeLinks(removed);
// });
// function nativeAdvToogle(catVal) {
//     if (catVal == 1) {
//         document.getElementById("position_slot").style.display = "block";
//         document.getElementById("nativeMedia").style.display = "block";
//         document.getElementById("StoryMedia") != undefined ? document.getElementById("StoryMedia").style.display = "none" : '';
//         if (document.getElementById("advType") != undefined) {
//             document.getElementById("advType").style.display = "none"
//             document.getElementById('adv_type').value = 1
//         }
//     } else {
//         document.getElementById("position_slot") != undefined ? document.getElementById("position_slot").style.display = "none" : null;
//         document.getElementById("nativeMedia").style.display = "none";
//         document.getElementById("StoryMedia") != undefined ? document.getElementById("StoryMedia").style.display = "block" : '';
//         document.getElementById("advType") != undefined ? document.getElementById("advType").style.display = "block" : '';
//     }
// }
// document.getElementById("adv_cat").addEventListener("change", function (e) {
//     nativeAdvToogle(e.target.value)
// });
