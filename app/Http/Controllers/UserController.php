<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {
        $users = User::with('transactions')->get();
        foreach($users as &$user) {
            $user['balance'] = array_sum(array_column($user['transactions']->toArray(),'sum'));
        }

//        return UserResource::collection($users);
        return response()->json(['users'=>UserResource::collection($users)]);

    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'status' => 'required',
        ]);
        $user->update($data);
        return response()->json([new UserResource($user)]);
    }

    public function get_active_user(){
        $users = UserResource::collection(User::where('status', 1)->get());
        return response()->json(['users'=>$users]);
    }
}
