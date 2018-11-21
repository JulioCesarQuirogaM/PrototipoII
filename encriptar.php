<?php
/**
 * En este caso, queremos aumentar el coste predeterminado de BCRYPT a 12.
 * Observe que también cambiamos a BCRYPT, que tendrá siempre 60 caracteres.
 */
$pass = $_GET["pass"];
$opciones = [
    'cost' => 12,
];
echo password_hash($pass, PASSWORD_BCRYPT, $opciones);
?>