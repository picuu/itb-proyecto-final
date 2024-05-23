<?php
//get all bookings
    function getBookings($conn){
        $result = mysqli_query($conn, "SELECT * FROM booking order by id");
        $bookings = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $bookings[] = $row;
        }
        return json_encode($bookings);
    }
//get booking by id
    function getBookingById($conn, $id){
        $result = mysqli_query($conn, "SELECT * FROM booking where id = $id");
        $bookings = mysqli_fetch_assoc($result);
        return json_encode($bookings);
    }
//add booking
    function addBooking($conn, $data){
        $data = json_decode(file_get_contents('php://input'), true);
        $id = $data['id'];
        $publisher_id = $data['publisher_id'];
        $enrolled_id = $data['enrolled_id'];
        $advert_id = $data['advert_id'];
        $date = $data['date'];

        $result = mysqli_query($conn, "INSERT INTO booking (id, publisher_id, enrolled_id, advert_id, date) VALUES ('$id', '$publisher_id', '$enrolled_id', '$advert_id', '$date')");
        if ($result) {
            $response = array('status' => 'success');
        } else {
            $response = array('status' => 'error');
        }
        return json_encode($response);
    }
?>