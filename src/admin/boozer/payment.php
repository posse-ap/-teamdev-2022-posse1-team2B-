<?php
require("../../dbconnect.php");
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
  <?php include (dirname(__FILE__) . "/boozer_header.php");?>
  <div class="main">
  <h2 class="pagetitle">契約企業明細一覧</h2>
    <?php foreach ($agents as $agent) : ?>
    <div class="agencybox">
      <div class="agencyboxinner">
        <h3><?php echo $agent['agent_name'];?></h3>
      </div>
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