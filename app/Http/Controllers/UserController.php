<?php

namespace App\Http\Controllers;

use App\Enums\RoleEnum;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::get();

        return view('user.index', [
            'users' => $users,
        ]);
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(CreateUserRequest $request)
    {
        if (isset($request->validated()['image'])) {
            $imagePath = $request->validated()['image']->store('images', 'public'); // Save in 'storage/app/public/images'
        }

        $user = new User();

        $user->fill([
            'name' => $request->validated()['name'],
            'address' => $request->validated()['address'],
            'image' => $imagePath ?? null,
            'email' => $request->validated()['email'],
        ]);

        $user->password = Hash::make($request->validated()['password']);
        $user->save();

        $user->assignRole($request->validated()['role']);

        return redirect()
            ->route('users.index')
            ->with('success', 'User created successfully!');
    }

    public function update(UpdateUserRequest $request, $id)
    {

        dd($request->validated());

        if (isset($request->validated()['image'])) {
            $imagePath = $request->validated()['image']->store('images', 'public'); // Save in 'storage/app/public/images'
        }

        $user = User::findOrFail($id);

        $user->name = $request->validated()['name'];
        $user->address = $request->validated()['address'];
        $user->image = $imagePath ?? $user->image;
        $user->syncRoles($request->validated()['role']);

        $user->save();

        return redirect()->route('users.index')
            ->with('success', 'User updated successfully!');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('user.edit')
            ->with('user', $user)
            ;
    }

    public function destroy($id)
    {
        if($id === auth()->user()->id)
            return redirect()->route('user.index')->with(
                'error', 'You cannot delete your own account!'
            );

        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with(
            'success', 'User deleted successfully!'
        );
    }
}
