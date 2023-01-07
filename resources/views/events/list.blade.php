@extends('dashboard')

@section('content')
  
    <div class="container mt-5">
    <form class="form-inline" method="GET">
    <div class="form-group mb-5">
        
        <div class="form-group mb-2">
            <label for="filter" class="col-sm-2 col-form-label">Search:</label>
        </div>
        <div class="form-group mb-2" style="padding-left: 10px;">
            <label for="">Start Date :&nbsp;</label>
            <input type="date" name="start_date" class="form-control" value="{{ $start_date }}">
        </div>

        <div class="form-group mb-2" style="padding-left: 10px;">
            <label for="">End Date :&nbsp;</label>
            <input type="date" name="end_date" class="form-control" value="{{ $end_date }}">
        </div>
        <div class="form-group mb-2" style="padding-left: 10px;">
            <input type="text" class="form-control" id="filter" name="filter" placeholder="Search..." value="{{$filter}}">
        </div>
        <div class="form-group mb-2 " style="padding-left: 10px;">
            <button type="submit" class="btn btn-success mb-2">Filter</button>
        </div>
        
    </div>
    
    </form>

    </div>
        <div class="container mt-5">
            <table class="table table-bordered mb-5">
                <thead>
                    <tr class="table-success">
                        <th scope="col">#</th>
                        <th scope="col">Event name</th>                        
                        <th scope="col">Start Date</th>
                        <th scope="col">End Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($event as $data)
                    <tr>
                        <th scope="row">{{ $data->id }}</th>
                        <td>{{ $data->event_name }}</td>
                        <td>{{ $data->start_date }}</td>
                        <td>{{ $data->end_date }}</td>                        
                    </tr>
                    @endforeach
                </tbody>
            </table>
           
            <div class="d-flex justify-content-center">
                {!! $event->links('pagination::bootstrap-4') !!}
            </div>
        </div>
  

@endsection