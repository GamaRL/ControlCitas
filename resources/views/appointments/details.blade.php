@section('title', __('Appointment Detail'))

<x-app-layout>
    <x-slot name="header">
        <div class="w-full flex rounded-lg items-center mt-3 py-3 px-3">
            <div class="w-5/6">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Appointment Details' ) }}
                </h2>
            </div>
            <div class="w-1/6">
                <button type="button" class="bg-orange-800 hover:bg-orange-dark text-white font-bold py-2 px-4 rounded-lg hover:bg-orange-500 transition ease-in-out duration-300">
                    <a href="{{route("appointments.list", ['filter' => 'all'])}}">{{ __('Back')}}</a>
                </button>
            </div>
        </div>
    </x-slot>
    <div class="container w-full">
        <h3>{{__(date('d M Y', strtotime($appointment->schedule->date)))}} - {{__(date('h:i a', strtotime($appointment->schedule->hour)))}}</h3>
        <p>
            {{ __('Doctor' ) }} {{$appointment->doctor->user->name." ".$appointment->doctor->user->first_last_name." ".$appointment->doctor->user->second_last_name}}
        </p>
        <p>
            {{ __('Patient' ) }} {{$appointment->patient->user->name." ".$appointment->patient->user->first_last_name." ".$appointment->patient->user->second_last_name}}
        </p>
        @if ( new Datetime($appointment->schedule->date." ".$appointment->schedule->hour) >= new Datetime() )
            <h4>{{ __('No remarks') }}</h4>
            <h4>{{ __('No treatment') }}</h4>
        @else
            <h4>{{ __('Remarks') }}</h4>
            {{$appointment->remarks}}
            <h4>{{ __('Treatment') }}</h4>
            {{$appointment->treatment}}
        @endif
    </div>
</x-app-layout>
