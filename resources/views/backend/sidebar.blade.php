<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

<ul class="sidebar-nav" id="sidebar-nav">

  <li class="nav-item">
    <a class="nav-link " href="{{ url('/dashboard') }}">
      <i class="bi bi-grid"></i>
      <span>Dashboard</span>
    </a>
  </li><!-- End Dashboard Nav -->

  @if(Auth::user()->role != 'admin')
  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-menu-button-wide"></i><span>Master Data</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      <li>
        <a href="{{ url('/kategori') }}">
          <i class="bi bi-circle"></i><span>Kategori Asset</span>
        </a>
      </li>
      <li>
        <a href="{{ url('/divisi') }}">
          <i class="bi bi-circle"></i><span>Divisi</span>
        </a>
      </li>
    </ul>
  </li><!-- End Components Nav -->

  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-gem"></i><span>Kelola Asset</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="icons-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      <li>
        <a href="{{ url('/asset') }}">
          <i class="bi bi-circle"></i><span>Asset</span>
        </a>
      </li>
      <li>
        <a href="">
          <i class="bi bi-circle"></i><span>History</span>
        </a>
      </li>
      <li>
        <a href="">
          <i class="bi bi-circle"></i><span>Mutasi</span>
        </a>
      </li>
    </ul>
  </li><!-- End Icons Nav -->
  @else
  <li class="nav-item">
    <a class="nav-link " href="{{ url('/user') }}">
      <i class="bi bi-person"></i>
      <span>Kelola User</span>
    </a>
  </li>
  @endif
</ul>

</aside><!-- End Sidebar-->