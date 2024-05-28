<?php
  //get all offers with all the information (category and tags)
  function getOffers($conn){
    $result_offers = mysqli_query($conn, "SELECT * FROM advert WHERE isRequest = '0' ORDER BY id");
    
    $offers = array();
    while ($offer = mysqli_fetch_assoc($result_offers)) {
      $offer_id = $offer['id'];
      $result_category = mysqli_query($conn, "SELECT c.name, c.id FROM advert a JOIN category c ON (a.category_id = c.id) WHERE a.id = '$offer_id'");
      $result_tags = mysqli_query($conn, "SELECT t.* FROM advert_tags at JOIN tag t ON (at.tag_id = t.id) WHERE advert_id = '$offer_id'");

      $offer['category'] = mysqli_fetch_assoc($result_category);

      $tags = array();
      while ($tag = mysqli_fetch_assoc($result_tags)) {
        $tags[] = $tag;
      }
      $offer['tags'] = $tags;

      $offers[] = $offer;
    }

    return json_encode($offers);
  }

  function getOffersByCategory($conn, $cat_id) {
    $result_offers = mysqli_query($conn, "SELECT * FROM advert WHERE isRequest = '0' AND category_id = '$cat_id' ORDER BY id");
    
    $offers = array();
    while ($offer = mysqli_fetch_assoc($result_offers)) {
      $offer_id = $offer['id'];
      $result_category = mysqli_query($conn, "SELECT c.name, c.id FROM advert a JOIN category c ON (a.category_id = c.id) WHERE a.id = '$offer_id'");
      $result_tags = mysqli_query($conn, "SELECT t.* FROM advert_tags at JOIN tag t ON (at.tag_id = t.id) WHERE advert_id = '$offer_id'");

      $offer['category'] = mysqli_fetch_assoc($result_category);

      $tags = array();
      while ($tag = mysqli_fetch_assoc($result_tags)) {
        $tags[] = $tag;
      }
      $offer['tags'] = $tags;

      $offers[] = $offer;
    }

    return json_encode($offers);
  }

  function getOffersByTag($conn, $tag_id) {
    $result_offers = mysqli_query($conn, "SELECT a.* FROM advert a JOIN advert_tags at ON (a.id = at.advert_id) WHERE a.isRequest = '0' AND at.tag_id = '$tag_id' ORDER BY a.id");
    
    $offers = array();
    while ($offer = mysqli_fetch_assoc($result_offers)) {
      $offer_id = $offer['id'];
      $result_category = mysqli_query($conn, "SELECT c.name, c.id FROM advert a JOIN category c ON (a.category_id = c.id) WHERE a.id = '$offer_id'");
      $result_tags = mysqli_query($conn, "SELECT t.* FROM advert_tags at JOIN tag t ON (at.tag_id = t.id) WHERE advert_id = '$offer_id'");

      $offer['category'] = mysqli_fetch_assoc($result_category);

      $tags = array();
      while ($tag = mysqli_fetch_assoc($result_tags)) {
        $tags[] = $tag;
      }
      $offer['tags'] = $tags;

      $offers[] = $offer;
    }

    return json_encode($offers);
  }
?>