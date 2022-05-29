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

$stmt = $db->prepare('select * from agents where valid = 0');
$stmt->execute();
$agents = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>agentslist</title>
  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <link rel="stylesheet" href="../../css/reset.css">
  <link rel="stylesheet" href="../../css/index.css">
</head>

<body>
  <?php
  include(dirname(__FILE__) . "/boozer_header.php");
  foreach ($agents as $index => $agent) :
  ?>

    <div class="main">
      <h2 class="pagetitle">エージェンシー企業の詳細情報</h2>
      <div class="agentdetailinner">
        <div class="agentheader">
          <img src="../../img/companylogo/<?php print_r($agent['image']); ?>" alt="エージェンシー企業の写真">
          <h3><?= $agent['agent_name'] ?></h3>
        </div>
        <dl class="agentinfo">
          <div>
            <dt>企業サイトのURL：</dt>
            <dd><?= $agent['url'] ?></dd>
          </div>
          <div>
            <dt>電話番号：</dt>
            <dd><?= $agent['tel_number'] ?></dd>
          </div>
          <div>
            <dt>会社住所：</dt>
            <dd><?= $agent['post_number'], $agent['prefecture'], $agent['municipalitie'], $agent['adress_number'] ?></dd>
          </div>
          <div>
            <dt>得意な業界：</dt>
            <dd>
              <?php
              $stmt = $db->prepare('select * from characteristic left join agents on characteristic.agent_id = agents.id right join category on characteristic.category_id = category.id where agent_id = :agent_id');
              $stmt->bindValue(':agent_id', $agent['id']);
              $stmt->execute();
              $matched_category = $stmt->fetchAll();
              print_r($matched_category[0]['category_name']);
              ?></dd>
          </div>
          <div>
            <dt>対応エリア：</dt>
            <dd>
              <?php
              $stmt = $db->prepare('select * from characteristic left join agents on characteristic.agent_id = agents.id right join job_area on characteristic.job_area_id = job_area.id where agent_id = :agent_id');
              $stmt->bindValue(':agent_id', $agent['id']);
              $stmt->execute();
              $matched_job_area = $stmt->fetchAll();
              print_r($matched_job_area[0]['area']);
              ?></dd>
          </div>
          <div>
            <dt>対象学生：</dt>
            <dd>
              <?php
              $stmt = $db->prepare('select * from characteristic left join agents on characteristic.agent_id = agents.id right join target_student on characteristic.target_student_id = target_student.id where agent_id = :agent_id');
              $stmt->bindValue(':agent_id', $agent['id']);
              $stmt->execute();
              $matched_target_student = $stmt->fetchAll();
              print_r($matched_target_student[0]['graduation_year']);
              ?></dd>
          </div>
          <div>
            <dt>通知先メールアドレス：</dt>
            <dd><?= $agent['notification_email'] ?></dd>
          </div>
          <div>
            <dt>登録エージェント：</dt>
            <?php
            $stmt = $db->prepare('SELECT * FROM managers WHERE agent_id = :agent_id');
            $stmt->bindValue(':agent_id', $agent['id']);
            $stmt->execute();
            $managers = $stmt->fetchAll();
            foreach ($managers as $manager) :

              $stmt = $db->prepare('SELECT login_email FROM users WHERE id = :id');
              $stmt->bindValue(':id', $manager['user_id']);
              $stmt->execute();
              $agent_login_email = $stmt->fetch();
            ?>
              <dd><?= $manager['manager_last_name'], $manager['manager_first_name'] ?></dd>
              <p><?= $agent_login_email[0] ?></p>
            <?php endforeach; ?>
          </div>
        </dl>
        <div class="pageendbuttons flexdirectionreverse">
          <form method="POST" action="./contact_from_agency.php">
            <button type="submit" name="go<?= $index + 1 ?>" class="submitbtn endbtn">公開</button>
          </form>
          <?php
          if (isset($_POST["go" . $index + 1])) {
            $stmt = $db->prepare('UPDATE agents SET valid = 1 WHERE id = :id');
            $stmt->bindValue(':id', $agent['id']);
            $stmt->execute();
          }
          ?>
          <form method="POST" action="./contact_from_agency.php">
            <button type="submit" name="reject<?= $index + 1 ?>" class="deletebtn endbtn">拒否</button>
          </form>
          <?php
          if (isset($_POST["reject" . $index + 1])) {
            $stmt = $db->prepare('DELETE from agents WHERE id = :id');
            $stmt->bindValue(':id', $agent['id']);
            $stmt->execute();
          }
          ?>
        </div>
      </div>
      <a href='javascript:history.back()' class="returnbtn">戻る</a>
    </div>


  <?php
  endforeach;
  include(dirname(__FILE__) . "/boozer_footer.php"); ?>
</body>

</html>