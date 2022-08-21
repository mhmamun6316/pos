<nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow container-xxl">
    <div class="navbar-container d-flex content">
      <div class="bookmark-wrapper d-flex align-items-center">
        <ul class="nav navbar-nav d-xl-none">
            <li class="nav-item"><a class="nav-link menu-toggle" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu ficon"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg></a></li>
        </ul>
      </div>

      <ul class="nav navbar-nav align-items-center ms-auto">

        <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-style"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-sun ficon"><circle cx="12" cy="12" r="5"></circle><line x1="12" y1="1" x2="12" y2="3"></line><line x1="12" y1="21" x2="12" y2="23"></line><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line><line x1="1" y1="12" x2="3" y2="12"></line><line x1="21" y1="12" x2="23" y2="12"></line><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line></svg></a></li>

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

