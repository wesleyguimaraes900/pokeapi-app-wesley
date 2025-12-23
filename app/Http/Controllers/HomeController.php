<?php

namespace App\Http\Controllers;

use App\Models\Import_pokemon;
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

            foreach ($pokemons["results"] as $poke) {

                $id1 = str_replace("https://pokeapi.co/api/v2/pokemon/", "", $poke->url);
                $id = (int) str_replace("/", "", $id1);

                $retorno2 = Import_pokemon::where('idApi',$id)->get();

                if(isset($retorno2->first()->idApi)){
                    $poke->status = true;
                }else{
                    $poke->status = false;
                }

            }

        } catch (Exception $e) {

            $pokemons["count"] = 0;

        }

        return view('dashboard', compact('pokemons'));

    }

}
