@props(['week_schedule', 'start_week', 'doctor'])

<div class="container">
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-indigo-100">
            <tr>
                <th scope="col" class="text-center px-6 py-3">{{__('Hour')}}</th>
                @for($i = 0; $i < 7; $i++)
                    @php
                        $date = $start_week->copy()->addDays($i);
                    @endphp
                    <th scope="col">
                        <div class="flex flex-col justify-center px-6 py-3">
                            <span class="text-center">{{Str::ucfirst($date->getTranslatedDayName())}}</span>
                            <span class="text-center">{{$date->format("d/m/Y")}}</span>
                        </div>
                    </th>
                @endfor
            </tr>
            </thead>

            <tbody>
            @foreach($week_schedule as $hour => $schedule)
                <tr class="bg-white border-b dark:bg-gray-800">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 text-center">
                        {{$hour}}
                    </th>
                    @foreach($schedule as $day => $cell)
                        <td class="px-6 py-4 text-center">
                            @switch($whose)
                                @case('patient')
                                    @if($cell !== null)
                                        @if($cell->appointment === null)
                                            <x-general.link
                                                href="{!!route('appointments.create', ['doctor' => $doctor, 'schedule' => $cell])!!}">
                                                Agendar
                                            </x-general.link>
                                        @else
                                            <x-general.link href="{{route('appointments.show', [$cell->appointment])}}">
                                                Ver mi cita
                                            </x-general.link>
                                        @endif
                                    @endif
                                    @break
                                @case('receptionist')
                                    @if($cell !== null)
                                        @if($cell->appointment === null)
                                            <span class="h-full text-green-500">Free</span>
                                        @else
                                            <div class="w-full">
                                                {{$cell->appointment->patient->user->name}}
                                                {{$cell->appointment->patient->user->first_last_name}}
                                                {{$cell->appointment->patient->user->second_last_name}}
                                                <br>
                                                <x-general.link
                                                    href="{{route('appointments.show', [$cell->appointment])}}">
                                                    {{__('Show More')}}
                                                </x-general.link>
                                            </div>
                                        @endif
                                    @endif
                                    @break
                                @case('doctor')
                                    @if($cell !== null)
                                        @if($cell->appointment === null)
                                            <form action="{{route('doctors.schedules.destroy', ['doctor' => $doctor, 'schedule' => $cell])}}"
                                                  method="post">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="bg-red-600 hover:bg-red-400 w-full text-white font-bold text-2xl rounded-lg">
                                                    -
                                                </button>
                                            </form>
                                        @else
                                            <div class="w-full">
                                                {{$cell->appointment->patient->user->name}}
                                                {{$cell->appointment->patient->user->first_last_name}}
                                                {{$cell->appointment->patient->user->second_last_name}}
                                                <br>
                                                <x-general.link
                                                    href="{{route('appointments.show', [$cell->appointment])}}">
                                                    {{__('Show More')}}
                                                </x-general.link>
                                            </div>
                                        @endif
                                    @elseif((new Carbon\Carbon($day))->isAfter(Carbon\Carbon::now()))
                                        <form action="{{route('doctors.schedules.store', ['doctor' => $doctor])}}"
                                              method="post"
                                              class="flex w-full h-full"
                                        >
                                            @csrf
                                            <input type="hidden" name="date" value="{{$day}}">
                                            <input type="hidden" name="hour" value="{{$hour}}">
                                            <button type="submit" class="text-white hover:bg-lime-400 font-bold bg-lime-500 w-full h-full text-2xl rounded-lg">
                                                +
                                            </button>
                                        </form>
                                    @endif
                                    @break
                            @endswitch
                        </td>
                    @endforeach
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
