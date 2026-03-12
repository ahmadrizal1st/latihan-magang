@extends('layouts.dashboard')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Control panel')

@section('breadcrumb')
<li class="active">Dashboard</li>
@endsection

@section('content')
<section class="content">

  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">
        <i class="fa fa-hand-o-right"></i>
        Welcome back, <span class="username">...</span>!
      </h3>
    </div>
    <div class="box-body">
      <p>You are logged in as <strong><span class="useremail">...</span></strong></p>
      <p>Start creating your amazing application!</p>
    </div>
    <div class="box-footer">
      <small class="text-muted">
        <i class="fa fa-clock-o"></i> {{ now()->format('l, d F Y H:i') }}
      </small>
    </div>
  </div>

</section>
@endsection