<?php
require('../../dbconnect.php');

$category_stmt = $db->prepare('SELECT * FROM category');
$category_stmt->execute();
$categories = $category_stmt->fetchAll();

$job_area_stmt = $db->prepare('SELECT * FROM job_area');
$job_area_stmt->execute();
$job_areas = $job_area_stmt->fetchAll();

$target_student_stmt = $db->prepare('SELECT * FROM target_student');
$target_student_stmt->execute();
$target_students = $target_student_stmt->fetchAll();

if (isset($_POST['new_entry'])) {

  $name = $_POST['name'];
  $url = $_POST['url'];
  $notification_email = $_POST['notification_email'];
  $tel_number = $_POST['tel_number'];
  $post_number = $_POST['post_number'];
  $prefecture = $_POST['prefecture'];
  $municipalitie = $_POST['municipalitie'];
  $address_number = $_POST['address_number'];
  $image = $_POST['image'];
  $detail = $_POST['detail'];

    $entry_stmt = $db->prepare(
      'insert into agents 
        (
          agent_name, 
          url, 
          image,
          notification_email, 
          tel_number, 
          post_number, 
          prefecture, 
          municipalitie, 
          adress_number, 
          detail
        ) 
        values 
        (
          :agent_name, 
          :url, 
          :image,
          :notification_email, 
          :tel_number, 
          :post_number, 
          :prefecture, 
          :municipalitie, 
          :adress_number, 
          :detail
        )'
    );

    $parameter = array(
      ':agent_name' => $name,
      ':url' => $url,
      ':image' => $image,
      ':notification_email' => $notification_email,
      ':tel_number' => $tel_number,
      ':post_number' => $post_number,
      ':prefecture' => $prefecture,
      ':municipalitie' => $municipalitie,
      ':adress_number' => $address_number,
      ':detail' => $detail
    );
    $entry_stmt->execute($parameter);

    $character_stm = $db->prepare(
      'insert into characteristic 
        (
          agent_id,
          category_id,
          job_area_id,
          target_student_id
        ) 
        values 
        (
          :agent_id,
          :category_id,
          :job_area_id,
          :target_student_id
        )'
    );

    $agent_id_stmt = $db->prepare('SELECT id FROM agents where agent_name = :name');
    $agent_id_stmt->bindValue(':name', $name);
    $agent_id_stmt->execute();
    $agent_id = $agent_id_stmt->fetchAll();

    $categories_stmt = $db->prepare('SELECT id FROM category where category_name = :category_name');
    $categories_stmt->bindValue(':category_name', $_POST["category"]);
    $categories_stmt->execute();
    $category_id = $categories_stmt->fetchAll();

    $job_areas_stmt = $db->prepare('SELECT id FROM job_area where area = :area');
    $job_areas_stmt->bindValue(':area', $_POST["job_area"]);
    $job_areas_stmt->execute();
    $job_area_id = $job_areas_stmt->fetchAll();

    $target_students_stmt = $db->prepare('SELECT id FROM target_student where graduation_year = :graduation_year');
    $target_students_stmt->bindValue(':graduation_year', $_POST["target_student"]);
    $target_students_stmt->execute();
    $target_student_id = $target_students_stmt->fetchAll();

    $param = array(
      ':agent_id' => $agent_id,
      ':category_id' => $category_id,
      ':job_area_id' => $job_area_id,
      ':target_student_id' => $target_student_id
    );
    $character_stm->execute($param);
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>新規作成</title>
  <link rel="stylesheet" href="../../css/reset.css">
  <link rel="stylesheet" href="../../css/index.css">
</head>

<body>
  <?php include (dirname(__FILE__) . "/agency_header.php");?>
  <div class="main">
    <h2 class="pagetitle">エージェンシー掲載情報を登録</h2>
    <p class="announce">※URL、通知先メールアドレス、電話番号は学生画面には表示されません。</p>
    <form action="../../thanks.php?new_entry" method="POST" class="inputform">
      <dl>
        <dd>会社名</dd>
        <dt><input name='name' type="text" required></dt>
        <dd>企業サイトのURL</dd>
        <dt><input name='url' type="text" required></dt>
        <dd>通知先メールアドレス</dd>
        <dt><input name='notification_email' type='email' required></dt>
        <dd>電話番号</dd>
        <dt><input name='tel_number' type='tel' required></dt>
        <dd>郵便番号</dd>
        <dt><input name='post_number' type="text" required></dt>
        <dd>都道府県</dd>
        <dt><input name='prefecture' type="text" required></dt>
        <dd>市区町村</dd>
        <dt><input name='municipalitie' type="text" required></dt>
        <dd>町域・番地</dd>
        <dt><input name='address_number' type="text" required></dt>
        <dd>得意な業種</dd>
        <dt>
          <select name='category' required>
            <?php foreach ($categories as $index => $category) : ?>
              <option value="<?php print_r($categories[$index]['category_name']); ?>"><?php print_r($categories[$index]['category_name']); ?></option>
            <?php endforeach; ?>
          </select>
        </dt>
        <dd>対応エリア</dd>
        <dt>
          <select name='job_area' required>
            <?php foreach ($job_areas as $index => $job_area) : ?>
              <option value="<?php print_r($job_areas[$index]['area']); ?>"><?php print_r($job_areas[$index]['area']); ?></option>
            <?php endforeach; ?>
          </select>
        </dt>
        <dd>対応学年</dd>
        <dt>
          <select name='target_student' required>
            <?php foreach ($target_students as $index => $target_student) : ?>
              <option value="<?php print_r($target_students[$index]['graduation_year']); ?>"><?php print_r($target_students[$index]['graduation_year']); ?></option>
            <?php endforeach; ?>
          </select>
        </dt>
        <dd>アイコン画像</dd>
        <dt><input name='image' type="file" required></dt>
        <dd>備考</dd>
        <dt><textarea name="detail" id="detail" cols="30" rows="10"></textarea></dt>
      </dl>
      <div class="pageendbuttons">
        <a href='./index.php' class="returnbtn endbtn">戻る</a>
        <button type="submit" class="submitbtn endbtn"  name='new_entry' onclick="
              <?php
              $from = 'boozer@craft.com';
              $to   = 'test@posse-ap.com';
              $subject = 'Hi, from craft';
              $body = 'contact from agency about create contents';

              $ret = mb_send_mail($to, $subject, $body, "From: {$from} \r\n");
              var_dump($ret);

              ?>
              ">新規作成依頼を送信</button>
      </div>
    </form>
  </div>
  <?php include (dirname(__FILE__) . "/agency_footer.php");?>
</body>

</html>