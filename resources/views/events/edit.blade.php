@extends('dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Event') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    @if (count($errors) > 0)
                        <div class = "alert alert-danger">
                            <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('event.update',$event->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="">Event Name</label>
                            <input type="text" name="event_name" class="form-control" value="{{$event->event_name}}">
                        </div>

                        <div class="form-group">
                            <label for="">Event body</label>
                            <textarea name="body" id="" cols="30" rows="10" class="form-control">{{$event->body}}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="">Start Date</label>
                            <input type="date" name="start_date" class="form-control" value="{{ date('Y-m-d', strtotime($event->start_date)) }}">
                        </div>

                        <div class="form-group">
                            <label for="">End Date</label>
                            <input type="date" name="end_date" class="form-control" value="{{ date('Y-m-d', strtotime($event->end_date)) }}">
                        </div>

                        <div class="form-group">
                        <label for="">Event Type</label>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" id="event_type1" name="event_type" value="1" {{ $event->event_type == '1' ? "checked" : '' }} >
                                <label class="form-check-label" for="event_type1">Public</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" id="event_type2" name="event_type" value="2" {{ $event->event_type == '2' ? "checked" : '' }} >
                                <label class="form-check-label" for="event_type2">Private</label>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection