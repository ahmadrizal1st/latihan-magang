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
        Welcome back, <span id="username">...</span>!
      </h3>
    </div>
    <div class="box-body">
      <p>You are logged in as <strong><span id="useremail">...</span></strong></p>
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

@push('scripts')
<script>
  $(function () {
    $.ajax({
      url: '{{ url("/auth/me") }}',
      method: 'GET',
      success: function (res) {
        if (res.success && res.data) {
          $('#username').text(res.data.name);
          $('#useremail').text(res.data.email);
        } else {
          window.location.href = '{{ url("/auth/login") }}';
        }
      },
      error: function () {
        window.location.href = '{{ url("/auth/login") }}';
      }
    });
  });
</script>
@endpush