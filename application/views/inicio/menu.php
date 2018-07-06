    <header>
        <!-- Header desktop -->
        <div class="container-menu-desktop">
            <!-- Topbar -->
            <div class="top-bar">
                <div class="content-topbar flex-sb-m h-full container">
                    <div class="left-top-bar">Los mejores libros de Harry Potter. ¡Y al mejor precio!</div>



                    <div class="right-top-bar flex-w h-full">
                        <?php
                        if( $this->session->userdata('login')){
                        ?>
                            <div class="flex-c-m trans-04 p-lr-25 item-top-menu">Bienvenid@ <?php echo $this->session->userdata('name'); ?></div>
                            <a href="<?php echo base_url(); ?>logout" class="flex-c-m trans-04 p-lr-25 item-top-menu"><span style="margin-right: 10px;" class="fa fa-sign-out"></span> Cerrar sesión</a>
                        <?php } else { ?>
                        <a href="<?php echo base_url(); ?>login" class="flex-c-m trans-04 p-lr-25  item-top-menu"><span style="margin-right: 10px;" class="fa fa-user"></span> Iniciar sesión</a>
                        <?php } ?>
                    </div>
                </div>
            </div>

            <div class="wrap-menu-desktop how-shadow1">
                <nav class="limiter-menu-desktop container">
                    
                    <!-- Logo desktop -->       
                    <a href="#" class="logo">
                        <h1>Harry <b>Books</b></h1>
                    </a>

                    <!-- Menu desktop -->
                    <div class="menu-desktop">
                        <ul class="main-menu">
                            <li>
                                <a href="<?php echo base_url(); ?>">Inicio</a>
                            </li>
                            <li class="label1" data-label1="Proximamente">
                                <a href="#">Mas libros</a>
                            </li>
                        </ul>
                    </div>  

                    <!-- Icon header -->
                    <div class="wrap-icon-header flex-w flex-r-m">
                        <a href="<?php echo base_url(); ?>carro_compras" id="content-cantidad-carrito" class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart" data-notify="<?php echo count($this->session->userdata('libros_carrito')); ?>">
                            <i class="fa fa-shopping-cart"></i>
                        </a>
                    </div>
                </nav>
            </div>  
        </div>
    </header>