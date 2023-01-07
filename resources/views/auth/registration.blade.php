

@extends('dashboard')
@section('content')
<main class="signup-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <h3 class="card-header text-center">Register User</h3>
                    @if(count($errors) > 0)
                    @foreach( $errors->all() as $message )
                    <div class="alert alert-danger display-hide">
                    <button class="close" data-close="alert"></button>
                    <span>{{ $message }}</span>
                    </div>
                    @endforeach
                    @endif
                    <div class="card-body">
                        <form action="{{ route('register.custom') }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <input type="text" placeholder="First Name" id="first_name" class="form-control" name="first_name"
                                    required autofocus>
                                @if ($errors->has('first_name'))
                                <span class="text-danger">{{ $errors->first('first_name') }}</span>
                                @endif
                            </div>
                            <div class="form-group mb-3">
                                <input type="text" placeholder="Last Name" id="last_name" class="form-control" name="last_name"
                                    required autofocus>
                                @if ($errors->has('last_name'))
                                <span class="text-danger">{{ $errors->first('last_name') }}</span>
                                @endif
                            </div>
                            <div class="form-group mb-3">
                                <input type="text" placeholder="DOB" id="datetimepicker" class="date form-control"  name="dob">
                                @if ($errors->has('dob'))
                                <span class="text-danger">{{ $errors->first('dob') }}</span>
                                @endif
                            </div>
   
                            <div class="form-group col-md5 mb-3">
                                <div class="form-check">
                                <input type="radio" class="form-check-input" id="gender1" name="gender" value="1" >
                                <label class="form-check-label" for="gender1">Male</label>
                                </div>
                                <div class="form-check">
                                <input type="radio" class="form-check-input" id="gender2" name="gender" value="2">
                                <label class="form-check-label" for="gender2">Female</label>
                                </div>
                                <div class="form-check">
                                <input type="radio" class="form-check-input" id="gender3" name="gender" value="3">
                                <label class="form-check-label" for="gender3">Not Specified</label>
                                </div>
                                @if ($errors->has('gender'))
                                <span class="text-danger">{{ $errors->first('gender') }}</span>
                                @endif
                            </div>

                            <div class="form-group mb-3">
                                <input type="text" placeholder="Email" id="email_address" class="form-control"
                                    name="email" required autofocus>
                                @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            <div class="form-group mb-3">
                                <input type="password" placeholder="Password" id="password" class="form-control"
                                    name="password" required>
                                @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                            
                            <div class="d-grid mx-auto">
                                <button type="submit" class="btn btn-dark btn-block">Sign up</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css"/>  
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">  
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>  
  <script type="text/javascript">  
    $('.date_old').datepicker({    
       format: 'dd-mm-yyyy'  
     });    

    var maxBirthdayDate = new Date();
    maxBirthdayDate.setFullYear( maxBirthdayDate.getFullYear() - 18 );
    maxBirthdayDate.setMonth(11,31);
    $( function() {
    $( ".date" ).datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'dd/mm/yy',
        maxDate: maxBirthdayDate,
        yearRange: '1900:'+maxBirthdayDate.getFullYear(),
        });
    });



</script>



@endsection