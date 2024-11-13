<?php

class ErrorController {
    public function notFound() {
        http_response_code(404);
        echo"Error 404: Pagina no encontrada";
    }
}