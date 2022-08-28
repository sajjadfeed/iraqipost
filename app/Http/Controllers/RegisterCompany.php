<?php

namespace App\Http\Controllers;

use App\IraqiCity;
use App\PartnerType;
use Illuminate\Http\Request;

class RegisterCompany extends Controller
{
    //

    public function create(){

        $iraqi_cities = IraqiCity::all();
        $partner_types = PartnerType::all();

        return view("web.company.create",["cities"=>$iraqi_cities,"partner_types"=>$partner_types]);
    }

}
