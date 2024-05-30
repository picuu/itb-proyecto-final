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
        $result = mysqli_query($conn, "SELECT b.id, b.advert_id, a.title, a.price, b.booking_date, a.isRequest FROM advert a, booking b WHERE a.id = b.advert_id AND b.user_id = '$owner_id' ORDER BY b.booking_date");
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
        $isRequest = $data['isRequest'];

        $result = mysqli_query($conn, "INSERT INTO booking VALUES (DEFAULT, '$advert_id', '$user_id', '$booking_date', NULL, NULL, NULL)");


        if ($result) {
            $booking_id = mysqli_insert_id($conn);

            if ($isRequest == 1) {
                mysqli_query($conn, "UPDATE user u SET balance = (balance + $advert_price) WHERE u.id = '$user_id'");
                mysqli_query($conn, "UPDATE user u SET balance = (balance - $advert_price) WHERE u.id = '$advert_owner_id'");
            } else {
                mysqli_query($conn, "UPDATE user u SET balance = (balance - $advert_price) WHERE u.id = '$user_id'");
                mysqli_query($conn, "UPDATE user u SET balance = (balance + $advert_price) WHERE u.id = '$advert_owner_id'");

            }
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

// get bookings that are made to any advert of an specific user
    function getUserPendingServices($conn, $user_id) {
        $q = "SELECT b.id, b.booking_date, b.advert_id, u.name AS user_name, a.title, a.price FROM user u JOIN booking b ON (u.id = b.user_id) JOIN advert a ON (b.advert_id = a.id) WHERE a.owner_id = '$user_id' order by b.id DESC";
        $result = mysqli_query($conn, $q);

        $services = array();
        while ($service = mysqli_fetch_assoc($result)) {
            $services[] = $service;
        }

        return json_encode($services);
    }
// delete a booking
    function deleteBooking($conn, $booking_id){
        $data = json_decode(file_get_contents('php://input'), true);
        $isRequest = $data['isRequest'];
        $user_id = $data['user_id'];
        $advert_id = $data['advert_id'];
        $price = $data['price'];
        $result_delete = "a";

        $result_delete = mysqli_query($conn, "DELETE FROM booking WHERE id='$booking_id'");

        $result_advert = mysqli_query($conn, "SELECT owner_id FROM advert WHERE id = '$advert_id'");
        $owner_id = mysqli_fetch_assoc($result_advert)['owner_id'];

        if ($isRequest == "1") {
            mysqli_query($conn, "UPDATE user u SET u.balance = (u.balance - $price) WHERE u.id = '$user_id'");
            mysqli_query($conn, "UPDATE user u SET u.balance = (u.balance + $price) WHERE u.id = '$owner_id'");
        } else {
            mysqli_query($conn, "UPDATE user u SET u.balance = (u.balance + $price) WHERE u.id = '$user_id'");
            mysqli_query($conn, "UPDATE user u SET u.balance = (u.balance - $price) WHERE u.id = '$owner_id'");
        }

        if ($result_delete) {
            $response = array('status' => 'success');
        } else {
            $response = array('status' => 'error');
        }
        return json_encode($response);
    }
?>