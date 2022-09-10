
(function($) {
    $.fn.inputFilter = function(callback, errMsg) {
        return this.on("input keydown keyup mousedown mouseup select contextmenu drop focusout", function(e) {
            if (callback(this.value)) {
                // Accepted value
                if (["keydown","mousedown","focusout"].indexOf(e.type) >= 0){
                    $(this).removeClass("input-error");
                    this.setCustomValidity("");
                }
                this.oldValue = this.value;
                this.oldSelectionStart = this.selectionStart;
                this.oldSelectionEnd = this.selectionEnd;
            } else if (this.hasOwnProperty("oldValue")) {
                // Rejected value - restore the previous one
                $(this).addClass("input-error");
                this.setCustomValidity(errMsg);
                this.reportValidity();
                this.value = this.oldValue;
                this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
            } else {
                // Rejected value - nothing to restore
                this.value = "";
            }
        });
    };
}(jQuery));


$(document).ready(function () {

    let titleFormTypes = [
        "الشركة",
        "المكتب",
        "الصفحة الالكترونية",
        "التطبيق",
        "السائق",
    ];


    let formTypeTitle = $(".formTypeTitle");

    let partner_type = $("#partner_type"); // partner_type section

    let mainInfo = $("#mainInfo");
    let companyBuget = $("#companyـbudget");
    let documentsType = $("#documentsType");
    let registerationInfo = $("#company_registeration_info");
    let companyPropertySection = $("#company_property_section");
    let ceoNameCol = $("#ceo_name_col");
    let formVideo = document.querySelector("video");
    registerationInfo.removeClass("d-none");



    documentsType.on("change",function (){
        let val = $(this).val();

        if (val ==="1"){
            $("#national_id_number_col").toggleClass("d-none");
            $("#paper_number_col,#book_number_col").addClass("d-none");


        }else if(val ==="2"){
            $("#national_id_number_col").addClass("d-none");
            $("#paper_number_col,#book_number_col").toggleClass("d-none");
        }else{
            $("#national_id_number_col,#paper_number_col,#book_number_col").addClass("d-none");
        }
    })


    const constraints = {
        video: {
            width: {
                min: 1280,
                ideal: 1920,
                max: 2560,
            },
            height: {
                min: 720,
                ideal: 1080,
                max: 1440
            },
        }
    };

    //camera video
    let canvas = document.querySelector("#canvas");
    let photo_input = $("#photo");
    let stream;
    $('#cameraModal').on('show.bs.modal', async function (event) {
        // do something...

        stream = await navigator.mediaDevices.getUserMedia(constraints);
        formVideo.srcObject = stream;

    });

    $('#cameraModal').on('hide.bs.modal', function (event) {
        // do something...
        stream.getTracks().forEach(function(track) {
            track.stop();
        });


    });

    $("#btnCapture").on("click",function (){

        canvas.getContext('2d').drawImage(formVideo, 0, 0, canvas.width, canvas.height);
        let image_data_url = canvas.toDataURL('image/jpeg');

        photo_input.val(image_data_url);
        stream.getTracks().forEach(function(track) {
            track.stop();
            $('#cameraModal').modal("hide");
        });
        // data url of the image
        // console.log(image_data_url);
    })

    mainInfo.load("/layouts/company-info.html",function (){
        $(".type-integer").inputFilter(function(value) {
            return /^-?\d*$/.test(value); }, "يجب ادخل رقم");


    });
    $("input[name='formType']").on("change", function (event) {

        let formTypeIndex = $(event.currentTarget).val();
        formTypeTitle.text(titleFormTypes[formTypeIndex - 1]);

        switch (formTypeIndex) {

            case "1": //Company Form
                mainInfo.load("/layouts/company-info.html",function (){
                    companyBuget.show();
                    partner_type.show();
                    ceoNameCol.show();
                    companyPropertySection.show();

                    $(".type-integer").inputFilter(function(value) {
                        return /^-?\d*$/.test(value); }, "يجب ادخل رقم");

                });


                break;

            case "2": //office
                mainInfo.load("/layouts/office-info.html",function () {
                    $(".type-integer").inputFilter(function(value) {
                        return /^-?\d*$/.test(value); }, "يجب ادخل رقم");

                });
                registerationInfo.removeClass("d-none");
                $("#companyـbudget").hide();
                partner_type.show();
                ceoNameCol.show();
                companyPropertySection.show();

                break;


            case "3": //Page Form

                mainInfo.load("/layouts/page-info.html",function () {
                    $(".type-integer").inputFilter(function(value) {
                        return /^-?\d*$/.test(value); }, "يجب ادخل رقم");

                });
                registerationInfo.addClass("d-none");
                partner_type.hide();
                ceoNameCol.show();
                companyPropertySection.show();
                break;

            case "4": // App Form
                mainInfo.load("/layouts/app-info.html",function () {
                    $(".type-integer").inputFilter(function(value) {
                        return /^-?\d*$/.test(value); }, "يجب ادخل رقم");

                });
                registerationInfo.addClass("d-none");
                partner_type.hide();
                ceoNameCol.show();
                companyPropertySection.show();
                break;

            case "5": //Driver Form
                mainInfo.load("/layouts/driver-info.html",function () {
                    $(".type-integer").inputFilter(function(value) {
                        return /^-?\d*$/.test(value); }, "يجب ادخل رقم");


                    $("#driver_license").on("change",function (e){

                        const file = e.target.files[0];
                        const reader = new FileReader();
                        reader.onloadend = () => {
                            // console.log(reader.result);
                            // Logs data:<type>;base64,wL2dvYWwgbW9yZ...
                            $("#driver_license_input").val(reader.result);

                        };
                        reader.readAsDataURL(file);
                        // console.log(reader.result);


                    });

                });
                registerationInfo.addClass("d-none");
                partner_type.hide();
                ceoNameCol.hide();
                companyPropertySection.hide();
                break

            default:
                console.log(formTypeIndex);
        }

    });


});

