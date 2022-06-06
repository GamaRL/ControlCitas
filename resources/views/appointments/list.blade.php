@section('title', __('Appointments'))

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Appointments' ) }} ({{count($appointments)}})
        </h2>
    </x-slot>
    <div class="container w-full">
        @foreach ($appointments as $appointment)
            <div class="w-full">
                <div style="width:20%">
                    {{$appointment->day}} <br>
                    {{$appointment->hour}}
                </div>
                <div style="width:55%">
                    @if ($appointment->whose == "patient" || $appointment->whose == "receptionist")
                        {{__('Doctor')}}: {{$appointment->doctor}}
                        <br>
                    @endif
                    @if ($appointment->whose == "doctor" || $appointment->whose == "receptionist")
                        {{__('Patient')}}: {{$appointment->patient}}
                        <br>
                    @endif
                </div>
                <div style="width:25%">
                    <button type="button" class="md:w-32 bg-orange-800 hover:bg-orange-dark text-white font-bold py-2 px-4 rounded-lg mt-3 hover:bg-orange-500 transition ease-in-out duration-300">
                        {{__('Send confirm reminder')}}
                    </button>
                    <button type="button" class="md:w-32 bg-orange-800 hover:bg-orange-dark text-white font-bold py-2 px-4 rounded-lg mt-3 hover:bg-orange-500 transition ease-in-out duration-300">
                        {{__('Cancel appointment')}}
                    </button>
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>
