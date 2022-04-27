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
    <p>○○企業</p>
    <dl>
      <dt>得意な業種</dt>
      <dd>IT</dd>
      <dt>対応エリア</dt>
      <dd>関東、関西</dd>
      <dt>対象学生</dt>
      <dd>24卒</dd>
      <dt>対応企業の規模</dt>
      <dd>中小企業</dd>
      <dt>備考</dt>
      <dd>LINEを用いて親身にサポートします。</dd>
    </dl>
    <form action="" method="">
      <input type="hidden" name="agent_id" value="<?php print($item['agent_id']);?>">
      <input type="submit" value="キープする">
    </form>
  </div>

  <?php include (dirname(__FILE__) . "/student_footer.php");?>
</body>
</html>