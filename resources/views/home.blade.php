@section('title', 'Login')

<x-app-layout>
    <x-slot name="header">
        <h2>
            <span class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Welcome' ) }}
            </span>
            @auth
                <span class="font-extrabold text-black text-xl">@ {{\Illuminate\Support\Facades\Auth::user()['name']}}</span>
            @endauth
        </h2>
    </x-slot>
    <div class="container flex flex-wrap items-center min-h-screen justify-center">
        <div class="w-full md:w-1/2 p-10">
            <img src="/img/logo.gif" alt="Sistema de Gestión de Citas Médicas" class="rounded-full shadow hover:shadow-2xl cursor-pointer"/>

        </div>
    </div>
</x-app-layout>
