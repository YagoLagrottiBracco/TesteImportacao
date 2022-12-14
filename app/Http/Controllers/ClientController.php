<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Http\Requests\ClientRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Imports\ClientsImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Clients/List', ['clients' => Client::paginate(100)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Clients/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\ClientRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientRequest $request)
    {

        Client::create($request->all());
        return $this->index();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return Inertia::render('Clients/Edit', ['client' => Client::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\ClientRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ClientRequest $request, $id)
    {
        Client::where(['id' => $id])->update($request->all());

        return $this->index();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Client::destroy($id);

        return $this->index();
    }

    /**
     * Import csv of all clients.
     *
     * @param  \Illuminate\Http\ClientRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function import(Request $request)
    {
        ini_set('max_execution_time', -1);
        ini_set('xdebug.max_nesting_level', -1);
        ini_set('memory_limit', -1);

        Validator::make($request->all(), [
            'import' => 'required|mimes:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,xlsx,csv,xls,text,text/csv,application/csv',
        ])->validate();

        Excel::queueImport(new ClientsImport, $request->file()['import']);

        return $this->index();
    }
}
