@props(["name", "type" => "text"])

<div class="flex flex-col w-full mx-1 my-3">
    <label for="{{$name}}" class="hidden">Number</label>
    <input type="{{$type}}" name="{{$name}}" id="{{$name}}" placeholder="{{$slot}}"
           class="w-100 mt-2 py-3 px-3 rounded-lg bg-white border border-gray-400 dark:border-gray-700 text-gray-800 font-semibold focus:border-indigo-500 focus:outline-none">
</div>
