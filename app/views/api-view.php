<?php

class JsonView {

    public function response($body, $status = 200) {
        header("Content-Type: application/json");
        header("HTTP/1.1." .$status. " " .$this->_requestStatus($status));
        echo json_encode($body);
    }

    private function _requestStatus($code) {
        $status = array(
            200 => "OK",
            201 =>"Created",
            400 =>"Bad request",
            401 => "Unauthorized",
            403 =>"Forbidden",
            404 =>"Not found",
            500 => "Internal Server Error"
        );
        if(!isset($status[$code])) {
            $code = 500;
        } 
        return $status[$code];
    }
}