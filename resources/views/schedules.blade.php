@section('title', __('Schedules'))

<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Doctor Schedules' ) }}
        </h1>
    </x-slot>
    <div class="container flex flex-wrap justify-center p-10">
        <div class="flex justify-start w-full">
            <label>
                <select>
                    @forelse($doctors as $doctor)
                        <option value="{{$doctor->id}}">
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
        <div class="flex justify-between w-full my-3">
            <x-general.link href="{!!route('doctors.schedules.all', ['doctor' => $doctor, 'add_weeks' => $add_weeks - 1])!!}">
                {!! __('pagination.previous') !!}
            </x-general.link>

            <x-general.link href="{!!route('doctors.schedules.all', ['doctor' => $doctor, 'add_weeks' => $add_weeks + 1])!!}">
                {!! __('pagination.next') !!}
            </x-general.link>
        </div>
        <x-patient-calendar :doctor="$doctor" :addWeeks="$add_weeks"></x-patient-calendar>
    </div>
</x-app-layout>
