<?php

namespace App\Http\Controllers;

use App\Models\Import_pokemon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Exception;

class PokemonController extends Controller
{

    public function find(Request $request){

        $apiUrl = "https://pokeapi.co/api/v2/pokemon/{$request->nomePoke}";

        try {

            $response = Http::get($apiUrl);
            $retorno = $response->object();
            $pokemons = (array) $retorno;

            $pokemons["results"] = $pokemons["forms"];
            $pokemons["count"] = 1;
            $pokemons["page"] = $request->page;

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

    public function nextPage($page){

        $nextPage = (int) $page + 10;

        $apiUrl = "https://pokeapi.co/api/v2/pokemon?limit=10&offset={$nextPage}";

        try {

            $response = Http::get($apiUrl);
            $retorno = $response->object();
            $pokemons = (array) $retorno;
            $pokemons["page"] = $nextPage;

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

    public function beforePage($page){

        $nextPage = $page == "0" ? 0 : (int) $page - 10;

        $apiUrl = "https://pokeapi.co/api/v2/pokemon?limit=10&offset={$nextPage}";

        try {

            $response = Http::get($apiUrl);
            $retorno = $response->object();
            $pokemons = (array) $retorno;
            $pokemons["page"] = $nextPage;

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

    public function detalhes($url){

        $urlDetalhe = base64_decode($url);

        try {

            $response = Http::get($urlDetalhe);
            $retorno = $response->object();
            $pokemon = (array) $retorno;

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

            $pokemon["base_experience"] = "";

        }

        return view('detalhes', compact('pokemon'));

    }

}
