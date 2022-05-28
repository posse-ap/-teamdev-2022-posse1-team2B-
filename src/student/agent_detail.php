<?php
require("../dbconnect.php");
session_start();
if (isset($_SESSION['keep'])) {
  $keeps = $_SESSION['keep'];
  $_SESSION['time'] = time();
}
$stmt = $db->prepare('SELECT * FROM agents');
$stmt->execute();
$agents = $stmt->fetchAll();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  if (isset($_POST['agent_id'])) {
    $agent_id = $_POST['agent_id'];
    $_SESSION['keep'][$agent_id] = $agent_id; //セッションにデータを格納
    if (isset($_POST['cancel'])) {
      unset($_SESSION['keep'][$agent_id]);
    }
  }
}
$keeps = array();
if (isset($_SESSION['keep'])) {
  $keeps = $_SESSION['keep'];
  $_SESSION['time'] = time();
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="../css/reset.css">
  <link rel="stylesheet" href="../css/index.css">
</head>

<body>
  <?php include(dirname(__FILE__) . "/student_header.php"); ?>
  <div class="main">
    <div>
      <a href="./keep.php" class="inquirybtn">キープ中の企業</a>
    </div>
    <!-- 閉じるボタン。前のページに戻る -->
    <?php
    echo ('<a href=' . '"javascript:history.back()"' . ' class="returnbtn">戻る</a>');

    $stmt = $db->prepare('SELECT * FROM agents WHERE id = :id');
    $id = $_GET["id"];
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    $agents = $stmt->fetchAll();
    ?>
    <div class="agentdetailinner">
      <div class="agentheader">
        <img src="../img/companylogo/<?php print_r($agents[0]['image']); ?>" alt="エージェンシー企業の写真">
        <p>
          <?php print_r($agents[0]["agent_name"]); ?>
        </p>
      </div>
      <div class="agentinfo">
        <div>
          <dt>会社HP：</dt>
          <dd><a href="<?php print_r($agents[0]["url"]); ?>" target="_blank">リンクはこちら</a></dd>
        </div>
        <div>
          <dt>問い合わせ電話番号：</dt>
          <dd><?php print_r($agents[0]["tel_number"]); ?></dd>
        </div>  
        <div>
          <dt>住所：</dt>
          <dd><?php print_r($agents[0]["post_number"]); ?></dd>
          <dd><?php print_r($agents[0]["prefecture"]);?></dd>
          <dd><?php print_r($agents[0]["municipalitie"]);?></dd>
          <dd><?php print_r($agents[0]["adress_number"]);?></dd>
        </div>

        <dl>
          <?php
          $stmt = $db->prepare('select * from characteristic left join agents on characteristic.agent_id = agents.id right join job_area on characteristic.job_area_id = job_area.id where agent_id = :agent_id');
          $stmt->bindValue(':agent_id', $id);
          $stmt->execute();
          $matched_job_area = $stmt->fetchAll();

          $stmt = $db->prepare('select * from characteristic left join agents on characteristic.agent_id = agents.id right join category on characteristic.category_id = category.id where agent_id = :agent_id');
          $stmt->bindValue(':agent_id', $id);
          $stmt->execute();
          $matched_category = $stmt->fetchAll();

          $stmt = $db->prepare('select * from characteristic left join agents on characteristic.agent_id = agents.id right join target_student on characteristic.target_student_id = target_student.id where agent_id = :agent_id');
          $stmt->bindValue(':agent_id', $id);
          $stmt->execute();
          $matched_target_student = $stmt->fetchAll();


          ?>
          <div>
            <dt>対応エリア：</dt>
            <dd><?php print_r($matched_job_area[0]['area']); ?></dd>
          </div>
          <div>
            <dt>得意な業種：</dt>
            <dd><?php print_r($matched_category[0]['category_name']); ?></dd>
          </div>
          <div>
            <dt>対象学生：</dt>
            <dd><?php print_r($matched_target_student[0]['graduation_year']); ?></dd>
            </dd>
          </div>
          <div>
            <dt>備考：</dt>
            <dd><?php print_r($agents[0]["detail"]); ?></dd>
          </div>
        </dl>
      </div>
      <form action="" method="POST">
        <?php
        if (isset($keeps[$agents[0]['id']]) === true) :
        ?>
          <p>キープ済み</p>
        <?php else : ?>
          <input type="hidden" name="category" value="<?php print_r($category); ?>">
          <input type="hidden" name="agent_id" value="<?php print_r($agents[0]["id"]); ?>">
          <button id="keep<?php echo $index; ?>" type="submit" name='keep' class="keepbtn">キープする</button>
        <?php endif; ?>
        <button type="submit" formaction="./contact.php" class="submitbtn">エージェンシーにお問い合わせ</button>
      </form>
    </div>
  </div>
  <?php include(dirname(__FILE__) . "/student_footer.php"); ?>
  <script src="./student.js"></script>
</body>

</html>