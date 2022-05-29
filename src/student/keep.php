<?php
require("../dbconnect.php");
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['agent_id'])) {
    $agent_id = $_POST['agent_id'];
    $_SESSION['time'] = time();
    $_SESSION['keep'][$agent_id] = $agent_id; //セッションにデータを格納
    if (isset($_POST['cancel_agency'])) {
      unset($_SESSION['keep'][$agent_id]);
      $_SESSION['time'] = time();
    }
  }
}
$keeps = array();
if (isset($_SESSION['keep']) && $_SESSION['time'] + 60 * 60 * 24  > time()) {
  $keeps = $_SESSION['keep'];
  $_SESSION['time'] = time();
} else {
  session_destroy();
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>キープ中のエージェンシー企業</title>
  <link rel="stylesheet" href="../css/reset.css">
  <link rel="stylesheet" href="../css/index.css">
</head>

<body>
  <?php include(dirname(__FILE__) . "/student_header.php");
  ?>
  <div class="main">
    <h1 class="pagetitle">キープ中のエージェンシー企業</h1>
    <?php if (count($keeps) > 0) : ?>
      <table>
        <a href="./agent_detail.php">
          <thead>
            <tr>
              <p class="announce">※URL、通知先メールアドレス、電話番号は学生画面には表示されません。</p>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($keeps as $keep) :
              $stmt = $db->prepare('SELECT * FROM agents WHERE id = :id where valid = 1');
              $stmt->bindValue(':id', $keep);
              $stmt->execute();
              $agent = $stmt->fetch();
            ?>
            <div class="KEEP">
              <table class="keptagencyouter">
                <tr class="keptagency">
                  <div class="keepcategorygroup">
                    <th>エージェンシー企業名：</th>
                    <td><?php print_r($agent['agent_name']); ?></td>
                    <?php
                    $stmt = $db->prepare('select * from characteristic left join agents on characteristic.agent_id = agents.id right join category on characteristic.category_id = category.id where agent_id = :agent_id where valid = 1');
                    $stmt->bindValue(':agent_id', $agent['id']);
                    $stmt->execute();
                    $matched_category = $stmt->fetchAll();

                    $stmt = $db->prepare('select * from characteristic left join agents on characteristic.agent_id = agents.id right join job_area on characteristic.job_area_id = job_area.id where agent_id = :agent_id where valid = 1');
                    $stmt->bindValue(':agent_id', $agent['id']);
                    $stmt->execute();
                    $matched_job_area = $stmt->fetchAll();

                    $stmt = $db->prepare('select * from characteristic left join agents on characteristic.agent_id = agents.id right join target_student on characteristic.target_student_id = target_student.id where agent_id = :agent_id where valid = 1');
                    $stmt->bindValue(':agent_id', $agent['id']);
                    $stmt->execute();
                    $matched_target_student = $stmt->fetchAll();
                    ?>
                  </div>
                  <div class="keepcategorygroup">
                    <th class="keepcategory">対応エリア：</th>
                    <td><?php print_r($matched_job_area[0]['area']); ?></td>
                  </div>
                  <div>
                    <th>得意な業種：</th>
                    <td><?php print_r($matched_category[0]['category_name']); ?></td>
                  </div>
                  <div>
                    <th>対象学生：</th>
                    <td><?php print_r($matched_target_student[0]['graduation_year']); ?></td>
                  </div>
                  <form action="" method="POST">
                    <input type="hidden" name="agent_id" value="<?php print_r($agent['id']); ?>">
                    <button type="submit" name="cancel_agency" class="inquirybtn">キープを取り消す</button>
                  </form>
                </tr>
              </table>
            </div>
            </tbody>
        </a>
      </table>
    <?php
            endforeach; ?>
    <form action="./contact.php" method="POST">
      <?php foreach ($keeps as $keep) : ?>
        <input type="hidden" value="<?php print_r($keep); ?>">
      <?php endforeach; ?>
      <button type="submit" name='keep_agency_contact' class="inquirybtn margintop">エージェンシーにお問い合わせ</button>
    </form>
  <?php else : ?>
    <p class="announce">キープしてるエージェンシーはありません。</p>
  <?php endif;
    echo ('<form action="index.php" GET="POST">
      <button type="submit" name="back" class="returnbtn marginbottom">TOPに戻る</button>
      </form>');
  ?>
  </div>
  <?php include(dirname(__FILE__) . "/student_footer.php"); ?>
  <script src="./student.js"></script>
</body>

</html>