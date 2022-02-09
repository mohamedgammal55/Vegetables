<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResources extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id'=>$this['id'],
            'title'=>$this['title_'.auth()->user()->lang],
        ];

    }//end fun
}//end class
