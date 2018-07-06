  <header class="main-header">

    <!-- Logo -->
    <a href="<?php echo base_url(); ?>administracion" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->

      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">Harry <b>Books</b></span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span><?php echo $this->session->userdata('name'); ?> <i style="margin-left: 5px;" class="fa fa-angle-down"></i></span>
            </a>
            <ul class="dropdown-menu" style="width: auto;min-width: auto;">
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-right">
                  <a href="<?php echo base_url(); ?>logout" class="btn btn-default btn-flat">Cerrar sesión</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left icon">
          <span class="fa fa-users"></span>
        </div>
        <div class="pull-left info">
          <p><?php echo $this->session->userdata('name'); ?></p>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">Menú</li>
          <li><a href="<?php echo base_url(); ?>administracion/clientes"><i class="fa fa-users"></i><span> Clientes</span></a></li>

          <li><a href="<?php echo base_url(); ?>administracion/informes"><i class="fa fa-archive"></i><span> Informes</span></a></li>
        </ul>
      </section>
    </aside>