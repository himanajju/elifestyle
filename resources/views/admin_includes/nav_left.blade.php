
  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="treeview">
          <a href="{{url('/admin/dash')}}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
              </a>
          
        </li>

      <li class="treeview">
        <a href="#">
          <i class="fa fa-user"></i><span>User</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left  pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="{{url('/admin/add/usergroup')}}"><i class="fa fa-circle-o fa-user"></i>Add Usergroup</a></li>
          <li><a href="{{url('/admin/add/user')}}"><i class="fa fa-circle-o fa-user"></i>Add User</a></li>
          <li><a href="{{url('/admin/add/plan')}}"><i class="fa fa-circle-o fa-dropbox"></i>Add Plan</a></li>
          </ul>
          </li>
            
      <li class="treeview">
        <a href="#">
          <i class="fa  fa-android"></i><span>App</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left  pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="{{url('/admin/add/app-permission')}}"><i class="fa fa-circle-o fa-user"></i>Add App Permission</a></li>
          <li><a href="{{url('/admin/add/app-category')}}"><i class="fa fa-circle-o fa-user"></i>Add Category</a></li>
          <li><a href="{{url('/admin/add/app-register')}}"><i class="fa fa-circle-o fa-dropbox"></i>Register App</a></li>
          </ul>
          </li>
            </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->


  