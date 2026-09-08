<?php
function login($Nombre, $contraseña, $pdo){
    
    $login = $pdo->prepare("SELECT * FROM Admin WHERE Nombre = :nombre");
    $login->bindParam(":nombre", $Nombre, PDO::PARAM_STR);
    $login->execute();
    $datos = $login->fetch(PDO::FETCH_ASSOC);

    if($datos){
        if(password_verify($contraseña, $datos["Contraseña"])){
            $_SESSION["SESION_A"] = [
                    "Sesion" => true,
                    "Sesion_Info" => $login
            ];
        }
    }
}

?>