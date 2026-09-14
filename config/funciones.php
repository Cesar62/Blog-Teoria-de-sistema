<?php
function login($Nombre, $contraseña, $pdo): bool
{

    $login = $pdo->prepare("SELECT * FROM Admin WHERE Nombre = :nombre");
    $login->bindParam(":nombre", $Nombre, PDO::PARAM_STR);
    $login->execute();
    $datos = $login->fetch(PDO::FETCH_ASSOC);

    if ($datos) {
        if (password_verify($contraseña, $datos["Contraseña"])) {
            return true;
        } else {
            return false;
        }

    } else {
        return false;
    }

}

function Registro(array $datos, string $tablabd, array $campos, PDO $pdo): bool
{

    //implode añade un texto despues de cada valor del array
    $columnas = implode(', ', $campos); //Esto resulta en campo1, campo2, campo3, etc 

    $placeholders = implode(', ', array_fill(0, count($campos), '?')); // esto da ?,?,?,?

    $sql = "INSERT INTO $tablabd ($columnas) VALUES ($placeholders)";

    $stm = $pdo->prepare($sql);

    if ($stm->execute(array_values($datos))) { //le pasamos la informacion que vamos a ingresar en la base
        return true;
    } else {
        print_r($stm->errorInfo());
        return false;
    }
}

function VerificarVacio(array $datos): bool
{

    foreach ($datos as $dato) { //en php se pasa al reves priemro la lista o array y despues la variable de salida en c# seria string dato in datos
        if ($dato == null) {
            return false;
        } elseif (trim($dato) == "") {
            return false;
        }
    }
    return true;
}
?>