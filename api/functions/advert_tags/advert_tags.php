<?php
//get all advert tags
    function getAdvertTags($conn){
        $result = mysqli_query($conn, "SELECT * FROM advert_tags order by advert_id");
        $tags = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $tags[] = $row;
        }
        return json_encode($tags);
    }

//get advert tags by id
    function getAdvertTagsById($conn, $id){
        $result = mysqli_query($conn, "SELECT * FROM advert_tags where advert_id = '$id'");

        $tags = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $tags[] = $row;
        }
        return json_encode($tags);
    }
?>