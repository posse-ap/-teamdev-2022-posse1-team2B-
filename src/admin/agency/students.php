<?php
session_start();
require("../../dbconnect.php");
if (isset($_SESSION['user_id']) && $_SESSION['time'] + 60 * 60 * 24 > time()) {
    // SESSIONにuser_idカラムが設定されていて、SESSIONに登録されている時間から1日以内なら
    $_SESSION['time'] = time();
    // SESSIONの時間を現在時刻に更新
} else {
    // そうじゃないならログイン画面に飛んでね
    header('Location: http://' . $_SERVER['HTTP_HOST'] . '../login.php');
    exit();
}

  //変数の初期化
  // 学生の詳細情報画面や確認画面の表示をスイッチするフラグ
  // 0→詳細画面 1→確認画面
  $page_flag = 0;
  // もしいたずら報告ボタンがおされたら
  // ＝フォームデータの中に$_POST["mischief_report"]が含まれていたら
  // →page_flag変数の値を1にする＝確認画面に表示を変える
  if(isset($_POST["mischief_report"])) {
    $page_flag = 1;
  } elseif(isset($_POST["report"])) {
    $page_flag = 2;
  }
  
$stmt = $db->prepare('select * from intermediate left join students on intermediate.student_id = students.id right join agents on intermediate.agent_id = agents.id where agent_id = 1');
// $stmt->bindValue(':agent_id', $agent['id']);
  // bindevalueの１が？の１個めってこと。これがあれば何個でもはてなつけられる！1,2とかだとわかりにくいから、「:agent_id」を設定する
  $stmt->execute();
  $matched_students = $stmt->fetchAll();
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
<?php 
  include (dirname(__FILE__) . "/agency_header.php"); 
  if ($page_flag === 1):
?>
    <!-- 確認画面 -->
    <div class="main">
        <p>本当に取り消し申請を行いますか？</p>
        <p>いたずら・迷惑行為とみなされたお問い合わせのみ取り消されます。</p>
      <!-- 入力した値を受け渡す -->
        <a href='javascript:history.back()'>戻る</a>
        <a href="../../thanks.php">いたずらを申請する</a>
      </div>
    </div>
    <!-- 学生詳細 -->
  <?php 
  elseif($page_flag === 2):
    $student_name=$_POST['name'];
    $tel_number=$_POST['tel_number'];
    $email=$_POST['email'];
    $college_name=$_POST['college_name'];
    $undergraduate=$_POST['undergraduate'];
    $college_department=$_POST['college_department'];
    $graduation_year=$_POST['graduation_year'];
  ?>
  <h2>学生の詳細情報</h2>

    <div id="studentDetail" class="student_detail">
      <a href="./students.php">☓</a>
      <dd>名前</dd><dt><?= $student_name ?></dt>
      <!-- <dd>カナ</dd><dt></dt> -->
      <dd>電話番号</dd><dt><?= $tel_number?></dt>
      <dd>メールアドレス</dd><dt><?= $email ?></dt>
      <dd>出身大学</dd><dt><?= $college_name ?></dt>
      <dd>学部</dd><dt><?= $undergraduate ?></dt>
      <dd>学科</dd><dt><?= $college_department ?></dt>
      <dd>卒業年</dd><dt><?= $graduation_year ?></dt>
      <dd>お問い合わせ内容</dd><dt><?php //お問い合わせ内容ってテーブルになくない？？？？？？？？？？？？？？ ?></dt>
      <form method="POST">
        <button type="submit" name="mischief_report">いたずらをboozerに報告</button>
      </form>
    </div>
    <!-- 学生一覧画面 -->
  <?php else: ?>
  <div>
    <section>
      <h2>学生一覧</h2>
      <?php foreach ($matched_students as $matched_student) : ?>
      <div>
        <span><?= $matched_student['student_name'] ?></span>
        <span><?= $matched_student['student_name'] ?></span>
        <span>お問い合わせ日時：<?= $matched_student['updated_at'] ?></span>
      </div>
  </section>
  <section>
    <dd>名前</dd><dt><?= $matched_student['student_name'] ?></dt>
    <!-- テーブルにカナない？ -->
    <dd>カナ</dd><dt><?= $matched_student['student_name_kana'] ?></dt>
    <dd>電話番号</dd><dt><?= $matched_student['tel_number'] ?></dt>
    <dd>メールアドレス</dd><dt><?= $matched_student['email'] ?></dt>
    <dd>出身大学</dd><dt><?= $matched_student['college_name'] ?></dt>
    <dd>学部</dd><dt><?= $matched_student['undergraduate'] ?></dt>
    <dd>学科</dd><dt><?= $matched_student['college_department'] ?></dt>
    <dd>卒業年</dd><dt><?= $matched_student['graduation_year'] ?></dt>
    <dd>お問い合わせ内容</dd><dt></dt>
    <form action="" method="POST">
        <input type="hidden" name="name" value="<?php echo $matched_student['student_name']; ?>">
        <input type="hidden" name="tel_number" value="<?php echo $matched_student["tel_number"]; ?>">
        <input type="hidden" name="email" value="<?php echo $matched_student["email"]; ?>">
        <input type="hidden" name="college_name" value="<?php echo $matched_student["college_name"]; ?>">
        <input type="hidden" name="undergraduate" value="<?php echo $matched_student["undergraduate"]; ?>">
        <input type="hidden" name="college_department" value="<?php echo $matched_student["college_department"]; ?>">
        <input type="hidden" name="graduation_year" value="<?php echo $matched_student["graduation_year"]; ?>">
      <input type='submit' name='report' value='詳細'>
    </form>
  </section>
  <?php endforeach; ?>
  <a href='./index.php'>戻る</a>
  <?php endif; 
  include (dirname(__FILE__) . "/agency_footer.php");
  ?>
  <script src="./agency.js"></script>
</body>
</html>