<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    public function outlet(){
        return $this->belongsTo(Outlet::class);
    }

    public function category(){
        return $this->belongsTo(ExpenseCategory::class,'expense_category_id','id');
    }

}
