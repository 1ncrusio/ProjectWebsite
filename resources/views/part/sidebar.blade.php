<div class="main-sidebar"> <aside id="sidebar-wrapper"> <div class="sidebar-brand"> <a href="{{ url('admin.index') }}">Stisla</a>
  </div>
  <div class="sidebar-brand sidebar-brand-sm"> <a href="{{ url('admin.index') }}">St</a> </div>
    <ul class="sidebar-menu"> <li class="menu-header">Dashboard</li> <li class="active"><a class="nav-link"
        href="{{ url('admin.index') }}"><i class="far fa-file-alt"></i><span>Dashboard</span></a></li> <li
          class="menu-header">Monitoring Dan System</li>
          <li class="nav-item dropdown">
          <a href="#" class="nav-link has-dropdown"><i class="fas fa-th"></i><span>Monitoring</span></a>
          <ul class="dropdown-menu">
            <li><a href="{{ url('mlantai') }}">Perlantai</a></li>
            <li><a href="{{ url('malat') }}">Peralat</a></li>
            
          </ul>
          <li class="active"><a class="nav-link" href="{{ url('cari') }}"><i class="fas fa-ellipsis-h"></i>
          <span>Cari</span></a></li>
          @if(Auth::user()->role == 'admin')
          <li class="active"><a class="nav-link" href="{{ url('perangkat') }}"><i class="fas fa-ellipsis-h"></i>
          <span>Perangkat</span></a></li>
          @endif
          @if(Auth::user()->role == 'admin')
          <li class="active"><a class="nav-link" href="{{ url('tambah-perangkat') }}"><i class="fas fa-ellipsis-h"></i>
          <span>Tambah Perangkat</span></a></li>
          @endif
         </li> <li class="menu-header">User</li>
            <li class="active"><a class="nav-link" href="{{ url('profile') }}"><i class="far fa-user"></i>
              <span>Profile</span></a></li>
              @if(Auth::user()->role == 'admin')
      <li class="active"><a class="nav-link" href="{{ url('data-user') }}"><i class="far fa-user"></i> <span>Tambah
      User</span></a></li>
      @endif

      <!-- <li class="menu-header">Laporan dan System</li> <li class="nav-item dropdown">
        <a href="#" class="nav-link has-dropdown"><i class="fas fa-ellipsis-h"></i>
          <span>Tampilan</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="{{url('edit/home')}}"
              onclick="centeredPopup(this.href,'myWindow','1500','1000','yes');return false">Home</a></li>
          <li><a class="nav-link" href="{{url('edit/about')}}"
              onclick="centeredPopup(this.href,'myWindow','1500','1000','yes');return false">About</a></li>
          <li><a class="nav-link" href="{{url('edit/contact')}}"
              onclick="centeredPopup(this.href,'myWindow','1500','1000','yes');return false">Contact Us</a></li>

        </ul>
        <a class="nav-link" href="{{ url('log') }}"><i class="far fa-file-alt"></i><span>Log</span></a></li>
        </aside>   -->
  </div>
  <script language="javascript">
    var popupWindow = null;

    function centeredPopup(url, winName, w, h, scroll) {
      LeftPosition = (screen.width) ? (screen.width - w) / 2 : 0;
      TopPosition = (screen.height) ? (screen.height - h) / 2 : 0;
      settings =
        'height=' + h + ',width=' + w + ',top=' + TopPosition + ',left=' + LeftPosition + ',scrollbars=' + scroll + ',resizable'
      popupWindow = window.open(url, winName, settings)
    }
  </script>