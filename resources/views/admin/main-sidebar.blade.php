
<aside class="main-sidebar">
    <section class="sidebar">
      <div class="user-panel">
        <div class="pull-left image">
          <img src="profile.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Azhar Ogi</p>
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
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="treeview" id="treeview_1">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Kategori</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <!--<li class="active"><a href="index.html"><i class="fa fa-circle-o"></i>Entertaiment</a></li>-->
            @foreach ($filterCategory as $record)
              <?php $category = ucfirst(strtolower($record));?>
              <li class="kategori" id={{ $category }}>
                <a href="/content"><i class="fa fa-circle-o"></i>{{ $category }}</a>
              </li>
            @endforeach
          </ul>
        </li>
        <li class="treeview" id="treeview_2">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Site</span>
           <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            @foreach ($filterHost as $record)
              <?php 
              $linkID = ucfirst(str_replace(".", "-", $record));
              $link = ucfirst($record);
              ?>
              <li class="site" id={{ $linkID }}><a href="/content">
                <i class="fa fa-circle-o"></i>{{ $link }}
              </a></li>
            @endforeach
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>Charts</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="pages/charts/chartjs.html"><i class="fa fa-circle-o"></i> ChartJS</a></li>
            <li><a href="pages/charts/morris.html"><i class="fa fa-circle-o"></i> Morris</a></li>
            <li><a href="pages/charts/flot.html"><i class="fa fa-circle-o"></i> Flot</a></li>
            <li><a href="pages/charts/inline.html"><i class="fa fa-circle-o"></i> Inline charts</a></li>
          </ul>
        </li>

        <li><a href="https://adminlte.io/docs"><i class="fa fa-book"></i> <span>Documentation</span></a></li>

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
  <script>
  $(".kategori").on("click",function(){
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
  });
  </script>
@include('admin.allscript')