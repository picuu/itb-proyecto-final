<?php
//get all valorations
    function getValorations($conn,$id){
        $result = mysqli_query($conn, "SELECT * FROM valoration order by id");
        $advertisements = array();
        while($row = mysqli_fetch_assoc($result)){
            $advertisements[] = $row;
        }
        return json_encode($advertisements);
    }
//get valoration by id
    function getValorationById($conn,$id){
        $result = mysqli_query($conn, "SELECT * FROM valoration where id = $'id'");
        $advertisements = pg_fetch_assoc($result);
        return json_encode($advertisements);
    }
//add valoration
    function addValoration($conn,$data){
        $data = json_decode(file_get_contents('php://input'), true);
        $id= $data['id'];
        $owner_id = $data['owner_id'];
        $valorated_member_id = $data['valorated_member_id'];
        $punctuation = $data['punctuation'];
        $comment = $data['comment'];
        $publish_date = $data['publish_date'];

        $result = mysqli_query($conn, "INSERT INTO valoration (id_user, id_advertisement, valoration, comment) VALUES ('$id_user', '$id_advertisement', '$valoration', '$comment')");
        if ($result) {
            $response = array('status' => 'success');
        } else {
            $response = array('status' => 'error');
        }
        return json_encode($response);
    }
?>