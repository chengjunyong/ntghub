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
          
        </div>
      </div>
    </div>
  </div>

</div>

@include('footer')

@endsection