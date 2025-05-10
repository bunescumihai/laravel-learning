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
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
        </tr>
        </thead>
        <tbody>

        @foreach($annonces as $annonce)
            <tr class="annonce-row-wrapper " data-annonce-id="{{ $annonce->id }}">
                <th scope="row"></th>
                <td>{{ $annonce->title }}</td>
                <td class="text-nowrap overflow-hidden text-truncate" style="max-width: 150px">{{ $annonce->description }}</td>
                <td>{{ $annonce->address }}</td>

                <td>
                    @foreach($annonce->contacts as $contact)
                        {{ $contact->contactType->name }}: {{ $contact->value }} <br/>
                    @endforeach
                </td>
                <td>{{$annonce->created_at}}</td>
                <td><a href="{{route('annonces.edit', $annonce->id)}}" class="link-primary">Edit</a></td>

                <td>
                    <button class="btn btn-danger annonce-delete">Delete</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <script>
        $('.annonce-delete').on('click', function (e){
            e.preventDefault();
            const clientRow = $(this).closest('.annonce-row-wrapper');
            const annonceId = clientRow.data('annonceId');

            if (confirm('Are you sure you want to delete this annonce?')) {
                $.ajax({
                    url: '/annonces/' + annonceId,
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
@endif
