@props(['annonces' => []])

@if(empty($annonces) || count($annonces) == 0)
    <div class="alert alert-info mt-3">
        No annonces found.
    </div>
@else
    <table class="table table-striped mt-5">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Description</th>
            <th scope="col">Address</th>
            <th scope="col">Contacts</th>
            <th scope="col">Created at</th>
{{--            <th scope="col">Edit</th>--}}
            <th scope="col">Delete</th>
        </tr>
        </thead>
        <tbody>

        @foreach($annonces as $annonce)
            <tr>
                <th scope="row"></th>
                <td>{{ $annonce->title }}</td>
                <td class="text-nowrap overflow-hidden text-truncate" style="max-width: 150px">{{ $annonce->description }}</td>
                <td>{{ $annonce->address }}</td>

                <td>Contact</td>
                <td>{{$annonce->created_at}}</td>
{{--                <td><a href="#" class="link-primary">Edit</a></td>--}}

                <td>
                    <form action="{{route('annonces.destroy', $annonce->id)}}" method="post">
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endif
