@extends('layouts.base')

@section('title', 'Clients')

@section('content')
    <h1 class="my-3">Clients</h1>

    <div class="d-flex justify-content-end">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Create</button>
    </div>

    @isset($success)
        <div class="alert alert-success mt-3">
            {{ $success }}
        </div>
    @endisset

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="p-4 position-relative">

                    <button data-bs-dismiss="modal" class="btn btn-close position-absolute end-0 me-3"></button>
                    <h3>Create client</h3>

                    <form action="{{route('clients.store')}}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Full name</label>
                            <input
                                name="name"
                                id="name"
                                type="text"
                                class="form-control"
                                value="{{ old('name') }}"
                                required
                            >
                        </div>

                        <div class="mb-3">
                            <label for="text" class="form-label">Address</label>
                            <input
                                name="address"
                                id="text"
                                class="form-control"
                                type="text"
                                value="{{ old('address') }}"
                                required
                            >
                            @error('address')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="image" class="form-label">Choose an image</label>
                            <input name="image" id="image" type="file" class="form-control" accept="images/jpg"
                                   required>
                            @error('image')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            @foreach($contactTypes as $index => $contactType)
                                <label for="{{$contactType->name}}" class="form-label">{{ $contactType->name }}</label>
                                <input type="hidden" name="contacts[{{ $index }}][contactTypeId]" class="form-control"
                                       value="{{ $contactType->id }}" required>
                                <input name="contacts[{{ $index }}][value]" id="{{$contactType->name}}" class="form-control">
                            @endforeach
                        </div>

                        <button class="btn btn-primary mt-4">Submit</button>

                    </form>
                </div>
            </div>
        </div>
    </div>

    @if($clients-> isEmpty())
        <div class="alert alert-info mt-3">
            No users found.
        </div>
    @else
        <table class="table table-striped mt-5">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Address</th>
                <th scope="col">Contacts</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
            </tr>
            </thead>
            <tbody>
            @foreach($clients as $client)
                <tr class="client-row-wrapper" data-client-id="{{ $client->id }}">
                    <th scope="row"></th>
                    <td>
                        <a href="{{ route('clients.show', $client->id) }}" class="align-items-center d-flex">

                            <div class="rounded-circle me-2"
                                 style="background-image: url('{{asset('storage/' . $client->image)}}'); width: 40px; height: 40px; background-size: cover; background-position: center"></div>
                            {{ $client->name }}
                        </a>
                    </td>

                    <td>{{ $client->address }}</td>

                    <td>
                        @foreach($client->contacts as $contact)
                            {{$contact->contactType->name}}: {{ $contact->value }}<br>
                        @endforeach
                    </td>


                    <td>
                        <a class="link-primary" href="{{ route('clients.edit', $client->id) }}">
                            Edit
                        </a>
                    </td>

                    <td>
                        <button class="btn btn-danger client-delete" type="submit">Delete</button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif

    @if ($errors->any())
        <script>
            var myModal = new bootstrap.Modal(document.getElementById('exampleModal'), {
                keyboard: false
            })
            myModal.toggle();
        </script>
    @endif

    <script>
        $('.client-delete').on('click', function (e){
            e.preventDefault();
            const clientRow = $(this).closest('.client-row-wrapper');
            const clientId = clientRow.data('clientId');

            if (confirm('Are you sure you want to delete this client?')) {
                $.ajax({
                    url: '/clients/' + clientId,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function () {
                        clientRow.remove();
                    },
                    error: function (xhr) {
                        console.error(xhr);
                        alert(xhr.responseJSON.error);
                    }
                });
            }
        });
    </script>

@endsection
