<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{

    // TODO: Validadation
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Gate::allows('manage-users')) return $next($request);
            abort(403, 'Anda tidak memiliki cukup hak akses');
        });
    }


    public function index(Request $request)
    {
        $users = User::paginate(6);
        $filterKeyword = $request->get('keyword');
        $status = $request->get('status');

        if ($status) {
            $users = User::where('status', $status)
                ->paginate(6);
        } else {
            $users = User::paginate(6);
        }

        if ($filterKeyword) {
            if ($status) {
                $users = User::where('email', 'LIKE', "%$filterKeyword%")
                    ->where('status', $status)
                    ->paginate(6);
            } else {
                $users = User::where('email', 'LIKE', "%$filterKeyword%")
                    ->paginate(6);
            }
        }
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view("users.create");
    }


    public function store(Request $request)
    {
        Validator::make($request->all(), [
            "name" => "required|min:5|max:100",
            "username" => "required|min:5|max:20|unique:users",
            "roles" => "required",
            "phone" => "required|digits_between:10,12",
            "address" => "required|min:20|max:200",
            "avatar" => "required",
            "email" => "required|email|unique:users",
            "password" => "required",
            "password_confirmation" => "required|same:password"
        ])->validate();

        $user = new User;
        $user->name = $request->get('name');
        $user->username = $request->get('username');
        $user->roles = json_encode($request->get('roles'));
        $user->address = $request->get('address');
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->password = Hash::make($request->get('password'));
        if ($request->file('avatar')) {
            $file = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $file;
        }
        $user->save();
        return redirect()->route('users.create')->with('status', 'User
        successfully created');
    }


    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', ['user' => $user]);
    }


    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', ['user' => $user]);
    }


    public function update(Request $request, $id)
    {
        Validator::make($request->all(), [
            "name" => "required|min:5|max:100",
            "roles" => "required",
            "phone" => "required|digits_between:10,12",
            "address" => "required|min:20|max:200",
        ])->validate();

        $user = User::findOrFail($id);
        $user->name = $request->get('name');
        $user->roles = json_encode($request->get('roles'));
        $user->address = $request->get('address');
        $user->phone = $request->get('phone');
        if ($user->avatar && file_exists(storage_path('app/public/' . $user->avatar))) {
            Storage::delete('public/' . $user->avatar);
            $file = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $file;
        }
        $user->save();
        return redirect()->route('users.index', [$id])->with('status', 'User
        succesfully updated');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index')->with('status', 'User
        successfully delete');
    }
}
