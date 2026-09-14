<?php
require "config/BD.php";

session_set_cookie_params([
	'lifetime' => 0,
	'secure' => true,
]);
session_start();

$Errors = $_SESSION['errors'] ?? [];
$Modal = $_SESSION['Modal'] ?? false;
$Login = $_SESSION['Login'] ?? false;
$Admin = $_SESSION['Admin'] ?? "";

if (!$Login) {
	header("Location: indextemp.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin Blog</title>
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
			<a href="indextemp.php"
				class="hover:text-gray-600 hover:bg-white transition delay-50 duration-500 rounded-lg p-2 lg:visible  lg:inline-block hidden nav-link">Inicio</a>
			<div <?php if (!$Login)
				echo 'id="User"'; ?>
				class="flex flex-row items-center gap-2 px-2 hover:scale-110 transition delay-50 duration-250 cursor-pointer rounded-lg hover:bg-white hover:text-black">
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

	<!--Ingreso de entradas del blog-->
	<section class="flex flex-col h-screen justify-center items-center text-white">
		<form
			class="grid grid-cols-[auto_auto] gap-x-3 gap-y-3 p-6 bg-blue-700 w-[50%] mx-auto border-5 border-blue-400 rounded-lg justify-items-center justify-center items-center">
			<h1 class="text-xl font-bold col-span-2 text-center mb-2">Registrar entradas de blog</h1>

			<p class="text-lg font-bold text-right">Titulo de la entrada</p>
			<input class="text-lg font-bold p-1 border-2 bg-black/25 rounded-lg w-64" placeholder="Ingrese titulo">

			<p class="col-span-2 text-lg font-bold text-right">Entrada</p>
			<textarea class="col-span-2 text-lg font-bold p-1 border-2 bg-black/25 rounded-lg w-full h-60" placeholder="Ingrese Entrada"></textarea>

			<input class="col-span-2 p-1 border-2 bg-black/25 rounded-lg w-[25%] font-bold cursor-pointer hover:scale-105" type="button" value="Enviar">
		</form>
	</section>

</body>	

</html>