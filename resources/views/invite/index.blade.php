@extends('dashboard')
@section('title')
Admin Dashboard
@endsection
@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />

<div id="loading" class="modal">
  <p><img src="loading.gif" /> Please Wait</p>
</div>

<!-- Modal -->
<div class="modal fade" id="postModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Send Invitees</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form >
  
            <div class="alert alert-danger print-error-msg" style="display:none">
                <ul></ul>
            </div>
    
            <div class="mb-3">
                <label for="titleID" class="form-label">Email:</label>
                <input type="text" id="emailID" name="name" class="form-control" placeholder="Email" required="">
            </div>

            <!--
            <div class="mb-3">
                <label for="bodyID" class="form-label">Body:</label>
                <textarea name="body" class="form-control" id="bodyID"></textarea>
            </div>
            -->
     
            <div class="mb-3 text-center">
                <button class="btn btn-success btn-submit">Submit</button>
            </div>
    
        </form>
      </div>
    </div>
  </div>
</div>


<div class="content-wrapper">
 

  

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Info boxes -->
                    <!-- Main content -->
                    <section class="content card-sticky">
                       
                    
                    <div class="row">
                        <div class="col-12">
                            <div class="card">

                                <div class="card-header">
                                    <h3 class="card-title">Invites Details</h3>
                                </div>
                                

                    <table id="invDetailsTable" class="table table-bordered table-hover">
                      <thead>
                      <tr>
                        <th colspan="5">
                            List Of Invites
                            <button type="button" class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#postModal">
                            Create Invitee
                            </button>
                        </th>
                    </tr>
                        <tr >                                                    
                          <th>#</th>
                          <th>Email</th>
                          <th>Date Time</th>                                                                           
                          <th>Action</th>
                        </tr>
                      </thead>                     
                      <tbody>               
                      </tbody>
                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <script
type="text/javascript"
charset="utf8"
src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.2.min.js"
></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>


<script type="text/javascript">

 

  
$(document).ready(function (){
   
    

    // Initialize datatable
    invDetailsTable = $('#invDetailsTable').DataTable({
     'processing': true,
     'serverSide': true,
     "responsive": false,
     "searching": false,
     "ordering": true,    
     'serverMethod': 'post',
     'ajax': {
        'url':'{{route('invites.all')}}',
        'headers': {'X-CSRF-TOKEN': "{{csrf_token()}}" },
        'data': function(data){           
           data.request = 1;           
        }
     },
     'columns': [
        { data: 'index' },
        { data: 'email' },        
        { data: 'created_at' },
        { data: 'action' },
     ] ,
      'order': [[1, 'asc']]
   });

 
  
});


</script>

<script type="text/javascript">
      
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
  
    $(".btn-submit").click(function(e){
    
        e.preventDefault();     
        var email = $("#emailID").val();
        //var body = $("#bodyID").val();
     
        $.ajax({
           type:'POST',
           url:"{{ route('invites.store') }}",
           data:{email:email},
           success:function(data){
            console.log(data);
                if($.isEmptyObject(data.error)){
                    alert(data.success);
                    $('#postModal').modal('hide');
                    $(".print-error-msg").css('display','none');
                    $('#emailID').val('');
                    
                    // location.reload();
                    invDetailsTable.ajax.reload();
                }else{
                    printErrorMsg(data.error);
                }
           }
        });
    
    });
    
       // Delete record
  $('#invDetailsTable').on('click','.deleteUser',function(){
     var id = $(this).data('id');

     var deleteConfirm = confirm("Are you sure?");
     if (deleteConfirm == true) {
        // AJAX request
        $.ajax({          
          url:'{{route('invites.destroy')}}',
          type: 'post',
          data: {request: 4, id: id},
          success: function(data){
            if($.isEmptyObject(data.error)){
                    alert(data.success);
                    // location.reload();
                    invDetailsTable.ajax.reload();
                }else{
                    printErrorMsg(data.error);
                }
          }
        });
     } 

  });

    function printErrorMsg (msg) {
        $(".print-error-msg").find("ul").html('');
        $(".print-error-msg").css('display','block');
        $.each( msg, function( key, value ) {
            $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
        });
    }
  
</script>


@endsection