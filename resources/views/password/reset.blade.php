@section('title', 'Forgot Password')

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Forgot Password' ) }}
        </h2>
    </x-slot>
    <div class="container flex items-center justify-center min-h-screen">
        <div class="bordered shadow p-10 rounded overflow-hidden shadow-xl rounded bg-white hover:shadow-2xl xl:w-1/3 sm:w-2/3 w-full">
            <div class="flex justify-center">
                <div class="rounded-full bg-indigo-800 text-white p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
            </div>
            <div class="mt-5">
                {{__('messages.password.new')}}
            </div>
            <x-forms.errors :errors="$errors"></x-forms.errors>
            <form autocomplete="off" method="POST" action="{{route('password.update')}}">
                @csrf
                <input type="hidden" name="token" value="{{$token}}">
                <x-forms.input name="email" type="email">
                    {{__('Email')}}
                </x-forms.input>
                <x-forms.input name="password" type="password">
                    {{__('New Password')}}
                </x-forms.input>
                <x-forms.input name="password_confirmation" type="password">
                    {{__('Confirm New Password')}}
                </x-forms.input>
                <div>
                    <x-general.button>{{__('Send')}}</x-general.button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
