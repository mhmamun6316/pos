<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockTransfer extends Model
{
    use HasFactory;

    protected $guarded = [];

    const STATUS = [
        0 => "Pending",
        1 => "Accepted",
        2 => "Completed"
    ];

    public function LocationFrom(){
        return $this->belongsTo(Outlet::class,'loc_from','id');
    }

    public function LocationTo(){
        return $this->belongsTo(Outlet::class,'loc_to','id');
    }
}
