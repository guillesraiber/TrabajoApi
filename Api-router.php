<?php
require_once './libs/router.php';
require_once './app/controllers/api-libros-controller.php';
require_once './app/controllers/api-user-controller.php';
require_once './app/middlewares/JWT-middleware.php';

$router = new Router();

$router->addMiddleware(new AuthMiddleware());

//Define la tabla de ruteo
//Todos los libros
$router->addRoute('libros', 'GET', 'LibroController',   'mostarLibros');
//Libros por id
$router->addRoute('libros/:ID','GET','LibroController','getLibro');
//Eliminar Libro
$router->addRoute('libros/:ID','DELETE','LibroController','eliminarLibro');
//Agregar libro
$router->addRoute('libros','POST','LibroController','agregarLibro');
//Modifica un libro
$router->addRoute('libros/:ID','PUT','LibroController','actualizar');
//Obtener token
$router->addRoute('usuarios/token','GET','UserController','getToken');

//rutea
$router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);
