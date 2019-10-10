<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\User as UserResource;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserRoleRelationship;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $maxResult = $request->get('maxResult') ? $request->get('maxResult') : 25;
        return UserResource::collection(
            User::with('roles')
            ->paginate($maxResult)
            ->appends($request->all())
        );
    }

    /**
     * Show the form for creating a new resource.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user = new User;
        $validatedData = $this->validate($request, [
            'username' => 'required|unique:users',
            'password' => 'required',
            'email' => 'required|unique:users',
            'name' => 'required'
        ]);

        $user->username = $request->input('username');
        $user->password = password_hash($request->input('password'), PASSWORD_BCRYPT);
        $user->email = $request->input('email');
        $user->name = $request->input('name');
        $user->nisn = $request->input('nisn');
        $user->nip = $request->input('nip');
        $user->address = $request->input('address');
        $user->dob = $request->input('date_of_birth') ? $request->input('date_of_birth') : date('2000-01-01');
        $user->save();
        
        UserResource::withoutWrapping();
        return new UserResource($user);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        UserResource::withoutWrapping();
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $password = password_hash($request->input('password'), PASSWORD_BCRYPT);

        $user = User::find($id);
        $user->fill($data);
        $user->password = $request->input('password') ? $password : $user->password;
        $user->save();
        UserResource::withoutWrapping();
        return new UserResource($user);
    }

    public function changePassword(Request $request, $id)
    {
        $validatedData = $this->validate($request, [
            'password' => 'required'
        ]);

        $password = password_hash($request->input('password'), PASSWORD_BCRYPT);
        $user = User::find($id);
        $user->password = $password;
        $user->save();
        return response()->json(['message' => 'Password berhasil diganti']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        $user->delete();
        return response()->json([],204); 
    }

    public function roles($id)
    {
        $user = User::findOrFail($id);
        UserRoleRelationship::withoutWrapping();
        return new UserRoleRelationship($user);
    }
}
