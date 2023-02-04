<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lista;

class HomeController extends Controller
{
    public function index(Lista $lista_selecionada)
    {
        $listas = Lista::all();

        return view('home', [
            'lista_selecionada' => $lista_selecionada,
            'listas' => $listas
        ]);
    }
}
