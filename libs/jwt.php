<?php

    function crearJWT($payload) {
        $header = json_encode(['typ' => 'JWT', 'alg' =>'HS256']);
        $payload = json_encode($payload);

        $header = base64_encode($header);
        $header = str_replace(['+','/','='], ['-', '_', ''], $header);
        $payload = base64_encode($payload);
        $payload = str_replace(['+','/','='], ['-', '_', ''],$payload);

        $signature = hash_hmac('sha256', $header."." . $payload, 'secreto18', true);
        $signature = base64_encode($signature);
        $signature = str_replace(['+','/','='], ['-', '_', ''], $signature);

        //JWT
        $jwt = $header .".". $payload ."-" . $signature;
        return $jwt;
    }

    function validarJWT($jwt) {
        $jwt = explode(".", $jwt);
        if(count($jwt) != 3) {
            return null;
        }
        $header = $jwt[0];
        $payload = $jwt[1];
        $signature = $jwt[2];

        $valid = hash_hmac('sha256', $header . '.' . $payload, 'secreto18', true);
        $valid = base64_encode($valid);
        $valid = str_replace(['+','/','='], ['-', '_', ''], $valid);

        if($signature != $valid) {
            return null;
        }

        $payload = base64_decode($payload);
        $payload = json_decode($payload);

        if($payload->exp <time()) {
            return null;
        }

        return $payload;
    }