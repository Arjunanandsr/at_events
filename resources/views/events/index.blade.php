@extends('dashboard')

@section('content')


<div class="container">
    <div class="row justify-content-center">
    <div class="col-12">
                <a href="{{ route('event.create') }}" class="btn btn-primary mb-2">Create Event</a> 
                <br>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th colspan="2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($events as $event)
                        <tr>
                            <td>{{ $event->id }}</td>
                            <td>{{ $event->event_name }}</td>
                            <td>{{ date('Y-m-d', strtotime($event->start_date)) }}</td>
                            <td>{{ date('Y-m-d', strtotime($event->end_date)) }}</td>
                            <td>
                            <a href="{{ route('event.show',$event->id) }}" class="btn btn-primary">Show</a>
                            <a href="{{ route('event.edit',$event->id) }}" class="btn btn-primary">Edit</a>
                            <form action="{{ route('event.destroy',$event->id) }}"" method="post" class="d-inline">
                                {{ csrf_field() }}
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div> 
    </div>
</div>


@endsection