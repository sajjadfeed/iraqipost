<?php

namespace App\Http\Controllers;

use App\Company;
use App\Models\User;


class PrintFormController extends Controller
{
    //

    public function print($id){

       $company = Company::find($id);

        return view("web.company.print",["company"=>$company]);
    }



}
