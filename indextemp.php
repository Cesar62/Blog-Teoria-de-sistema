<?php
require "config/BD.php";
require "config/funciones.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_set_cookie_params([
    'lifetime' => 0,
    'secure' => true,
]);
session_start();

$Errors = $_SESSION['errors'] ?? [];
$Modal = $_SESSION['Modal'] ?? false;
$Login = $_SESSION['Login'] ?? false;
$Admin = $_SESSION['Admin'] ?? "";

// Borramos los mensajes de la sesión porque ya los recuperamos
unset($_SESSION['errors']);
unset($_SESSION['Modal']);


if (!empty($_POST)) {

    $Boton = $_POST['btn'];
    $Nombre = $_POST['Nombre'];
    $Contraseña = $_POST['Contraseña'];

    switch ($Boton) {

        case 'Iniciar Sesion':

            if (!VerificarVacio([$Nombre, $Contraseña])) {

                $_SESSION['errors'] = [
                    'Ha ingresado Campos Vacios'
                ];

                $_SESSION['Modal'] = true;

                header("Location: indextemp.php");
                exit;
            }


            if (!login($Nombre, $Contraseña, $pdo)) {

                $_SESSION['errors'] = [
                    'No logueo'
                ];

                $_SESSION['Modal'] = true;

                header("Location: indextemp.php");
                exit;

            } else {

                $_SESSION['Admin'] = $Nombre;

                $_SESSION['errors'] = [
                    'Inicio de sesion correcto'
                ];
                $_SESSION['Login'] = true;

                $_SESSION['Modal'] = true;

                header("Location: indextemp.php");
                exit;
            }

            break;


        default:

            $_SESSION['errors'] = [
                'Algo ha fallado'
            ];

            $_SESSION['Modal'] = true;

            header("Location: indextemp.php");
            exit;
    }
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
            <div <?php if(!$Login)echo 'id="User"';?> class="flex flex-row items-center gap-2 px-2 hover:scale-110 transition delay-50 duration-250 cursor-pointer rounded-lg hover:bg-white hover:text-black">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-10 rounded-full">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                </svg>
                <?php if ($Login): ?>
                    <?php echo $Admin; ?>
                <?php endif; ?>
            </div>

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

    <form id="login" action="indextemp.php" method="post"
        class="fixed inset-0 z-10  flex items-center justify-center hidden bg-black/50 backdrop-blur-sm">
        <!--Clases para crear modales el backdrop pone blur en el fondo-->
        <div class="text-white flex flex-col gap-2 w-[25%] bg-black border-3 border-white rounded-lg p-2 ">
            <h1 class="text-lg font-bold text-center">Inicio de sesión</h1>
            <p class="text-md font-bold">Nombre</p>
            <input name="Nombre" class="border-2 p-2 border-white w-full rounded-lg bg-white/25 lgInput">
            <p class="text-md font-bold">Contraseña</p>
            <input name="Contraseña" class="border-2 p-2 border-white w-full rounded-lg bg-white/25 lgInput">
            <div class="flex flex-row w-full justify-center">
                <input type="button" name="btn" id="btnl"
                    class="p-2 bg-white border-2 border-gray-900 text-black font-bold rounded-lg cursor-pointer hover:scale-105 hover:bg-black hover:border-white hover:text-white"
                    value="Iniciar Sesion">
            </div>
        </div>
    </form>

    <div id="MError"
        class="fixed inset-x-0 top-20 z-20 flex items-center justify-center text-white invisible opacity-0 pointer-events-none transition-all duration-1000 ease-in-out">
        <div class="p-2 bg-red-500 flex flex-col items-center max-w-[25%] rounded-lg border-2 border-white">
            <H1 class="font-bold">Alerta</H1>
            <p id="Mtext"></p>
        </div>
    </div>

</body>

<script>
    const User = document.getElementById("User");
    const Login = document.getElementById("login");

    User.addEventListener("click", function () {
        Login.classList.toggle("hidden");
    });


    const Modal = document.getElementById("MError");
    const ModalText = document.getElementById("Mtext");

    <?php if ($Modal): ?>
        Modal.classList.replace("invisible", "visible");
        Modal.classList.replace("opacity-0", "opacity-100");
        <?php foreach ($Errors as $Error): ?>
            ModalText.innerHTML = "<?php echo implode("<br>", $Errors); ?>";
        <?php endforeach; ?>

        setTimeout(() => {
            Modal.classList.replace("opacity-100", "opacity-0");
            setTimeout(() => {
                Modal.classList.add("invisible");
            }, 500);
        }, 4000);
    <?php endif; ?>


    const btnl = document.getElementById("btnl");
    const linput = document.querySelectorAll(".lgInput");

    btnl.addEventListener("click", function () {
        const campoVacio = Array.from(linput).some(input => input.value === "");

        if (campoVacio) {

            Modal.classList.replace("invisible", "visible");
            Modal.classList.replace("opacity-0", "opacity-100");

            ModalText.innerHTML = "Ha ingresado Campos Vacios";

            setTimeout(() => {
                Modal.classList.replace("opacity-100", "opacity-0");
                setTimeout(() => {
                    Modal.classList.add("invisible");
                }, 500);
            }, 4000);

            return;
        }

        btnl.type = "submit";
        btnl.click();
    });
</script>

</html>