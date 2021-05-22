<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Caseprice;

class Casepc extends Model
{
    use HasFactory;

    public function caseprices()
    {
        return $this->hasMany(Caseprice::class,'casepcID');
    }
}
