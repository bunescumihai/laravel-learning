@extends('layouts.base')

@section('title', 'Create user')

@php
    use App\Enums\RoleEnum;
@endphp

@section('content')
    <h1>Create user</h1>
    <div class="col-4 mt-3">
        <form action="{{route('users.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div>
                <label for="name" class="form-label">Full name</label>
                <input
                    name="name"
                    id="name"
                    type="text"
                    class="form-control"
                    placeholder="enter your full name"
                    value="{{ old('name') }}"
                    required
                >
                @error('name')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-3">
                <label for="email" class="form-label">Email</label>
                <input
                    name="email"
                    id="email"
                    type="email"
                    class="form-control"
                    placeholder="enter your email"
                    value="{{ old('email') }}"
                    required
                >
                @error('email')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-3">
                <label for="password" class="form-label">Password</label>
                <input name="password" id="password" type="password" class="form-control" required>
                @error('password')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-3">
                <label for="text" class="form-label">Address</label>
                <input
                    name="address"
                    id="text"
                    type="text"
                    value="{{ old('address') }}"
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
                    <option disabled selected>Select the role</option>
                    <option value="{{RoleEnum::ADMIN}}">Admin</option>
                    <option value="{{RoleEnum::MANAGER}}">Manager</option>
                </select>
            </div>

            <div class="mt-3">
                <label for="image" class="form-label">Chose an image</label>
                <input name="image" id="image" type="file" accept="images/jpg" class="form-control">
                @error('image')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <button class="btn btn-primary mt-3"> Submit</button>

            @if ($errors->any())
                <div class="alert alert-danger">
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
