$(document).ready(function () {



    let registerForm = $("#registerForm");
    let api_url = registerForm.attr("action");
    let photoInput = $("#photo");

    $("#btnSave").on("click",function (){
        registerForm.validate({
            submitHandler:function (form){

                if (photoInput.val() ===""){
                   Swal.fire({
                       title:"يجب التقاط صورة للاستمارة",
                       text:"",
                       icon:'error',
                       confirmButtonText:"الغاء"
                   });

                }else{
                    $.ajax({
                        url: api_url,
                        dataType: "json",
                        type: "Post",
                        async: true,
                        data: registerForm.serialize(),
                        success: function (data) {
                            $(this).attr("enabled");
                            if (data.status === false){
                                Swal.fire({
                                    title: 'تأكد من استخدام بريد الكتروني و رقم هاتف غير مكررين',
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

            }
        });



    });

});
