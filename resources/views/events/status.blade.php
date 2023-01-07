@extends('dashboard')

@section('content')
  
        <div class="container mt-5">
           <b> Events count created by the users.</b>
            <table class="table table-bordered mb-5">
                <thead>
                    <tr class="table-success">
                        <th scope="col">#</th>
                        <th scope="col">Email</th>                        
                        <th scope="col">Count</th>                        
                    </tr>
                </thead>
                <tbody>
                    @foreach($userEvent as $data)
                    <tr>
                        <th scope="row">{{ $data->id }}</th>
                        <td>{{ $data->email }}</td>                        
                        <td>{{ $data->cnt }}</td>                        
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
  
    

        <div class="container mt-5">
           <b> Average by user.</b>
            <table class="table table-bordered mb-5">
                <thead>
                    <tr class="table-success">
                        <th scope="col">#</th>
                        <th scope="col">User</th>                        
                        <th scope="col">Average</th>                        
                    </tr>
                </thead>
                <tbody>
                    @foreach($userEvent as $data)
                    <tr>
                        <th scope="row">{{ $data->id }}</th>
                        <td>{{ $data->email }}</td>                        
                        <td>{{ round($data->cnt / $userEvent->sum('cnt')  * 100,0)  }} %</td>                        
                    </tr>
                    @endforeach
                     
                </tbody>
            </table>
        </div>

@endsection