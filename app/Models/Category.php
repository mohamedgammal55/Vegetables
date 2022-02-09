<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded=[];

    protected $appends=['title'];

    public function getTitleAttribute()
    {
        return $this->title_ar . '  --  '. $this->title_en;
    }
}//end class
