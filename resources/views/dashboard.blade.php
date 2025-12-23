<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Listagem Api') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                @if(session()->has('resposta'))
                    @if(!session()->get('resposta')->status)
                        <div class="text-xl dark:text-red-400 p-6 w-7 shadow-sm sm:rounded-lg"
                    style="text-align:center;">
                            <p>{{session()->get('resposta')->msg}}</p>
                        </div>
                    @else
                        <div class="text-xl dark:text-green-400 p-6 w-7 shadow-sm sm:rounded-lg"
                    style="text-align:center;"">
                            <p>{{session()->get('resposta')->msg}}</p>
                        </div>
                    @endif
                @endif

                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <form method="GET" action="/busca">

                        @csrf

                        <div>
                            <x-text-input id="page" value="{{$pokemons['page']}}"
                                type="hidden" name="page" />
                            <x-input-label for="nomePoke" :value="__('Busca por Nome')" />
                            <x-text-input id="nomePoke" class="mt-1 w-[40px]"
                                type="text" name="nomePoke" autofocus autocomplete="Nome do Pokémon" />

                            <x-primary-button class="ms-3">
                                {{ __('Buscar') }}
                            </x-primary-button>

                        </div>

                    </form>

                </div>

                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <a href="{{ route('beforePage', ['page' => $pokemons['page']]); }}" >Anterior</a> &nbsp &nbsp &nbsp
                    <a href="{{ route('nextPage', ['page' => $pokemons['page']]); }}" >Próximo</a>

                    <table class="w-full table-auto border-collapse text-sm">

                        <thead>
                            <tr>
                                <th class="border border-gray-200 p-4 pt-0 pb-3 pl-8 text-left font-medium text-gray-400 dark:border-gray-600 dark:text-gray-200">Nome</th>
                                <th class="border border-gray-200 p-4 pt-0 pb-3 pl-8 text-left font-medium text-gray-400 dark:border-gray-600 dark:text-gray-200">Status</th>
                                <th colspan="2" class="border border-gray-200 p-4 pt-0 pb-3 pl-8 text-left font-medium text-gray-400 dark:border-gray-600 dark:text-gray-200">Detalhes</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-700">

                            @if( isset($pokemons["count"]) && $pokemons["count"] > 0)

                                @foreach($pokemons["results"] as $poke)

                                    <tr>
                                        <td class="border border-gray-200 p-4 pl-8
                                            text-gray-500 dark:border-gray-600 dark:text-gray-400"
                                            style="text-align:center;">
                                            <b>{{mb_strtoupper($poke->name)}}</b>
                                        </td>
                                        <td class="border border-gray-200 p-4 pl-8
                                            text-gray-500 dark:border-gray-600 dark:text-{{($poke->status ? 'green' : 'red')}}-400"
                                            style="text-align:center;">
                                            <b>{{($poke->status ? "Importado" : "Não Importado")}}</b>
                                        </td>
                                        <td class="border border-gray-200 p-4 pl-8
                                            text-blue-500 dark:border-gray-600 dark:text-blue-400"
                                            style="text-align:center;">

                                            @php

                                                $urlCript = base64_encode($poke->url);

                                            @endphp

                                            <a href="{{ route('detalhes', ['url' => $urlCript]); }}" >
                                                Detalhes
                                            </a>

                                        </td>
                                        <td class="border border-gray-200 p-4 pl-8
                                            text-blue-500 dark:border-gray-600 dark:text-blue-400"
                                            style="text-align:center;">
                                            <a  onclick="return confirm('Você tem certeza que gostaria de importar os dados desse Pokémon?');"
                                                 href="{{ route('importar', ['url' => $urlCript]); }}" >
                                                Importar
                                            </a>

                                        </td>
                                    </tr>

                                @endforeach

                            @else

                                <tr>
                                    <td colspan="3" align="center"
                                        class="border border-gray-200 p-4 pl-8
                                            text-gray-500 dark:border-gray-600 dark:text-gray-400"
                                            style="text-align:center;">

                                        NENHUM DADO ENCONTRADO

                                    </td>
                                </tr>

                            @endif

                        </tbody>

                    </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
