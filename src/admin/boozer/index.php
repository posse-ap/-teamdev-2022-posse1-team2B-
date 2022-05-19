<!-- 
・「登録開始」ってなに？
-->
<?php 
$page_flag=0;
if(isset($_POST['delete'])){
  $page_flag = 1;
}

?>


<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>menu</title>
  <link rel="stylesheet" href="boozer.css">
</head>
<body>
  <?php include (dirname(__FILE__) . "/boozer_header.php");?>
  <?php if($page_flag === 1): ?>
  <h2>掲載企業一覧</h2>
  <div>
    <p>本当にエージェンシー企業を削除しますか？</p>
    <dd>会社名</dd><dt><?= $matched_student['student_name'] ?></dt>
    <dd>カナ</dd><dt><?= $matched_student['student_name'] ?></dt>
    <dd>電話番号</dd><dt><?= $matched_student['tel_number'] ?></dt>
    <dd>メールアドレス</dd><dt><?= $matched_student['email'] ?></dt>
    <dd>出身大学</dd><dt><?= $matched_student['college_name'] ?></dt>
    <dd>学部</dd><dt><?= $matched_student['undergraduate'] ?></dt>
    <dd>学科</dd><dt><?= $matched_student['college_department'] ?></dt>
    <dd>卒業年</dd><dt><?= $matched_student['graduation_year'] ?></dt>
  </div>
  <?php else: ?>
  <h2>掲載企業一覧</h2>
  <div>
    <form action="" method="POST">
      <img src="" alt="">
      <h3><?php echo $agency['agent_name']; ?></h3>
      <a href="edit.php?id=<?php echo$agency['id'];?>">編集</a>
      <input name="delete" value="エージェンシ―企業を削除">
      <!-- この削除は、データベースから削除って意味？それとも単に掲載を削除？ -->
    </form>
  </div>
  <!-- <div>
    <img src="" alt="">
    <h3>エージェントB</h3>
    <a href="edit.php">編集</a>
    <button>削除</button>
  </div>
  <div>
    <img src="" alt="">
    <h3>エージェントC</h3>
    <a href="edit.php">編集</a>
    <button>削除</button>
  </div> -->
  <a href="./agentslist.php">企業一覧をもっと見る</a>

  <a href="./payment.php">明細確認</a>
  <a href="./students.php">学生情報</a>
  <?php endif; ?>
  <?php include (dirname(__FILE__) . "/boozer_footer.php");?>
  <script src="boozer.js"></script>
</body>
</html>