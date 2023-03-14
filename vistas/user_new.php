


<div class="user_new">

    <form action="php/usuario_guardar.php" method="POST" class="formularioAjax" autocomplete="off">
       
        <h1 class="tittle">Cargar usuario</h1>
        <div class="casillas">
            <div class="contra">
                <label for="user">Nombres</label>   <br>
                <input type="text" id="nombre" name="usuario_nombre" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}"> 
            </div>
            <div class="contra">
                <label for="apellido">Apellidos</label>  <br>
                <input type="text" id="apellido" name="usuario_apellido" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}"> 
            </div>
            <div class="contra">
                <label for="usuario">Usuario</label>  <br>
                <input type="text" id="usuario" name="usuario_usuario" pattern="[a-zA-Z0-9]{4,20}"> 
            </div>
            <div class="contra">
                <label for="email">Email</label>  <br>
                <input type="text" id="email" name="usuario_email" > 
            </div>
            <div class="contra">
                <label for="pass">Contraseña</label>  <br>
                <input type="password" id="pass" name="usuario_contra1" pattern="[a-zA-Z0-9$@.-]{7,100}"> 
            </div>
            <div class="contra">
                <label for="confirm">Confirmar contraseña</label> <br>
                <input type="password" id="confirm" name="usuario_contra2" pattern="[a-zA-Z0-9$@.-]{7,100}">
            </div>
        </div>
        <button class="btn" >Guardar</button>
        <div class="formu"></div>
    </form>
</div>