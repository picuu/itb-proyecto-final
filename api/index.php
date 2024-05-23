<?php
    require_once 'connection.php';
    include 'functions/advert/advert.php';
    include 'functions/advert_tags/advert_tags.php';
    include 'functions/booking/booking.php';
    include 'functions/category/category.php';
    include 'functions/tag/tag.php';
    include 'functions/user/user.php';
    include 'functions/offer/offer.php';

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

    header("Access-Control-Allow-Origin: *");
    
    switch($numElementsRuta) {
        case 1:
            paginaError();
            break;
        case 2:
            header("Content-Type: application/json");
            if($uri[0]=="user") {
                // mostrar todos los usuarios
                if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                    $getAllUsers = getUsers($conn);
                    echo $getAllUsers;
                }
                // crear nuevo usuario
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $data = json_decode(file_get_contents('php://input'), true);
                    $addANewUser = addUser($conn, $data);
                    echo $addANewUser;
                }
            } elseif($uri[0]=="advert") {
                // mostrar todos los anuncios
                if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                    $getAllAdverts = getAdverts($conn);
                    echo $getAllAdverts;
                }
                // crear nuevo anuncio
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $data = json_decode(file_get_contents('php://input'), true);
                    $addANewAdvert = addAdvert($conn, $data);
                    echo $addANewAdvert;
                }
            } elseif ($uri[0] == "offer") {
                // mostrar todas las ofertas
                if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                    echo getOffers($conn);
                }
            } elseif($uri[0]=="booking") {
                // mostrar todas las reservas

                // crear nueva reserva
                
            } elseif($uri[0]=="category") {
                // mostrar todas las categorías
                if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                    $getAllCategories = getCategories($conn);
                    echo $getAllCategories;
                }
                // crear nueva categoria
                
            } elseif($uri[0]=="tag") {
                // mostrar todos los tags
               
                // crear nuevo tag
                
            } elseif($uri[0]=="advert_tags"){
                // mostrar

                // crear

            } else {
                paginaError();
            }
        case 3:
            header("Content-Type: application/json");
            if($uri[0]=="user") {
                // mostrar un usario concreto
                if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                    $id = $uri[1];
                    $getASingleUser = getUserById($conn, $id);
                    echo $getASingleUser;
                }
                // actualizar un usuario
                if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
                    $id = $uri[1];
                    $data = json_decode(file_get_contents('php://input'), true);
                    $updateAUser = updateUser($conn, $id, $data);
                    echo $updateAUser;
                }
                // borrar un usuario
                if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
                    $id = $uri[1];
                    $deleteAUser = deleteUser($conn, $id);
                    echo $deleteAUser;
                }
            } elseif ($uri[0]=="advert") {
                // mostrar un anuncio concreto
                if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                    $id = $uri[1];
                    $getASingleAdvert = getAdvertById($conn, $id);
                    echo $getASingleAdvert;
                }
                // actualizar un anuncio
                if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
                    $id = $uri[1];
                    $data = json_decode(file_get_contents('php://input'), true);
                    $updateAnAdvert = updateAdvert($conn, $id, $data);
                    echo $updateAnAdvert;
                }
                // borrar un anuncio
                if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
                    $id = $uri[1];
                    $deleteAnAdvert = deleteAdvert($conn, $id);
                    echo $deleteAnAdvert;
                }
            } elseif ($uri[0]=="booking") {
                // mostrar una reserva concreta

                // crear
                
            } elseif ($uri[0]=="category") {
                // mostrar una categoría concreta
                if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                    $id = $uri[1];
                    $getASingleCategory = getCategoryById($conn, $id);
                    echo $getASingleCategory;
                }
                //crear
               
            } elseif ($uri[0]=="tag") {
                // mostrar un tag concreto

                // crear
                
            } elseif ($uri[0]=="advert_tags") {
                // mostrar

                //crear

            } else {
                paginaError();
            }
    }

function paginaError() {
    header("HTTP/1.1 404 Not Found");
    exit();
}

?>