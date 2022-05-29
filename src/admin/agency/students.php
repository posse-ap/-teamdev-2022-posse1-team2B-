<?php
session_start();
require("../../dbconnect.php");
if (isset($_SESSION['user_id']) && $_SESSION['time'] + 60 * 60 * 24 > time()) {
  // SESSIONにuser_idカラムが設定されていて、SESSIONに登録されている時間から1日以内なら
  $_SESSION['time'] = time();
  // SESSIONの時間を現在時刻に更新
} else {
  // そうじゃないならログイン画面に飛んでね
  header('Location: http://' . $_SERVER['HTTP_HOST'] . '/admin/login.php');
  exit();
}

//変数の初期化
// 学生の詳細情報画面や確認画面の表示をスイッチするフラグ
// 0→詳細画面 1→確認画面
$page_flag = 0;
// もしいたずら報告ボタンがおされたら
// ＝フォームデータの中に$_POST["mischief_report"]が含まれていたら
// →page_flag変数の値を1にする＝確認画面に表示を変える
if (isset($_POST["mischief"])) {
  $page_flag = 1;
} elseif (isset($_POST["report"])) {
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
  include(dirname(__FILE__) . "/agency_header.php");
  if ($page_flag === 1) :
  ?>
    <!-- 確認画面 -->
    <div class="main">
      <p class="pagetitle">本当に取り消し申請を行いますか？</p>
      <p class="announce">いたずら・迷惑行為とみなされたお問い合わせのみ取り消されます。</p>
      <!-- 入力した値を受け渡す -->
      <a href='javascript:history.back()' class="returnbtn">戻る</a>
      <form action="../../thanks.php" method="POST">
        <button name="mischief_report" class="deletebtn" onclick="
              <?php
              $from = 'boozer@craft.com';
              $to   = 'test@posse-ap.com';
              $subject = 'error student data from a agency';
              $body = 'please check information from here';

              $ret = mb_send_mail($to, $subject, $body, "From: {$from} \r\n");
              var_dump($ret);
              ?>
              ">いたずらを申請する</button>
      </form>
    </div>
    </div>
    <!-- 学生詳細 -->
  <?php
  elseif ($page_flag === 2) :
    $student_name = $_POST['name'];
    $tel_number = $_POST['tel_number'];
    $email = $_POST['email'];
    $college_name = $_POST['college_name'];
    $undergraduate = $_POST['undergraduate'];
    $college_department = $_POST['college_department'];
    $graduation_year = $_POST['graduation_year'];
  ?>
    <div class="main">
      <h2 class="pagetitle">学生の詳細情報</h2>

      <div id="studentDetail" class="tableouter">
        <div class="table">
          <dd>名前</dd>
          <dt><?= $student_name ?></dt>
          <!-- <dd>カナ</dd><dt></dt> -->
          <dd>電話番号</dd>
          <dt><?= $tel_number ?></dt>
          <dd>メールアドレス</dd>
          <dt><?= $email ?></dt>
          <dd>出身大学</dd>
          <dt><?= $college_name ?></dt>
          <dd>学部</dd>
          <dt><?= $undergraduate ?></dt>
          <dd>学科</dd>
          <dt><?= $college_department ?></dt>
          <dd>卒業年</dd>
          <dt><?= $graduation_year ?></dt>
          <dd>お問い合わせ内容</dd>
          <dt><?php //お問い合わせ内容ってテーブルになくない？？？？？？？？？？？？？？ 
              ?></dt>
        </div>
        <form method="POST">
          <button type="submit" name="mischief" class="deletebtn margintop" onclick="
        <?php
        $from = 'boozer@craft.com';
        $to   = 'test@posse-ap.com';
        $subject = 'Hi, from craft';
        $body = 'contact from a agency about error student';

        $ret = mb_send_mail($to, $subject, $body, "From: {$from} \r\n");
        var_dump($ret);

        ?>
        ">いたずらをboozerに報告</button>
        </form>
      </div>
      <a href="./students.php" class="returnbtn">戻る</a>


      <!-- 学生一覧画面 -->
    <?php else : ?>
      <div class="main">
        <section>
          <h2 class="pagetitle">学生一覧</h2>
          <?php foreach ($matched_students as $matched_student) : ?>
            <div class="studentbox">
              <span><?php echo $matched_student['student_last_name'] . $matched_student['student_first_name']; ?></span>
              <span><?php echo $matched_student['student_last_name_kana'] . $matched_student['student_first_name_kana']; ?></span>
              <span>お問い合わせ日時：<?= $matched_student['updated_at'] ?></span>
              <form action="" method="POST">
                <input type="hidden" name="name" value="<?php echo $matched_student['student_last_name']; ?>">
                <input type="hidden" name="name" value="<?php echo $matched_student['student_first_name']; ?>">
                <input type="hidden" name="name" value="<?php echo $matched_student['student_last_name_kana']; ?>">
                <input type="hidden" name="name" value="<?php echo $matched_student['student_first_name_kana']; ?>">
                <input type="hidden" name="tel_number" value="<?php echo $matched_student["tel_number"]; ?>">
                <input type="hidden" name="email" value="<?php echo $matched_student["email"]; ?>">
                <input type="hidden" name="college_name" value="<?php echo $matched_student["college_name"]; ?>">
                <input type="hidden" name="undergraduate" value="<?php echo $matched_student["undergraduate"]; ?>">
                <input type="hidden" name="college_department" value="<?php echo $matched_student["college_department"]; ?>">
                <input type="hidden" name="graduation_year" value="<?php echo $matched_student["graduation_year"]; ?>">
                <input type='submit' name='report' value='詳細' class="submitbtn">
              </form>
            </div>
        </section>
        <!-- <section class="tableouter">
      <div class="table">
        <dd>名前</dd><dt><?= $matched_student['student_last_name'] . $matched_student['student_first_name']; ?></dt>
        <dd>カナ</dd><dt><?= $matched_student['student_first_name_kana'] . $matched_student['student_first_name_kana']; ?></dt>
        <dd>電話番号</dd><dt><?= $matched_student['tel_number'] ?></dt>
        <dd>メールアドレス</dd><dt><?= $matched_student['email'] ?></dt>
        <dd>出身大学</dd><dt><?= $matched_student['college_name'] ?></dt>
        <dd>学部</dd><dt><?= $matched_student['undergraduate'] ?></dt>
        <dd>学科</dd><dt><?= $matched_student['college_department'] ?></dt>
        <dd>卒業年</dd><dt><?= $matched_student['graduation_year'] ?></dt>
        <dd>お問い合わせ内容</dd><dt></dt>
      </div>
      <form action="" method="POST">
          <input type="hidden" name="name" value="<?php echo $matched_student['student_last_name']; ?>">
          <input type="hidden" name="name" value="<?php echo $matched_student['student_first_name']; ?>">
          <input type="hidden" name="name" value="<?php echo $matched_student['student_last_name_kana']; ?>">
          <input type="hidden" name="name" value="<?php echo $matched_student['student_first_name_kana']; ?>">
          <input type="hidden" name="tel_number" value="<?php echo $matched_student["tel_number"]; ?>">
          <input type="hidden" name="email" value="<?php echo $matched_student["email"]; ?>">
          <input type="hidden" name="college_name" value="<?php echo $matched_student["college_name"]; ?>">
          <input type="hidden" name="undergraduate" value="<?php echo $matched_student["undergraduate"]; ?>">
          <input type="hidden" name="college_department" value="<?php echo $matched_student["college_department"]; ?>">
          <input type="hidden" name="graduation_year" value="<?php echo $matched_student["graduation_year"]; ?>">
        <input type='submit' name='report' value='詳細' class="submitbtn">
      </form>
    </section> -->
      <?php endforeach; ?>
      <a href='./index.php' class="returnbtn">戻る</a>
    <?php endif;
  include(dirname(__FILE__) . "/agency_footer.php");
    ?>
    <script src="./agency.js"></script>
</body>

</html>