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
            <input type="number" name="contact" class="form-control" placeholder="9 or 10 Digit" value="{{ substr($customer->contact,3) }}"/>
          </div>
      </div>
      <div class="col-md-6">
        <label>Date Of Birth</label>
        <input type="date" name="dob" value="{{$customer->date_birth}}" class="form-control">
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

});
</script>
@endsection