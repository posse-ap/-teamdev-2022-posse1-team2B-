<?php 
require("../dbconnect.php");
session_start();
if($_SERVER['REQUEST_METHOD']==='POST'){
  if(isset($_POST['agent_id'])){
      $agent_id = $_POST['agent_id'];
      $_SESSION['time'] = time();
      $_SESSION['keep'][$agent_id]=$agent_id; //セッションにデータを格納
    if(isset($_POST['cancel_agency'])) {
      unset($_SESSION['keep'][$agent_id]);
      $_SESSION['time'] = time();
    }
  }
}
$keeps=array();
if(isset($_SESSION['keep']) && $_SESSION['time'] + 30 > time()){
  $keeps=$_SESSION['keep'];
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
  <?php include (dirname(__FILE__) . "/student_header.php");
  ?>
  <div class="main">
    <h1>キープ中のエージェンシー企業</h1>
    <?php if(count($keeps) > 0): ?>
      <table>
        <a href="./agent_detail.php">
          <thead>
            <tr>
            <p>※URL、通知先メールアドレス、電話番号は学生画面には表示されません。</p>
              <th>エージェンシー企業名</th>
              <th>得意な業種</th>
              <!-- <th>対応エリア</th>
              <th>対象学生</th>
              <th>対応企業の規模</th> -->
              <!-- <th>備考</th> -->
            </tr>
          </thead>  
          <tbody>
            <?php 
            // var_dump($keeps);
            // print_r($keeps);
            foreach($keeps as $keep):
              $stmt = $db->prepare('SELECT * FROM agents WHERE id = :id');
              $stmt->bindValue(':id', $keep);
              $stmt->execute();
              $agent = $stmt->fetch();
            ?>
            <tr>
              <td><?php print_r($agent['agent_name']); ?></td>
              <td><?php print_r($agent['category']); ?></td>
              <!-- <td><?php //print($agent['supported_area']); ?></td>
              <td><?php //print($agent['target_student']); ?></td>
              <td><?php //print($agent['corporate_scale']); ?></td>
              <td><?php //print($agent['remarks']); ?></td> -->
              <td>
                <form action="" method="POST">
                  <input type="hidden" name="agent_id" value="<?php print_r($agent['id']);?>">
                  <button type="submit" name="cancel_agency">キープを取り消す</button>
                </form>
              </td>
            </tr>
          </tbody>
        </a>
    </table>
    <?php 
    endforeach; ?>
    <form action="./contact.php" method="POST">
      <?php foreach($keeps as $keep): ?>
      <input type="hidden" value="<?php print_r($keep);?>">
      <?php endforeach; ?>
      <button type="submit" name='keep_agency_contact' class="inquirybtn">エージェンシー企業に問い合わせる</button>
    </form>
    <?php else: ?>
      <p>キープしてるエージェンシー企業はありません。</p>
    <?php endif;
      if (isset($_POST["contact_agency"])) {
        // 戻るが押されたとき
        echo ('<form action="condition_selection.php" GET="POST">
      <button type="submit" name="back" class="returnbtn">戻る</button>
      </form>');      
    } elseif (isset($_POST["cancel_agency"])){
      echo ('<form action="index.php" GET="POST">
      <button type="submit" name="back" class="returnbtn">戻る</button>
      </form>');    
    } else{
      echo ('<a href=' . '"javascript:history.back()"' . ' class="returnbtn">戻る</a>');
    }
    ?>

    <!-- <a href='javascript:history.back()' class="returnbtn">戻る</a> -->
  </div>
  <?php include (dirname(__FILE__) . "/student_footer.php");?>
  <script src="./student.js"></script>
</body>
</html>