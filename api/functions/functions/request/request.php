<?php
//get all requests
    function getRequests($conn){
        $result = mysqli_query($conn, "SELECT * FROM request order by id");
        $requests = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $requests[] = $row;
        }
        return json_encode($requests);
    }
//get request by id
    function getRequestById($conn, $id){
        $result = mysqli_query($conn, "SELECT * FROM request where id = $id");
        $requests = mysqli_fetch_assoc($result);
        return json_encode($requests);
    }
//add request
    function addRequest($conn, $data){
        $data = json_decode(file_get_contents('php://input'), true);
        $id = $data['id'];
        $owner_id = $data['owner_id'];
        $title = $data['title'];
        $description = $data['description'];
        $category_id = $data['category_id'];
        $time = $data['time'];
        $ubication = $data['ubication'];
        $availability = $data['availability'];
        $publish_date = $data['publish_date'];

        $result = mysqli_query($conn, "INSERT INTO request (id, owner_id, title, description, category_id, time, ubication, availability, publish_date) VALUES ('$id', '$owner_id', '$title', '$description', '$category_id', '$time', '$ubication', '$availability', '$publish_date')");

        if ($result) {
            $response = array('status' => 'success');
        } else {
            $response = array('status' => 'error');
        }
        return json_encode($response);
    }
?>