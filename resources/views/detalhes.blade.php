<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detalhes Pokémon') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <b>Name:</b> {{($pokemon["name"] != "" ? mb_strtoupper($pokemon["name"]) : mb_strtoupper($pokemon["forms"][0]->name))}}<br>
                    <b>Height:</b> {{(isset($pokemon["height"]) ? $pokemon["height"] : "" )}}<br>
                    <b>Weight:</b> {{(isset($pokemon["weight"]) ? $pokemon["weight"] : "" )}}<br>
                    <b>Thumbnail:</b>
                    @php

                        $src = (isset($pokemon['sprites']->other->dream_world->front_default) ?
                            $pokemon['sprites']->other->dream_world->front_default :
                            $pokemon['sprites']->front_default)

                    @endphp
                    <img src="{{$src}}" width="200" height="200">
                    <br>

                </div>

            </div>
        </div>
    </div>
</x-app-layout>
