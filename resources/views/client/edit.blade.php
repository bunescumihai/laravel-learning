@extends('layouts.base')

@section('title', 'Edit user')

@php
    use App\Enums\RoleEnum;
@endphp

@section('content')
    <h1>Edit user</h1>

    <div class="col-4">
        <form action="{{route('clients.update', $client->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="mb-3">
                <label for="name" class="form-label">Full name</label>
                <input
                    name="name"
                    id="name"
                    type="text"
                    class="form-control"
                    placeholder="enter your full name"
                    value="{{ old('name', $client->name) }}"
                    required
                >
                @error('name')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>


            <div class="mb-3">
                <label for="text" class="form-label">Address</label>
                <input
                    name="address"
                    id="text"
                    type="text"
                    value="{{ old('address', $client->address) }}"
                    class="form-control"
                    required
                >
                @error('address')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Chose an image</label>
                <input name="image" id="image" type="file" accept="images/jpg" class="form-control">
                @error('image')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="form-label">Email</label>
                <input type="hidden" name="contacts[0][type]" class="form-control"
                       value="{{ \App\Enums\ContactTypeEnum::EMAIL }}" required>
                <input name="contacts[0][value]" id="email" value="{{ old('contacts[0][value]', $client->email()) }}" type="email" class="form-control">

                <label for="phone" class="form-label">Phone number</label>
                <input type="hidden" name="contacts[1][type]" class="form-control"
                       value="{{ \App\Enums\ContactTypeEnum::PHONE }}" required>
                <input name="contacts[1][value]" id="phone" value={{ old('contacts[1][value]', $client->phone()) }} type="text" class="form-control">
            </div>

            <button class="btn btn-primary mt-4"> Submit</button>

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

