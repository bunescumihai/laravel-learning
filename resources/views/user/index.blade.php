@extends('layouts.base')

@section('title', 'Users')

@section('content')

    @if(session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif

    <div class="d-flex justify-content-between">
        <h1 class="my-3">Users</h1>
        <div class="d-flex align-items-center">
            <a href="{{route('users.create')}}" class="btn btn-primary"> Create user</a>
        </div>
    </div>

    @if($users-> isEmpty())
        <div class="alert alert-info mt-3">
            No users found.
        </div>
    @else
        <table class="table table-striped mt-5">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <th scope="row"></th>
                    <td>
                        <div class="align-items-center d-flex">

                            <div class="rounded-circle me-2"
                                 style="background-image: url('{{asset('storage/' . $user->image)}}'); width: 40px; height: 40px; background-size: cover; background-position: center"></div>
                            {{ $user->name }}
                        </div>
                    </td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->roles->pluck('name')[0]}}</td>
                    <td>
                        <a class="link-primary" href="{{ route('users.edit', $user->id) }}">
                            Edit
                        </a>
                    </td>
                    <td>
                        @if($user->id == auth()->user()->id)
                            YOU
                        @else
                            <form action="{{route('users.destroy', $user->id)}}" method="post">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
@endsection
