@props(["name", "value" => "", "type" => "text"])

<div class="flex flex-col w-full my-2">
    <label for="{{$name}}" class="block mb-2 text-sm font-medium text-gray-900">
        {{$slot}}
    </label>
    <input
        type="{{$type}}"
        id="{{$name}}"
        name="{{$name}}"
        value="{{old($name)}}"
        class="bg-gray-50 border border-gray-300 text-gray-900
        text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500
        focus:outline-none block w-full p-2.5">
</div>
