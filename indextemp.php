<?php
require "config/BD.php";
require "config/funciones.php";

session_set_cookie_params([
    'lifetime' => 0,
    'secure' => true,
]);
session_start();

$Login_Fallo = false;

$Boton = $_POST['btn'];

if(empty($_POST)){
    echo "Nada";
}else{
    echo"si hay post";
}

switch ($Boton) {
    case 'Iniciar Sesion':
        
        break;

        default:
        echo'Algo ha fallado';
        break;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Teoria de Sistemas</title>
    <link rel="stylesheet" href="src/output.css">
</head>

<body class="bg-slate-950">
    <!--Navbar -->
    <nav class="flex flex-row z-30 fixed bg-black p-2 w-full text-white font-bold lg:text-xl text-lg">
        <div class=" flex basis-full justify-start items-center">
            <h1>Blog Teoria Sistemas</h1>
        </div>
        <div class="flex basis-full justify-center hidden lg:visible">
        </div>
        <div class="flex flex-row basis-full items-center justify-end gap-4 tracking-widest lg:mr-10">
            <button class="lg:hidden cursor-pointer" onclick="toggleMenu()">
                <svg class="size-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                    </path>
                </svg>
            </button>
            <a href="#Inicio" data-target="Inicio"
                class="hover:text-gray-600 hover:bg-white transition delay-50 duration-500 rounded-lg p-2 lg:visible  lg:inline-block hidden nav-link">INICIO</a>
            <btn id="precio" onclick="togglePrecio()"
                class="cursor-pointer hover:text-gray-600 hover:bg-white transition delay-50 duration-500 rounded-lg p-2 lg:visible  lg:inline-block hidden nav-link">
                PRECIO</btn>
            <a href="#Contacto" data-target="Contacto"
                class="hover:text-gray-600 hover:bg-white transition delay-50 duration-500 rounded-lg p-2 lg:visible  lg:inline-block hidden nav-link">CONTACTO</a>
            <svg id="User" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor"
                class="size-10 bg-black rounded-full hover:scale-115 transition delay-50 duration-250 cursor-pointer">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
            </svg>
        </div>
    </nav>

    <!--relleno-->
    <section class="p-10"></section>


    <!--entradas del blog-->
    <section class="flex flex-row gap-4 justify-center text-white">
        <div class="shrink-0 flex flex-col items-center w-[25%] h-20 rounded-lg bg-white/15 overflow-y-auto">
            <h1 class="font-bold text-lg">Titulo</h1>
        </div>
        <div class="shrink-0 flex flex-col items-center w-[25%] h-20 rounded-lg bg-white/15 overflow-y-auto">
            <h1 class="font-bold text-lg">Titulo</h1>
        </div>
        <div class="shrink-0 flex flex-col items-center w-[25%] h-20 rounded-lg bg-white/15 overflow-y-auto">
            <h1 class="font-bold text-lg">Titulo</h1>
        </div>
    </section>

    <form id="login" action="indextemp.php" method="post" class="fixed inset-0 z-10  flex items-center justify-center hidden"> <!--Clases para crear modales-->
        <div class="text-white flex flex-col gap-2 w-[25%] bg-black border-3 border-white rounded-lg p-2 ">
            <h1 class="text-lg font-bold text-center">Inicio de sesión</h1>
            <p class="text-md">Nombre</p>
            <input name="Nombre" class="border-2 border-white w-full rounded-lg bg-white/25">
            <p  class="text-md">Contraseña</p>
            <input name="contraseña" class="border-2 border-white w-full rounded-lg bg-white/25">
            <div class="flex flex-row w-full justify-center">
                <input name="btn" type="submit" class="p-2 bg-white border-2 border-gray-900 text-black font-bold rounded-lg cursor-pointer hover:scale-105 hover:bg-black hover:border-white hover:text-white" value="Iniciar Sesion">
            </div>
        </div>
    </form>

</body>

<script>
    const User = document.getElementById("User");
    const Login =document.getElementById("login");

    User.addEventListener("click", function(){
        Login.classList.toggle("hidden");
    })
</script>

</html>