<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::all();
        return view('clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request -> validate([
            'client_name' => 'required',
            'post_code' => 'required',
            'client_address' => 'required',
        ]);

        $client = new Client();
        $client->client_name = $request->input('client_name');
        $client->post_code = $request->input('post_code');
        $client->client_address = $request->input('client_address');
        $client->client_phone = $request->input('client_phone');
        $client->delivery_destination = $request->input('delivery_destination');
        $client->save();
        return redirect()->route('clients.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        $request -> validate([
            'client_name' => 'required',
            'post_code' => 'required',
            'client_address' => 'required',
        ]);

        $client->client_name = $request->input('client_name');
        $client->post_code = $request->input('post_code');
        $client->client_address = $request->input('client_address');
        $client->client_phone = $request->input('client_phone');
        $client->delivery_destination = $request->input('delivery_destination');
        $client->save();
        return redirect()->route('clients.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('clients.index');
    }

    public function searchclient(){
        $data = $_POST['searchclient_name'];
        if($data !=null){
            $clients = Client::where('client_name','like', '%'.$data.'%')->get();
        } else{
            $people = null;
        }
        return response()->json($clients);
    }
}


