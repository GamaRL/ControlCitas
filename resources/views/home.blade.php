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
    <div class="container flex flex-wrap items-center justify-center h-screen">
        <h1 class="text-xl">Home</h1>
    </div>
</x-app-layout>
