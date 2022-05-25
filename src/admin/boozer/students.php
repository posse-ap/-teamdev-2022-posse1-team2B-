<?php
require("../../dbconnect.php");

$stmt = $db->prepare('select * from intermediate left join students on intermediate.student_id = students.id right join agents on intermediate.agent_id = agents.id');
  // $stmt->bindValue();
  // bindevalueの１が？の１個めってこと。これがあれば何個でもはてなつけられる！1,2とかだとわかりにくいから、「:agent_id」を設定する
  $stmt->execute();
  $agents_students_match = $stmt->fetchAll();
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
    <section>
      <h2 class="pagetitle">学生一覧</h2>
      <?php 
        $months = [1,2,3,4,5,6,7,8,9,10,11,12];
        foreach ($months as $key => $month) : ?>
        <div class="months">
          <button class="monthcircle"><?= $month;?> </button>
        </div>
      <?php endforeach;?> 
      <?php
        foreach ($agents_students_match as $index => $agent_student_match) : ?>
        <!-- 学生のデータを問い合わせぶん回す -->
      <div class="studentsbox">
        <span><?= $agent_student_match['student_name'] ?></span>
        <span><?= mb_convert_kana($agent_student_match['student_name'], "c", "utf-8"); ?></span>
        <dd>申込みエージェント</dd><dt><?= $agent_student_match['agent_name'] ?></dt>
      </div>
    </section>

    <section class="tableouter">
      <!-- <button>☓</button> -->
      <div class="table">
        <dd>名前</dd><dt><?= $agent_student_match['student_name'] ?></dt>
        <dd>カナ</dd><dt><?= mb_convert_kana($agent_student_match['student_name']); ?></dt>
        <dd>電話番号</dd><dt><?= $agent_student_match['tel_number'] ?></dt>
        <dd>メールアドレス</dd><dt><?= $agent_student_match['email'] ?></dt>
        <dd>出身大学</dd><dt><?= $agent_student_match['college_name'] ?></dt>
        <dd>学部</dd><dt><?= $agent_student_match['undergraduate'] ?></dt>
        <dd>学科</dd><dt><?= $agent_student_match['college_department'] ?></dt>
        <dd>卒業年</dd><dt><?= $agent_student_match['graduation_year']?></dt>
        <dd>申込みエージェント</dd><dt><?= $agent_student_match['agent_name'] ?></dt>
      </div>
    </section>
    <?php endforeach; ?>
    <a href="index.php" class="returnbtn">戻る</a>
  </div>
  <?php include (dirname(__FILE__) . "/boozer_footer.php");?>
  <script src="./boozer.js"></script>
</body>
</html>