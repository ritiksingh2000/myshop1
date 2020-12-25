<?php


if ($_SERVER['REQUEST_METHOD']=="POST"){
  $action = $_POST['act'];
  if ($action=="reg"){
    $f_name = $_POST['f_name'];
    $l_name = $_POST['l_name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $con_pass = $_POST['con_pass'];

    $dbcon = new PDO("mysql:host=localhost;dbname=ecom", 'root', '');
    $sql = $dbcon->prepare("SELECT * FROM users WHERE email='$email'");
    $sql->execute();
    $num = $sql->rowCount();

    if($num==0){
      $dbcon = new PDO("mysql:host=localhost;dbname=ecom", 'root', '');
      $sql = $dbcon->prepare("SELECT * FROM users WHERE username='$username'");
      $sql->execute();
      $num = $sql->rowCount();
      if($num==0){
        if ($password == $con_pass) {
          $pass_hash = password_hash($password, PASSWORD_DEFAULT);
          $dbcon = new PDO("mysql:host=localhost;dbname=ecom", 'root', '');
          $sql = $dbcon->prepare("INSERT INTO users (f_name, l_name, username, email, pasword) VALUES ('$f_name', '$l_name', '$username', '$email', '$pass_hash')");
          $sql->execute();
          session_start();
          $_SESSION['is_logged'] = true;
          $_SESSION['f_name'] = $f_name;
          $_SESSION['l_name'] = $l_name;
          $_SESSION['email'] = $email;
          $_SESSION['username'] = $username;
          $_SESSION['is_msg'] = true;
          $_SESSION['msg_bg'] = "success";
          $_SESSION['msg'] = "Account Created Successfully and Logged in.";
          header("location: account.php");
        }else{
          session_start();
          $_SESSION['is_msg'] = true;
          $_SESSION['msg_bg'] = "warning";
          $_SESSION['msg'] = "Passwords are not same. Try Again";
        }
      } else {
        session_start();
        $_SESSION['is_msg'] = true;
        $_SESSION['msg_bg'] = "warning";
        $_SESSION['msg'] = "Username Alredy Taken. Try Again";
      }
      
    } else {
      session_start();
      $_SESSION['is_msg'] = true;
      $_SESSION['msg_bg'] = "warning";
      $_SESSION['msg'] = "Account Alredy Exists.";
    }
    

  } elseif ($_POST['act'] == "login") {
    $dbcon = new PDO("mysql:host=localhost;dbname=ecom", 'root', '');
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = $dbcon->prepare("SELECT * From users WHERE email='$email'");
    $sql->execute();
    $data=$sql->fetch();
    $num = $sql->rowCount();
    if($num==1){
      echo var_dump(password_verify($password, $data['pasword']));
      if(password_verify($password , $data['pasword'] )){
        $dbcon = new PDO("mysql:host=localhost;dbname=ecom", 'root', '');
        $sql = $dbcon->prepare("SELECT * FROM users WHERE email='$email'");
        $sql->execute();
        $user_data=$sql->fetch();
        session_start();
        $_SESSION['is_logged'] = true;
        $_SESSION['f_name'] = $user_data['f_name'];
        $_SESSION['l_name'] = $user_data['l_name'];
        $_SESSION['email'] = $user_data['email'];
        $_SESSION['username'] = $user_data['username'];
        $_SESSION['is_msg'] = true;
        $_SESSION['msg_bg'] = "success";
        $_SESSION['msg'] = "Successfully Logged in.";
        header("location: account.php");
      } else {
        session_start();
        $_SESSION['is_msg'] = true;
        $_SESSION['msg_bg'] = "warning";
        $_SESSION['msg'] = "Wrong Password. Please Try again.";
        header("location: account.php");
      }
    }else{
      session_start();
      $_SESSION['is_msg'] = true;
      $_SESSION['msg_bg'] = "warning";
      $_SESSION['msg'] = "Email Does not Exists.";
      header("location: account.php");
    }
    
    
  }elseif($_POST['act'] == "logout"){
    session_start();
    session_destroy();
    session_start();
    $_SESSION['is_msg'] = true;
    $_SESSION['msg_bg'] = "warning";
    $_SESSION['msg'] = "User Logged Out.";
    header("location: account.php");
    

  } elseif ($_POST['act'] == "send_message") {
    $email = $_POST['email'];
    $phone_num = $_POST['Phone'];
    $subject = $_POST['Subject'];
    $message = $_POST['message'];

    $connection = new PDO("mysql:host=localhost;dbname=ecom", 'root', '');
    $sql = $connection->prepare("INSERT INTO user_messages (user_email, user_phone_number, user_message_subject, user_message) VALUES ('$email', '$phone_num', '$subject', '$message')");
    $result_sql = $sql->execute();
    if(isset($result_sql)){
      session_start();
      $_SESSION['is_msg'] = true;
      $_SESSION['msg_bg'] = "success";
      $_SESSION['msg'] = "Message Sent Successfully. We will reply as soon as possible";
      
      header("location: contact_us.php");
    }else{
      session_start();
      $_SESSION['is_msg'] = true;
      $_SESSION['msg_bg'] = "warning";
      $_SESSION['msg'] = "Unable To Send Message. Please Try Again.";
      header("location: contact_us.php");
    }
  }
}else{
  $action = $_GET['act'];
  $val = $_GET['val'];
  if ($action == "addtocart") {
    $ip = $_SERVER['REMOTE_ADDR'];
    $dbcon = new PDO("mysql:host=localhost;dbname=ecom", 'root', '');
    $sql = $dbcon->prepare("INSERT INTO cart_item (user_ip, product_id) VALUES ('$ip', '$val')");
    $sql->execute();
    header("location: index.php");
  } elseif ($action == "p_remove") {
    $dbcon = new PDO("mysql:host=localhost;dbname=ecom", 'root', '');
    $sql = $dbcon->prepare("DELETE FROM cart_item WHERE id=$val");
    $sql->execute();
    header("location: index.php");
  }
}

?>