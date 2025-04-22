@extends('layouts.base')

@section('title', 'Create annonce terrain')

@section('content')
    <h1 class="mt-3">Edit annonce terrain</h1>
    <div class="col-4">
        <x-annonce-form :annonce="$annonce" :action="route('annonces.update-terrain', $annonce->id)" :method="'PUT'">
            <x-annonce-terrain-specifications-partial-form :annonce="$annonce"></x-annonce-terrain-specifications-partial-form>
        </x-annonce-form>
    </div>
@endsection
