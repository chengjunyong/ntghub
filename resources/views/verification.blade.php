@extends('layouts.app')

@section('content')
<style type="text/css">
  label{
    margin-top:5px;
  }
</style>
<div class="app-page-title">
  <div class="page-title-wrapper">
    <div class="page-title-heading">
      <div class="page-title-icon">
          <i class="pe-7s-check icon-gradient bg-mean-fruit"></i>
      </div>
      <div>Customer Verification
        <div class="page-title-subheading">Check customer information below.</div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  
  <div class="col-md-6">
    <div class="card" style="margin-bottom: 15px;">
      <div class="card-header">
        Customer Information
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-12">
            <label>Card Code</label>
            <input type="text" name="card_code" class="form-control" placeholder="Please Scan Member Card" />
          </div>
          <div class="col-md-12" style="text-align: center;">
            <label style="margin-top: 5px !important;">OR</label>
          </div>
          <div class="col-md-12">
            <label>Card ID</label>
            <div class="input-group">
              <input type="text" name="card_id" class="form-control" placeholder="Member ID"/>
              <div class="input-group-prepend">
                <button class="btn btn-secondary" id="check_id">Check Member ID</button>
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <label>Customer Name</label>
            <input type="text" id="name" class="form-control" placeholder="Pending Scan Or Check" readonly />
          </div>
          <div class="col-md-12">
            <label>Customer Contact</label>
            <input type="text" id="contact" class="form-control" placeholder="Pending Scan Or Check" readonly />
          </div>
          <div class="col-md-12">
            <label>Customer Email</label>
            <input type="text" id="email" class="form-control" placeholder="Pending Scan Or Check" readonly />
          </div>
          <div class="col-md-12">
            <label>Date Of Birth</label>
            <input type="text" id="dob" class="form-control" placeholder="Pending Scan Or Check" readonly />
          </div>
          <div class="col-md-12">
            <label>Member Registered Date</label>
            <input type="text" id="registered_date" class="form-control" placeholder="Pending Scan Or Check" readonly />
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-6">
    <div class="card">
      <div class="card-header">
        Purchase Information
      </div>
      <div class="card-body">
        <div class="row">
          <form method="post" action="{{route('postVerification')}}" style="width:100%">
            @csrf
            <input type="text" name="user_id" id="user_id" hidden required />
            <div class="col-md-12">
              <label>Category</label>
              <select name="category_id" id="category_id" class="form-control">
                @foreach($category as $result)
                  <option value="{{$result->id}}">{{$result->name}}</option>
                @endforeach
              </select>
            </div>

            <div class="col-md-12" id="sec_underwarranty">
              <label>Under Warranty</label>
              <select name="under_warranty" id="under_warranty" class="form-control">
                <option value="1">Yes</option>
                <option value="0">No</option>
              </select>
            </div>

            <div class="col-md-12" id="sec_warranty" hidden>
              <label>Warranty</label>
              <input type="date" id="warranty" name="warranty" class="form-control" placeholder="Warranty End Date" disabled/>
            </div>
            <div class="col-md-12">
              <label>Brand</label>
              <select name="brand_id" class="form-control">
                @foreach($brand as $result)
                  <option value="{{$result->id}}">{{$result->name}}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-12">
              <label>Serial Code (IMEI Number)</label>
              <input type="text" id="serial_code" name="serial_code" class="form-control" placeholder="Product Code or IMEI Number (Mobile)" />
            </div>
            <div class="col-md-12">
              <label>Notes</label>
              <textarea name="notes" class="form-control" rows="5"></textarea>
            </div>
            <div class="col-md-12" style="text-align: center;margin-top: 15px;">
              <input type="submit" class="btn btn-primary"/>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

</div>

@include('footer')
<script>
$(document).ready(function(){
  let cache;

  $("#check_id").click(function(){
    $.post('{{route('getCustomerDetails')}}',
    {
      '_token' : '{{ csrf_token() }}',
      'member_id' : $("input[name=card_id]").val(),
      'card_code' : null,

    },function(data){
      if(data != null){
        $("#name").val(data['name']);
        $("#contact").val("+60"+data['contact']);
        $("#email").val(data['email']);
        $("#dob").val(data['datetime']);
        $("#registered_date").val(data['register']);
        $("#user_id").val(data['id']);
      }else{
        swal.fire(
          'Error',
          "Card Id & Card Code Doesn't Exist",
          'error',
        );
        $("#user_id").val(null);
      }
    },'json');
  });

  $("input[name=card_code]").keyup(function(){
    clearInterval(cache);
    cache = setTimeout(getDetail,100);
  });

  $("input[type=submit]").click(function(){

    if($("#user_id").val() == ""){
      swal.fire(
        'No Customer Detected',
        'Please Scan Member Card Or Insert Member ID To Find Customer Data',
        'error',
      )
    }
  });

  $("#category_id").change(function(){

    if($(this).val() != 1){
      $("#sec_underwarranty").prop('hidden',true);
      $("#under_warranty").prop('disabled',true);

    }else{
      $("#sec_underwarranty").prop('hidden',false);
      $("#under_warranty").prop('disabled',false);
    }

    if($(this).val() != 2){
      $("#sec_warranty").prop('hidden',true);
      $("#warranty").prop('disabled',true);

    }else{
      $("#sec_warranty").prop('hidden',false);
      $("#warranty").prop('disabled',false);
    }

  });

  function getDetail(){
    let code = $("input[name=card_code]").val();
    $.post('{{route('getCustomerDetails')}}',
    {
      '_token' : '{{ csrf_token() }}',
      'member_id' : null,
      'card_code' : code,

    },function(data){
      if(data != null){
        $("#name").val(data['name']);
        $("#contact").val("+60"+data['contact']);
        $("#email").val(data['email']);
        $("#dob").val(data['datetime']);
        $("#registered_date").val(data['register']);
        $("#user_id").val(data['id']);
      }else{
        swal.fire(
          'Error',
          "Card Id & Card Code Doesn't Exist",
          'error',
        );
        $("#user_id").val(null);
      }

    },'json');
  }

});
</script>

@if(session()->has('success'))
  <script>swal.fire('Success','Data Record Successful','success')</script>
@endif

@endsection