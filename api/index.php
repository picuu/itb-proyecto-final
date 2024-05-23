<?php
    require_once 'connection.php';
    include 'functions/advert/advert.php';
    include 'functions/advert_tags/advert_tags.php';
    include 'functions/booking/booking.php';
    include 'functions/category/category.php';
    include 'functions/tag/tag.php';
    include 'functions/user/user.php';

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
                // mostrar todos los usuarios
                if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                    getUsers($conn);
                }
                // crear nuevo usuario
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $data = json_decode(file_get_contents('php://input'), true);
                    $name = $data['name'];
                    $surname = $data['surname'];
                    $email = $data['email'];
                    $phone = $data['phone'];
                    $password = md5($data['password']);
                    $auth_level = $data['auth_level'];

                    $result = mysqli_query($conn, "INSERT INTO user (name, surname, email, phone, password, auth_level) VALUES ('$name', '$surname', '$email', '$phone', '$password', '$auth_level')");
                    if ($result) {
                        $response = array('status' => 'success');
                    } else {
                        $response = array('status' => 'error');
                    }
                    header('Content-Type: application/json');
                    echo json_encode($response);
                }
            } elseif($uri[0]=="valoration") {
                // mostrar todas las valoraciones
                if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                    $result = mysqli_query($conn, "SELECT * FROM valoration order by id");
                    $valorations = array();
                    while ($row = mysqli_fetch_assoc($result)) {
                        $valorations[] = $row;
                    }
                    header('Content-Type: application/json');
                    echo json_encode($valorations);
                }
            } elseif($uri[0]=="advert") {
                // mostrar todos los anuncios
                if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                    $result = mysqli_query($conn, "SELECT * FROM advert order by id");
                    $advertisements = array();
                    while ($row = mysqli_fetch_assoc($result)) {
                        $advertisements[] = $row;
                    }
                    header('Content-Type: application/json');
                    echo json_encode($advertisements);
                }
            } elseif($uri[0]=="offer") {
                // mostrar todas las ofertas
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
                // mostrar todas las peticiones
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
                // mostrar todos los talleres
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
                // mostrar todas las reservas
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
                // mostrar todos los historiales
                if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                    $result = mysqli_query($conn, "SELECT * FROM history order by id");
                    $history = array();
                    while ($row = mysqli_fetch_assoc($result)) {
                        $history[] = $row;
                    }
                    header('Content-Type: application/json');
                    echo json_encode($history);
                }
            } elseif($uri[0]=="category") {
                // mostrar todas las categorías
                if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                    $result = mysqli_query($conn, "SELECT * FROM category order by id");
                    $categories = array();
                    while ($row = mysqli_fetch_assoc($result)) {
                        $categories[] = $row;
                    }
                    header('Content-Type: application/json');
                    echo json_encode($categories);
                }
                // crear nueva categoria
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $data = json_decode(file_get_contents('php://input'), true);
                    $name = $data['name'];

                    $result = mysqli_query($conn, "INSERT INTO category (name) VALUES ('$name')");
                    if ($result) {
                        $response = array('status' => 'success');
                    } else {
                        $response = array('status' => 'error');
                    }
                    header('Content-Type: application/json');
                    echo json_encode($response);
                }
            } elseif($uri[0]=="tag") {
                // mostrar todos los tags
                if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                    $result = mysqli_query($conn, "SELECT * FROM tag order by id");
                    $tags = array();
                    while ($row = mysqli_fetch_assoc($result)) {
                        $tags[] = $row;
                    }
                    header('Content-Type: application/json');
                    echo json_encode($tags);
                }
                // crear nuevo tag
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $data = json_decode(file_get_contents('php://input'), true);
                    $name = $data['name'];

                    $result = mysqli_query($conn, "INSERT INTO tag (name) VALUES ('$name')");
                    if ($result) {
                        $response = array('status' => 'success');
                    } else {
                        $response = array('status' => 'error');
                    }
                    header('Content-Type: application/json');
                    echo json_encode($response);
                }
            } else {
                paginaError();
            }
        case 3:
            if($uri[0]=="user") {
                // mostrar un usario concreto
                if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                    $id = $uri[1];
                    $result = mysqli_query($conn, "SELECT * FROM user WHERE id=$id");
                    $users = array();
                    while ($row = mysqli_fetch_assoc($result)) {
                        $users[] = $row;
                    }
                    header('Content-Type: application/json');
                    echo json_encode($users);
                }
            } elseif ($uri[0]=="valoration") {
                // mostrar una valoración concreta
                if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                    $id = $uri[1];
                    $result = mysqli_query($conn, "SELECT * FROM valoration WHERE id=$id");
                    $users = array();
                    while ($row = mysqli_fetch_assoc($result)) {
                        $users[] = $row;
                    }
                    header('Content-Type: application/json');
                    echo json_encode($users);
                }
            } elseif ($uri[0]=="advert") {
                // mostrar un anuncio concreto
                if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                    $id = $uri[1];
                    $result = mysqli_query($conn, "SELECT * FROM advert WHERE id=$id");
                    $users = array();
                    while ($row = mysqli_fetch_assoc($result)) {
                        $users[] = $row;
                    }
                    header('Content-Type: application/json');
                    echo json_encode($users);
                }
            } elseif ($uri[0]=="offer") {
                // mostrar una oferta concreta
                if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                    $id = $uri[1];
                    $result = mysqli_query($conn, "SELECT * FROM offer o, advert a WHERE o.id = a.id AND o.id=$id");
                    $users = array();
                    while ($row = mysqli_fetch_assoc($result)) {
                        $users[] = $row;
                    }
                    header('Content-Type: application/json');
                    echo json_encode($users);
                }
            } elseif ($uri[0]=="request") {
                // mostrar una petición concreta
                if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                    $id = $uri[1];
                    $result = mysqli_query($conn, "SELECT * FROM request r, advert a WHERE r.id = a.id AND r.id=$id");
                    $users = array();
                    while ($row = mysqli_fetch_assoc($result)) {
                        $users[] = $row;
                    }
                    header('Content-Type: application/json');
                    echo json_encode($users);
                }
            } elseif ($uri[0]=="workshop") {
                // mostrar un taller concreto
                if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                    $id = $uri[1];
                    $result = mysqli_query($conn, "SELECT * FROM workshop w, advert a WHERE w.id = a.id AND w.id=$id");
                    $users = array();
                    while ($row = mysqli_fetch_assoc($result)) {
                        $users[] = $row;
                    }
                    header('Content-Type: application/json');
                    echo json_encode($users);
                }
            } elseif ($uri[0]=="booking") {
                // mostrar una reserva concreta
                if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                    $id = $uri[1];
                    $result = mysqli_query($conn, "SELECT * FROM booking WHERE id=$id");
                    $users = array();
                    while ($row = mysqli_fetch_assoc($result)) {
                        $users[] = $row;
                    }
                    header('Content-Type: application/json');
                    echo json_encode($users);
                }
            } elseif ($uri[0]=="history") {
                // mostrar un historial concreto
                if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                    $id = $uri[1];
                    $result = mysqli_query($conn, "SELECT * FROM history WHERE id=$id");
                    $users = array();
                    while ($row = mysqli_fetch_assoc($result)) {
                        $users[] = $row;
                    }
                    header('Content-Type: application/json');
                    echo json_encode($users);
                }
            } elseif ($uri[0]=="category") {
                // mostrar una categoría concreta
                if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                    $id = $uri[1];
                    $result = mysqli_query($conn, "SELECT * FROM category WHERE id=$id");
                    $users = array();
                    while ($row = mysqli_fetch_assoc($result)) {
                        $users[] = $row;
                    }
                    header('Content-Type: application/json');
                    echo json_encode($users);
                }
            } elseif ($uri[0]=="tag") {
                // mostrar un tag concreto
                if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                    $id = $uri[1];
                    $result = mysqli_query($conn, "SELECT * FROM tag WHERE id=$id");
                    $users = array();
                    while ($row = mysqli_fetch_assoc($result)) {
                        $users[] = $row;
                    }
                    header('Content-Type: application/json');
                    echo json_encode($users);
                }
            } else {
                paginaError();
            }
    }

function paginaError() {
    header("HTTP/1.1 404 Not Found");
    exit();
}

?>