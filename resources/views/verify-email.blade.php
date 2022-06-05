@section('title', 'Verify Email')

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Verify Email' ) }}
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
            <div class="mt-10">
                {{__('messages.verify.email')}}
            </div>

            <div>
                {{__('messages.verify.resend-message')}}
                <x-general.link :href="route('verification.send')">{{__('messages.verify.resend-link')}}</x-general.link>
            </div>
            @isset($message)
                <div class="flex justify-center text-green-500 font-bold my-10">
                    <span class="text-green">{{__($message)}}</span>
                </div>
            @endisset
        </div>
    </div>
</x-app-layout>
