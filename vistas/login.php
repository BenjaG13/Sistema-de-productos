


<div class="login">

    <form action="" method="POST" autocomplete="off">
        <h2 class="tittle">Sistema de inventario</h2>
        <div class="usuario">
            <label for="user">Usuario</label> <br>
            <input type="text" id="user" name="user" pattern="[a-zA-Z0-9]{4,20}" required>
        </div>
        <div class="contra">
            <label for="pass">Contraseña</label> <br>
            <input type="password" id="pass" name="pass" pattern="[a-zA-Z0-9]{4,20}" required>
        </div>
        <button class="btn" >Iniciar sesion</button>

    </form>
    
    <?php

            if ((isset($_POST['user'])) && (isset($_POST['pass']))){
                require_once("php/main.php");

                require_once("php/iniciar_sesion.php");
            }
        ?>

</div>



