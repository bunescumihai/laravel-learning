@extends('layouts.base')

@section('title', 'Clients')

@section('content')
    <h1 class="my-3">Clients</h1>

    <div class="d-flex justify-content-end">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Create</button>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="p-4">

                    <form action="{{route('client.store')}}" method="post">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Full name</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="enter your email">
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" id="email" placeholder="enter your email">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input class="form-control" name="password" type="password" id="password">
                        </div>

                        <div class="mb-3">
                            <label for="text" class="form-label">Address</label>
                            <input class="form-control" name="address" type="text" id="text">
                        </div>

                        <div>
                            <label for="image"></label>
                            <input name="image" id="image" type="file" accept="images/jpg">
                        </div>

                        <button class="btn btn-primary mt-4"> Submit</button>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">First</th>
            <th scope="col">Last</th>
            <th scope="col">Handle</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th scope="row">1</th>
            <td>Mark</td>
            <td>Otto</td>
            <td>@mdo</td>
        </tr>
        <tr>
            <th scope="row">2</th>
            <td>Jacob</td>
            <td>Thornton</td>
            <td>@fat</td>
        </tr>
        <tr>
            <th scope="row">3</th>
            <td colspan="2">Larry the Bird</td>
            <td>@twitter</td>
        </tr>
        </tbody>
    </table>
@endsection
