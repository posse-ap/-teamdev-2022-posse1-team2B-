<?php 
require("../dbconnect.php");
session_start();
$keeps=array();
//POSTデータをカート用のセッションに保存
if($_SERVER['REQUEST_METHOD']==='POST'){
  $agent_id = $_POST['agent_id'];
  $_SESSION['keep'][$agent_id]=$agent_id; //セッションにデータを格納
  if(isset($_POST['cancel'])) {
    unset($_SESSION['keep'][$agent_id]);
}
}
if(isset($_SESSION['keep'])){
  $keeps=$_SESSION['keep'];
  }
var_dump($keeps);
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
        <!-- <dd>会社名</dd><dt><input name='name' type="text" required></dt>
        <dd>企業サイトのURL</dd><dt><input name='url' type="text" required></dt>
        <dd>通知先メールアドレス</dd><dt><input name='notification_email' type='email' required></dt>
        <dd>電話番号</dd><dt><input name='tel_number' type='tel' required></dt>
        <dd>郵便番号</dd><dt><input name='post_number' type="text" required></dt>
        <dd>都道府県</dd><dt><input name='prefecture' type="text" required></dt>
        <dd>市区町村</dd><dt><input name='municipalitie' type="text" required></dt>
        <dd>町域・番地</dd><dt><input name='address_number' type="text" required></dt>
        <dd>特異な業種</dd><dt><input name='category' type='text' required></dt> -->
              <th>エージェンシー企業名</th>
              <th>得意な業種</th>
              <!-- <th>対応エリア</th>
              <th>対象学生</th>
              <th>対応企業の規模</th> -->
              <!-- <th>備考</th> -->
            </tr>
          </thead>  
          <tbody>
            <?php foreach($keeps as $keep):
              $stmt = $db->prepare('SELECT * FROM agents WHERE id = :id');
              $stmt->bindValue(':id', $keep);
              $stmt->execute();
              $agent = $stmt->fetch();
            ?>
            <tr>
              <td><?php print($agent['agent_name']); ?></td>
              <td><?php print($agent['category']); ?></td>
              <!-- <td><?php //print($agent['supported_area']); ?></td>
              <td><?php //print($agent['target_student']); ?></td>
              <td><?php //print($agent['corporate_scale']); ?></td>
              <td><?php //print($agent['remarks']); ?></td> -->
              <td>
                <form action="" method="POST">
                  <input type="hidden" name="agent_id" value="<?php print_r($agent['id']);?>">
                  <button type="submit" name="cancel">キープを取り消す</button>
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
    <?php endif;?>
    <a href='javascript:history.back()' class="returnbtn">戻る</a>
  </div>
  <?php include (dirname(__FILE__) . "/student_footer.php");?>
  <script src="./student.js"></script>
</body>
</html>