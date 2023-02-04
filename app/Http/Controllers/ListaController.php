<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lista;
use App\Models\Item;
use Illuminate\Support\Carbon;

class ListaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function findAll()
    {
        return Lista::all();
    }

    public function findById($id = null)
    {
        return Lista::find($id);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd(request->item["name"]);
        $newItem = new Lista;
        $newItem->name = $request->lista["name"];
        $newItem->save();

        return $newItem;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $existingItem = Lista::find($id);

        if ( $existingItem ){
            $existingItem->completed = $request->lista['completed'] ? true : false;
            $existingItem->completed_at = $request->lista['completed'] ? Carbon::now() : null;
            $existingItem->save();
            return $existingItem;
        }

        return "Item not found.";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $existingLista = Lista::find($id);
        if ( $existingLista ){
            $existingLista->delete();

            $existingItems = Item::where('list_id',$id);
            if ( $existingItems ){
                $existingItems->delete();
            }
            return 'Lista Excluida';
        }
        return 'Lista nao encontrada.';
    }
}
