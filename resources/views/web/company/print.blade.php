<!doctype html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>البريد العراقي Iraqi post</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500;600;700;800;900&display=swap');
    </style>

    <style>
        body {
            font-family: Cairo, sans-serif;
        }
    </style>
</head>
<body>
<div class="container-fluid mt-3">

    <div class="row">
        <div class="col">
            <h5>رقم الاستمارة:
                {{$company->id}}
            </h5>
            <h5>التاريخ:
                {{\Carbon\Carbon::parse($company->created_at)->format("Y/m/d")}}
            </h5>
        </div>

        <div class="col">
            <p>الشركة العامة للبريد والتوفير</p>
        </div>

        <div class="col">
            <img src="{{asset("assets/img/iraqipost_logo.png")}}" width="100"/>
            <img src="{{$company->photo}}" width="100"/>
        </div>
    </div>


    <!-- Tabel -->
    <style>
        table, th, td {

        }

        tr {
            border: 1px solid #cccccc;
        }

        th, td {
            border-left: 1px solid #cccccc;
        }

        th, td {
            padding: 5px;

            text-align: right;
        }
    </style>

    <br>
    <br>
    <br>
    <table class="table" style="width: 100%">

        <tr>
            <th>اسم الشركة:</th>
            <td class="border-0">{{$company->user->name}}</td>

            <td class="border-0"></td>
            <td class="border-0"></td>

        </tr>

        <tr>
            <th>المحافظة:</th>
            <td>{{$company->address->city->name}}</td>

            <th>القضاء:</th>
            <td class="border-0">{{$company->address->alqada}}</td>
        </tr>

        <tr>
            <th>المحلة:</th>
            <td>{{$company->address->almahala}}</td>

            <th>الزقاق:</th>
            <td class="border-0">{{$company->address->alziqaq}}</td>
        </tr>

        <tr>
            <th>رقم الهاتف</th>
            <td>{{$company->user->phone_number}}</td>

            <th>البريد الالكتروني</th>
            <td class="border-0">{{$company->user->email}}</td>

        </tr>
        <tr>
            <th>اسم المدير المفوض</th>
            <td class="border-0">{{$company->ceo_name}}</td>
            <td class="border-0"></td>
            <td class="border-0"></td>
        </tr>

        <tr>
            <th>الرقم التعريفي</th>
            <td>98293892</td>
            <th>الموقع الالكتروني</th>
            <td class="border-0">{{$company->user->email}}</td>
        </tr>

        <tr>
            <th>الاسم التجاري</th>
            <td>{{$company->trade_name}}</td>
            <th>الشكل القانوني</th>
            <td class="border-0">{{$company->legal_form}}</td>
        </tr>
        @if($company->formType ==1 || $company->formType==2)
        <tr>
            <th>رقم التسجيل</th>
            <td>{{$company->legal_reg->registration_number}}</td>
            <th>عنوان التسجيل</th>
            <td class="border-0">{{$company->legal_reg->registration_address}}</td>
        </tr>

        <tr>
            <th>تاريخ التسجيل</th>
            <td>{{$company->legal_reg->registration_date}}</td>
            <th>نوع التسجيل</th>
            <td class="border-0">{{$company->legal_reg->registration_type}}</td>
        </tr>

            @if($company->formType !=2)
            <tr>
                <th>رأس مال الشركة</th>
                <td class="border-0">{{$company->budget}}</td>

                <td class="border-0"></td>
                <td class="border-0"></td>
            </tr>
            @endif

        @endif

        @if($company->formType !=5)
        <tr>
            <th>عدد العجلات المسجلة</th>
            <td>{{$company->property->cars_count}}</td>

            <th>عدد الدراجات المسجلة</th>
            <td class="border-0">{{$company->property->motorcycle_count}}</td>

        </tr>

        <tr>
            <th>عدد الموظفين</th>
            <td class="border-0">{{$company->property->employee_count}}</td>
            <td class="border-0"></td>
            <td class="border-0"></td>
            <td class="border-0"></td>
        </tr>

        @endif

        <tr>
            <th>aksjdkadjs</th>
        </tr>
    </table>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa"
        crossorigin="anonymous"></script>

<script>
    // window.print();
</script>
</body>
</html>
