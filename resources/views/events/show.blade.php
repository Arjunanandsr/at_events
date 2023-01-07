@extends('dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('View Event') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h2>{{$event->event_name}}</h2>
                    <p>Start At: {{date('Y-m-d', strtotime($event->start_date))}} - End At: {{date('Y-m-d', strtotime($event->end_date))}} </p>
                    <p>Published At: {{date('Y-m-d', strtotime($event->published_at))}}</p>
                    <br>
                    <div>
                        {{$event->body}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection