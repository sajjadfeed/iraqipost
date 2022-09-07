<?php

namespace App\Http\Controllers\Api;

use App\Address;
use App\CompaniesProperty;
use App\CompaniesRegistrationInfo;
use App\Company;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RegisterCompany extends Controller
{
    //


    public function store(Request $request){

//        Default validation
        $defaultValidation = $this->defaultValidation($request->all());
        if ($defaultValidation->fails()){
            return response()->json(["status"=>false,"message"=>$defaultValidation->errors()]);
        }

        if ($request->formType ==1 || $request->formType ==2){
            $companyRegistrationValidation = $this->companyRegistrationValidation($request->all());
            if ($companyRegistrationValidation->fails()){
                return response()->json(["status"=>false,"message"=>$companyRegistrationValidation->errors()]);
            }
        }
////




        //create user
        $user = new User();
        $user->name = $request->input("company_name");
        $user->email = $request->email;
        $user->role_id = 3;
        $user->password = Hash::make("11223344");
        $user->phone_number = $request->input("phone_number");
        $user->save();

//        //save address
        $address = new Address();
        $address->city_id = $request->input("city_id");
        $address->alqada = $request->input("alqada");
        $address->alziqaq = $request->input("alziqaq");
        $address->almahala = $request->input("almahala");
        $address->user_id = $user->id;
        $address->save();


        //save company Registration Info

        if ($request->formType ==1 || $request->formType ==2){
            $regInfo = new CompaniesRegistrationInfo();
            $regInfo->registration_number = $request->input("registration_number");
            $regInfo->registration_address = $request->input("registration_address");
            $regInfo->registration_date = Str::replace("/","-",$request->input("registration_date"));
            $regInfo->registration_type = $request->input("registration_type");
            $regInfo->user_id = $user->id;
            $regInfo->save();
        }


        if ($request->formType !=5){
            $property = new CompaniesProperty();
            $property->cars_count = $request->input("cars_count");
            $property->motorcycle_count = $request->input("motorcycle_count");
            $property->employee_count = $request->input("employee_count");
            $property->user_id = $user->id;
            $property->save();
        }





        $photoPath = "companies/".md5($request->input("company_name")) . "-".$user->id.".jpeg";
        $base64Image = explode(";base64,", $request->photo);
        $image_base64 = base64_decode($base64Image[1]);
        $store = Storage::put($photoPath, $image_base64);



        $company = new Company();
        $company->user_id = $user->id;
        $company->trade_name = $request->input("trade_name");
        $company->formType = $request->input("formType");
        $company->legal_form = $request->input("legal_form");
        $company->budget = $request->input("company_budget");
        $company->website_url = $request->input("website_url");
        $company->address_id = $address->id;
        $company->legal_registration_id = (isset($regInfo)? $regInfo->id: null);
        $company->photo = $photoPath;
        $company->partner_type_id = $request->input("partnet_type");
        $company->passport_number = $request->input("passport_number");
        $company->property_id = (isset($property) ?$property->id: null);
        $company->ceo_name = $request->input("ceo_name");
        $company->national_id_number = $request->input("national_id_number");

        //page fields
        $company->id_number = $request->input("id_number");
        $company->page_url = $request->input("page_url");


        //app fields
        $company->android_app_id = $request->input("android_app_id");
        $company->android_app_url = $request->input("android_app_url");
        $company->ios_app_id = $request->input("ios_app_id");
        $company->ios_app_url = $request->input("ios_app_url");



        //driver fields
        $company->revision_number = $request->input("revision_number");
        if ($request->formType ==5){
            $driver_license_path = "drivers/".md5($request->company_name)."-".$user->id.".jpeg";

            $base64driverLicense = explode(";base64,", $request->driver_license);
            $base64driverLicense = base64_decode($base64driverLicense[1]);
            Storage::put($driver_license_path, $base64driverLicense);
            $company->driver_license = $driver_license_path;
        }
        $company->save();



        return response()->json(["status"=>true,"message"=>"Form created","form_id"=>$company->id]);

    }


    public function defaultValidation($request){
        $validator = Validator::make($request,[
            "formType"=>["required","max:2"],
            "company_name"=>["required","max:255"],
            "email"=>["required","unique:users","max:100"],
            "phone_number"=>["required","unique:users","max:11"],
            "city_id"=>["required","max:2"],
            "alqada"=>["required","max:255"],
            "almahala"=>["required","max:255"],
            "alziqaq"=>["required","max:255"],
            "passport_number"=>["required","max:255"],
            "national_id_number"=>["required","max:255"],
            "photo"=>["required"],
        ]);

        return $validator;




    }

    public function companyRegistrationValidation($request){
        $validator = Validator::make($request,[
            "registration_number"=>["required","max:255"],
            "registration_address"=>["required","max:255"],
            "registration_date"=>["required","max:100","date_format:Y-m-d"],
            "registration_type"=>["required"],

        ]);

        return $validator;



    }



    public function upload(Request $request){


        if ($request->hasFile("image")){

            $imageName = time().'.'.$request->file("image")->getClientOriginalExtension();
            $filePath = "public/". $imageName;
//
            $store = Storage::put($filePath, file_get_contents($request->file("image")));



//            return Storage::disk('s3')->response($filePath);


        }

    }
}
