

<div class="user_list">
    <h1 class="tittle">Lista de usuarios</h1>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Usuario</th>
                <th>Email</th>  
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                
                <td> <?php echo $reg['usuario_id'] ?> </td>
                <td> <?php echo $reg['usuario_nombre'] ?> </td>
                <td> <?php echo $reg['usuario_apellido'] ?> </td>
                <td> <?php echo $reg['usuario_usuario'] ?> </td>
                <td> <?php echo $reg['usuario_email'] ?> </td>
                <td>
                    <a href="#" class="user_edit">Editar</a>
                    <a href="#" class="user_delete">Eliminar</a>
                </td>
                
            </tr>
        </tbody>
        
             
    </table>
    
</div>
