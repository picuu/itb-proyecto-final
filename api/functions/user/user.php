<?php
include '../../connection.php';
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
        $result = mysqli_query($conn, "SELECT * FROM user where id = $'id'");
        $advertisements = pg_fetch_assoc($result);
        return json_encode($advertisements);
    }
// add user
    function addUser($conn,$data){
        $data = json_decode(file_get_contents('php://input'), true);            $name = $data['name'];
        $id= $data['id'];
        $name = $data['name'];
        $surname = $data['surname'];
        $email = $data['email'];
        $phone = $data['phone'];
        $password = $data['password'];
        $balance = $data['balance'];
        $auth_level = $data['auth_level'];

        $result = mysqli_query($conn, "INSERT INTO user (id, name, surname, email, phone, password, balance, auth_level) VALUES ('$id', '$name', '$surname', '$email', '$phone', '$password', '$balance', '$auth_level')");
        if ($result) {
            $response = array('status' => 'success');
        } else {
            $response = array('status' => 'error');
        }
        return json_encode($response);
    }
?>