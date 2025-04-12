<?php

namespace App\Http\Controllers;

use App\Enums\RoleEnum;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function list()
    {
        $users = User::whereHas('roles', function ($query) {
            $query->where('name', RoleEnum::ADMIN)
                ->orWhere('name', RoleEnum::MANAGER);
        })->where('id', '!=', auth()->user()->id)
            ->orderBy('id', 'desc')->get();

        return view('user.list', [
            'users' => $users,
        ]);
    }

    public function createView()
    {
        return view('user.create');
    }

    public function create(CreateUserRequest $request)
    {
        if (isset($request->validated()['image'])) {
            $imagePath = $request->validated()['image']->store('images', 'public'); // Save in 'storage/app/public/images'
        }

        $user = User::create([
            'name' => $request->validated()['name'],
            'email' => $request->validated()['email'],
            'address' => $request->validated()['address'],
            'image' => $imagePath,
            'password' => Hash::make($request->validated()['password']),
        ]);

        $user->assignRole($request->validated()['role']);

        return redirect()
            ->route('user.list')
            ->with('success', 'User created successfully!');
    }

    public function edit(UpdateUserRequest $request, $id)
    {
        if (isset($request->validated()['image'])) {
            $imagePath = $request->validated()['image']->store('images', 'public'); // Save in 'storage/app/public/images'
        }

        $user = User::findOrFail($id);

        $user->name = $request->validated()['name'];
        $user->address = $request->validated()['address'];
        $user->syncRoles($request->validated()['role']);
        $user->image = $imagePath ?? $user->image;


        $user->save();

        return redirect()->route('user.list')
            ->with('success', 'User updated successfully!');
    }

    public function editView($id)
    {
        $user = User::findOrFail($id);

        return view('user.edit')
            ->with('user', $user)
            ;
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('user.list')->with(
            'success', 'User deleted successfully!'
        );
    }
}
