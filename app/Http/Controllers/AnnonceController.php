<?php

namespace App\Http\Controllers;

use App\Enums\AnnonceTypeEnum;
use App\Http\Requests\CreateAnnonceMaisonRequest;
use App\Http\Requests\CreateAnnonceTerrainRequest;
use App\Models\Annonce;
use App\Models\Client;
use App\Models\Image;
use Illuminate\Http\Request;

class AnnonceController extends Controller
{

    public function index()
    {
        $annonces = Annonce::orderBy('id', 'desc')->get();

        return view('annonce.index')
            ->with('annonces', $annonces)
            ;
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

        return view('annonce.create-terrain', [
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
        $client = Client::findOrFail($id);

        $annonce = new Annonce();

        $annonce->fill([
            'title' => $request->validated()['title'],
            'description' => $request->validated()['description'],
            'address' => $request->validated()['address'],
            'specifications' => $request->validated()['specifications'],
            'use_client_contacts' => (bool)($request->validated()['use_client_contacts'] ?? false),
        ]);

        $annonce->annonce_type = AnnonceTypeEnum::MAISON;

        $client->annonces()->save($annonce);

        if ($request->has('images')) {
            foreach ($request->file('images') as $imageFile) {
                $imageUrl = $imageFile->store('images', 'public');
                $annonce->images()->create([
                    'image' => $imageUrl,
                ]);
            }
        }

        return redirect()->route('clients.show', $id)
            ->with('success', 'Annonce created successfully!')
            ;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeTerrain(CreateAnnonceTerrainRequest $request, $id)
    {
        $client = Client::findOrFail($id);

        $annonce = new Annonce();

        $annonce->fill([
            'title' => $request->validated()['title'],
            'description' => $request->validated()['description'],
            'address' => $request->validated()['address'],
            'specifications' => $request->validated()['specifications'],
            'use_client_contacts' => (bool)($request->validated()['use_client_contacts'] ?? false),
        ]);

        $annonce->annonce_type = AnnonceTypeEnum::TERRAIN;

        $client->annonces()->save($annonce);

        if ($request->has('images')) {
            foreach ($request->file('images') as $imageFile) {
                $imageUrl = $imageFile->store('images', 'public');
                $annonce->images()->create([
                    'image' => $imageUrl,
                ]);
            }
        }

        return redirect()->route('clients.show', $id)
            ->with('success', 'Annonce created successfully!')
            ;

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
        $annonce = Annonce::findOrFail($id);

//        foreach ($annonce->images as $image){
//            $imagePath = public_path('storage/' . $image->image);
//            if (file_exists($imagePath)) {
//                unlink($imagePath);
//            }
//        };
//
//        $annonce->images()->delete();

        $annonce->delete();

        return redirect()->back();
    }

}
