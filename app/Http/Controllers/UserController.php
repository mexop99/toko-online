<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $users = User::paginate(5);
        $status = $request->get('status');
        $filterKeyword = $request->get('keyword');
        if ($filterKeyword) {
            if ($status) {
                # code...
                $users = User::where('email', 'LIKE', "%$filterKeyword%")->where('status', $status)->paginate(10);
            } else {
                $users = User::where('email', 'LIKE', "%$filterKeyword%")->paginate(10);
            }
        }
        return view('users.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view("users.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        /**
         * Validasi Input Form
         */
        Validator::make($request->all(), [
            "name" => "required|min:6|max:100",
            "username" => "required|min:6|max:20|unique:users",
            "roles" => "required",
            "address" => "required|min:10|max:200",
            "avatar" => "required",
            "email" => "required|email|unique:users",
            "password" => "required|min:6",
            "password2" => "required|same:password",
        ])->validate();



        /**
         * mengambil data dari form
         * 
         */
        $new_user = new User;

        $new_user->name = $request->get('name');
        $new_user->username = $request->get('username');
        $new_user->roles = json_encode($request->get('roles'));
        $new_user->address = $request->get('address');
        $new_user->email = $request->get('email');
        $new_user->password = Hash::make($request->get('password'));

        if ($request->file('avatar')) {
            $file = $request->file('avatar')->store('avatars', 'public');
            $new_user->avatar = $file;
        }

        $new_user->save();
        return redirect()->route('users.create')->with('status', 'User Successfully Created!');
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
        return view('users.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', ['user' => $user]);
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
        /**
         * validasi
         */

        Validator::make($request->all(), [
            "name"=>"required|min:6|max:100",
            "status" => "required",
            "roles" => "required",
            "address" => "required|min:10|max:250"
        ])->validate();



        /**
         * megambil data request
         */
        $user = User::findOrFail($id);
        $user->name = $request->get('name');
        $user->roles = json_encode($request->get('roles'));
        $user->address = $request->get('address');
        $user->status = $request->get('status');

        if ($request->file('avatar')) {
            if ($user->avatar && file_exists(storage_path('app/public' . $user->avatar))) {
                Storage::delete('public/' . $user->avatar);
            }
            $file = $request->file('avatar')->store('avatar', 'public');
            $user->avatar = $file;
        }
        $user->save();
        return redirect()->route('users.edit', [$id])->with('status', 'User Successfully Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index')->with('status', 'User Successfully Deleted!');
    }
}