<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function dueSale(){
        return $this->hasMany(SaleDue::class,'order_id','id');
    }

    public function outlet(){
        return $this->belongsTo(Outlet::class);
    }

    public function customer(){
        return $this->belongsTo(Customer::class);
    }

}
