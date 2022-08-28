$(document).ready(function () {


    let api_url = "http://127.0.0.1:8000/api"

    let registerForm = $("#registerForm");
    $("#btnSave").on("click",function (){
        registerForm.validate({
            submitHandler:function (form){
                $(this).attr("disabled");
                // $(".error").text("هذا الحقل مطلوب.")

                $.ajax({
                    url: api_url + "/company/register",
                    dataType: "json",
                    type: "Post",
                    async: true,
                    data: registerForm.serialize(),
                    success: function (data) {
                        $(this).attr("enabled");
                        if (data.status == false){
                            Swal.fire({
                                title: 'تأكد من استخدام بريد الكتروني غير مكرر',
                                text: data.message,
                                icon: 'error',
                                confirmButtonText: 'الغاء'
                            })
                        }else {

                            Swal.fire({
                                title: 'تم انشاء الاستمارة بنجاح',
                                text:'اختر احد الخيارات',
                                showDenyButton: true,
                                confirmButtonText: 'استمارة جديدة',
                                denyButtonText: `طباعة`,
                                icon:'success'
                            }).then((result)=>{
                                if (result.isConfirmed){
                                    console.log("isConfirmed");
                                    window.location.href = "/form/create";
                                    //new form
                                }else if(result.isDenied){
                                    //print data
                                   window.location.href = "/form/" + data.form_id+"/print";

                                }
                            });
                        }
                        console.log(data)
                    },
                    error: function (xhr, exception) {
                        $(this).attr("enabled");

                        console.log(xhr);
                    }

                });
            }
        });



    });

});
