<?php
/*
	Se encarga de cerrar la sesión y redirigir al usuario a la página de inicio.
	Inicia la sesión para poder destruirla.
*/

session_start();
session_destroy();
header("Location: index.html");
