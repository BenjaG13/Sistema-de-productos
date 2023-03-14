



<div class="buscador">
    <div class="regXpag">
        <h2 class="tittle">Usuarios</h2>
        <label for="num_registros" >Mostrar: </label>
        

            <select name="num_registros" id="num_registros" >
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>

            <label for="num_registros" >registros </label>
    </div>

    <form action="" method="POST" autocomplete="off">
            <label for="campo" >Buscar: </label>


            <input type="text" name="campo" id="campo" class="form-control">
    </form>
</div>

<div class="user_list">
    <h1 class="tittle">Lista de usuarios</h1>
        <table>
            <thead>
                <th class="sort asc">Num. empleado</th>
                <th class="sort asc">Nombre</th>
                <th class="sort asc">Apellido</th>
                <th class="sort asc">usuario</th>
                <th class="sort asc">Email</th>
                <th></th>
                <th></th>
            </thead>

            
            <tbody id="content">

            </tbody>
        </table>
        <label id="lbl-total"></label>
    </div>



        

    <div id="nav-paginacion"></div>

    <input type="hidden" id="pagina" value="1">
    <input type="hidden" id="orderCol" value="0">
    <input type="hidden" id="orderType" value="asc">
</div>

<script>
     function acpUserDel(){
        const urlParams = new URLSearchParams(window.location.search);
        const user_del = urlParams.get('user_del');
       

        console.log(user_del)
        if (confirm("seguro que deseas eliminar el usuario con id "+ user_del)){
                window.location.href="index.php?vista=lista_user&user_del="+ user_del;
        }else{
            window.location.href="index.php?vista=lista_user";
   }
     }   
   

     setTimeout(acpUserDel, 300)



</script>