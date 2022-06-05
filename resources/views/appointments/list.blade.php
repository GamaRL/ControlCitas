@section('title', __('Appointments'))

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Appointments' ) }} ({{count($appointments)}})
        </h2>
    </x-slot>
    <div class="container w-full">
        @foreach ($appointments as $appointment)
            <div class="w-full flex bg-stone-300 rounded-lg items-center mt-3 py-2">
                <div class="w-1/6">
                    <p class="font-semibold text-2xl tabular-nums text-center">
                        {{__(date('d', strtotime($appointment->date)))}} {{__(date('M', strtotime($appointment->date)))}} <br>
                        {{__(date('h:i a', strtotime($appointment->hour)))}}
                    </p>
                </div>
                <div class="w-2/6">
                    <p>
                        @if ($whose == "patient" || $whose == "receptionist")
                            {{__('Doctor')}} {{$appointment->doctor}}
                            <br>
                        @endif
                        @if ($whose == "doctor" || $whose == "receptionist")
                            {{__('Patient')}} {{$appointment->patient}}
                            <br>
                        @endif
                    </p>
                </div>
                <div class="w-1/2 flex justify-around items-center">
                    @if ($whose == "receptionist")
                        <button type="button" class="bg-orange-800 hover:bg-orange-dark text-white font-bold py-2 px-4 rounded-lg hover:bg-orange-500 transition ease-in-out duration-300">
                            <a href="{{route('appointments.sendConfirmReminder', ['id' => $appointment->id])}}">{{ __('Send confirm reminder')}}</a>
                        </button>
                        <button type="button" class="bg-orange-800 hover:bg-orange-dark text-white font-bold py-2 px-4 rounded-lg hover:bg-orange-500 transition ease-in-out duration-300">
                            <a href="">{{ __('Cancel appointment')}}</a>
                        </button>
                    @endif                    
                    @if ($whose == "patient")
                        <button type="button" class="bg-orange-800 hover:bg-orange-dark text-white font-bold py-2 px-4 rounded-lg hover:bg-orange-500 transition ease-in-out duration-300">
                            <a href="}}">{{ __('Confirm Appointment')}}</a>
                        </button>
                    @endif      
                    @if (true)
                        <button type="button" class="bg-orange-800 hover:bg-orange-dark text-white font-bold py-2 px-4 rounded-lg hover:bg-orange-500 transition ease-in-out duration-300">
                            <a href="}}">{{ __('Show More')}}</a>
                        </button>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>
