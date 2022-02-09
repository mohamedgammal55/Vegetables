<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomersResources extends JsonResource
{

    public function toArray($request)
    {
        return [
            'name'=>$this->name,
            'phone'=>$this->phone,
        ];

    }//end fun
}//end class
