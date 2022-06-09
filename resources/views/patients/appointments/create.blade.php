@section('title', __('New Appointment'))

<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New Appointment' ) }}
        </h1>
    </x-slot>
    <div class="container flex justify-center items-center lg:p-10 min-h-screen shadow rounded-full">
        <form action="{{route('appointments.store')}}" class="w-full bg-white" method="POST">
            @csrf
            <div class="container flex flex-row flex-wrap w-full">
                <div class="w-full lg:w-1/2 p-10">
                    <div class="flex flex-col w-full my-5">
                        <input type="hidden" name="doctor_id" value="{{$doctor->id}}">
                        <span class="w-full block mb-2 text-sm font-medium text-gray-900">{{__('Doctor')}}:</span>
                        <span class="bg-gray-50 border border-gray-300 text-gray-900
                                text-sm rounded-lg block w-full p-2.5">
                            {{$doctor->user->name}}
                            {{$doctor->user->first_last_name}}
                            {{$doctor->user->second_last_name}}
                            ({{__($doctor->speciality)}})
                        </span>
                    </div>
                    <div class="flex flex-col w-full my-5">
                        <input type="hidden" name="schedule_id" value="{{$schedule->id}}">
                        <span class="w-full block mb-2 text-sm font-medium text-gray-900">{{__('Date')}}:</span>
                        <span class="bg-gray-50 border border-gray-300 text-gray-900
                                text-sm rounded-lg block w-full p-2.5">
                            {{(new Carbon\Carbon($schedule->date))->format('d/m/Y')}}
                        </span>
                    </div>
                    <div class="flex flex-col w-full my-5">
                        <span class="w-full block mb-2 text-sm font-medium text-gray-900">{{__('Schedule')}}:</span>
                        <span class="bg-gray-50 border border-gray-300 text-gray-900
                                text-sm rounded-lg  block w-full p-2.5">
                            {{$schedule->hour}}
                        </span>
                    </div>
                </div>
                <div class="w-full lg:w-1/2 p-10">
                    <x-forms.errors :errors="$errors"/>
                    <x-forms.textarea name="reason" rows="7">{{__('Reason')}}:</x-forms.textarea>
                    <x-general.button>{{__('Send')}}</x-general.button>
                </div>
            </div>
        </form>

    </div>
</x-app-layout>
