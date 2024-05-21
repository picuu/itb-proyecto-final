<?php
//get all workshops
    function getWorkshops($conn){
        $result = mysqli_query($conn, "SELECT * FROM workshop order by id");
        $workshops = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $workshops[] = $row;
        }
        return json_encode($workshops);
    }
//get workshop by id
    function getWorkshopById($conn, $id){
        $result = mysqli_query($conn, "SELECT * FROM workshop where id = $id");
        $workshops = mysqli_fetch_assoc($result);
        return json_encode($workshops);
    }
//add workshop
    function addWorkshop($conn, $data){
        $data = json_decode(file_get_contents('php://input'), true);
        $id= $data['id'];
        $owner_id = $data['owner_id'];
        $title = $data['title'];
        $description = $data['description'];
        $category_id = $data['category_id'];
        $time = $data['time'];
        $ubication = $data['ubication'];
        $availability = $data['availability'];
        $publish_date = $data['publish_date'];
        $volunteer_id = $data['volunteer_id'];
        $subscribed_users_id = $data['subscribed_users_id'];
        $max_subscribed= $data['max_subscribed'];

        $result = mysqli_query($conn, "INSERT INTO workshop (id, owner_id, title, description, category_id, time, ubication, availability, publish_date, volunteer_id, subscribed_users_id, max_subscribed) VALUES ('$id', '$owner_id', '$title', '$description', '$category_id', '$time', '$ubication', '$availability', '$publish_date', '$volunteer_id', '$subscribed_users_id', '$max_subscribed')");
        if ($result) {
            $response = array('status' => 'success');
        } else {
            $response = array('status' => 'error');
        }
        return json_encode($response);
?>