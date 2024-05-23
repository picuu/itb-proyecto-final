<?php
//get all history
    function getHistory($conn){
        $result = mysqli_query($conn, "SELECT * FROM history order by id");
        $history = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $history[] = $row;
        }
        return json_encode($history);
    }

//get history by id
    function getHistoryById($conn, $id){
        $result = mysqli_query($conn, "SELECT * FROM history where id = $id");
        $history = mysqli_fetch_assoc($result);
        return json_encode($history);
    }

//add history
    function addHistory($conn, $data){
        $data = json_decode(file_get_contents('php://input'), true);
        $id = $data['id'];
        $publisher_id = $data['publisher_id'];
        $enrolled_id = $data['enrolled_id'];
        $advert= $data['advert'];
        $booking= $data['booking'];

        $result = mysqli_query($conn, "INSERT INTO history (id, publisher_id, enrolled_id, advert, booking) VALUES ('$id', '$publisher_id', '$enrolled_id', '$advert', '$booking')");

        if ($result) {
            $response = array('status' => 'success');
        } else {
            $response = array('status' => 'error');
        }
        return json_encode($response);
?>