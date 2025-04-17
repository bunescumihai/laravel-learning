@extends('layouts.base')

@section('title', 'Edit user')

@php
    use App\Enums\RoleEnum;
@endphp

@section('content')
    <h1>Edit user</h1>

    <div class="col-4">
        <form action="{{route('users.update', $user->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')

            <div>
                <label for="name" class="form-label">Full name</label>
                <input
                    name="name"
                    id="name"
                    type="text"
                    class="form-control"
                    placeholder="enter your full name"
                    value="{{ old('name', $user->name) }}"
                    required
                >
                @error('name')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-3">
                <label for="text" class="form-label">Address</label>
                <input
                    name="address"
                    id="text"
                    type="text"
                    value="{{ old('address', $user->address) }}"
                    class="form-control"
                    required
                >
                @error('address')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-3">
                <label for="role">Role</label>
                <select class="form-select" name="role" id="role" required>
                    <option @selected($user->hasRole(RoleEnum::ADMIN)) value="{{RoleEnum::ADMIN}}">Admin</option>
                    <option @selected($user->hasRole(RoleEnum::MANAGER)) value="{{RoleEnum::MANAGER}}">Manager</option>
                </select>
            </div>

            <div class="mt-3">
                <label for="image" class="form-label">Chose an image</label>
                <input name="image" id="image" type="file" accept="images/jpg" class="form-control">
                @error('image')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <button class="btn btn-primary mt-4"> Submit</button>

            @if ($errors->any())
                <div class="alert alert-danger mt-3">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </form>
    </div>
@endsection

