<?php

namespace App\Http\Controllers;

use App\Enums\AnnonceTypeEnum;
use App\Http\Requests\annonce\CreateAnnonceMaisonRequest;
use App\Http\Requests\annonce\CreateAnnonceTerrainRequest;
use App\Http\Requests\annonce\UpdateAnnonceMaisonRequest;
use App\Http\Requests\annonce\UpdateAnnonceTerrainRequest;
use App\Models\Annonce;
use App\Models\AnnonceContact;
use App\Models\Client;
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

        // Store annonce
        $annonce = new Annonce();
        $annonce->fill([
            'title' => $request->validated()['title'],
            'description' => $request->validated()['description'],
            'address' => $request->validated()['address'],
            'specifications' => $request->validated()['specifications'],
            'use_client_contacts' => (bool)($request->validated()['use_client_contacts'] ?? false),
            'start_publication_date' => $request->validated()['start_publication_date'],
            'end_publication_date' => $request->validated()['end_publication_date'],
        ]);
        $annonce->annonce_type = AnnonceTypeEnum::MAISON;
        $client->annonces()->save($annonce);

        // Store contacts
        $contacts = array();
        foreach ($request->validated()['contacts'] as $value) {
            if (!empty($value['value'])) {
                $contact = new AnnonceContact();

                $contact->fill([
                    'contact_type_id' => $value['contactTypeId'],
                    'value' => $value['value'],
                ]);

                $contacts[] = $contact;
            }
        }
        $annonce->contacts()->saveMany($contacts);

        // Store images
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
            'start_publication_date' => $request->validated()['start_publication_date'],
            'end_publication_date' => $request->validated()['end_publication_date'],
        ]);
        $annonce->annonce_type = AnnonceTypeEnum::TERRAIN;
        $client->annonces()->save($annonce);

        // Store contacts
        $contacts = array();
        foreach ($request->validated()['contacts'] as $value) {
            if (!empty($value['value'])) {
                $contact = new AnnonceContact();

                $contact->fill([
                    'contact_type_id' => $value['contactTypeId'],
                    'value' => $value['value'],
                ]);

                $contacts[] = $contact;
            }
        }
        $annonce->contacts()->saveMany($contacts);

        // Store images
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
        $annonce = Annonce::findOrFail($id);

        $viewName = '';

        switch ($annonce->annonce_type) {
            case AnnonceTypeEnum::MAISON->value:
                $viewName = 'annonce.edit-maison';
                break;
            case AnnonceTypeEnum::TERRAIN->value:
                $viewName = 'annonce.edit-terrain';
                break;
            default:
                abort(404);
        }

        return view($viewName)
            ->with('annonce', $annonce)
            ;
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateTerrain(UpdateAnnonceTerrainRequest $request, string $id)
    {
        $annonce = Annonce::findOrFail($id);
        $annonce->fill([
            'title' => $request->validated()['title'],
            'description' => $request->validated()['description'],
            'address' => $request->validated()['address'],
            'specifications' => $request->validated()['specifications'],
            'use_client_contacts' => (bool)($request->validated()['use_client_contacts'] ?? false),
            'start_publication_date' => $request->validated()['start_publication_date'],
            'end_publication_date' => $request->validated()['end_publication_date'],
        ]);
        $annonce->save();


        // Store contacts
        $contacts = array();
        $annonce->contacts()->delete();
        foreach ($request->validated()['contacts'] as $value) {
            if (!empty($value['value'])) {
                $contact = new AnnonceContact();

                $contact->fill([
                    'contact_type_id' => $value['contactTypeId'],
                    'value' => $value['value'],
                ]);

                $contacts[] = $contact;
            }
        }
        $annonce->contacts()->saveMany($contacts);


        // Store images
        if ($request->has('images')) {
            foreach ($request->file('images') as $imageFile) {
                $imageUrl = $imageFile->store('images', 'public');
                $annonce->images()->create([
                    'image' => $imageUrl,
                ]);
            }
        }

        return redirect()->route('clients.show', $annonce->client_id)
            ->with('success', 'Annonce updated successfully!')
            ;

    }
    /**
     * Update the specified resource in storage.
     */
    public function updateMaison(UpdateAnnonceMaisonRequest $request, string $id)
    {

        $annonce = Annonce::findOrFail($id);
        $annonce->fill([
            'title' => $request->validated()['title'],
            'description' => $request->validated()['description'],
            'address' => $request->validated()['address'],
            'specifications' => $request->validated()['specifications'],
            'use_client_contacts' => $request->validated()['use_client_contacts'],
            'start_publication_date' => $request->validated()['start_publication_date'],
            'end_publication_date' => $request->validated()['end_publication_date'],
        ]);
        $annonce->save();


        $contacts = array();
        $annonce->contacts()->delete();
        foreach ($request->validated()['contacts'] as $value) {
            if (!empty($value['value'])) {
                $contact = new AnnonceContact();

                $contact->fill([
                    'contact_type_id' => $value['contactTypeId'],
                    'value' => $value['value'],
                ]);

                $contacts[] = $contact;
            }
        }
        $annonce->contacts()->saveMany($contacts);

        if ($request->has('images')) {
            foreach ($request->file('images') as $imageFile) {
                $imageUrl = $imageFile->store('images', 'public');
                $annonce->images()->create([
                    'image' => $imageUrl,
                ]);
            }
        }

        return redirect()->route('clients.show', $annonce->client_id)
            ->with('success', 'Annonce updated successfully!')
            ;
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

        return response()->json([
            'success' => true,
        ]);
    }

}
