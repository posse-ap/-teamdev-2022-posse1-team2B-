<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <?php include (dirname(__FILE__) . "/boozer_header.php");?>
  <?php 
    $months = [1,2,3,4,5,6,7,8,9,10,11,12];
    foreach ($months as $key => $month) : ?>
    <button><?= $month;?> </button>
  <?php endforeach;?>
  <div>
    <span>発行日 </span>
    <span>集計期間 </span>
    <div>
      <span></span>
      <span><?= $payment ?></span>
    </div>
    <div>
      <span><?=$agent_name?></span>
      <span><?=$agent_email ?></span>
      <span><?=$agent_name ?></span>
      <span><?=$agent_email ?></span>
      <span><?=$notification_email ?></span>
    </div>
    <div>
      <h4>請求詳細</h4>
      <span><?php echo"($action_number - $error_number) * 3000 = $payment 円"; ?></span>
    </div>
    <div>
      <h4>問い合わせ数</h4>
      <span>学生問い合わせ数 <?= $action_number ?></span>
      <span>いたずら数 <?= $error_number ?></span>
    </div>
    <div>
      <h4>振込先</h4>
      <p>〇〇銀行 〇〇支店<br>口座番号:普通 1234567<br>口座名:カブシキガイシャブーザー</p>
      <span>お支払い期日: </span>
    </div>
  </div>
  <?php include (dirname(__FILE__) . "/boozer_footer.php");?>
</body>
</html>