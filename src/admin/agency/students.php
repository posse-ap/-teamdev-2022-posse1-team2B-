<?php
require("../../dbconnect.php");

$stmt = $db->prepare('select * from intermediate left join students on intermediate.student_id = students.id right join agents on intermediate.agent_id = agents.id where agent_id = 1');
// $stmt->bindValue(':agent_id', $agent['id']);
  // bindevalueの１が？の１個めってこと。これがあれば何個でもはてなつけられる！1,2とかだとわかりにくいから、「:agent_id」を設定する
  $stmt->execute();
  $matched_students = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <section>
    <h2>学生一覧</h2>
    <?php
      foreach ($matched_students as $matched_student) : ?>
    <div>
      <span><?= $matched_student['student_name'] ?></span>
      <span><?= $matched_student['student_name'] ?></span>
      <span>お問い合わせ日時：<?= $matched_student['updated_at'] ?></span>
    </div>
  </section>

  <section>
    <button>☓</button>
    <dd>名前</dd><dt><?= $matched_student['student_name'] ?></dt>
    <dd>カナ</dd><dt><?= $matched_student['student_name'] ?></dt>
    <dd>電話番号</dd><dt><?= $matched_student['tel_number'] ?></dt>
    <dd>メールアドレス</dd><dt><?= $matched_student['email'] ?></dt>
    <dd>出身大学</dd><dt><?= $matched_student['college_name'] ?></dt>
    <dd>学部</dd><dt><?= $matched_student['undergraduate'] ?></dt>
    <dd>学科</dd><dt><?= $matched_student['college_department'] ?></dt>
    <dd>卒業年</dd><dt><?= $matched_student['graduation_year'] ?></dt>
    <dd>お問い合わせ内容</dd><dt></dt>
    <button>いたずらをboozerに報告</button>
  </section>

  <?php endforeach; ?>

  <a href="">戻る</a>
</body>
</html>