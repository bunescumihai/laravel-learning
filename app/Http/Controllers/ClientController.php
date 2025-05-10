<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\Client;
use App\Models\ClientContact;
use App\Models\Contact;
use App\Models\ContactType;
use Illuminate\Support\Facades\View;

class ClientController extends Controller
{

    public function index()
    {
        $clients = Client::orderBy('id', 'desc')->get();
        $contactTypes = ContactType::get();

        return View::first(['client.index'])->
            with('clients', $clients)
            ->with('contactTypes', $contactTypes)
            ;
    }

    public function show(string $id)
    {


        return view('client.show')
            ->with('client', Client::findOrFail($id))
            ;
    }

    public function store(CreateClientRequest $request)
    {
        $imagePath = $request->validated()['image']->store('images', 'public');
        $client = new Client();

        $client->fill([
            'name' => $request->validated()['name'],
            'image' => $imagePath,
            'address' => $request->validated()['address'],
        ]);

        auth()->user()->clients()->save($client);

        $contacts = array();

        foreach ($request->validated()['contacts'] as $value) {
            if (!empty($value['value'])) {
                $contact = new ClientContact();

                $contact->fill([
                    'contact_type_id' => $value['contactTypeId'],
                    'value' => $value['value'],
                ]);

                $contacts[] = $contact;
            }
        }

        $client->contacts()->saveMany($contacts);

        return redirect()->route('clients.index')
            ->with('success', 'Client created successfully!')
            ;
    }

    public function edit(string $id)
    {
        return view('client.edit')
            ->with('client', Client::findOrFail($id))
            ->with('contactTypes', ContactType::get())
            ;
    }

    public function update(UpdateClientRequest $request, string $id)
    {
        $client = Client::findOrFail($id);

        $client->name = $request->validated()['name'];
        $client->address = $request->validated()['address'];

        if(isset($request->validated()['image'])){
            $imagePath = $request->validated()['image']->store('images', 'public');
            $client->image = $imagePath;
        }
        $client->save();

        $client->contacts()->delete();

        $contacts = array();

        foreach ($request->validated()['contacts'] as $value) {
            if (!empty($value['value'])) {
                $contact = new ClientContact();

                $contact->fill([
                    'contact_type_id' => $value['contactTypeId'],
                    'value' => $value['value'],
                ]);

                $contacts[] = $contact;
            }
        }

        $client->contacts()->saveMany($contacts);

        return redirect()->route('clients.index')
            ->with('success', 'Client updated successfully!')
            ;
    }

    public function destroy(string $id)
    {

        $client = Client::findOrFail($id);

        if($client->annonces()->count() > 0){
            return response()->json(['error' => 'Client cannot be deleted because it has associated annonces.'], 400);
        }

        Contact::where('foreign_id', $client->id)->delete();
        $client->delete();

        return response()->json(['success' => 'Client deleted successfully!']);
    }
}
