<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $clients = Client::paginate(8);
        $data = ['nav_status' => 'clients', 'user' => $user, 'clients' => $clients];
        return view('dashboard.clients', compact('data'));
    }

    

    public function addClient()
    {
        $user = Auth::user();
        $data = ['nav_status' => 'clients', 'user' => $user];
        return view('dashboard.clients.addClient', compact('data'));
    }

    public function saveClient(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:clients',
            'phone_number' => 'required|string|max:255',
            'physical_address' => 'required|string|max:255',
            'contact_person_name' => 'required|string|max:255',
            'contact_person_phone' => 'required|string|max:255',
            'contact_person_position' => 'required|string|max:255',
            'contact_person_email' => 'required|string|max:255',

        ]);

        Client::create($request->all());

        return redirect()->route('dashboard.clients')->with('success', 'Client created successfully.');
    }

    public function editClient($id)
    {
        $user = Auth::user();
        
        $client = Client::findOrFail($id);
        $data = ['nav_status' => 'clients', 'client' => $client,'user' => $user];
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
