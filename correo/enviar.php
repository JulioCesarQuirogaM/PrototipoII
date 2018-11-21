<?php  

// Llamando a los campos
$nombre = $_POST['nombre'];
$destinatario = $_POST['correo'];
$telefono = '+1(310) 567-5555';
$mensaje = $_POST['mensaje'];

// Datos para el correo
$correoSRG = 'osmanaleisis@gmail.com';

$asunto = "Admin SRG";

$carta = "Estaimado/a.: $nombre \n";
$carta .= "correoSRG \n";
$carta .= "$telefono \n";
$carta .= "Mensaje: $mensaje";

// Enviando Mensaje
mail($destinatario, $asunto, $carta);
header('Location:../adminper.php');

?>