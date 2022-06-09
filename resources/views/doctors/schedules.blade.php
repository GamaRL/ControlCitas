@section('title', __('Schedules'))

<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Doctor Schedules' ) }}
        </h1>
    </x-slot>
    <div class="container flex flex-wrap lg:p-10">
        <div class="flex justify-start w-1/3">
            <div class="bg-gray-50 border border-gray-300 text-gray-900 text-sm
                    rounded-lg block w-full p-2.5">
                {{$doctor->user->getAttribute('name')}}
                {{$doctor->user->getAttribute('first_last_name')}}
                {{$doctor->user->getAttribute('second_last_name')}}
                /
                {{__($doctor->speciality)}}
            </div>
        </div>
        <div class="flex justify-between w-full my-3">
            <x-general.link href="{!!route('doctors.schedules.all', ['doctor' => $doctor, 'add_weeks' => $add_weeks - 1])!!}">
                {!! __('pagination.previous') !!}
            </x-general.link>

            <x-general.link href="{!!route('doctors.schedules.all', ['doctor' => $doctor, 'add_weeks' => $add_weeks + 1])!!}">
                {!! __('pagination.next') !!}
            </x-general.link>
        </div>
        <x-doctor-calendar :doctor="$doctor" :addWeeks="$add_weeks"></x-doctor-calendar>
    </div>
</x-app-layout>
