<?php
require('../dbconnect.php');
session_start();

if (!empty($_POST)) {
  // なにか入力されていたら
  $login = $db->prepare('SELECT * FROM users WHERE login_email = ? AND password = ?');
  // usersからデータを取ってくる
  $login->execute(array(
    $_POST['email'],
    sha1($_POST['password'])
  ));
  // ポストされたものと一致するデータがあれば取得を実行
  $user = $login->fetch();
  // userって名前をつける

  if ($user) {
    // もしIDとパスワードが一致していたら
    $_SESSION = array();
    // 空の配列をSESSIONに格納
    $_SESSION['user_id'] = $user['id'];
    // SESSIONの中のuser_idカラムに上で取ってきたデータのIDを与える
    $_SESSION['time'] = time();
    // SESSION中のtimeカラムに今の時間を入れる
    if($_POST['email'] =='test@posse-ap.com') {
      header('Location: http://' . $_SERVER['HTTP_HOST'] . '/admin/boozer/index.php');
      // アクセスした瞬間にadmin_index.phpに移動する
      exit();
      
    }else {
      $email = $_POST['email'];
      $_SESSION['login']['email'] = $email;
      $login=array();
      if(isset($_SESSION['login'])){
        $login = $_SESSION['login'];
      }
      header('Location: http://' . $_SERVER['HTTP_HOST'] . '/admin/agency/index.php');
      // アクセスした瞬間にadmin_index.phpに移動する
      exit();

    }
    // 終わる
  } else {
    // IDとパスワードが一致していなかったら
    $error = 'fail';
    // エラー文がでる
  }
}

$stmt = $db->query('SELECT id FROM students');
$students = $stmt->fetchAll();



// if($_SERVER['REQUEST_METHOD']==='POST'){

//   if(isset($_POST['email']) && isset($_POST['password'])) {
//     $email = $_POST['email'];
//     $password = $_POST['password'];
//     $password = $_POST['password'];
//     $_SESSION['login'][$email] = $email;
//     $_SESSION['login'][$password] = $password;
//   }
//   }
//   $login=array();
//   if(isset($_SESSION['login'])){
//     $login = $_SESSION['login'];
//   }
  



?>

<!--
TODO
リーディング
複製
それぞれ対応させる 
-->



<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ログイン</title>
  <link rel="stylesheet" href="../../css/reset.css">
  <link rel="stylesheet" href="../../css/index.css">
</head>

<body>
  <div class="main">
    <h1 class="pagetitle">ログイン</h1>
    <form action="/admin/login.php" method="POST" class="inputform">
      <div>
        <label>ログイン用メールアドレス</label><br>
        <input type="email" name="email" required>
      </div>
      <div>
        <label>パスワード</label><br>
        <input type="password" required name="password">
      </div>
      <input type="submit" name="login" value="ログイン" class="ignore firstloginbtn">
    </form>
    <div id="forget">ログイン用メールアドレス・パスワードをお忘れの方はこちら</div>
    <div id="loginEmailAddress" class="login_email_address">
      <button id="closeButton" class="exitbtn">✕</button>
      <p>xxxx@co.jp までご連絡ください。 </p>
    </div>
    <a href="../student/index.php">学生の方はこちら</a>
  <script src="index.js"></script>
</body>

</html>