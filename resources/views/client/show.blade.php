@extends('layouts.base')

@section('title', 'View client')

@section('content')
    <section class="mt-4">
        <div class="row">
            <div class="col-3 d-flex align-items-center flex-column">
                <div class="rounded-circle"
                     style="width: 200px; height: 200px; background-image: url('{{asset('storage/'. $client->image)}}'); background-size: cover; background-position: center;">
                </div>
                <div class="ms-4">
                    <h1 class="mt-3">{{ $client->name }}</h1>
                    <p class="mt-2">Address: {{ $client->address }}</p>
                    @if($client->contacts->isNotEmpty())
                        <p class="mt-2">Contacts:</p>
                        <ul>
                            @foreach($client->contacts as $contact)
                                <li>{{ \App\Enums\ContactTypeEnum::getKeyByValue($contact->type).': ' . $contact->value }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
            <div class="col-9">
                <div class="d-flex">
                    <a href="{{route('annonces.create-maison', $client->id)}}" class="btn btn-outline-secondary">Create annonce maison</a>
                    <a href="{{route('annonces.create-terrain', $client->id)}}" class="btn btn-outline-secondary ms-3">Create annonce terrain</a>
                </div>

                <div>
                    <x-annonces :annonces="$client->annonces"></x-annonces>
                </div>
            </div>
        </div>
    </section>

@endsection
