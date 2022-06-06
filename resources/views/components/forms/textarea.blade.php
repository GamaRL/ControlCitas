@props(["name", "value" => "", "rows" => "2", "disabled" => false])

<div class="flex flex-col w-full my-2">
    <label for="{{$name}}" class="block mb-2 text-sm font-medium text-gray-900">
        {{$slot}}
    </label>
    <textarea
        id="{{$name}}"
        name="{{$name}}"
        rows="{{$rows}}"
        @if($disabled) disabled @endif
        class="bg-gray-50 border border-gray-300 text-gray-900
        text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500
        focus:outline-none block w-full">{{old($name) != "" ? old($name) : $value}}</textarea>
</div>
