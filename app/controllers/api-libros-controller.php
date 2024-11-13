<?php
require_once './app/models/api-libro-model.php';
require_once './app/views/api-view.php';
class LibroController {
    private $model;
    private $view;
    private $data;

    public function __construct() {
        $this->model = new LibroModel();
        $this->view = new JsonView();
        $this->data = file_get_contents("php://input");
    }

    private function getData() {
        return json_decode($this->data);
    }

    public function mostarLibros() {
        $libros = $this->model->getLista();
        if(isset($_GET['order']) && isset($_GET['sort'])) {
            if(($_GET['sort'] == "precio") || ($_GET["sort"] == "PRECIO")) {
                if($_GET['order'] == "ASC" || ($_GET['order'] == "asc")) {
                    $libros = $this->model->ascendente();
                } elseif($_GET['order'] == "DESC" || ($_GET['order'] == "desc")) {
                    $libros = $this->model->descendente();
                }
                else {
                    $libros = $this->model->getLista();
                }
            }
        }
        if(isset($_GET['filter'])) {
            if(($_GET['filter'] == "precio")) {
                $libros = $this->model->filtrado();
            } else {
                $libros = $this->model->getLista();
            }
        }
        $libros = $this->view->response($libros, 200);
    }
    
    public function getLibro($params = null) {
        $id = $params->params->{':ID'};
        $libro = $this->model->getLibro($id);
        if($libro) {
            $this->view->response($libro);
        } else{ 
            $this->view->response('El libro no esta disponible', 404);
        }
    }

    public function eliminarLibro($params = null) {
        $id = $params->params->{':ID'};
        $libro = $this->model->getLibro($id);
        if($libro) {
            $this->model->eliminar($id);
            $this->view->response($libro);
        } else {
            $this->view->response('El libro no existe', 404);
        }
    }

    public function agregarLibro($params = null) {
        $libros = $this->getData();
        if(empty($libros->ID_Libro) || empty($libros->Titulo) || empty($libros->Autor) || empty($libros->Genero) || empty($libros->Editorial)|| empty($libros->Precio)) {
            $this->view->response('Complete los datos',400);
        } else {
            $id = $this->model->insertarLibro($libros->ID_Libro,$libros->Titulo, $libros->Autor, $libros->Genero, $libros->Editorial, $libros->Precio);
            $libro = $this->model->getLibro($id);
            $this->view->response($libro, 201);
        }
    }

    public function actualizar($params = null) {
        $id = $params->params->{':ID'};
        $libro = $this->model->getLibro($id);
        $NewBook = $this->getData();
        if($libro) {
            $this->model->actualizar($NewBook->Titulo, $NewBook->Autor, $NewBook->Genero, $NewBook->Editorial, $NewBook->Precio, $id);
               $this->view->response("Modificado con exito", 200);
        } else {
            $this->view->response("El libro con id = $id no existe",404);
        }
    }
}
