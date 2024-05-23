<?php
  //get all offers
  function getOffers($conn){
    $result = mysqli_query($conn, "SELECT * FROM advert WHERE isRequest = '0' ORDER BY id");
    
    $offers = array();
    while ($row = mysqli_fetch_assoc($result)) {
      $offers[] = $row;
    }

    return json_encode($offers);
  }
?>