<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{

    public function index(Request $request)
    {

        $apiUrl = "https://pokeapi.co/api/v2/pokemon?limit=10&offset=0";

        try {

            $response = Http::get($apiUrl);
            $retorno = $response->object();
            $pokemons = (array) $retorno;
            $pokemons["page"] = 0;

        } catch (Exception $e) {

            $pokemons["count"] = 0;

        }

        return view('dashboard', compact('pokemons'));

    }

}
