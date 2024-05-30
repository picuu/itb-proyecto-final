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

//get all bookings by user id
    function getBookingsByUserId($conn, $owner_id) {
        $result = mysqli_query($conn, "SELECT a.title, b.booking_date, b.valoration_score, b.valoration_comment, b.valoration_date FROM advert a, booking b WHERE a.id = b.advert_id AND b.user_id = '$owner_id' ORDER BY b.booking_date");
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

// get bookings by advert
    function getBookingsByAdvert($conn, $advert_id) {
        $result_bookings = mysqli_query($conn, "SELECT * FROM booking WHERE advert_id = '$advert_id' order by id");

        $bookings = array();
        while ($booking = mysqli_fetch_assoc($result_bookings)) {
            $result_owner = mysqli_query($conn, "SELECT u.* FROM user u JOIN advert a ON (a.owner_id = u.id) WHERE a.id = '$booking[advert_id]'");
            $owner = mysqli_fetch_assoc($result_owner);

            $booking["owner"] = $owner;
            $bookings[] = $booking;
        }

        return json_encode($bookings);
    }
?>