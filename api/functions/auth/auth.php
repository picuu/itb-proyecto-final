<?php
// Login authentication
function login($conn) {
  $data = json_decode(file_get_contents('php://input'), true);

  $user_email = $data['user_email'] ?? '';
  $user_password = md5($data['user_password'] ?? '');

  $q = "SELECT * FROM user WHERE email = '$user_email' AND password = '$user_password'";
  $result = mysqli_query($conn, $q);

  $user = array();
  if (mysqli_num_rows($result) > 0) {
      $user['token'] = base64_encode(random_bytes(32));

      $data = mysqli_fetch_assoc($result);
      $user['isAdmin'] = $data['isAdmin'];
      $user['id'] = $data['id'];
  }

  return json_encode($user);
}

// Registered
function register($conn, $data) {
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
    $response = array();
    $response['token'] = base64_encode(random_bytes(32));
    $data = mysqli_fetch_assoc($result);
    $response['isAdmin'] = $data['isAdmin'];
    $response['id'] = $data['id'];
  } else {
      $response = array('status' => 'error');
  }
  return json_encode($response);
}
?>