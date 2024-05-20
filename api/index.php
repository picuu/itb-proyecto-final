<?php
    require_once 'connection.php';

    // Guardamos la URL
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    
    // Establecemos que el último caracter de la URL siempre sea un slash ("/")
    $darrerCaracter = substr($uri, strlen($uri)-1);
    if($darrerCaracter!="/") {
        $uri.="/";
    }

    // Cortamos la URL para que se dirija al nuevo enrutador "index.php" que estamos creando
    $uri = substr($uri, strpos($uri, "index.php/")+10); // echo "URL tallada: $uri<br>";
    
    // Hacemos un split estableciendo el slash ("/") como separador del array
    $uri = explode('/', $uri);
    $numElementsRuta = count($uri); // echo $numElementsRuta."<br>";
    
    switch($numElementsRuta) {
        case 1:
            paginaError();
            break;
        case 2:
            if($uri[0]=="user") {
                if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                    $result = mysqli_query($conn, "SELECT * FROM user order by id");
                    $users = array();
                    while ($row = mysqli_fetch_assoc($result)) {
                        $users[] = $row;
                    }
                    header('Content-Type: application/json');
                    echo json_encode($users);
                }
            } elseif($uri[0]=="valoration") {

            } elseif($uri[0]=="") {
                
            } else {
                paginaError();
            }
        case 3:
            if($uri[0]=="user") {

            } elseif ($uri[0]=="valoration") {
                
            } else {
                paginaError();
            }
    }

function paginaError() {
    header("HTTP/1.1 404 Not Found");
    exit();
}

?>