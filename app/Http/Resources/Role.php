<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class Role extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'type'          => 'roles',
            'id'            => (string)$this->id,
            'attributes'    => [
                'name' => $this->name,
                'description' => $this->description
            ],
            'links' => [
                'self' => route('roles.show', ['name' => $this->name])
            ],
        ];
    }
}
