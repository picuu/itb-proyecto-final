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
        $advert_id = $data['advert_id'];
        $user_id = $data['user_id'];
        $booking_date = $data['booking_date'];
        $advert_owner_id = $data['advert_owner_id'];
        $advert_price = intval($data['advert_price']);

        $result = mysqli_query($conn, "INSERT INTO booking VALUES (DEFAULT, '$advert_id', '$user_id', '$booking_date', NULL, NULL, NULL)");


        if ($result) {
            $booking_id = mysqli_insert_id($conn);
            mysqli_query($conn, "UPDATE user u SET balance = (balance - $advert_price) WHERE u.id = '$user_id'");
            mysqli_query($conn, "UPDATE user u SET balance = (balance + $advert_price) WHERE u.id = '$advert_owner_id'");
            $response = array('status' => 'success', 'booking_id' => $booking_id);
        } else {
            $response = array('status' => 'error');
        }
        return json_encode($response);
    }
?>