<?php
session_start();
require('../../dbconnect.php');
if (isset($_SESSION['user_id']) && $_SESSION['time'] + 60 * 60 * 24 > time()) {
  // SESSIONにuser_idカラムが設定されていて、SESSIONに登録されている時間から1日以内なら
  $_SESSION['time'] = time();
  // SESSIONの時間を現在時刻に更新
} else {
  // そうじゃないならログイン画面に飛んでね
  header('Location: http://' . $_SERVER['HTTP_HOST'] . '../login.php');
  exit();
} 
$stmt = $db->prepare('SELECT * FROM category');
$stmt->execute();
$categories = $stmt->fetchAll();

$stmt = $db->prepare('SELECT * FROM job_area');
$stmt->execute();
$job_areas = $stmt->fetchAll();

$stmt = $db->prepare('SELECT * FROM target_student');
$stmt->execute();
$target_students = $stmt->fetchAll();

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
  <?php include(dirname(__FILE__) . "/agency_header.php"); ?>
  <div class="main">
    <h1 class="pagetitle">掲載内容修正申し込み</h1>
    <form action="../../thanks.php" method="POST" class="inputform">
      <div>
        <label for="companyName">会社名</label>
        <input name='name' type="text" id="companyName">
      </div>
      <div>
        <label for="companyAddress">企業サイトのURL</label>
        <input name='url' type="text" id="companyAddress">
      </div>
      <div>
        <label for="notificationEmail">通知先メールアドレス<span class="must">必須</span></label>
        <input name='notification_email' type='email'>
      </div>
      <div>
        <label for="companyPostnumber">電話番号</label>
        <input name='tel_number' type="text" id="companyTelnumber">
      </div>
      <div>
        <label for="companyRemarks">郵便番号</label>
        <input name='post_number' type="text" id="companyRemarks">
      </div>
      <div>
        <label for="companyAddress">都道府県</label>
        <input name='prefecture' type="text" id="companyAddress">
      </div>
      <div>
        <label for="companyRemarks">市区町村</label>
        <input name='municipalitie' type="text" id="companyRemarks">
      </div>
      <div>
        <label for="companyRemarks">町域・番地</label>
        <input type="text" name="address_number" id="companyRemarks">
      </div>
      <div>
        <label for="category">得意な業種(最も該当するものを１つお選びください)<span class="must">必須</span></label>
        <select name='category' required>
          <?php foreach ($categories as $index => $category) : ?>
            <option value="<?php print_r($categories[$index]['category_name']); ?>"><?php print_r($categories[$index]['category_name']); ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div>
        <label for="jobArea">対応エリア(最も該当するものを１つお選びください)<span class="must">必須</span></label>
        <select name='job_area' required>
          <?php foreach ($job_areas as $index => $job_area) : ?>
            <option value="<?php print_r($job_areas[$index]['area']); ?>"><?php print_r($job_areas[$index]['area']); ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div>
        <label for="targetStudent">対応学年(最も該当するものを１つお選びください)<span class="must">必須</span></label>
        <select name='target_student' required>
          <?php foreach ($target_students as $index => $target_student) : ?>
            <option value="<?php print_r($target_students[$index]['graduation_year']); ?>"><?php print_r($target_students[$index]['graduation_year']); ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div>
        <label for="companyImage">アイコン画像</label><br>
        <input type="file" name="companyImage" id="companyimage" accept="image/*" class="ignore iconimage margintop">
      </div>
      <div>
        <label for="companyRemarks">備考（アピールポイントなど）</label>
        <input type="text" name="company_remarks" id="companyRemarks">
      </div>

      <button type="submit" name="fix_entry" class="submitbtn margintop" onclick="
              <?php
              $from = 'boozer@craft.com';
              $to   = 'test@posse-ap.com';
              $subject = 'Modification request from a agency';
              $body = 'please check information from here';

              $ret = mb_send_mail($to, $subject, $body, "From: {$from} \r\n");
              var_dump($ret);
              ?>
              ">修正を申し込む</button>
    </form>
  </div>
  <?php include(dirname(__FILE__) . "/agency_footer.php"); ?>
  <script src="agency.js"></script>
</body>

</html>