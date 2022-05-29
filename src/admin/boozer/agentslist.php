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

$stmt = $db->prepare('select * from agents where valid = 1');
$stmt->execute();
$agents = $stmt->fetchAll();
$page_flag = 0;

if (isset($_GET['agent_id'])) {
  $page_flag = 1;
  $id = $_GET['agent_id'];

  $stmt = $db->prepare('SELECT * FROM agents WHERE id = :agent_id where valid = 1');
  $stmt->bindValue(':agent_id', $id);
  $stmt->execute();
  $agency = $stmt->fetchAll();

  $stmt = $db->prepare('SELECT * FROM managers WHERE agent_id = :agent_id');
  $stmt->bindValue(':agent_id', $id);
  $stmt->execute();
  $managers = $stmt->fetchAll();
}
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
  <?php include(dirname(__FILE__) . "/boozer_header.php");
  if ($page_flag === 1) : ?>
    <div class="main">
      <h2 class="pagetitle">エージェンシー企業の詳細情報</h2>
      <form method="POST" action="edit.php" class="agencydetailbox">
        <h3><?= $agency[0]['agent_name'] ?></h3>
        <dl class="agentinfo">
        <img src="../../img/companylogo/<?php print_r($agents[0]['image']); ?>" alt="エージェンシー企業の写真">

          <div>
            <dt>企業サイトのURL：</dt>
            <dd><?= $agency[0]['url'] ?></dd>
          </div>
          <div>
            <dt>電話番号：</dt>
            <dd><?= $agency[0]['tel_number'] ?></dd>
          </div>
          <div>
            <dt>会社住所：</dt>
            <dd><?= $agency[0]['post_number'], $agency[0]['prefecture'], $agency[0]['municipalitie'], $agency[0]['adress_number'] ?></dd>
          </div>
          <div>
            <dt>得意な業界：</dt>
            <dd>
              <?php
              $stmt = $db->prepare('select * from characteristic left join agents on characteristic.agent_id = agents.id right join category on characteristic.category_id = category.id where agent_id = :agent_id where valid = 1');
              $stmt->bindValue(':agent_id', $id);
              $stmt->execute();
              $matched_category = $stmt->fetchAll();
              print_r($matched_category[0]['category_name']);
              ?></dd>
          </div>
          <div>
            <dt>対応エリア：</dt>
            <dd>
              <?php
              $stmt = $db->prepare('select * from characteristic left join agents on characteristic.agent_id = agents.id right join job_area on characteristic.job_area_id = job_area.id where agent_id = :agent_id where valid = 1');
              $stmt->bindValue(':agent_id', $id);
              $stmt->execute();
              $matched_job_area = $stmt->fetchAll();
              print_r($matched_job_area[0]['area']);
              ?></dd>
          </div>
          <div>
            <dt>対象学生：</dt>
            <dd>
              <?php
              $stmt = $db->prepare('select * from characteristic left join agents on characteristic.agent_id = agents.id right join target_student on characteristic.target_student_id = target_student.id where agent_id = :agent_id where valid = 1');
              $stmt->bindValue(':agent_id', $id);
              $stmt->execute();
              $matched_target_student = $stmt->fetchAll();
              print_r($matched_target_student[0]['graduation_year']);
              ?></dd>
          </div>
          <div>
            <dt>通知先メールアドレス：</dt>
            <dd><?= $agency[0]['notification_email'] ?></dd>
          </div>
          <div>
            <dt>登録エージェント：</dt>
            <?php foreach ($managers as $index => $manager) :
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
        <input type="hidden" name="agent_id" value="<?php echo $agency[0]['id']; ?>">
        <div class="pageendbuttons">
          <input class="submitbtn endbtn" type="submit" name="edit" value="編集">
          <input class="deletebtn endbtn" type="submit" name="delete" formaction="delete.php" value="削除">
        </div>
      </form>
      <a href='javascript:history.back()' class="returnbtn">戻る</a>
    </div>
  <?php else : ?>
    <div class="main">
      <h2 class="pagetitle">掲載企業一覧</h2>
      <?php foreach ($agents as $index => $agent) : ?>
        <div>
          <a href='./agentslist.php?agent_id=<?php echo $agent['id']; ?>'>
            <div class="agencybox">
              <form method="POST" action="edit.php">
                <div class="agencyboxinner">
                  <img src="" alt="">
                  <h3><?= $agent['agent_name'] ?></h3>
                  <input type="hidden" name="agent_id" value="<?php echo $agent['id']; ?>">
                </div>
                <div>
                  <input type="submit" name="edit" value="編集" class="editbtn">
                  <input type='submit' formaction='delete.php' name='delete' value='削除' class="deletebtn">
                </div>
              </form>
            </div>
          </a>
        </div>
      <?php endforeach; ?>
      <a href='javascript:history.back()' class="returnbtn">戻る</a>
    </div>
  <?php
  endif;
  include(dirname(__FILE__) . "/boozer_footer.php");
  ?>
</body>

</html>