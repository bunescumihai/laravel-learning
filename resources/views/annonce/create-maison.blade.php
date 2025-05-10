@extends('layouts.base')

@section('title', 'Create annonce maison')

@section('content')
    <h1 class="mt-3">Create annonce maison</h1>
    <div class="col-4">
        <x-annonce-form :action="route('clients.annonces.store-maison', $id)">
            <x-annonce-maison-specifications-partial-form></x-annonce-maison-specifications-partial-form>
        </x-annonce-form>
    </div>
@endsection
