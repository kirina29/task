<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SubtaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $st='';
        if($this->status->name=='Новая'){
            $st='0%';
        }
        else if($this->status->name=='В работе'){
            $st='50%';
        }
        else if($this->status->name=='Готова'){
            $st='100%';
        }
            return [
                'id'=>$this->id,
                'name'=>$this->name,
                'manager'=>UserResource::collection($this->users),
                'actualStart'=>$this->start_date,
                'actualEnd'=>$this->deadline_date,
                'status'=>$this->status->name,
                'rowHeight'=>'30',
                'progressValue'=>$st,
            ];
    }
}
