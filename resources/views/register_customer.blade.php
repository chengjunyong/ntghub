@extends('layouts.app')

@section('content')
<style>
  label{
    margin-top:15px;
  }

  /* Chrome, Safari, Edge, Opera */
  input::-webkit-outer-spin-button,
  input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
  }

  /* Firefox */
  input[type=number] {
    -moz-appearance: textfield;
  }

</style>

<div class="app-page-title">
  <div class="page-title-wrapper">
    <div class="page-title-heading">
      <div class="page-title-icon">
          <i class="pe-7s-add-user icon-gradient bg-mean-fruit"></i>
      </div>
      <div>Register Customer
        <div class="page-title-subheading">Fill up all customer information below.</div>
      </div>
    </div>
  </div>
</div>

<div class="card">
  <div class="card-header">
    Create Customer 
  </div>
  <div class="card-body">
    <form method="post" action="#">
      @csrf
      <div class="row">
        <div class="col-md-6">
          <label>Card ID</label><br/>
          <input type="number" name="card_number" class="form-control" step="1" placeholder="Card Serial Number" required/>
        </div>
        <div class="col-md-6">
          <label>Card Code (Scan Member Card)</label><br/>
          <input type="text" name="card_code" class="form-control" placeholder="Please use card reader to scan customer member card." required/>
        </div>
        <div class="col-md-6">
          <label>Name</label><br/>
          <input type="text" name="customer_name" class="form-control" placeholder="Customer Name" required />
        </div>
        <div class="col-md-6">
          <label>Email Address</label><br/>
          <input type="email" name="customer_email" class="form-control" placeholder="Email Address" required/>
        </div>
        <div class="col-md-6">
          <label>Contact Number</label><br/>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">+60</span>
            </div>
            <input type="number" name="customer_contact" class="form-control" placeholder="9 or 10 Digit" required/>
          </div>
        </div>
        <div class="col-md-6">
          <label>Date Of Birth</label><br/>
          <input type="date" name="customer_dob" class="form-control" required/>
        </div>
        <div class="col-md-12" style="margin-top: 20px;text-align: center">
          <input type="reset" class="btn btn-danger" value="Reset" />
          <input type="submit" class="btn btn-primary" value="Create" />
        </div>
      </div>
    </form>
  </div>
</div>
@include('footer')

@if(session()->has('success'))
<script>swal.fire('Completed','Create Customer Successful','success')</script>
@endif  


<script type="text/javascript">
$(document).ready(function(){
  
  $("input[name=customer_contact]").keyup(function(){
    if($(this).val().length < 9){
      $(this)[0].setCustomValidity('Minimum 9 Digit For Contact Number');

    }else if($(this).val().length > 10){
      $(this)[0].setCustomValidity('Cannot Exceed 10 Digit Contact Number');

    }else{
      $(this)[0].setCustomValidity('');
    }
  });

  $("input[name=card_code]").change(function(){
    $(this).attr("readonly",true);
  });

  $("input[type=reset]").click(function(){
    $("input[name=card_code]").attr("readonly",false);
  }); 

});
</script>
@endsection