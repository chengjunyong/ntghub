@extends('layouts.app')

@section('content')
<div class="app-page-title">
  <div class="page-title-wrapper">
    <div class="page-title-heading">
      <div class="page-title-icon">
          <i class="pe-7s-id icon-gradient bg-mean-fruit"></i>
      </div>
      <div>Customer List
        <div class="page-title-subheading">Customer Information</div>
      </div>
    </div>
  </div>
</div>

<div class="card" style="margin-bottom: 5px;">
  <div class="card-header">
    Customer Details Data
    <input type="text" hidden id="id" value="{{$customer->id}}" />
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-md-6">
        <label>Card Code</label>
        <input type="text" name="code" value="{{$customer->card_code}}" class="form-control" readonly>
      </div>
      <div class="col-md-6">
        <label>Card ID</label>
        <input type="text" name="id" value="{{$customer->card_id}}" class="form-control" readonly>
      </div>
      <div class="col-md-6">
        <label>Name</label>
        <input type="text" name="name" value="{{$customer->name}}" class="form-control">
      </div>
      <div class="col-md-6">
        <label>E-mail</label>
        <input type="text" name="email" value="{{$customer->email}}" class="form-control">
      </div>
      <div class="col-md-6">
        <label>Contact Number</label><br/>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">+60</span>
            </div>
            <input type="number" name="contact" class="form-control" placeholder="9 or 10 Digit" value="{{ $customer->contact }}"/>
          </div>
      </div>
      <div class="col-md-6">
        <label>Date Of Birth</label>
        <input type="date" name="dob" value="{{$customer->date_birth}}" class="form-control" required>
      </div>
      <div class="col-md-6">
        <label>Preference Language</label>
        <select class="form-control" name="prefer_language" required>
          <option value="Chinese" {{ ($customer->prefer_language == "Chinese") ? 'selected' : '' }}>Chinese</option>
          <option value="Malay" {{ ($customer->prefer_language == "Malay") ? 'selected' : '' }}>Malay</option>
          <option value="English" {{ ($customer->prefer_language == "English") ? 'selected' : '' }}>English</option>
        </select>
      </div>
      <div class="col-md-6">
        <label>Registered Date</label>
        <input type="date" name="register" value="{{$customer->create}}" class="form-control" readonly>
      </div>
      <div class="col-md-6">
        <label>Last Updated</label>
        <input type="date" name="update" value="{{$customer->update}}" class="form-control" readonly>
      </div>
      <div class="col-md-12" style="margin-top: 20px;text-align: center">
        <button id="modify" class="btn btn-primary">Modify Data</button>
      </div>
    </div>
  </div>
</div>

<div class="card" style="margin-bottom: 15px;">
  <div class="card-header">
    Customer Purchase History
  </div>
  <div class="card-body">
    <table id="history" style="width:100%;" class="table table-striped">
      <thead>
        <tr>
          <td>Category</td>
          <td>Brand</td>
          <td>Serial Code / IMEI Code</td>
          <td>Warranty End Date</td>
          <td>Notes</td>
          <td>Purchase Date</td>
        </tr>
      </thead>
      <tbody>
        @foreach($transaction as $result)
          <tr>
            <td>{{$result->category_name}}</td>
            <td>{{$result->brand_name}}</td>
            <td>{{$result->serial_code}}</td>
            <td>{{$result->warranty_end_date}}</td>
            <td>{{$result->notes}}</td>
            <td>{{$result->created_at}}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@include('footer')

<script>
$(document).ready(function(){
  $("input[name=contact]").keyup(function(){
    if($(this).val().length < 9){
      $(this)[0].setCustomValidity('Minimum 9 Digit For Contact Number');

    }else if($(this).val().length > 10){
      $(this)[0].setCustomValidity('Cannot Exceed 10 Digit Contact Number');

    }else{
      $(this)[0].setCustomValidity('');
    }
  });

  $('#history').DataTable();

  $("#modify").click(function(){
    let emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;

    if($("input[name=name]").val() == ''){
      swal.fire('Error','Please Fill Up The Customer Name','error');

    }else if($("input[name=email]").val() == '' || !emailReg.test($("input[name=email]").val()) ){
      swal.fire('Error','Please Make Sure The Email Is Not Empty And Correct Format','error');

    }else if($("input[name=contact]").val() == '' || $("input[name=contact]").val().length < 9 || $("input[name=contact]").val().length > 10){
      swal.fire('Error','Please Make Sure Contact Number Is Not Empty And Within 9 to 10 Digit','error');

    }else if($("input[name=dob]").val() == ''){
      swal.fire('Error','Please Fill Up The Date Of Birth','error');

    }else{

      $.post('{{ route('ajaxModifyCustomer') }}',
      {
        '_token' : '{{ csrf_token() }}',
        'id' : $("#id").val(),
        'name' : $("input[name=name]").val(),
        'email' : $("input[name=email]").val(),
        'contact' : $("input[name=contact]").val(),
        'dob' : $("input[name=dob]").val(),
        'prefer_language' : $("select[name=prefer_language]").val(),

      },function(data){

        if(data){
          swal.fire('Success','Update Successful','success');
        }else{
          swal.fire('Fail','Update Failure, Please Contact IT Support','error');
        }


      },'json');

    }

  });

});
</script>
@endsection