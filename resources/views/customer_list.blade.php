@extends('layouts.app')

@section('content')
<div class="app-page-title">
  <div class="page-title-wrapper">
    <div class="page-title-heading">
      <div class="page-title-icon">
          <i class="pe-7s-id icon-gradient bg-mean-fruit"></i>
      </div>
      <div>Customer List
        <div class="page-title-subheading">Customer Information Table</div>
      </div>
    </div>
  </div>
</div>

<div class="card" style="margin-bottom: 15px;">
  <div class="card-header">
    Customer List
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-md-12">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Name</th>
              <th scope="col">E-mail</th>
              <th scope="col">Contact</th>
              <th scope="col">Date Of Birth</th>
              <th scope="col">Registered Date</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
            @foreach($customer as $result)
              <tr>
                <td>{{$result->name}}</td>
                <td>{{$result->email}}</td>
                <td>{{$result->contact}}</td>
                <td>{{$result->dob}}</td>
                <td>{{$result->created_at}}</td>
                <td><button class="btn btn-primary" onclick="window.location.assign('{{ route('getCustomerInfo',$result->id) }} ')">Details</button></td>
              </tr>
            @endforeach
          </tbody>
        </table>
        <div class="link" style="float:right">{{ $customer->links() }}</div>
      </div>
    </div>
  </div>
</div>

@include('footer')

@endsection