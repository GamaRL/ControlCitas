@php
    use Carbon\Carbon;
    use Carbon\CarbonInterface;
    use Illuminate\Support\Collection;

    $now = Carbon::now();
    $startOfWeek = $now->copy()->startOfWeek(CarbonInterface::SUNDAY);


@endphp

<div class="container">
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="table-header-group">
            <tr>
                <th scope="col"></th>
                @for($i = 0; $i < 7; $i++)
                    @php
                        $date = $startOfWeek->copy()->addDays($i);
                    @endphp
                    <th scope="col">
                        <div class="flex flex-col">
                            <span>{{Str::ucfirst($date->getTranslatedDayName())}}</span>
                            <span>{{$date->format("d/m/Y")}}</span>
                        </div>
                    </th>
                @endfor
            </tr>
            </thead>

            <tbody>
            <tr>
                <td>11:30</td>
                <td>
                    <button>Hola</button>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
