<?php
//get all tags
    function getTags($conn){
        $result = mysqli_query($conn, "SELECT * FROM tag order by id");
        $tags = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $tags[] = $row;
        }
        return json_encode($tags);
    }

//get tag by id
    function getTagById($conn, $id){
        $result = mysqli_query($conn, "SELECT * FROM tag where id = $id");
        $tags = mysqli_fetch_assoc($result);
        return json_encode($tags);
    }

//add tag
    function addTag($conn, $data){
        $data = json_decode(file_get_contents('php://input'), true);
        $id= $data['id'];
        $name = $data['name'];

        $result = mysqli_query($conn, "INSERT INTO tag (id, name) VALUES ('$id', '$name')");
        if ($result) {
            $response = array('status' => 'success');
        } else {
            $response = array('status' => 'error');
        }
        return json_encode($response);
?>
