<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <?php include (dirname(__FILE__) . "/student_header.php");?>
  <div>
    <a href="./keep.php">キープ中の企業</a>
  </div>
  <div>
    <div>
      <img src="../img/<?php print_r($agent_id);?>.png" alt="エージェンシー企業の写真">
    </div>
    <div>
      <!-- 閉じるボタン。前のページに戻る -->
      <button>✕</button>
      <p><?php print_r($agent_name);?></p>
      <dl>
        <dt>得意な業種</dt>
        <dd><?php print_r($industry);?></dd>
        <dt>対応エリア</dt>
        <dd><?php print_r($supported_area);?></dd>
        <dt>対象学生</dt>
        <dd><?php print_r($target_student);?></dd>
        <dt>対応企業の規模</dt>
        <dd><?php print_r($corporate_scale);?></dd>
        <dt>備考</dt>
        <dd><?php print_r($remarks)?></dd>
      </dl>
      <form action="./keep.php" method="POST">
        <input type="hidden" name="agent_id" value="<?php print($item['agent_id']);?>">
        <button type="submit">キープする</button>
        <button type="submit" formaction="./contact.php">エージェンシー企業に問い合わせる</button>
      </form>
    </div>
  </div>


  <?php include (dirname(__FILE__) . "/student_footer.php");?>
</body>
</html>