    <div id="sidebar-nav" class="sidebar">
      <div class="sidebar-scroll">
        <nav>
          <ul class="nav">
            <li><a href="/dashboard" class="{{'dashboard' == request()->path() ? 'active' : ''}}"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
            
            <li><a href="/kendaraan" class="{{'kendaraan' == request()->path() ? 'active' : ''}}"><i class="lnr lnr-code"></i> <span>Data Kendaraan</span></a></li>
            
            <li><a href="/service" class="{{'service' == request()->path() ? 'active' : ''}}"><i class="lnr lnr-file-empty"></i> <span>Data Service</span></a></li>
            @if(Auth::user()->level=='admin')
            <li>
              <a href="#subPages" data-toggle="collapse" class="collapsed"><i class="lnr lnr-dice"></i> <span>Data Master</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
              <div id="subPages" class="collapse ">
                <ul class="nav">
                  <li><a href="/petugas" class="{{'petugas' == request()->path() ? 'active' : ''}}">Data Petugas</a></li>
                  <li><a href="/user" class="{{'user' == request()->path() ? 'active' : ''}}">Data User</a></li>
                </ul>
              </div>
            </li>
            @endif
            
          </ul>
        </nav>
      </div>
    </div>