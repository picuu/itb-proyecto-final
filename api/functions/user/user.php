<?php
// get all users
    function getUsers($conn){
        $result = mysqli_query($conn, "SELECT * FROM user order by id");
        $advertisements = array();
        while($row = mysqli_fetch_assoc($result)){
            $advertisements[] = $row;
        }
        return json_encode($advertisements);
    }
// get user by id
    function getUserById($conn,$id){
        $result = mysqli_query($conn, "SELECT * FROM user WHERE id = '$id'");
        $advertisements = mysqli_fetch_assoc($result);
        return json_encode($advertisements);
    }
// add user
    function addUser($conn,$data){
        $name = $data['name'];
        $surname = $data['surname'];
        $email = $data['email'];
        $phone = $data['phone'];
        $password = md5($data['password']);
        $balance = $data['balance'];
        $isAdmin = $data['isAdmin'];

        $result = mysqli_query($conn, "INSERT INTO user (id, name, surname, email, phone, password, balance, isAdmin) VALUES (default, '$name', '$surname', '$email', '$phone', '$password', '$balance', '$isAdmin')");
        if ($result) {
            $response = array('status' => 'success');
        } else {
            $response = array('status' => 'error');
        }
        return json_encode($response);
    }
?>