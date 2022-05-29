<?php
require("../dbconnect.php");
session_start();
if (isset($_SESSION['keep'])) {
  $keeps = $_SESSION['keep'];
  $_SESSION['time'] = time();
}
$stmt = $db->prepare('SELECT * FROM agents where valid = 1');
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
    <?php
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
            $sql = 'select * from characteristic left join agents on characteristic.agent_id = agents.id left join category on characteristic.category_id = category.id left join job_area on characteristic.job_area_id = job_area.id  left join target_student on characteristic.target_student_id = target_student.id where agent_id = :agent_id';
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':agent_id', $id);
            $stmt->execute();
            $agent_information=$stmt->fetch();
          
          ?>
          <div>
            <dt>対応エリア：</dt>
            <dd><?php print_r($agent_information['area']); ?></dd>
          </div>
          <div>
            <dt>得意な業種：</dt>
            <dd><?php print_r($agent_information['category_name']); ?></dd>
          </div>
          <div>
            <dt>対象学生：</dt>
            <dd><?php print_r($agent_information['graduation_year']); ?></dd>
            </dd>
          </div>
          <div>
            <dt>備考：</dt>
            <dd><?php print_r($agent_information["detail"]); ?></dd>
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
        <a href='javascript:history.back()' class="returnbtn">戻る</a>
      </form>
    </div>

  </div>
  <?php include(dirname(__FILE__) . "/student_footer.php"); ?>
  <script src="./student.js"></script>
</body>

</html>