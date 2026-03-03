<aside class="main-sidebar">
  <section class="sidebar">

    <div class="user-panel">
      <div class="pull-left image">
        <img src="{{ asset('adminlte/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>{{ session('user.name') }}</p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>

    <form action="#" method="get" class="sidebar-form">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Search...">
        <span class="input-group-btn">
          <button type="submit" name="search" id="search-btn" class="btn btn-flat">
            <i class="fa fa-search"></i>
          </button>
        </span>
      </div>
    </form>

    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MAIN NAVIGATION</li>
      <li>
        <a href="{{ url('dashboard') }}">
          <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
      </li>
      <li>
        <a href="{{ url('employee') }}">
          <i class="fa fa-users"></i> <span>Employee</span>
        </a>
      </li>
      <li>
        <a href="{{ url('job') }}">
          <i class="fa fa-briefcase"></i> <span>Job</span>
        </a>
      </li>
      <li>
        <a href="{{ url('user') }}">
          <i class="fa fa-user"></i> <span>Job</span>
        </a>
      </li>

      <li class="header">REGIONS</li>
      <li>
        <a href="{{ url('province') }}">
          <i class="fa fa-map"></i> Province
        </a>
      </li>
      <li>
        <a href="{{ url('city') }}">
          <i class="fa fa-building"></i> City
        </a>
      </li>
      <li>
        <a href="{{ url('district') }}">
          <i class="fa fa-map-marker"></i> District
        </a>
      </li>
      <li>
        <a href="{{ url('village') }}">
          <i class="fa fa-home"></i> Village
        </a>
      </li>
      <li>
        <a href="{{ url('setting') }}">
          <i class="fa fa-gear"></i> Setting
        </a>
      </li>
    </ul>

  </section>
</aside>

@pushOnce('scripts')
<script>
  $(document).ready(function () {
    var currentUrl = window.location.href;

    $('.sidebar-menu li a').each(function () {
      var linkUrl = $(this).attr('href');
      if (linkUrl && linkUrl !== '#' && currentUrl.startsWith(linkUrl)) {
        $(this).closest('li').addClass('active');
      }
    });
  });
</script>
@endPushOnce