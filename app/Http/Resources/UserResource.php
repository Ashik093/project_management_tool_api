<?php

namespace App\Http\Resources;

use Illuminate\Support\Facades\URL;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'user_name'=>$this->user_name,
            'email'=>$this->email,
            'phone'=>$this->phone,
            'gender'=>$this->gender,
            'adress'=>$this->adress,
            'profile_photo'=>URL::to($this->profile_photo),
            'is_active'=>$this->is_active == 1 ? 'Yes':'No',
            'last_login_ip'=>$this->last_login_ip,
            'last_login_date'=>$this->last_login_date,
        ];
    }
}
