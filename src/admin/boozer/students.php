<?php
session_start();
require('../../dbconnect.php');
if (isset($_SESSION['user_id']) && $_SESSION['time'] + 60 * 60 * 24 > time()) {
  $_SESSION['time'] = time();
} else {
  header('Location: http://' . $_SERVER['HTTP_HOST'] . '/admin/login.php');
  exit();
}

$stmt = $db->prepare('select * from intermediate left join students on intermediate.student_id = students.id right join agents on intermediate.agent_id = agents.id');
$stmt->execute();
$agents_students_match = $stmt->fetchAll();



$page_flag = 0;
if($_POST['report']) {
  $page_flag = 1;
} 
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
    <?php
    if($page_flag === 1) :
      $student_id = $_POST['student_id'];
      $stmt = $db->prepare('select * from students where id = :student_id');
      $stmt->bindValue(':student_id', $student_id);
      $stmt->execute();
      $student_information = $stmt->fetch();
      $stmt = $db->prepare('select * from intermediate left join students on intermediate.student_id = students.id right join agents on intermediate.agent_id = agents.id where student_id = :student_id');
      $stmt->bindValue(':student_id', $student_id);
      $stmt->execute();
      $agents_information = $stmt->fetchAll();
    ?>
    <div class="table" onclick="showModal();">
        <dd>名前</dd>
        <dt><?= $student_information['student_last_name'], $student_information['student_first_name']; ?></dt>
        <dd>カナ</dd>
        <dt><?= $student_information['student_last_name_kana'], $student_information['student_first_name_kana']; ?></dt>
        <dd>電話番号</dd>
        <dt><?= $student_information['tel_number'] ?></dt>
        <dd>メールアドレス</dd>
        <dt><?= $student_information['email'] ?></dt>
        <dd>出身大学</dd>
        <dt><?= $student_information['college_name'] ?></dt>
        <dd>学部</dd>
        <dt><?= $student_information['undergraduate'] ?></dt>
        <dd>学科</dd>
        <dt><?= $student_information['college_department'] ?></dt>
        <dd>卒業年</dd>
        <dt><?= $student_information['graduation_year'] ?></dt>
        <dd>申込みエージェント</dd>
        <?php foreach($agents_information as $agent_information) : ?>
        <dt><?= $agent_information['agent_name']; ?></dt>
        <?php endforeach; ?>
        <dd>申込みエージェント通知先</dd>
        <dt><?= $agent_information['notification_email']; ?></dt>
        <?php $agent_email = $agent_information['notification_email'] ?>
    </div>
    <a href="index.php" class="returnbtn">TOPに戻る</a>
    <?php
    else:
    ?>
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
        <div class="studentsbox">
            <span><?= $agent_student_match['student_last_name'], $agent_student_match['student_first_name']; ?></span>
            <span><?= $agent_student_match['student_last_name_kana'], $agent_student_match['student_first_name_kana']; ?></span>
            <dd>申込みエージェント：</dd>
            <dt><?= $agent_student_match['agent_name'] ?></dt>
            <form action="" method="POST">
              <input type="hidden" name="student_id" value="<?php echo $agent_student_match['student_id']; ?>">
              <input type='submit' name='report' value='詳細' class="width submitbtn" id="boozer_student_detailbtn">
            </form>
            <form action="students.php" method="post">
              <button type="submit" name="valid<?= $index+1 ?>" class="width deletebtn">いたずら認定</button>
                </form>
          <?php
            if (isset($_POST["valid" . $index+1])) {
              $stmt = $db->prepare('UPDATE students SET valid = 1 WHERE id = :id');

              $stmt->bindValue(':id', $agent_student_match['student_id']);

              $stmt->execute();

              $from = 'boozer@craft.com';
              $to   = $agent_student_match["notification_email"];
              $subject = 'Hi, from craft';
              $body = 'your error contact is admitted!';

              $ret = mb_send_mail($to, $subject, $body, "From: {$from} \r\n");
              var_dump($ret);
            }
          ?>
        </div>
    </section>
    <!-- <section class="tableouter" id="boozer_student_table">
 
    </section> -->
  <?php endforeach; ?>
  </div>
  <?php endif; ?>
  <?php include(dirname(__FILE__) . "/boozer_footer.php"); ?>
  <script src="./boozer.js"></script>
</body>

</html>