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
            $id = (int) $pokemons["id"];

            $retorno2 = Import_pokemon::where('idApi',$id)->get();

            if(isset($retorno2->first()->idApi)){
                $pokemons["results"][0]->status = true;
            }else{
                $pokemons["results"][0]->status = false;
            }

            $pokemons["results"][0]->url = str_replace("pokemon-form","pokemon", $pokemons["results"][0]->url);

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

        } catch (Exception $e) {

            $pokemon["base_experience"] = "";

        }

        return view('detalhes', compact('pokemon'));

    }

    public function importar($url){

        $urlDetalhe = base64_decode($url);

        try {

            $id1 = str_replace("https://pokeapi.co/api/v2/pokemon/", "", $urlDetalhe);
            $id = (int) str_replace("/", "", $id1);

            $retorno2 = Import_pokemon::where('idApi',$id)->get();

            if(isset($retorno2->first()->idApi)){

                $msg = (object) [
                    "msg" => "Pokémon já importado",
                    "status" => false
                ];

                return redirect()
                   ->back()
                   ->with('resposta', $msg);

            }else{

                $response = Http::get($urlDetalhe);
                $retorno = $response->object();
                $pokemon = (array) $retorno;

                $data = [
                    "idApi" => $pokemon["id"],
                    "name" =>($pokemon["name"] != "" ? mb_strtoupper($pokemon["name"]) : mb_strtoupper($pokemon["forms"][0]->name)),
                    "height" =>(isset($pokemon["height"]) ? $pokemon["height"] : "" ),
                    "weight" =>(isset($pokemon["weight"]) ? $pokemon["weight"] : "" ),
                    "thumbnail" => (isset($pokemon['sprites']->front_default) ?
                                $pokemon['sprites']->front_default :
                                $pokemon['sprites']->other->dream_world->front_default)
                ];

                Import_pokemon::create($data);

                $msg = (object) [
                    "msg" => "Importado com sucesso!",
                    "status" => true
                ];

                return redirect()
                    ->back()
                    ->with('resposta', $msg);

            }



        } catch (Exception $e) {

            $msg = (object) [
                "msg" => "Erro ao tentar importar",
                "status" => false
            ];

            return redirect()
                   ->back()
                   ->with('resposta', $msg);

        }

    }

}
