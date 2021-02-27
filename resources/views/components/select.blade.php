@props(['name', 'id'])

<select {!! $attributes->merge(['class' => 'rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50', 'style' => 'width:100%']) !!} name="{{$name}}" id="{{$id}}">{{ $slot }}</select>