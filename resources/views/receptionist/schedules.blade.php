@section('title', __('Schedules'))

<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Doctor Schedules' ) }}
        </h1>
    </x-slot>
    <div class="container flex flex-wrap justify-center lg:p-10">
        <div class="flex justify-start w-full">
            <label>
                <select id="doctor">
                    @forelse($doctors as $s_doctor)
                        <option value="{{$s_doctor->id}}" @if($doctor->id === $s_doctor->id) selected @endif>
                            {{$s_doctor->user->getAttribute('name')}}
                            {{$s_doctor->user->getAttribute('first_last_name')}}
                            {{$s_doctor->user->getAttribute('second_last_name')}}
                            /
                            {{__($s_doctor->speciality)}}
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
        <x-receptionist-calendar :doctor="$doctor" :addWeeks="$add_weeks"></x-receptionist-calendar>
    </div>
    <script>
        document.getElementById('doctor')
            .addEventListener('change', event => {
                window.location = `{!! route('doctors.schedules.all') !!}?add_weeks={!! $add_weeks !!}&doctor=${event.target.value}`;

            })
    </script>
</x-app-layout>
