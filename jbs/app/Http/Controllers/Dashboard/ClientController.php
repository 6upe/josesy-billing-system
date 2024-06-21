<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::paginate(8);
        $data = ['nav_status' => 'clients', 'clients' => $clients];
        return view('dashboard.clients', compact('data'));
    }

    

    public function addClient()
    {
        $data = ['nav_status' => 'clients'];
        return view('dashboard.clients.addClient', compact('data'));
    }

    public function saveClient(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:clients',
            'phone_number' => 'required|string|max:255',
            'physical_address' => 'required|string|max:255',
        ]);

        Client::create($request->all());

        return redirect()->route('dashboard.clients')->with('success', 'Client created successfully.');
    }

    public function editClient($id)
    {
        $client = Client::findOrFail($id);
        $data = ['nav_status' => 'clients', 'client' => $client];
        return view('dashboard.clients.editClient', compact('data'));
    }

    public function updateClient(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:clients,email,' . $id,
            'phone_number' => 'required|string|max:255',
            'physical_address' => 'required|string|max:255',
        ]);

        $client = Client::findOrFail($id);
        $client->update($request->all());

        return redirect()->route('dashboard.clients')->with('success', 'Client updated successfully.');
    }

    public function deleteClient($id)
    {
        $client = Client::findOrFail($id);
        $client->delete();

        return redirect()->route('dashboard.clients')->with('success', 'Client deleted successfully.');
    }


}
