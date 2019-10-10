<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class User extends Resource
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
            'type'          => 'users',
            'id'            => (string)$this->id,
            'attributes'    => [
                'username' => $this->username,
                'email' => $this->email,
                'name' => $this->name,
                'nisn' => $this->nisn,
                'nip' => $this->nip,
                'gender' => $this->gender,
                'address' => $this->address,
                'date_of_birth' => $this->dob
            ],
            'relationships' => new UserRoleRelationship($this),
            'links' => [
                'self' => route('users.show', ['id' => $this->id]),
            ],
        ];
    }
}
