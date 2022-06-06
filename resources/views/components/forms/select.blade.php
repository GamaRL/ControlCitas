@props(["name", "options", "labels" => null, "disabled" => false])

@dd(collect($options)->mergeRecursive($labels))

<div class="flex flex-col w-full my-2">
    <label for="{{$name}}" class="block mb-2 text-sm font-medium text-gray-900">
        {{$slot}}
    </label>
    <select
        name="{{$name}}"
        id="{{$name}}"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm
        rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full
        p-2.5 appearance-none">
        @if($disabled) disabled @endif
        @foreach($options as $option)
            <option name="{{$name}}" id="{{$name}}" value="{{$option}}" {{$option === old($name) ? "selected" : ""}}>
                {{__($option)}}
            </option>
        @endforeach
    </select>
</div>
