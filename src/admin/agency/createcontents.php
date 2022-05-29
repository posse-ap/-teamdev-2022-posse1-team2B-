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
  <title>掲載内容新規作成</title>
  <link rel="stylesheet" href="../../css/reset.css">
  <link rel="stylesheet" href="../../css/index.css">
</head>

<body>
  <?php include(dirname(__FILE__) . "/agency_header.php"); ?>
  <div class="main">
    <h1 class="pagetitle">掲載内容新規作成</h1>
    <div>
      <form action="../../thanks.php" method="POST" class="inputform">
        <div>
          <label for="companyName">会社名<span class="must">必須</span></label>
          <input name='name' type="text" required>
        </div>
        <div>
          <label for="companyURL">企業サイトのURL<span class="must">必須</span></label>
          <input name='url' type="text" required>
        </div>
        <div>
          <label for="notificationEmail">通知先メールアドレス<span class="must">必須</span></label>
          <input name='notification_email' type='email' required>
        </div>
        <div>
          <label for="telNumber">電話番号<span class="must">必須</span></label>
          <input name='tel_number' type='tel' required>
        </div>
        <div>
          <label for="postNumber">郵便番号<span class="must">必須</span></label>
          <input name='post_number' type="text" required>
        </div>
        <div>
          <label for="prefecture">都道府県<span class="must">必須</span></label>
          <input name='prefecture' type="text" required>
        </div>
        <div>
          <label for="municipalitie">市区町村<span class="must">必須</span></label>
          <input name='municipalitie' type="text" required>
        </div>
        <div>
          <label for="addressNumber">町域・番地<span class="must">必須</span></label>
          <input name='address_number' type="text" required>
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
          <label for="iconImage" class="uploadicon">アイコン画像<span class="must">必須</span></label><br>
          <input name='image' type="file" required>
        </div>
        <div>
          <label for="companyRemarks">備考（アピールポイントなど）</label>
          <textarea name="detail" id="detail" cols="30" rows="10"></textarea>
        </div>

        <div class="pageendbuttons">
          <a href="./index.php" class="returnbtn endbtn">戻る</a>
          <!-- 入力した値を受け渡す -->
          <button type="submit" class="submitbtn endbtn" onclick="
              <?php
              $from = 'boozer@craft.com';
              $to   = 'test@posse-ap.com';
              $subject = 'Posting request from a agency';
              $body = 'please check information from here';

              $ret = mb_send_mail($to, $subject, $body, "From: {$from} \r\n");
              var_dump($ret);
              ?>
              ">作成完了</button>
        </div>
        <input type="hidden" name="company_name" value="<?php if (isset($_POST["company_name"])) {
                                                          echo $_POST["company_name"];
                                                        } ?>">
        <input type="hidden" name="create">
        <input type="hidden" name="company_address" value="<?php if (isset($_POST["company_address"])) {
                                                              echo $_POST["company_address"];
                                                            } ?>">
        <input type="hidden" name="company_remarks" value="<?php if (isset($_POST["company_remarks"])) {
                                                              echo $_POST["company_remarks"];
                                                            } ?>">
        <input type="hidden" name="icon_image" value="<?php if (isset($_POST["icon_image"])) {
                                                        echo $_POST["icon_image"];
                                                      } ?>">
      </form>
    </div>
  </div>
  <?php include(dirname(__FILE__) . "/agency_footer.php"); ?>
</body>
<script src="./agency.js"></script>

</html>