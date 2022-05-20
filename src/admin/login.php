<!--
TODO
リーディング
複製
それぞれ対応させる 
-->


<?php
session_start();
require('../dbconnect.php');

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
?>




<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>管理者ログイン</title>
</head>

<body>
  <div>
    <h1>管理者ログイン</h1>
    <form action="/admin/login.php" method="POST">
      <input type="email" name="email" required>
      <input type="password" required name="password">
      <input type="submit" value="ログイン">
    </form>
  </div>
</body>

</html>