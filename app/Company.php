<?php

namespace App;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;


class Company extends Model
{

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function address(){
        return $this->belongsTo(Address::class);
    }

    public function legal_reg(){
        return $this->belongsTo(CompaniesRegistrationInfo::class,"legal_registration_id");
    }

    public function property(){
        return $this->belongsTo(CompaniesProperty::class);
    }
}
