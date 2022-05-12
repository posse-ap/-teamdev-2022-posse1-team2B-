<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>キープ中のエージェンシー企業</title>
</head>
<body>
  <?php include (dirname(__FILE__) . "/student_header.php");?>
  <h1>キープ中のエージェンシー企業</h1>
    <div>
      <div>
        <p><?php print_r($keep_agent["name"]);?></p>
        <dl>
          <dt>得意な業種</dt>
          <dd><?php print_r($keep_agent["industry"]);?></dd>
          <dt>対応エリア</dt>
          <dd><?php print_r($keep_agent["supported_area"]);?></dd>
          <dt>対象学生</dt>
          <dd><?php print_r($keep_agent["target_student"]);?></dd>
          <dt>対応企業の規模</dt>
          <dd><?php print_r($keep_agent["corporate_scale"]);?></dd>
          <dt>備考</dt>
          <dd><?php print_r($keep_agent["remarks"]);?></dd>
        </dl>
        
      </div>
      <form action="./contact.php" method="POST">
        <button type="button">戻る</button>
        <input type="hidden" name="agent_id" value="<?php print($agent['agent_id']);?>">
        <button type="submit">エージェンシー企業に問い合わせる</button>
      </form>
    </div>
  <?php include (dirname(__FILE__) . "/student_footer.php");?>
</body>
</html>