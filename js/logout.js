const logout = document.querySelector(".logout");

console.log(logout)
function cerrarSesion(){
    let cerrar = confirm("¿seguro que quieres cerrar sesion?")

    if (cerrar == true){
        location.href="index.php?vista=log_out"
    }
}


logout.addEventListener("click",cerrarSesion)