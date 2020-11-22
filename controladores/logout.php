<?php
session_start();
session_destroy();
header("Location: ../index.php"); // Redireccionando a la pagina index.php
?>