@extends('../layout/base')

@section('title','Authentication')

@section('content')
    <div class="col-4 mt-3">
        <form action="" method="post">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" placeholder="enter your email">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input class="form-control" type="password" id="password">
            </div>
            <button class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
