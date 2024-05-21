<?php
//get all offers
    function getOffers($conn,$id){
        $result = mysqli_query($conn, "SELECT * FROM offer order by id");
        $advertisements = array();
        while($row = mysqli_fetch_assoc($result)){
            $advertisements[] = $row;
        }
        return json_encode($advertisements);
    }
//get offer by id
    function getOfferById($conn,$id){
        $result = mysqli_query($conn, "SELECT * FROM offer where id = $'id'");
        $advertisements = pg_fetch_assoc($result);
        return json_encode($advertisements);
    }
//add offer
    function addOffer($conn,$data){
        $data = json_decode(file_get_contents('php://input'), true);
        $id= $data['id'];
        $volunteer_id = $data['volunteer_id'];
        $subscribed_users_id = $data['subscribed_users_id'];
        $max_subscribed= $data['max_subscribed'];

        $result = mysqli_query($conn, "INSERT INTO offer (id, volunteer_id, subscribed_users_id, max_subscribed) VALUES ('$id', '$volunteer_id', '$subscribed_users_id', '$max_subscribed')");
        if ($result) {
            $response = array('status' => 'success');
        } else {
            $response = array('status' => 'error');
        }
        return json_encode($response);
    }
?>