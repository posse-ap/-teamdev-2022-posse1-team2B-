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

$stmt = $db->prepare('select * from intermediate left join students on intermediate.student_id = students.id right join agents on intermediate.agent_id = agents.id');
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
  <?php include(dirname(__FILE__) . "/boozer_header.php"); ?>
  <div class="main">
    <section>
      <h2 class="pagetitle">学生一覧</h2>
      <div class="months">
        <?php
        $months = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
        foreach ($months as $key => $month) : ?>
          <button class="monthcircle"><?= $month; ?> </button>
        <?php endforeach; ?>
      </div>
      <?php
      foreach ($agents_students_match as $index => $agent_student_match) : ?>
        <!-- 学生のデータを問い合わせぶん回す -->
        <div class="studentsbox">
          <span><?= $agent_student_match['student_last_name'], $agent_student_match['student_first_name']; ?></span>
          <span><?= $agent_student_match['student_last_name_kana'], $agent_student_match['student_first_name_kana']; ?></span>
          <dd>申込みエージェント：</dd>
          <dt><?= $agent_student_match['agent_name'] ?></dt>
          <form action="" method="POST">
            <input type='submit' name='report' value='詳細' class="submitbtn" id="boozer_student_detailbtn">
          </form>
        </div>
        
    </section>


    <section class="tableouter" id="boozer_student_table">
      <!-- <button>☓</button> -->
      <div class="table" onclick="showModal();">
        <dd>名前</dd>
        <dt><?= $agent_student_match['student_last_name'], $agent_student_match['student_first_name']; ?></dt>
        <dd>カナ</dd>
        <dt><?= $agent_student_match['student_last_name_kana'], $agent_student_match['student_first_name_kana']; ?></dt>
        <dd>電話番号</dd>
        <dt><?= $agent_student_match['tel_number'] ?></dt>
        <dd>メールアドレス</dd>
        <dt><?= $agent_student_match['email'] ?></dt>
        <dd>出身大学</dd>
        <dt><?= $agent_student_match['college_name'] ?></dt>
        <dd>学部</dd>
        <dt><?= $agent_student_match['undergraduate'] ?></dt>
        <dd>学科</dd>
        <dt><?= $agent_student_match['college_department'] ?></dt>
        <dd>卒業年</dd>
        <dt><?= $agent_student_match['graduation_year'] ?></dt>
        <dd>申込みエージェント</dd>
        <dt><?= $agent_student_match['agent_name'] ?></dt>
      </div>
      <form action="students.php" method="post">
        <button type="submit" name="valid<?= $index+1 ?>" class="deletebtn margintop">いたずら認定</button>
      </form>
      <?php
        if (isset($_POST["valid" . $index+1])) {
          // 特定のボタンがクリックされたら
          $stmt = $db->prepare('UPDATE students SET valid = 1 WHERE id = :id');
          // validを１にする

          // 値をセット
          $stmt->bindValue(':id', $agent_student_match['student_id']);

          // SQL実行
          $stmt->execute();
        }
      ?>
    </section>
  <?php endforeach; ?>
  <a href="index.php" class="returnbtn">戻る</a>
  </div>
  <?php include(dirname(__FILE__) . "/boozer_footer.php"); ?>
  <script src="./boozer.js"></script>
</body>

</html>