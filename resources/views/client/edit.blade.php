@extends('layouts.base')

@section('title', 'Edit user')

@php
    use App\Enums\ContactTypeEnum;
@endphp

@section('content')
    <h1>Edit client</h1>

    <div class="col-4">
        <form action="{{route('clients.update', $client->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')

            <div class="mt-2">
                <label for="image" class="form-label">Change your avatar</label>

                <div style="width: 200px; height: 200px;">
                    <label for="image"
                           id="image-label"
                           class="form-label-image"
                           style="background-image: url('{{ asset('/storage/' . $client->image) }}')"
                    >
                        <i class="bi-image h1 icon"></i>
                    </label>
                </div>

                <input
                    name="image"
                    id="image"
                    type="file"
                    accept="images/jpg"
                    class="d-none"
                >
                @error('image')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-3">
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

            <div class="mt-3">
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

            @foreach($contactTypes as $index => $contactType)
                <div class="mt-3">
                    <label for="{{$contactType->name}}" class="form-label">{{ $contactType->name }}</label>
                    <input type="hidden" name="contacts[{{ $index }}][contactTypeId]" class="form-control"
                           value="{{ $contactType->id }}" required>
                    <input name="contacts[{{ $index }}][value]" id="{{$contactType->name}}"
                           value="{{ old('contacts[' . $index . '][value]', optional($client->contacts->firstWhere('contact_type_id', $contactType->id))->value) }}"
                           class="form-control">
                </div>
            @endforeach

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
    <script>
        $('#image').on('change', function () {

            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    $('#image-label').css('background-image', 'url(' + e.target.result + ')');
                }
                reader.readAsDataURL(file);
            } else {
                $('#image-label').css('background-image', 'url({{ asset('/storage/' . $client->image) }})');
            }
        });
    </script>
@endsection

