<?php
//get all categories
    function getCategories($conn){
        $result = mysqli_query($conn, "SELECT * FROM category ORDER BY id");
        $categories = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $categories[] = $row;
        }
        return json_encode($categories);
    }

//get category by id
    function getCategoryById($conn, $id){
        $result = mysqli_query($conn, "SELECT * FROM category where id = '$id'");
        $categories = mysqli_fetch_assoc($result);
        return json_encode($categories);
    }

//add category
    function addCategory($conn, $data){
        $data = json_decode(file_get_contents('php://input'), true);
        $id= $data['id'];
        $name = $data['name'];

        $result = mysqli_query($conn, "INSERT INTO category (id, name) VALUES ('$id', '$name')");
        if ($result) {
            $response = array('status' => 'success');
        } else {
            $response = array('status' => 'error');
        }
        return json_encode($response);
    }
?>