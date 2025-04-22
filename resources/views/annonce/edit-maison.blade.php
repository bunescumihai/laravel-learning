@extends('layouts.base')

@section('title', 'Create annonce maison')

@section('content')
    <h1 class="mt-3">Edit annonce maison</h1>
    <div class="col-4">
        <x-annonce-form :annonce="$annonce" :action="route('annonces.update-maison', $annonce->id)" :method="'PUT'">
            <x-annonce-maison-specifications-partial-form :annonce="$annonce"></x-annonce-maison-specifications-partial-form>
        </x-annonce-form>
    </div>
@endsection
