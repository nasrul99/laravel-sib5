  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

      <div class="d-flex align-items-center justify-content-between">
          <a href="index.html" class="logo d-flex align-items-center">
              <img src="assets/img/logo.png" alt="">
              <span class="d-none d-lg-block">Middleware</span>
          </a>
          <i class="bi bi-list toggle-sidebar-btn"></i>
      </div><!-- End Logo -->

      <div class="search-bar">
          <form class="search-form d-flex align-items-center" method="POST" action="#">
              <input type="text" name="query" placeholder="Search" title="Enter search keyword">
              <button type="submit" title="Search"><i class="bi bi-search"></i></button>
          </form>
      </div><!-- End Search Bar -->

      <nav class="header-nav ms-auto">
          <ul class="d-flex align-items-center">

              <li class="nav-item d-block d-lg-none">
                  <a class="nav-link nav-icon search-bar-toggle " href="#">
                      <i class="bi bi-search"></i>
                  </a>
              </li><!-- End Search Icon-->

              <li class="nav-item dropdown pe-3">

                  <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                      @if(empty(Auth::user()->foto))
                          <img src="{{ asset('backend/assets/img/nophoto.png') }}" alt="Profile"
                              class="rounded-circle">
                      @else        
                          <img src="{{ asset('backend/assets/img') }}/{{ Auth::user()->foto }}" alt="Profile"
                              class="rounded-circle">
                      @endif
                          <span class="d-none d-md-block dropdown-toggle ps-2">
                              @if(empty(Auth::user()->name))
                                  ''
                              @else
                                  {{ Auth::user()->name }}
                              @endif
                          </span>
                  </a><!-- End Profile Iamge Icon -->

                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                      <li class="dropdown-header">
                          <h6>
                              @if(empty(Auth::user()->name))
                                  ''
                              @else
                                  {{ Auth::user()->name }}
                              @endif
                          </h6>
                          <span>
                              @if(empty(Auth::user()->role))
                                  ''
                              @else
                                  {{ Auth::user()->role }}
                              @endif
                          </span>
                      </li>
                      <li>
                          <hr class="dropdown-divider">
                      </li>

                      <li>
                          <a class="dropdown-item d-flex align-items-center" href="">
                              <i class="bi bi-person"></i>
                              <span>My Profile</span>
                          </a>
                      </li>
                      <li>
                          <hr class="dropdown-divider">
                      </li>
                      @if(Auth::user()->role == 'admin')
                      <li>
                          <a class="dropdown-item d-flex align-items-center" 
                             href="{{ url('/user')}}">
                              <i class="bi bi-gear"></i>
                              <span>Account Settings</span>
                          </a>
                      </li>
                      @endif
                      <li>
                          <hr class="dropdown-divider">
                      </li>
                      <li>
                          <hr class="dropdown-divider">
                      </li>

                      <li>
                          <!--a class="dropdown-item d-flex align-items-center" href="#">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Sign Out</span>
                          </a-->
                          <a class="dropdown-item" title="Logout" href="{{ route('logout') }}"
                              onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                              <i class="bi bi-box-arrow-right"></i> Log Out
                          </a>
                          <form id="logout-form" action="{{ route('logout') }}" method="POST"
                              class="d-none">
                              @csrf
                          </form>
                      </li>

                  </ul><!-- End Profile Dropdown Items -->
              </li><!-- End Profile Nav -->

          </ul>
      </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->
