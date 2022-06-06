@section('title', __('View Profile'))

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('View Profile' ) }}
        </h2>
    </x-slot>
    <div class="container flex items-center justify-center min-h-full p-10">
        <div class="bordered shadow p-10 rounded overflow-hidden shadow-xl rounded bg-white hover:shadow-2xl xl:w-1/3 sm:w-2/3 w-full">
            <div class="flex justify-center">
                <div class="rounded-full bg-indigo-800 text-white p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
            </div>
            <x-forms.input disabled name="name" value="{{$user->name}}">
                {{__('Name')}}
            </x-forms.input>
            <x-forms.input disabled name="first_last_name" value="{{$user->first_last_name}}">
                {{__('First Last Name')}}
            </x-forms.input>
            <x-forms.input disabled name="second_last_name" value="{{$user->second_last_name}}">
                {{__('Second Last Name')}}
            </x-forms.input>
            <x-forms.input disabled name="email" value="{{$user->email}}">
                {{__('Email')}}
            </x-forms.input>
            <x-forms.input disabled name="telephone" value="{{$user->telephone}}">
                {{__('Telephone Number')}}
            </x-forms.input>
            @if ($user->type == "doctor")
                <x-forms.input disabled name="professional_license" value="{{$user->doctor->professional_license}}">
                    {{__('Professional License')}}
                </x-forms.input>
                <x-forms.input disabled name="speciality" value="{{$user->doctor->speciality}}">
                    {{__('Speciality')}}
                </x-forms.input>
            @endif
            @if ($user->type == "patient")
                <x-forms.input disabled name="curp" value="{{$user->patient->curp}}">
                    {{__('CURP')}}
                </x-forms.input>
                <x-forms.input type="date" disabled name="birth" value="{{$user->patient->birth}}">
                    {{__('Birth')}}
                </x-forms.input>
            @endif
            <div class="flex justify-center">
                <a href="{{route('home')}}" class="text-white bg-red-800 hover:bg-red-500 text-white font-bold py-2 px-4 rounded-lg mt-3 transition ease-in-out duration-300">
                    {{__('Back')}}
                </a>
                <a href="{{route('profile.edit')}}" class="ml-2 text-white bg-indigo-800 hover:bg-indigo-500 text-white font-bold py-2 px-4 rounded-lg mt-3 transition ease-in-out duration-300">
                    {{__('Edit')}}
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
