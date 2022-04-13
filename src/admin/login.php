<?php
session_start();
require('../dbconnect.php');

if (!empty($_POST)) { //POST送信された場合
  $login = $db->prepare('SELECT * FROM users WHERE email=? AND password=?');
  $login->execute(array(
    $_POST['email'], //emailというname造成の付いたHTML POSTメソッドに入力された値を受け取る
    sha1($_POST['password']) //文字列のshaハッシュを計算する
    // shaハッシュ 任意の長さの原文を元に160ビットの値を生成する。生成された値はハッシュ値という
  ));
  $user = $login->fetch();
  
  if ($user) {
    $_SESSION = array();
    $_SESSION['user_id'] = $user['id']; //セッション変数に登録
    $_SESSION['time'] = time(); //time() 現在日時を取得
    header('Location: http://' . $_SERVER['HTTP_HOST'] . '/admin/index.php');
    exit();
  } else {
    $error = 'fail';
  }
}
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
    <a href="/index.php">イベント一覧</a>
  </div>
</body>

</html>