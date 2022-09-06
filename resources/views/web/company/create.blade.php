@extends("web.layouts.main")
@section("css")

    <link type="text/css" href="{{asset("assets/css/form.css")}}" rel="stylesheet"/>
@endsection

@section("js")

    <script type="text/javascript" src="{{asset("assets/js/jquery.validate.js")}}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script type="text/javascript" src="{{asset("assets/js/form.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/ajax.js")}}"></script>

@endsection
@section("container")

    <div class="form-header bg-dark text-white p-3">
        <h3>إنشاء إستمارة تسجيل</h3>
        <p>املئ معلومات استمارة التسجيل, لانشاء نموذج استمارة تسجيل الشركات .</p>
    </div>
    <div class="container-fluid" style="background-color: #ffffff;">

        <form method="post" action="{{route("api.company.create")}}" enctype="multipart/form-data" id="registerForm" class="needs-validation">

            <!-- Form type-->
            <div class="row p-3">
                <!-- company type -->
                <div class="col">
                    <div class="form-row">
                        <div class="col">
                            <div class="form-group m-0">
                                <label for="dob" class="col-form-label">نوع الاستمارة :</label>

                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="company" checked name="formType"
                                           class="custom-control-input" value="1">
                                    <label class="custom-control-label m-0" for="company">شركة</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="office" name="formType" class="custom-control-input"
                                           value="2">
                                    <label class="custom-control-label m-0" for="office">مكتب</label>
                                </div>

                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="page" name="formType" class="custom-control-input"
                                           value="3">
                                    <label class="custom-control-label m-0" for="page">صفحة الكترونية</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="mobile_app" name="formType" class="custom-control-input"
                                           value="4">
                                    <label class="custom-control-label m-0" for="mobile_app">تطبيق</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="driver" name="formType" class="custom-control-input"
                                           value="5">
                                    <label class="custom-control-label m-0" for="driver">سائق</label>
                                </div>


                            </div>
                        </div>

                        <div class="col text-left">
                            <button type="submit" id="btnSave" class="btn btn-primary pull-left">انشاء استمارة</button>

                        </div>

                    </div>

                </div>


            </div>

            <hr>
            <!-- Company info-->

            <div class="row">

                <div class="container-fluid">
                    <div class="row">
                        <!-- Company details Right side-->
                        <div class="col">

                            <div id="company_info">
                                <h4>
                                    معلومات
                                    <span class="formTypeTitle">الشركة</span>

                                </h4>

                                <!-- main Info -->
                                <div id="mainInfo"></div>
                            </div>
                            <br>
                            <div id="company_address">
                                <h4>عنوان <span class="formTypeTitle"><span class="formTypeTitle">الشركة</span></span>
                                </h4>
                                <div class="border border-1 p-5 rounded">
                                    <div class="form-row">
                                        <div class="col">
                                            <label for="company_name">المحافظة</label>
                                            <select class="form-control" name="city_id" required>
                                                <option selected value="">اختر المحافظة</option>
                                                @foreach($cities as $city)
                                                    <option value="{{$city->id}}">{{$city->name}}</option>

                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label for="alqada_input">القضاء</label>
                                            <input required type="text" name="alqada" id="alqada_input"
                                                   class="form-control"
                                                   placeholder="القضاء">
                                        </div>

                                    </div>
                                    <div class="form-row">
                                        <div class="col">
                                            <label for="almahala_input">المحلة</label>
                                            <input required id="almahala_input" name="almahala" type="text"
                                                   class="form-control type-integer"
                                                   placeholder="المحلة">
                                        </div>
                                        <div class="col">
                                            <label for="alziqaq_input">الزقاق</label>
                                            <input required type="text" id="alziqaq_input" name="alziqaq"
                                                   class="form-control type-integer"
                                                   placeholder="الزقاق">
                                        </div>

                                    </div>

                                    <div class="form-row">
                                        <div class="col">
                                            <label for="near_input">اقرب نقطة دالة</label>
                                            <input required type="text" id="near_input" name="near"
                                                   class="form-control"
                                                   placeholder="اقرب نقطة دالة">
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <br>
                            <div id="company_registeration_info" class="d-none">
                                <h4> معلومات تسجيل <span class="formTypeTitle">الشركة</span></h4>
                                <div class="border border-1 p-5 rounded">
                                    <div class="form-row">

                                        <div class="col">
                                            <label for="registration_number_input">رقم التسجيل لدى غرفة التجارة</label>
                                            <input required type="text" name="registration_number"
                                                   id="registration_number_input" class="form-control type-integer"
                                                   placeholder="رقم التسجيل">
                                        </div>
                                        <div class="col">
                                            <label for="registration_address_input">عنوان التسجيل</label>
                                            <input required id="registration_address_input" name="registration_address"
                                                   type="text" class="form-control"
                                                   placeholder="عنوان التسجيل">
                                        </div>
                                    </div>
                                    <div class="form-row">

                                        <div class="col">
                                            <label for="registration_date_input">تاريخ التسجيل</label>
                                            <input required type="date" name="registration_date"
                                                   id="registration_date_input" class="form-control"
                                                   placeholder="2022-08-28">
                                        </div>
                                        <div class="col">
                                            <label for="registration_type_input">نوع التسجيل</label>
                                            <input required type="text" name="registration_type"
                                                   id="registration_type_input" class="form-control"
                                                   placeholder="نوع التسجيل">
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <br>

                        </div>

                        <!-- Company details left side-->
                        <div class="col">
                            <div id="company_info">
                                <h4> معلومات المدير و الشركاء</h4>
                                <div class="border border-1 p-5 rounded">
                                    <input hidden="" name="photo" id="photo" required>

                                    <div class="pt-4 pb-4"
                                         style="border: 2px dashed;padding: 20px;text-align: center;cursor: pointer"
                                         title="التقاط صورة">
                                        <div class="container-fluid">
                                            <div class="row align-items-center">
                                                <div class="col">
                                                    <canvas id="canvas" width="200" height="200"
                                                            class="rounded"></canvas>

                                                </div>

                                                <div class="col">
                                                    <div id="cameraModalContainer" data-toggle="modal"
                                                         data-target="#cameraModal">
                                                        <div class="s-48 icon-camera"></div>
                                                        <span>اضغط لاضافة او التقاط صورة</span>
                                                        <div>من كامرة الحاسوب</div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    @include("web.layouts.form.camera-modal")
                                    <br>
                                    <div id="partner_type">
                                        <div class="form-row">
                                            <div class="form-group m-0">
                                                <label for="dob" class="col-form-label"> نوع الشريك او المدير</label>

                                                <br>
                                                @foreach($partner_types as $partner_type)
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" id="partnet-type-{{$partner_type->id}}"
                                                               name="partnet_type"
                                                               class="custom-control-input"
                                                               value="{{$partner_type->id}}">
                                                        <label class="custom-control-label m-0"
                                                               for="partnet-type-{{$partner_type->id}}">
                                                            {{$partner_type->title}}
                                                        </label>
                                                    </div>
                                                @endforeach

                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">

                                        <div class="col" id="ceo_name_col">
                                            <label for="ceo_name_input"> اسم المدير المفوض او الشريك او المؤسس</label>
                                            <input required type="text" id="ceo_name_input" name="ceo_name"
                                                   class="form-control"
                                                   placeholder="اسم المدير المفوض او الشريك">
                                        </div>
                                        <div class="col">
                                            <label for="national_id_number_input">رقم البطاقة الوطنية</label>
                                            <input required id="national_id_number_input" name="national_id_number"
                                                   type="text" class="form-control type-integer"
                                                   placeholder="رقم البطاقة الوطنية">
                                        </div>
                                    </div>
                                    <div class="form-row">

                                        <div class="col">
                                            <label for="passport_input">رقم جواز السفر</label>
                                            <input required type="text" name="passport_number" id="passport_input"
                                                   class="form-control"
                                                   placeholder="رقم جواز السفر">
                                        </div>
                                        <div class="col">

                                            <label for="phone_number_input">رقم الهاتف</label>
                                            <input required type="text" minlength="11" maxlength="11" name="phone_number" id="phone_number_input"
                                                   class="form-control type-integer"
                                                   placeholder="رقم الهاتف">
                                        </div>
                                    </div>

                                </div>

                                <br>
                                <div id="company_property_section">
                                    <h4>ممتلكات <span class="formTypeTitle">الشركة</span></h4>
                                    <div class="border border-1 p-5 rounded">
                                        <div class="form-row">

                                            <div class="col">
                                                <label for="cars_count_input">عدد العجلات</label>
                                                <input required type="text" name="cars_count" id="cars_count_input"
                                                       class="form-control type-integer"
                                                       placeholder="عدد العجلات" >
                                            </div>
                                            <div class="col">
                                                <label for="motorcycle_count_input">عدد الدراجات المسجلة</label>
                                                <input required id="motorcycle_count_input" name="motorcycle_count"
                                                       type="text" class="form-control type-integer"
                                                       placeholder="عدد الدراجات المسجلة">
                                            </div>
                                        </div>
                                        <div class="form-row">

                                            <div class="col">
                                                <label for="employee_count_input">عدد الموظفين العاملين</label>
                                                <input required type="text" name="employee_count"
                                                       id="employee_count_input" class="form-control type-integer"
                                                       placeholder="عدد الموظفين العاملين">
                                            </div>

                                        </div>

                                    </div>
                                </div>
                                <br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </form>
    </div>
@endsection
