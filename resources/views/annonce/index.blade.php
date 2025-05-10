@extends('../layouts/base')

@section('title', 'Annonces')

@section('content')
    <h1 class="my-3">Annonces</h1>
    <section>
        <x-annonces-grid :annonces="$annonces">
            akdhjsf aksdhjfl kajhdbs
        </x-annonces-grid>
    </section>
@endsection

