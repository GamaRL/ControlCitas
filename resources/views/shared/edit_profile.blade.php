@section('title', __('Edit Profile'))

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Profile' ) }}
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
            <x-forms.errors :errors="$errors"></x-forms.errors>
            <form autocomplete="off" class="mt-3 w-full" method="POST" action="{{route('profile.update')}}">
                @csrf
                @method('put')
                <x-forms.input name="email" type="email" value="{{$user->email}}">
                    {{__('Email')}}
                </x-forms.input>
                <x-forms.input name="telephone" type="tel" value="{{$user->telephone}}">
                    {{__('Telephone Number')}}
                </x-forms.input>
                <span class="text-xl w-full border-b-2 border-gray-300">
                    {{__('Change Password')}}
                </span>
                <x-forms.input name="current_password" type="password">
                    {{__('Current Password')}}
                </x-forms.input>
                <x-forms.input name="new_password" type="password">
                    {{__('New Password')}}
                </x-forms.input>
                <x-forms.input name="new_password_confirmation" type="password">
                    {{__('Confirm New Password')}}
                </x-forms.input>
                <div class="flex justify-center rounded-lg items-center">
                    <button class="text-white bg-indigo-800 hover:bg-indigo-500 text-white font-bold py-2 px-4 rounded-lg mt-3 transition ease-in-out duration-300">
                        {{__('Save Changes')}}
                    </button>
                    <a href="{{route('profile.view')}}" class="ml-2 text-white bg-red-800 hover:bg-red-500 text-white font-bold py-2 px-4 rounded-lg mt-3 transition ease-in-out duration-300">
                        {{__('Cancel')}}
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
