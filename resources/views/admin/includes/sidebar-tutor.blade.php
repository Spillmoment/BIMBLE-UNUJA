<!-- Left Panel -->
<aside id="left-panel" class="left-panel">
  <nav class="navbar navbar-expand-sm navbar-default">
      <div id="main-menu" class="main-menu collapse navbar-collapse">
          <ul class="nav navbar-nav">

   
    
            <li class="{{ (Request::route()->getName() == 'tutor.home') ? 'active' : '' }}">
              <a href="{{ route('tutor.home') }}"><i class
                  ="menu-icon fa fa-laptop"></i>Dashboard </a>
              </li>
              
              <li class="menu-title text-capitalize">Manage Siswa</li>
              <li class="{{ 
                              (Request::route()->getName() == 'siswa.index') ? 'active' : ''    
                          }}">
                  <a href="{{ route('siswa.index') }}"> <i class="menu-icon fa fa-users"></i>Data Siswa</a>
              </li>
         


          </ul>
      </div><!-- /.navbar-collapse -->
  </nav>
</aside>
<!-- /#left-panel -->
