@extends('layouts.app')

@section('content')
<table class="table">
<thead>
    <tr>
        <th>
        Room Number
        </th>
        <th>
        Type
        </th>
    </tr>
</thead>
<tbody>
    @foreach($rooms as $room)
</tbody>
<tr>
        <td>
        {{$room->number }}
        </td>
        <td>
        {{$room->RoomType->name}}
        </td>
 </tr>
 @endforeach
</table>
@endsection