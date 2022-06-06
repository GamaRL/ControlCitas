@section('title', __('Appointments'))

<x-app-layout>
    <x-slot name="header">
        <div class="w-full flex justify-between rounded-lg items-center mt-3 py-3 px-3">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Appointments' ) }} ({{__($filter)}}: {{count($appointments)}})
                </h2>
            </div>
            <div class="flex">
                <a href="{{route("appointments.index", ['filter' => 'all'])}}"
                   class="bg-orange-800 hover:bg-orange-500 text-white font-bold py-2 px-4 rounded-lg transition ease-in-out duration-300 text-xs">
                    {{ __('All')}}
                </a>
                <a href="{{route("appointments.index", ['filter' => 'upcoming'])}}"
                   class="bg-orange-800 hover:bg-orange-500 text-white font-bold py-2 px-4 rounded-lg transition ease-in-out duration-300 text-xs">
                    {{ __('Upcoming')}}
                </a>
                <a href="{{route("appointments.index", ['filter' => 'last'])}}"
                   class="bg-orange-800 hover:bg-orange-500 text-white font-bold py-2 px-4 rounded-lg transition ease-in-out duration-300 text-xs">
                    {{ __('Last')}}
                </a>
            </div>
        </div>
    </x-slot>
    <div class="container flex flex-col w-full justify-center min-h-screen m-auto">
        @forelse ($appointments as $appointment)
            <div class="w-full flex bg-stone-300 rounded-lg items-center mt-3 py-2">
                <div class="w-1/6">
                    <p class="font-semibold text-2xl tabular-nums text-center">
                        {{(new Carbon\Carbon($appointment->schedule->date))->format('d M Y')}} <br>
                        {{(new Carbon\Carbon($appointment->schedule->hour))->format('H:i')}}
                    </p>
                </div>
                <div class="w-2/6">
                    <p>
                        {{__('Doctor')}}:
                        {{$appointment->doctor->user->name}}
                        {{$appointment->doctor->user->first_last_name}}
                        {{$appointment->doctor->user->second_last_name}}
                        <br>
                        @if ($whose !== "patient")
                            {{__('Patient')}}:
                            {{$appointment->patient->user->name}}
                            {{$appointment->patient->user->first_last_name}}
                            <br>
                        @endif
                    </p>
                </div>
                <div class="w-1/2 flex justify-around items-center">
                    @if ($whose == "receptionist")
                        <a href="{{route('appointments.sendConfirmReminder', ['id' => $appointment->id])}}"
                           class="bg-blue-800 hover:bg-blue-500 text-white font-bold py-2 px-4 rounded-lg transition ease-in-out duration-300 text-xs">
                            {{ __('Send confirm reminder')}}
                        </a>
                    @endif
                    @if ($whose == "patient")
                        @if ($appointment->confirmed_at === null)
                            <a class="bg-green-800 hover:bg-green-500 text-white font-bold py-2 px-4 rounded-lg transition ease-in-out duration-300 text-xs"
                                 href="{{route('appointments.confirm', ['id' => $appointment->id])}}">{{ __('Confirm Appointment')}}
                            </a>
                            <a href="{{route('appointments.destroy', ['id' => $appointment->id])}}"
                                class="bg-red-800 hover:bg-red-500 text-white font-bold py-2 px-4 rounded-lg transition ease-in-out duration-300 text-xs">
                                 {{ __('Cancel appointment')}}
                             </a>
                        @else
                            &#10004;&nbsp;{{__("CONFIRMED")}}
                        @endif
                    @endif
                    <a class="bg-teal-800 hover:bg-teal-500 text-white font-bold py-2 px-4 rounded-lg transition ease-in-out duration-300 text-xs"
                     href="{{route('appointments.show', [$appointment])}}">{{ __('Show More')}}</a>
                </div>
            </div>
        @empty
            <div class="flex justify-center self-center items-center min-h-full w-full">
                <div>
                    <h2 class="text-xl font-extrabold">{{__('No data available.')}}</h2>
                </div>
            </div>
        @endforelse
    </div>
</x-app-layout>
