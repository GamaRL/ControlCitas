@section('title', 'Login')

<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Doctor Schedules' ) }}
        </h1>
    </x-slot>
    <div class="container flex flex-wrap items-center justify-center h-screen">
        @forelse($doctors as $doctor)
            <li>{{$doctor->getAttribute('name')}}</li>
        @empty
            <h2>{{__("There are no registered doctors.")}}</h2>
        @endforelse
        <x-schedules.calendar></x-schedules.calendar>
    </div>
</x-app-layout>
