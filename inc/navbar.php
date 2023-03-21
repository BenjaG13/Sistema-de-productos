
    <nav class="menu">
        <section class="menu_container">
            <a href="index.php?vista=home" class="menu_logo">Inventario</a>

            <ul class="menu_links none">
                
                <li class="menu_item menu_item-show">
                    <p class="menu_link">Usuarios <i class="fa-solid fa-arrow-right"></i></p>

                    <ul class="menu_nesting">
                        <li class="menu_inside">
                            <a href="index.php?vista=user_new" class="menu_link menu_link-inside">Nuevo</a>
                        </li>
                        <li class="menu_inside">
                            <a href="index.php?vista=lista_user" class="menu_link menu_link-inside">Lista</a>
                        </li>
                    </ul>
                </li>

                <li class="menu_item menu_item-show">
                    <p class="menu_link">Categorias <i class="fa-solid fa-arrow-right"></i></p>

                    <ul class="menu_nesting">
                        <li class="menu_inside">
                            <a href="#1" class="menu_link menu_link-inside">Nuevo</a>
                        </li>
                        <li class="menu_inside">
                            <a href="#2" class="menu_link menu_link-inside">Lista</a>
                        </li>
                        <li class="menu_inside">
                            <a href="#3" class="menu_link menu_link-inside">Buscar</a>
                        </li>
                    </ul>
                </li>

                <li class="menu_item menu_item-show">
                    <p class="menu_link">Productos <i class="fa-solid fa-arrow-right"></i></p>

                    <ul class="menu_nesting">
                        <li class="menu_inside">
                            <a href="#" class="menu_link menu_link-inside">Nuevo</a>
                        </li>
                        <li class="menu_inside">
                            <a href="#" class="menu_link menu_link-inside">Lista</a>
                        </li>
                        <li class="menu_inside">
                            <a href="#" class="menu_link menu_link-inside">Por categoria</a>
                        </li>
                        <li class="menu_inside">
                            <a href="#" class="menu_link menu_link-inside">Buscar</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <div class="options">
                <a href="index.php?vista=user_update&user_edit=<?php echo $_SESSION['id']  ?>" class="mi_cuenta">Mi Cuenta</a>
                <a href="#sal" class="salir logout">Salir</a>
            </div>

            <div class="menu_hamburguer">
                <i class="fa-solid fa-bars"></i>
            </div>

        </section>

    </nav>


    

