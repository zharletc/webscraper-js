
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<header class="main-header">

    <a href="/" class="logo">

      <span class="logo-mini"><b>D</b>C</span>

      <span class="logo-lg"><b>Dy</b>Crawler</span>
    </a>

    <nav class="navbar navbar-static-top">

      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="profile.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs">{{ Auth::user()->name }}</span>
            </a>
            <ul class="dropdown-menu">
              <li class="user-header">
                <img src="profile.jpg" class="img-circle" alt="User Image">

                <p>
                  {{ Auth::user()->name }} - Web Developer
                  <small>Since 2018</small>
                </p>
              </li>
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <form action="{{ url('/logout') }}" name="fsignout" method="POST">
                     {{ csrf_field() }}
                    <button name="signout" type="submit" class="btn btn-default btn-flat">Sign out</button>
                  </form>
                  
                  </form>
                </div>
              </li>
            </ul>
          </li>
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>