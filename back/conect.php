<?php

error_reporting(0);

header('Content-type: application/json; charset=utf-8');

$conexion = new mysqli('mdb-test.c6vunyturrl6.us-west-1.rds.amazonaws.com', 'bsale_test', 'bsale_test', 'bsale_test');

if ($conexion -> connect_errno) {
    $respuesta = [
        'error' => true
    ];
} else {
    $conexion -> set_charset("utf8");
    //AGREGAMOS EL UTF PARA PODER ADMITIR CUALQUIER TIPO DE DATOS
    $statement = $conexion -> prepare("SELECT * FROM product");
    $statement -> execute();
    $resultado = $statement -> get_result();

    $respuesta = [];

    while ($row = $resultado -> fetch_assoc()) {
        $producto = [
            'id' => $row['id'],
            'nombre' => $row['name'],
            'img' => $row['url_image'],
            'precio' => $row['price'],
            'descuento' => $row['discount'],
            'categoria' => $row['category']
        ];

        

        array_push($respuesta, $producto);
    }
    
}

echo json_encode($respuesta);



?>