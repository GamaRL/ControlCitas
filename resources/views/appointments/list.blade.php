@section('title', __('Appointments'))

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Appointments' ) }} ({{count($appointments)}})
        </h2>
    </x-slot>
    <div class="container flex w-full">
        @foreach ($appointments as $appointment)
            <div class="w-full flex">
                <div class="w-1/4">
                    {{__(date('d', strtotime($appointment->date)))}} <br>
                    {{__(date('M', strtotime($appointment->date)))}} <br>
                    {{__(date('h a', strtotime($appointment->hour)))}}
                </div>
                <div class="w-1/2">
                    @if ($appointment->whose == "patient" || $appointment->whose == "receptionist")
                        {{__('Doctor')}} {{$appointment->doctor}}
                        <br>
                    @endif
                    @if ($appointment->whose == "doctor" || $appointment->whose == "receptionist")
                        {{__('Patient')}} {{$appointment->patient}}
                        <br>
                    @endif
                </div>
                <div class="w-1/4">
                    <button type="button" class="bg-orange-800 hover:bg-orange-dark text-white font-bold py-2 px-4 rounded-lg mt-3 hover:bg-orange-500 transition ease-in-out duration-300">
                       <a href="{{route('appointments.sendConfirmReminder', ['id' => $appointment->id])}}">{{ __('Send confirm reminder')}}</a>
                    </button>
                    <button type="button" class="bg-orange-800 hover:bg-orange-dark text-white font-bold py-2 px-4 rounded-lg mt-3 hover:bg-orange-500 transition ease-in-out duration-300">
                       <a href="">{{ __('Cancel appointment')}}</a>
                    </button>
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>
