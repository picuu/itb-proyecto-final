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
                if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                    $result = mysqli_query($conn, "SELECT * FROM valoration order by id");
                    $valorations = array();
                    while ($row = mysqli_fetch_assoc($result)) {
                        $valorations[] = $row;
                    }
                    header('Content-Type: application/json');
                    echo json_encode($valorations);
                }
            } elseif($uri[0]=="offer") {
                if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                    $result = mysqli_query($conn, "SELECT * FROM offer o, advert a WHERE o.id = a.id order by o.id");
                    $offers = array();
                    while ($row = mysqli_fetch_assoc($result)) {
                        $offers[] = $row;
                    }
                    header('Content-Type: application/json');
                    echo json_encode($offers);
                }
            } elseif($uri[0]=="request") {
                if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                    $result = mysqli_query($conn, "SELECT * FROM request r, advert a WHERE r.id = a.id order by r.id");
                    $requests = array();
                    while ($row = mysqli_fetch_assoc($result)) {
                        $requests[] = $row;
                    }
                    header('Content-Type: application/json');
                    echo json_encode($requests);
                }
            } elseif($uri[0]=="workshop") {
                if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                    $result = mysqli_query($conn, "SELECT * FROM workshop w, advert a WHERE w.id = a.id order by w.id");
                    $workshops = array();
                    while ($row = mysqli_fetch_assoc($result)) {
                        $workshops[] = $row;
                    }
                    header('Content-Type: application/json');
                    echo json_encode($workshops);
                }
            } elseif($uri[0]=="booking") {
                if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                    $result = mysqli_query($conn, "SELECT * FROM booking order by id");
                    $bookings = array();
                    while ($row = mysqli_fetch_assoc($result)) {
                        $bookings[] = $row;
                    }
                    header('Content-Type: application/json');
                    echo json_encode($bookings);
                }
            } elseif($uri[0]=="history") {
                if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                    $result = mysqli_query($conn, "SELECT * FROM history order by id");
                    $history = array();
                    while ($row = mysqli_fetch_assoc($result)) {
                        $history[] = $row;
                    }
                    header('Content-Type: application/json');
                    echo json_encode($history);
                }
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