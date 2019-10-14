<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class UserRoleRelationship extends Resource
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
            'roles'   => [
                'links' => [
                    'self' => route('users.relationships.roles', ['id' => $this->id]),
                ],
                'data'  => $this->roles,
            ]
        ];
    }
}
