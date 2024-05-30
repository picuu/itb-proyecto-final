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
  $balance = 360;
  $isAdmin = $data['isAdmin'] ?? 0;

  $result = mysqli_query($conn, "SELECT * FROM user WHERE email = '$email'");
  if (mysqli_num_rows($result) == 0) {
    $q = "INSERT INTO user VALUES (default, '$name', '$surname', '$image', '$email', '$phone', '$password', '$balance', '$isAdmin')";
    $result_register = mysqli_query($conn, $q);
    
    $res = array();
    if ($result_register) {
        $res['token'] = base64_encode(random_bytes(32));
        $res['isAdmin'] = $data['isAdmin'];
        $res['id'] = mysqli_insert_id($conn);
    } else {
      $res['status'] = 'error';
    }
  } else {
    $res = array('status' => 'error', 'code' => '409', 'message' => 'This email is already in use');
  }

  
  return json_encode($res);
}
?>