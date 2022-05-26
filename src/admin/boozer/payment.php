<?php
session_start();
require('../../dbconnect.php');
if (isset($_SESSION['user_id']) && $_SESSION['time'] + 60 * 60 * 24 > time()) {
    // SESSIONにuser_idカラムが設定されていて、SESSIONに登録されている時間から1日以内なら
    $_SESSION['time'] = time();
    // SESSIONの時間を現在時刻に更新
} else {
    // そうじゃないならログイン画面に飛んでね
    header('Location: http://' . $_SERVER['HTTP_HOST'] . '../login.php');
    exit();
}
$stmt = $db->prepare('SELECT * FROM agents');
$stmt->execute();
$agents = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="../../css/reset.css">
  <link rel="stylesheet" href="../../css/index.css">
</head>
<body>
  <div class="mainpayment">
    <?php include (dirname(__FILE__) . "/boozer_header.php");
    foreach ($agents as $agent) : ?>
    <div class="agencybox">
      <h3><?php echo $agent['agent_name'];?></h3>
      <div>
        <a href="./payment_detail.php?agent_id=<?php echo $agent['id'];?>" class="submitbtn">明細情報の詳細</a>
        <span>未払い</span>
      </div>
    </div>
    <?php endforeach; ?>
    <a href='javascript:history.back()' class="returnbtn">戻る</a>
  </div>
  <?php include (dirname(__FILE__) . "/boozer_footer.php");?>
</body>
</html>