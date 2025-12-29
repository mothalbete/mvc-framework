<?php
//mostrar los usuarios en la vista
foreach ($usuarios as $usuario) {
    echo "<p>Usuario: " . htmlspecialchars($usuario->nombre) . " - Email: " . htmlspecialchars($usuario->email) . "</p>";
}   

?>