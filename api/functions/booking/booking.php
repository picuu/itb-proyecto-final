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
        $advert_id = $data['advert_id'];
        $user_id = $data['user_id'];
        $booking_date = $data['booking_date'];

        $result = mysqli_query($conn, "INSERT INTO booking VALUES (DEFAULT, '$advert_id', '$user_id', '$booking_date', NULL, NULL, NULL)");
        if ($result) {
            $booking_id = mysqli_insert_id($conn);
            $response = array('status' => 'success', 'booking_id' => $booking_id);
        } else {
            $response = array('status' => 'error');
        }
        return json_encode($response);
    }
?>