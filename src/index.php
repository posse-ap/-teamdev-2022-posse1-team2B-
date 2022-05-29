<?php
session_start();
require(dirname(__FILE__) . "/dbconnect.php");

?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>サンプル</title>
</head>
<body>
  <a href="./admin/login.php">エージェント管理ページにログイン</a>
</body>

</html>