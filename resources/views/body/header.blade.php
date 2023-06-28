<header class="topbar" data-navbarbg="skin6">
  <nav class="navbar top-navbar navbar-expand-md navbar-light">
      <div class="navbar-header" data-logobg="skin6">
          <!-- ============================================================== -->
          <!-- Logo -->
          <!-- ============================================================== -->
          <a class="navbar-brand" href="index.html">
              <!-- Logo icon -->
              <b class="logo-icon">
                  <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                  <!-- Dark Logo icon -->
                  <img src="{{ asset('theme/assets/images/logo-icon.png') }}" alt="homepage" class="dark-logo" />
                  <!-- Light Logo icon -->
                  <img src="{{ asset('theme/assets/images/logo-light-icon.png') }}" alt="homepage" class="light-logo" />
              </b>
              <!--End Logo icon -->
              <!-- Logo text -->
              {{-- 
              <span class="logo-text">
                  <!-- dark Logo text -->
                  <img src="{{ asset('theme/assets/images/logo-text.png') }}" alt="homepage" class="dark-logo" />
                  <!-- Light Logo text -->
                  <img src="{{ asset('theme/assets/images/logo-light-text.png') }}" class="light-logo" alt="homepage" />
              </span>
               --}}
               <span class="logo-text">Table Tabulation</span>
          </a>
          <!-- ============================================================== -->
          <!-- End Logo -->
          <!-- ============================================================== -->
          <!-- This is for the sidebar toggle which is visible on mobile only -->
          <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i
                  class="mdi mdi-menu"></i></a>
      </div>
      <!-- ============================================================== -->
      <!-- End Logo -->
      <!-- ============================================================== -->
      <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
          <!-- ============================================================== -->
          <!-- toggle and nav items -->
          <!-- ============================================================== -->
          <ul class="navbar-nav float-start me-auto">
              <!-- ============================================================== -->
              <!-- Search -->
              <!-- ============================================================== -->
              {{-- 
              <li class="nav-item search-box"> <a class="nav-link waves-effect waves-dark"
                      href="javascript:void(0)"><i class="mdi mdi-magnify me-1"></i> <span class="font-16">Search</span></a>
                  <form class="app-search position-absolute">
                      <input type="text" class="form-control" placeholder="Search &amp; enter"> <a
                          class="srh-btn"><i class="mdi mdi-window-close"></i></a>
                  </form>
              </li>
               --}}
            @auth
            <li class="nav-item">
                <a>You are currently Logged in as <span class="text-info">{{ auth()->user()->name }}</span> </a>
            </li>
            @endauth
          </ul>
          <!-- ============================================================== -->
          <!-- Right side toggle and nav items -->
          <!-- ============================================================== -->
          
          <ul class="navbar-nav float-end">
              <!-- ============================================================== -->
              <!-- User profile and search -->
              <!-- ============================================================== -->
              @auth
               
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ (!empty($user_photo)) ? url('upload/'.$user_photo) : url('upload/no_image.jpg') }}" alt="user-img" class="rounded-circle" width="31">
                    </a>
                    
                    <ul class="dropdown-menu dropdown-menu-end user-dd animated" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="javascript:void(0)" ><i class="ti-user m-r-5 m-l-5"></i>
                            {{ auth()->user()->email }}</a>
                        <a class="dropdown-item" href="/profile/account" ><i class="mdi mdi-account-box m-r-5 m-l-5"></i>Update Account</a>
                            
                            <form action="/logout" method="post">
                                @csrf 
                                <button class="dropdown-item" type="submit"><i class="mdi mdi-logout m-r-5 m-l-5"></i>Logout</button>
                            </form>
                    </ul>
                </li>
              @endauth

              @guest
                <li>
                    <a href="/login" class="btn btn-outline-primary " style="margin-right:1rem;">Login</a>
                </li>
                <li>
                    <a href="/register" class="btn btn-outline-dark">Register</a>
                </li>
              @endguest
              <!-- ============================================================== -->
              <!-- User profile and search -->
              <!-- ============================================================== -->
          </ul>
          
      </div>
  </nav>
</header>