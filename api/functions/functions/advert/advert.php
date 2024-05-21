<?php
//get all adverts
    function getAdverts($conn){
        $result = mysqli_query($conn, "SELECT * FROM advert order by id");
        $advertisements = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $advertisements[] = $row;
        }
        return json_encode($advertisements);
    }
//get advert by id
    function getAdvertById($conn, $id){
        $result = mysqli_query($conn, "SELECT * FROM advert where id = $id");
        $advertisements = mysqli_fetch_assoc($result);
        return json_encode($advertisements);
    }
//add advert
    function addAdvert($conn, $data){
        $data = json_decode(file_get_contents('php://input'), true);
        $id= $data['id'];
        $owner_id = $data['owner_id'];
        $title = $data['title'];
        $description = $data['description'];
        $category_id = $data['category_id'];
        $time = $data['time'];
        $ubicacion = $data['ubicacion'];
        $availability = $data['availability'];
        $publish_date = $data['publish_date'];

        $result = mysqli_query($conn, "INSERT INTO advert (id, owner_id, title, description, category_id, time, ubicacion, availability, publish_date) VALUES ('$id', '$owner_id', '$title', '$description', '$category_id', '$time', '$ubicacion', '$availability', '$publish_date')");

        if ($result) {
            $response = array('status' => 'success');
        } else {
            $response = array('status' => 'error');
        }
        return json_encode($response);
    }
?>