<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Exception;

class PokemonController extends Controller
{

    public function limit($qtd){

        $apiUrl = "https://pokeapi.co/api/v2/pokemon?limit={$qtd}";

        try {

            $response = Http::get($apiUrl);
            $retorno = $response->object();
            $pokemons = (array) $retorno;

        } catch (Exception $e) {

            $pokemons["count"] = 0;

        }

        return view('dashboard', compact('pokemons'));

    }

    public function find(Request $request){

        $apiUrl = "https://pokeapi.co/api/v2/pokemon/{$request->nomePoke}";

        try {

            $response = Http::get($apiUrl);
            $retorno = $response->object();
            $pokemons = (array) $retorno;

            $pokemons["results"] = $pokemons["forms"];
            $pokemons["count"] = 1;

        } catch (Exception $e) {

            $pokemons["count"] = 0;

        }

        return view('dashboard', compact('pokemons'));

    }

}
