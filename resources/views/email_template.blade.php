@extends('layouts.app')

@section('content')
<style>

</style>

<div class="app-page-title">
  <div class="page-title-wrapper">
    <div class="page-title-heading">
      <div class="page-title-icon">
          <i class="pe-7s-mail-open-file icon-gradient bg-mean-fruit"></i>
      </div>
      <div>E-mail Template
        <div class="page-title-subheading">Update Your E-mail Template.</div>
      </div>
    </div>
  </div>
</div>

<div class="row">

  <div class="col-md-6">
    <div class="card" style="margin-bottom: 15px;">
      <div class="card-header">
        Upload Email Template
      </div>
      <div class="card-body">
        <form method="post" action="{{route('postUploadTemplate')}}" enctype="multipart/form-data">
          @csrf
          <label>Template Name</label>
          <input type="text" name="template_name" class="form-control" required><br/>
          <label>Upload Template</label>
          <input type="file" name="template[]" multiple class="form-control-file" required webkitdirectory mozdirectory><br/>
          <input type="submit" value="Upload" class="btn btn-primary">
        </form>
      </div>
    </div>
  </div>

  <div class="col-md-6">
    <div class="card" style="margin-bottom: 15px;">
      <div class="card-header">
        Email Template List
      </div>
      <div class="card-body">
        <div>
          <table id="template_table" style="width:100%">
            <thead>
              <th>Template Name</th>
              <th>Created Date</th>
              <th></th>
              <th></th>
            </thead>
            <tbody>
              @foreach($template as $result)
              <tr>
                <td>{{$result->template_name}}</td>
                <td>{{$result->created_at}}</td>
                <td><button class="btn btn-primary" onclick="window.open('{{$result->dir}}')">View</button></td>
                <td><button class="btn btn-primary" onclick="return send(this)" value="{{$result->id}}">Test Email</button></td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

</div>

@include('footer')
<script>
$(document).ready(function(){
  $("#template_table").DataTable();

  $("input[name=template_name]").keyup(function(){
    $(this).val($(this).val().toLowerCase());
  });

});

function send(result){
  let email_id = result.value;

  Swal.fire({
    title : 'Please input a email address',
    input : 'email',
    showCancelButton : true,
    confirmButtonText : 'Send',
  }).then((result)=>{
    if(result.isConfirmed){
      $.get('{{route('getTestEmail')}}',
      {
        'email_id' : email_id,
        'email' : result.value,
      },function(data){
        if(data){
          Swal.fire('Success','Email Sent','success');
        }else{
          Swal.fire('Failure','Email Sent Failure','error');
        }
      },'json');
    }
  });
}


</script>

@if(session()->has('success'))
<script>
  Swal.fire('Success','Template Upload Successful','success');
</script>
@endif

@endsection