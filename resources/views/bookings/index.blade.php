
@extends('layouts.app')

@section('buttons')
<a class="btn btn-primary" href="{{route('bookings.create')}}" role="button">Add New Booking</a>
@endsection

@section('content')
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Room</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Reservation?</th>
            <th>Paid?</th>
            <th>Started?</th>
            <th>Passed?</th>
            <th>Created</th>
            <th class="Actions">Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse ( $booking as $bookings)
            <tr>
                <td>{{ $bookings->id }}</td>
                <td>{{ $bookings->room_id }}</td>
                <td>{{ date('F d, Y', strtotime($bookings->start)) }}</td>
                <td>{{ date('F d, Y', strtotime($bookings->end)) }}</td>
                <td>{{ $bookings->is_reservation ? 'Yes' : 'No' }}</td>
                <td>{{ $bookings->is_paid ? 'Yes' : 'No' }}</td>
                <td>{{ (strtotime($bookings->start) < time()) ? 'Yes' : 'No' }}</td>
                <td>{{ (strtotime($bookings->end) < time()) ? 'Yes' : 'No' }}</td>
                <td>{{ date('F d, Y', strtotime($bookings->created_at)) }}</td>
                <td class="actions">
                    <a
                        href="{{ action('App\Http\Controllers\BookingController@show', ['booking' => $bookings->id]) }}"
                        alt="View"
                        title="View">
                      View
                    </a>
                    <a
                        href="{{ action('App\Http\Controllers\BookingController@edit', ['booking' => $bookings->id]) }}"
                        alt="Edit"
                        title="Edit">
                      Edit
                    </a>
                    
                    <form action="{{ action('App\Http\Controllers\BookingController@destroy',
                         ['booking' => $bookings->id]) }}" method="POST">
                        @method('DELETE')
                        @csrf()
                        <button type="submit" class="btn btn-link" title="delete" value="DELETE"> Delete </button>
                </td>
            </tr>

        @empty

        @endforelse

    </tbody>
</table>

@endsection