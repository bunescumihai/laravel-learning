<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAnnonceMaisonRequest;
use App\Http\Requests\CreateAnnonceTerrainRequest;
use App\Models\Annonce;
use App\Models\Client;
use Illuminate\Http\Request;

class AnnonceController extends Controller
{

    public function index()
    {
        return view('annonce.index');
    }

    public function createMaison($id)
    {
        Client::findOrFail($id);

        return view('annonce.create-maison', [
            'id' => $id,
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function createTerrain($id)
    {
        Client::findOrFail($id);

        return view('annonce.create-maison', [
            'id' => $id,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }
    /**
     * Store a newly created resource in storage.
     */
    public function storeMaison(CreateAnnonceMaisonRequest $request, $id)
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeTerrain(CreateAnnonceTerrainRequest $request, $id)
    {
        $client = Client::findOrFail($id);

        $annonce = new Annonce();

        $annonce->fill([
            'client_id' => $request->validated()['client_id'],
            'title',
            'description',
            'address',
            'specifications',
            'use_client_contacts',
            'annonce_type',
        ]);

    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

}
