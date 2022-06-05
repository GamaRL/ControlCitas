@props(['week_schedule', 'start_week'])

<div class="container">
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500">
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
                    @foreach($schedule as $day)
                        <td class="px-6 py-4 text-center">
                            @if($day === null)
                                ''
                            @else
                                <x-general.link href="/">
                                    Agendar
                                </x-general.link>
                            @endif
                        </td>
                    @endforeach
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
