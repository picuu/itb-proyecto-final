<?php
//get all adverts
    function getAdverts($conn){
        $result = mysqli_query($conn, "SELECT * FROM advert ORDER BY id");
        $advertisements = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $advertisements[] = $row;
        }
        return json_encode($advertisements);
    }
    //get advert by id
    function getAdvertById($conn, $id) {
        $result_offer = mysqli_query($conn, "SELECT * FROM advert WHERE isRequest = '0' AND id = '$id'");
        
        $offer = mysqli_fetch_assoc($result_offer);
        $result_category = mysqli_query($conn, "SELECT c.name, c.id FROM advert a JOIN category c ON (a.category_id = c.id) WHERE a.id = '$id'");
        $result_tags = mysqli_query($conn, "SELECT t.* FROM advert_tags at JOIN tag t ON (at.tag_id = t.id) WHERE advert_id = '$id'");

        $offer['category'] = mysqli_fetch_assoc($result_category);

        $tags = array();
        while ($tag = mysqli_fetch_assoc($result_tags)) {
        $tags[] = $tag;
        }
        $offer['tags'] = $tags;

        return json_encode($offer);
    }
//add advert
    function addAdvert($conn, $data){
        $owner_id = $data['owner_id'];
        $category_id = $data['category_id'];
        $title = $data['title'];
        $image = $data['image'];
        $description = $data['description'];
        $isRequest = $data['isRequest'];
        $price = $data['price'];
        $availability = $data['availability'];
        $loc_name = $data['loc_name'];
        $loc_latitude = $data['loc_latitude'];
        $loc_longitude = $data['loc_longitude'];
        $max_subscribers = $data['max_subscribers'];
        $publish_date = $data['publish_date'];

        $result = mysqli_query($conn, "INSERT INTO advert (id, owner_id, category_id, title, image, description, isRequest, price, availability, loc_name, loc_latitude, loc_longitude, max_subscribers, publish_date) VALUES (default, '$owner_id', '$category_id', '$title', '$image', '$description', '$isRequest', '$price', '$availability', '$loc_name', '$loc_latitude', '$loc_longitude', '$max_subscribers', '$publish_date')");

        if ($result) {
            $response = array('status' => 'success');
        } else {
            $response = array('status' => 'error');
        }
        return json_encode($response);
    }
// update an advert
    function updateAdvert($conn, $id, $data){
        $owner_id = $data['owner_id'];
        $category_id = $data['category_id'];
        $title = $data['title'];
        $image = $data['image'];
        $description = $data['description'];
        $isRequest = $data['isRequest'];
        $price = $data['price'];
        $availability = $data['availability'];
        $loc_name = $data['loc_name'];
        $loc_latitude = $data['loc_latitude'];
        $loc_longitude = $data['loc_longitude'];
        $max_subscribers = $data['max_subscribers'];
        $publish_date = $data['publish_date'];

        $result = mysqli_query($conn, "UPDATE advert SET owner_id='$owner_id', category_id='$category_id', title='$title', image='$image', description='$description', isRequest='$isRequest', price='$price', availability='$availability', loc_name='$loc_name', loc_latitude='$loc_latitude', loc_longitude='$loc_longitude', max_subscribers='$max_subscribers', publish_date='$publish_date' WHERE id='$id'");
        if ($result) {
            $response = array('status' => 'success');
        } else {
            $response = array('status' => 'error');
        }
        return json_encode($response);
    }
// delete an advert
    function deleteAdvert($conn, $id){
        $result = mysqli_query($conn, "DELETE FROM advert WHERE id='$id'");
        if ($result) {
            $response = array('status' => 'success');
        } else {
            $response = array('status' => 'error');
        }
        return json_encode($response);
    }

    // get the category of an advert
    function getAdvertCategory($conn, $id) {
        $result = mysqli_query($conn, "SELECT c.name, c.id FROM advert a JOIN category c ON (a.category_id = c.id) WHERE a.id = '$id'");
        
        $category = mysqli_fetch_assoc($result);

        return json_encode($category);
    }
?>