<?php
session_start();
require('../../dbconnect.php');
if (isset($_SESSION['user_id']) && $_SESSION['time'] + 60 * 60 * 24 > time()) {
    // SESSIONにuser_idカラムが設定されていて、SESSIONに登録されている時間から1日以内なら
    $_SESSION['time'] = time();
    // SESSIONの時間を現在時刻に更新
} else {
    // そうじゃないならログイン画面に飛んでね
    header('Location: http://' . $_SERVER['HTTP_HOST'] . '/admin/login.php');
    exit();
}
$agent_id = $_GET['agent_id'];

$stmt = $db->prepare('SELECT * FROM agents WHERE id = :id');
$stmt->bindValue(':id', $agent_id);
$stmt->execute();
$agent = $stmt->fetch();

$stmt = $db->prepare('SELECT * FROM managers WHERE agent_id = :agent_id');
$stmt->bindValue(':agent_id', $agent_id);
$stmt->execute();
$managers = $stmt->fetch();

$stmt = $db->prepare('select * from intermediate left join students on intermediate.student_id = students.id right join agents on intermediate.agent_id = agents.id where agent_id = :agent_id');
$stmt->bindValue(':agent_id', $agent_id);
$stmt->execute();
$matched_students = $stmt->fetchAll();

// print_r($matched_students);

$month_total = 0;
foreach($matched_students as $matched_student) {
  if(strpos($matched_student['created_at'], date('Y-m')) !== false) {
    $month_total++;
  }else {
    $month_total += 0;
  }
}

$error_total = 0;
foreach($matched_students as $matched_student) {
  if($matched_student['valid'] !== 0) {
    $error_total++;
  }else {
    $error_total += 0;
  }
}

$payment = ($month_total - $error_total) * 3000;
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
    <div class="months">
      <?php 
        $months = [1,2,3,4,5,6,7,8,9,10,11,12];
        foreach ($months as $key => $month) : 
        ?>
        <button class="monthcircle"><?= $month;?></button>
      <?php endforeach;?>
    </div>

    <div class="paymentboxouter">
      <div class="agencyname">
        <span><?=$agent['agent_name']?></span>
        <span>¥<?= $payment ?></span>
      </div>
      <div class="paymentmanager">
        <span><?php print_r($managers['manager_last_name']);?></span>
        <span><?php print_r($managers['manager_first_name']);?></span><br>
        <span><?php print_r($managers['agent_department']);?></span><br>
        <span><?=$agent['notification_email'] ?></span>
      </div>
      <div class="paymentdetailbox">
        <div class="paymentbox">
          <h4>請求詳細</h4>
          <span><?php      
          echo"($month_total - $error_total) * 3000 = $payment 円"; ?></span>
        </div>
        <div class="paymentbox">
          <h4>問い合わせ数</h4>
          <span>学生問い合わせ数 <?= $month_total ?></span><br>
          <span>いたずら数 <?= $error_total ?></span>
        </div>
        <div class="paymentbox">
          <h4>振込先</h4>
          <p>〇〇銀行 〇〇支店<br>口座番号:普通 1234567<br>口座名:カブシキガイシャブーザー</p>
          <span>お支払い期日: </span>
        </div>
      </div>
    </div>
    <a href="payment.php" onclick="
    <?php
      $notification_email = $agent['notification_email'];
      $addresses = ['test@posse-ap.com', $notification_email];

      foreach ($addresses as $address) {
        $from = 'boozer@craft.com';
        $to   = $address;
        $subject = 'payment from boozer';
        $body = 'please check information from here';

        $ret = mb_send_mail($to, $subject, $body, "From: {$from} \r\n");
        var_dump($ret);
      }
      ?>
    ">発行する</a>
    <a href='javascript:history.back()'>戻る</a>
  </div>
  <?php include (dirname(__FILE__) . "/boozer_footer.php");?>
  <script src="./boozer.js"></script>
</body>
</html>