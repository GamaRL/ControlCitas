@section('title', __('Schedules'))

<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Doctor Schedules' ) }}
        </h1>
    </x-slot>
    <div class="container flex flex-wrap justify-center">
        <div class="flex justify-start w-full">
            <label>
                <select>
                    @forelse($doctors as $doctor)
                        <option>
                            {{$doctor->user->getAttribute('name')}}
                            {{$doctor->user->getAttribute('first_last_name')}}
                            {{$doctor->user->getAttribute('second_last_name')}}
                        </option>
                    @empty
                        <h2>{{__("There are no registered doctors.")}}</h2>
                    @endforelse
                </select>
            </label>
        </div>
        <x-patient-calendar :doctor="$doctors->get(0)" :date="Carbon\Carbon::now()"></x-patient-calendar>
    </div>
</x-app-layout>
