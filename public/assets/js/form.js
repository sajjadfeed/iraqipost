

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
    let registerationInfo = $("#company_registeration_info");
    let companyPropertySection = $("#company_property_section");
    let ceoNameCol = $("#ceo_name_col");
    let formVideo = document.querySelector("video");
    registerationInfo.removeClass("d-none");



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

    mainInfo.load("/layouts/company-info.html");
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
                });


                break;

            case "2": //office
                mainInfo.load("/layouts/office-info.html");
                registerationInfo.removeClass("d-none");
                $("#companyـbudget").hide();
                partner_type.show();
                ceoNameCol.show();
                companyPropertySection.show();

                break;


            case "3": //Page Form

                mainInfo.load("/layouts/page-info.html");
                registerationInfo.addClass("d-none");
                partner_type.hide();
                ceoNameCol.show();
                companyPropertySection.show();
                break;

            case "4": // App Form
                mainInfo.load("/layouts/app-info.html");
                registerationInfo.addClass("d-none");
                partner_type.hide();
                ceoNameCol.show();
                companyPropertySection.show();
                break;

            case "5": //Driver Form
                mainInfo.load("/layouts/driver-info.html");
                registerationInfo.addClass("d-none");
                partner_type.hide();
                ceoNameCol.hide();
                companyPropertySection.hide();
                break

            default:
                console.log(formTypeIndex);
        }

    })
})


