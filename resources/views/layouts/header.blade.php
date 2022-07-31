<nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-dark navbar-shadow container-xxl">
    <div class="navbar-container d-flex content">
      <div class="bookmark-wrapper d-flex align-items-center">
        <ul class="nav navbar-nav d-xl-none">
            <li class="nav-item"><a class="nav-link menu-toggle" href="#"><i class="ficon" data-feather="menu"></i></a></li>
        </ul>

      </div>
      <ul class="nav navbar-nav align-items-center ms-auto">
        <li class="nav-item dropdown dropdown-language"><a class="nav-link dropdown-toggle" id="dropdown-flag" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="flag-icon flag-icon-us"></i><span class="selected-language">English</span></a>
          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-flag"><a class="dropdown-item" href="#" data-language="en"><i class="flag-icon flag-icon-us"></i> English</a><a class="dropdown-item" href="#" data-language="fr"><i class="flag-icon flag-icon-fr"></i> French</a></div>
        </li>
        <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-style"><i class="ficon" data-feather="sun"></i></a></li>
        <li class="nav-item dropdown dropdown-notification me-25"><a class="nav-link" href="#" data-bs-toggle="dropdown"><i class="ficon" data-feather="bell"></i><span class="badge rounded-pill bg-danger badge-up">5</span></a>
          <ul class="dropdown-menu dropdown-menu-media dropdown-menu-end">
            <li class="dropdown-menu-header">
              <div class="dropdown-header d-flex">
                <h4 class="notification-title mb-0 me-auto">Notifications</h4>
                <div class="badge rounded-pill badge-light-primary">6 New</div>
              </div>
            </li>
            <li class="scrollable-container media-list">
                <a class="d-flex" href="#">
                    <div class="list-item d-flex align-items-start">
                    <div class="me-1">
                        <div class="avatar"><img src="../../../app-assets/images/portrait/small/avatar-s-15.jpg" alt="avatar" width="32" height="32"></div>
                    </div>
                    <div class="list-item-body flex-grow-1">
                        <p class="media-heading"><span class="fw-bolder">Congratulation Sam 🎉</span>winner!</p><small class="notification-text"> Won the monthly best seller badge.</small>
                    </div>
                    </div>
               </a>
            </li>
          </ul>
        </li>
        <li class="nav-item dropdown dropdown-user"><a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="user-nav d-sm-flex d-none">
                <span class="user-name fw-bolder">{{ Auth::user()->name }}</span><span class="user-status">
                    @php
                       echo App\Models\User::ROLE[Auth::user()->role_id]
                    @endphp
               </span>
            </div>
        <span class="avatar"><img class="round" src="{{ (!empty(Auth::user()->photo))?url(Auth::user()->photo):url('uploads/avatar-1.jpg') }}" alt="avatar" height="40" width="40"><span class="avatar-status-online"></span></span></a>
          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user">
              <a class="dropdown-item" href="{{ route('profile.view') }}"><i class="me-50" data-feather="user"></i> Profile</a>
              <a class="dropdown-item" href="{{ route('password.change') }}"><i class="me-50" data-feather="power"></i>Re-Password</a>
              <form action="{{ route('logout') }}" method="POST">
                @csrf
                  <a class="dropdown-item" onclick="event.preventDefault();
                  this.closest('form').submit();"><i class="me-50" data-feather="power"></i> Logout</a>
              </form>
          </div>
        </li>
      </ul>
    </div>
  </nav>

