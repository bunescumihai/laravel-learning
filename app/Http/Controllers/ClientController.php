<?php

namespace App\Http\Controllers;

use App\Enums\RoleEnum;
use App\Http\Requests\CreateClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\Client;
use App\Models\Contact;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use function PHPUnit\Framework\isNull;

class ClientController extends Controller
{

    public function index()
    {
        $clients = Client::orderBy('id', 'desc')->get();

        return View::first(['client.index'])->
            with('clients', $clients);
    }

    public function show(string $id)
    {


        return view('client.show')
            ->with('client', Client::findOrFail($id))
            ;
    }

    public function store(CreateClientRequest $request)
    {
        dump($request->validated()['contacts']);

        $imagePath = $request->validated()['image']->store('images', 'public');
        $client = new Client();

        $client->fill([
            'name' => $request->validated()['name'],
            'image' => $imagePath,
            'address' => $request->validated()['address'],
        ]);

        $client->save();

        $contacts = array();

        foreach ($request->validated()['contacts'] as $value) {
            if (!empty($value['value'])) {
                $contacts[] = [
                    'foreign_id' => $client->id,
                    'type' => $value['type'],
                    'value' => $value['value'],
                ];
            }
        }

        Contact::insert($contacts);


        return redirect()->route('clients.index')
            ->with('success', 'Client created successfully!')
            ;
    }

    public function edit(string $id)
    {
        return view('client.edit')
            ->with('client', Client::findOrFail($id))
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

        foreach ($request->validated()['contacts'] as $value) {
            $contact = Contact::where('foreign_id', $client->id)->where('type', $value['type'])->first();
            if ($contact) {
                if (!empty($value['value'])) {
                    $contact->value = $value['value'];
                    $contact->save();
                } else {
                    $contact->delete();
                }
            } else {
                if (!empty($value['value'])) {
                    Contact::create([
                        'foreign_id' => $client->id,
                        'type' => $value['type'],
                        'value' => $value['value'],
                    ]);
                }
            }
        }



        $client->save();

        return redirect()->route('clients.index')
            ->with('success', 'Client updated successfully!')
            ;
    }

    public function destroy(string $id)
    {
        $client = Client::findOrFail($id);
        Contact::where('foreign_id', $client->id)->delete();

        $client->delete();

        return redirect()->route('clients.index')
            ->with('success', 'Client deleted successfully!')
            ;
    }
}
