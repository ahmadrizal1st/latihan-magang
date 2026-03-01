  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset('adminlte/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Alexander Pierce</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li>
          <a href="{{ url("employee") }}">
            <i class="fa fa-table"></i> <span>Employee</span>
          </a>
        </li>
        <li>
          <a href="{{ url("job") }}">
            <i class="fa fa-table"></i> <span>Job</span>
          </a>

        <li class="header">WILAYAH</li>
          <li>
            <a href="{{ url("province") }}">
              <i class="fa fa-table"></i>
              Provinsi
            </a>
          </li>
          <li>
            <a href="{{ url("city") }}">
              <i class="fa fa-table"></i>
              Kota/Kabupaten
            </a>
          </li>
          <li>
            <a href="{{ url("district") }}">
              <i class="fa fa-table"></i>
              Kecamatan
            </a>
          </li>
          <li>
            <a href="{{ url("village") }}">
              <i class="fa fa-table"></i>
              Kelurahan
            </a>
          </li>
          <li>
            <a href="{{ url("postal-code") }}">
              <i class="fa fa-table"></i>
              Kode Pos
            </a>
          </li>
        </li>
      </li>
      </ul>
    </section>
    <!-- /.sidebar -->
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