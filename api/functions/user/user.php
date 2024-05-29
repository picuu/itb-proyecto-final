<?php
// get all users
    function getUsers($conn) {
        $result = mysqli_query($conn, "SELECT * FROM user ORDER BY id");
        $advertisements = array();
        while($row = mysqli_fetch_assoc($result)){
            $advertisements[] = $row;
        }
        return json_encode($advertisements);
    }
// get user by id
    function getUserById($conn, $id) {
        $result = mysqli_query($conn, "SELECT * FROM user WHERE id = '$id'");
        $advertisements = mysqli_fetch_assoc($result);
        return json_encode($advertisements);
    }
// add a new user
    function addUser($conn, $data) {
        $name = $data['name'];
        $surname = $data['surname'];
        $image = $data['image'];
        $email = $data['email'];
        $phone = $data['phone'];
        $password = md5($data['password']);
        $balance = $data['balance'] ?? 0;
        $isAdmin = $data['isAdmin'] ?? 0;

        $result = mysqli_query($conn, "INSERT INTO user (id, name, surname, image, email, phone, password, balance, isAdmin) VALUES (default, '$name', '$surname', '$image', '$email', '$phone', '$password', '$balance', '$isAdmin')");
        if ($result) {
            $response = array('status' => 'success');
        } else {
            $response = array('status' => 'error');
        }
        return json_encode($response);
    }
// update a user
    function updateUser($conn, $id, $data) {
        $name = $data['name'];
        $surname = $data['surname'];
        $image = $data['image'];
        $email = $data['email'];
        $phone = $data['phone'];
        $password = md5($data['password']);
        $balance = $data['balance'] ?? 0;
        $isAdmin = $data['isAdmin'] ?? 0;

        $result = mysqli_query($conn, "UPDATE user SET name='$name', surname='$surname', image='$image', email='$email', phone='$phone', password='$password', balance='$balance', isAdmin='$isAdmin' WHERE id='$id'");
        if ($result) {
            $response = array('status' => 'success');
        } else {
            $response = array('status' => 'error');
        }
        return json_encode($response);
    }
// delete a user
    function deleteUser($conn, $id){
        $result = mysqli_query($conn, "DELETE FROM user WHERE id='$id'");
        if ($result) {
            $response = array('status' => 'success');
        } else {
            $response = array('status' => 'error');
        }
        return json_encode($response);
    }
?>