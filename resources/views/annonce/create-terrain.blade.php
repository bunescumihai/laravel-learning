@extends('layouts.base')

@section('title', 'Create annonce terrain')

@section('content')
    <h1 class="mt-3">Create annonce terrain</h1>
    <div class="col-4">
        <x-annonce-form :action="route('clients.annonces.store-terrain', $id)">
            <x-annonce-terrain-specifications-partial-form></x-annonce-terrain-specifications-partial-form>
        </x-annonce-form>
    </div>
@endsection
