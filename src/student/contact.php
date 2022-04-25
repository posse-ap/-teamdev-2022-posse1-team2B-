<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>お問い合わせ入力</title>
</head>
<body>
  <?php include (dirname(__FILE__) . "/student_header.php");?>
  <h1>企業に問い合わせる</h1>
  <div>
    <div>申し込み先企業：<?php $agency?></div>
    <form>
      <div>
        <label for="familyName">氏</label>
        <input type="text" name="family_name" id="familyName" required>
      </div>
      <div>
        <label for="studentName">名</label>
        <input type="text" name="student_name" id="studentName" required>
      </div>
      <div>
        <button>戻る</button>
        <button>問い合わせる</button>
      </div>
    </form>
  </div>

  <?php include (dirname(__FILE__) . "/student_footer.php");?>
</body>
</html>