<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResources extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id'=>$this['id'],
            'category_id'=>$this['category_id'],
            'title'=>$this['title_'.auth()->user()->lang],
            'photo'=>get_file($this->photo)
        ];

    }//end fun
}//end class
