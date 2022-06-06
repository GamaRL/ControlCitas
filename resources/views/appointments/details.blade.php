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
                <a href="{{route("appointments.index")}}"
                    class="bg-orange-800 hover:bg-orange-dark text-white font-bold py-2 px-4 rounded-lg hover:bg-orange-500 transition ease-in-out duration-300 text-xs">
                    {{ __('Back')}}
                </a>
            </div>
        </div>
</x-slot>
    <div class="container flex justify-center items-center min-h-screen w-full mx-auto p-10">
        <div class="bg-white rounded-lg shadow shadow-lg hover:shadow-2xl p-10 lg:w-1/3 w-full">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">{{__('Appointment Information')}}</h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500">{{__('Schedule Info')}}</p>
            </div>
            <div class="border-t border-gray-200">
                <dl>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">{{__('Date')}}</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{__(date('d M Y', strtotime($appointment->schedule->date)))}}
                        </dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">{{__('Hour')}}</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{__(date('h:i a', strtotime($appointment->schedule->hour)))}}
                        </dd>
                    </div>
                </dl>
            </div>

            <div class="px-4 py-5 sm:px-6">
                <p class="mt-1 max-w-2xl text-sm text-gray-500">{{__('Doctor Info')}}</p>
            </div>

            <div class="border-t border-gray-200">
                <dl>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">{{__('Name')}}</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{$appointment->doctor->user->name}}
                            {{$appointment->doctor->user->first_last_name}}
                            {{$appointment->doctor->user->second_last_name}}
                        </dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">{{__('Speciality')}}</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{__($appointment->doctor->speciality)}}
                        </dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">{{__('Professional License')}}</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{__($appointment->doctor->professional_license)}}
                        </dd>
                    </div>
                </dl>
            </div>

            <div class="px-4 py-5 sm:px-6">
                <p class="mt-1 max-w-2xl text-sm text-gray-500">{{__('Patient Info')}}</p>
            </div>
            <div class="border-t border-gray-200">
                <dl>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">{{__('Name')}}</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{$appointment->patient->user->name}}
                            {{$appointment->patient->user->first_last_name}}
                            {{$appointment->patient->user->second_last_name}}
                        </dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">{{__('Age')}}</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{\Carbon\Carbon::now()->diffInYears($appointment->patient->birth)}}
                        </dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">C.U.R.P.</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{$appointment->patient->curp}}
                        </dd>
                    </div>
                </dl>
            </div>

            <div class="px-4 py-5 sm:px-6">
                <p class="mt-1 max-w-2xl text-sm text-gray-500">{{__('Additional Info')}}</p>
            </div>
            <div class="border-t border-gray-200">
                <dl>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">{{__('Confirmed')}}</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {!! $appointment->confirmed_at !== null ? '&#10004;' : '&#10007;' !!}
                        </dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">{{__('Reason')}}</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{$appointment->reason}}
                        </dd>
                    </div>
                    @if(\Carbon\Carbon::now()->isAfter(new \Carbon\Carbon($appointment->schedule->date.' '.$appointment->schedule->hour)))
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">{{__('Remarks')}}</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{$appointment->remarks}}
                        </dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">{{__('Treatment')}}</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{$appointment->treatment}}
                        </dd>
                    </div>
                    @endif
                </dl>
            </div>
        </div>
    </div>
</x-app-layout>
