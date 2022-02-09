<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function details()
    {
        return $this->hasMany(OrderDetails::class,'order_id');
    }//end fun

    public function employee()
    {
        return $this->belongsTo(User::class,'added_by_id');
    }

}//end class
