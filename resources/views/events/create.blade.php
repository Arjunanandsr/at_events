@extends('dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create Event') }}</div>

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
                    
                    <form action="{{ route('event.store') }}" method="post">
                        @csrf

                        <div class="form-group">
                            <label for="">Event Name</label>
                            <input type="text" name="event_name" class="form-control" value="">
                        </div>

                        <div class="form-group">
                            <label for="">Event body</label>
                            <textarea name="body" id="" cols="30" rows="10" class="form-control"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="">Start Date</label>
                            <input type="date" name="start_date" class="form-control" value="">
                        </div>

                        <div class="form-group">
                            <label for="">End Date</label>
                            <input type="date" name="end_date" class="form-control" value="">
                        </div>

                        <div class="form-group">
                        <label for="">Event Type</label>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" id="event_type1" name="event_type" value="1" >
                                <label class="form-check-label" for="event_type1">Public</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" id="event_type2" name="event_type" value="2" >
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