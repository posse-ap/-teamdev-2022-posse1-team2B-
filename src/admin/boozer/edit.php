<?php
session_start();
require('../../dbconnect.php');
if (isset($_SESSION['user_id']) && $_SESSION['time'] + 60 * 60 * 24 > time()) {
  // SESSIONにuser_idカラムが設定されていて、SESSIONに登録されている時間から1日以内なら
  $_SESSION['time'] = time();
  // SESSIONの時間を現在時刻に更新
} else {
  // そうじゃないならログイン画面に飛んでね
  header('Location: http://' . $_SERVER['HTTP_HOST'] . '/admin/login.php');
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


if (isset($_POST['edit_entry'])) {
  $id = $_POST['agent_id'];
  // $new_url = $_POST['new_url'];
  // $new_notification_email = $_POST['new_notification_email'];
  // $new_tel_number = $_POST['new_tel_number'];
  // $new_post_number = $_POST['new_post_number'];
  // $new_prefecture = $_POST['new_prefecture'];
  // $new_municipalitie = $_POST['new_municipalitie'];
  // $new_address_number = $_POST['new_address_number'];
  // $new_image = $_POST['new_image'];
  // $new_detail = $_POST['new_detail'];

  // トランザクション開始
  if (isset($_POST['new_name'])) {
    $new_name = $_POST['new_name'];
    try {
      $stmt = $db->prepare(
        'UPDATE
          agents
        SET
          agent_name = :new_name
        WHERE
          id = :id'
      );

      $stmt->bindValue(':id', $id);
      $stmt->bindParam(':new_name', $new_name);
      $stmt->execute();
      $res = $db->commit();
    } catch (PDOException $e) {
      // 	// エラーが発生した時トランザクションが開始したところまで巻き戻せる
      // echo "エラーが発生しました";
      ?>
      <script language="javascript" type="text/javascript">
      window.location = '../../thanks.php?edit';
    </script>
    <?php
    }
  } else {
    exit;
  }
  if (isset($_POST['new_url'])) {
    $new_url = $_POST['new_url'];
    try {
      $stmt = $db->prepare(
        'UPDATE
          agents
        SET
          url = :new_url
        WHERE
          id = :id'
      );

      $stmt->bindValue(':id', $id);
      $stmt->bindParam(':new_url', $new_url);
      $stmt->execute();
      $res = $db->commit();
    } catch (PDOException $e) {
      // 	// エラーが発生した時トランザクションが開始したところまで巻き戻せる
      // echo "エラーが発生しました";
      ?>
      <script language="javascript" type="text/javascript">
      window.location = '../../thanks.php?edit';
    </script>
    <?php
    }
  } else {
    exit;
  }
  if (isset($_POST['new_image'])) {
    $new_image = $_POST['new_image'];
    try {
      $stmt = $db->prepare(
        'UPDATE
          agents
        SET
          image = :new_image
        WHERE
          id = :id'
      );

      $stmt->bindValue(':id', $id);
      $stmt->bindParam(':new_image', $new_image);
      $stmt->execute();
    } catch (PDOException $e) {
      // 	// エラーが発生した時トランザクションが開始したところまで巻き戻せる
      // echo "エラーが発生しました";
      ?>
      <script language="javascript" type="text/javascript">
      window.location = '../../thanks.php?edit';
    </script>
    <?php
    }
  } else {
    exit;
  }
  if (isset($_POST['new_notification_email'])) {
    $new_notification_email = $_POST['new_notification_email'];
    try {
      $stmt = $db->prepare(
        'UPDATE
          agents
        SET
          notification_email = :new_notification_email
        WHERE
          id = :id'
      );

      $stmt->bindValue(':id', $id);
      $stmt->bindParam(':new_notification_email', $new_notification_email);
      $stmt->execute();
      $res = $db->commit();
    } catch (PDOException $e) {
      // 	// エラーが発生した時トランザクションが開始したところまで巻き戻せる
      // echo "エラーが発生しました";
      ?>
      <script language="javascript" type="text/javascript">
      window.location = '../../thanks.php?edit';
    </script>
    <?php
    }
  } else {
    exit;
  }
  // $db->beginTransaction();
  if (isset($_POST['new_tel_number'])) {
    $new_tel_number = $_POST['new_tel_number'];
    try {
      $stmt = $db->prepare(
        'UPDATE
          agents
        SET
          tel_number = :new_tel_number
        WHERE
          id = :id'
      );

      $stmt->bindValue(':id', $id);
      $stmt->bindParam(':new_tel_number', $new_tel_number);
      $stmt->execute();
      $res = $db->commit();
    } catch (PDOException $e) {
      // 	// エラーが発生した時トランザクションが開始したところまで巻き戻せる
      // echo "エラーが発生しました";
      ?>
      <script language="javascript" type="text/javascript">
      window.location = '../../thanks.php?edit';
    </script>
    <?php
    }
  } else {
    exit;
  }
  // $db->beginTransaction();
  if (isset($_POST['new_post_number'])) {
    $new_post_number = $_POST['new_post_number'];
    try {
      $stmt = $db->prepare(
        'UPDATE
          agents
        SET
          post_number = :new_post_number
        WHERE
          id = :id'
      );

      $stmt->bindValue(':id', $id);
      $stmt->bindParam(':new_post_number', $new_post_number);
      $stmt->execute();
      $res = $db->commit();
    } catch (PDOException $e) {
      // 	// エラーが発生した時トランザクションが開始したところまで巻き戻せる
      // $db->rollBack();
      // echo "エラーが発生しました";
      ?>
      <script language="javascript" type="text/javascript">
      window.location = '../../thanks.php?edit';
    </script>
    <?php
    }
  } else {
    exit;
  }
  // $db->beginTransaction();
  if (isset($_POST['new_prefecture'])) {
    $new_prefecture = $_POST['new_prefecture'];
    try {
      $stmt = $db->prepare(
        'UPDATE
          agents
        SET
          prefecture = :new_prefecture
        WHERE
          id = :id'
      );

      $stmt->bindValue(':id', $id);
      $stmt->bindParam(':new_prefecture', $new_prefecture);
      $stmt->execute();
      $res = $db->commit();
    } catch (PDOException $e) {
      // 	// エラーが発生した時トランザクションが開始したところまで巻き戻せる
      // $db->rollBack();
      ?>
      <script language="javascript" type="text/javascript">
      window.location = '../../thanks.php?edit';
    </script>
    <?php
      // echo "エラーが発生しました";
    }
  } else {
    exit;
  }
  // $db->beginTransaction();
  if (isset($_POST['new_municipalitie'])) {
    $new_municipalitie = $_POST['new_municipalitie'];
    try {
      $stmt = $db->prepare(
        'UPDATE
          agents
        SET
          municipalitie = :new_municipalitie
        WHERE
          id = :id'
      );

      $stmt->bindValue(':id', $id);
      $stmt->bindParam(':new_municipalitie', $new_municipalitie);
      $stmt->execute();
      $res = $db->commit();
    } catch (PDOException $e) {
      // 	// エラーが発生した時トランザクションが開始したところまで巻き戻せる
      // $db->rollBack();
      // echo "エラーが発生しました";
      ?>
      <script language="javascript" type="text/javascript">
      window.location = '../../thanks.php?edit';
    </script>
    <?php
    }
  } else {
    exit;
  }
  // $db->beginTransaction();
  if (isset($_POST['new_adress_number'])) {
    $new_adress_number = $_POST['new_adress_number'];
    try {
      $stmt = $db->prepare(
        'UPDATE
          agents
        SET
          adress_number = :new_adress_number
        WHERE
          id = :id'
      );

      $stmt->bindValue(':id', $id);
      $stmt->bindParam(':new_adress_number', $new_adress_number);
      $stmt->execute();
      $res = $db->commit();
    } catch (PDOException $e) {
      // 	// エラーが発生した時トランザクションが開始したところまで巻き戻せる
      // $db->rollBack();
      // echo "エラーが発生しました";
      ?>
      <script language="javascript" type="text/javascript">
      window.location = '../../thanks.php?edit';
    </script>
    <?php
    }
  } else {
    exit;
  }
  // $db->beginTransaction();
  if (isset($_POST['new_detail'])) {
    $new_detail = $_POST['new_detail'];
    try {
      $stmt = $db->prepare(
        'UPDATE
          agents
        SET
          detail = :new_detail
        WHERE
          id = :id'
      );

      $stmt->bindValue(':id', $id);
      $stmt->bindParam(':new_detail', $new_detail);
      $stmt->execute();
      $res = $db->commit();
    } catch (PDOException $e) {
      // 	// エラーが発生した時トランザクションが開始したところまで巻き戻せる
      // $db->rollBack();
      // echo "エラーが発生しました";
      ?>
      <script language="javascript" type="text/javascript">
      window.location = '../../thanks.php?edit';
    </script>
    <?php
    }
  } else {
    exit;
  }
  // $db->beginTransaction();
  if (isset($_POST['new_category'])) {
    try {
      $stmt = $db->prepare(
        'UPDATE
          characteristic
        SET
          category_id = :category_id
        WHERE
          id = :id'
      );

      $stmt = $db->prepare('SELECT id FROM category where category_name = :category_name');
      $stmt->bindValue(':category_name', $_POST["new_category"]);
      $stmt->execute();
      $category_id = $stmt->fetchAll();


      $stmt->bindValue(':id', $id);
      $stmt->bindParam(':category_id', $category_id[0]['id']);
      $stmt->execute();
      $res = $db->commit();
    } catch (PDOException $e) {
      // 	// エラーが発生した時トランザクションが開始したところまで巻き戻せる
      // $db->rollBack();
      // echo "エラーが発生しました";
      ?>
      <script language="javascript" type="text/javascript">
      window.location = '../../thanks.php?edit';
    </script>
    <?php
    }
  } else {
    exit;
  }
  // $db->beginTransaction();
  if (isset($_POST['new_job_area'])) {
    try {
      $stmt = $db->prepare(
        'UPDATE
          characteristic
        SET
          job_area_id = :job_area_id
        WHERE
          id = :id'
      );

      $stmt = $db->prepare('SELECT id FROM job_area where area = :area');
      $stmt->bindValue(':area', $_POST["new_job_area"]);
      $stmt->execute();
      $job_area_id = $stmt->fetchAll();


      $stmt->bindValue(':id', $id);
      $stmt->bindParam(':job_area_id', $job_area_id[0]['id']);
      $stmt->execute();
      $res = $db->commit();
    } catch (PDOException $e) {
      // 	// エラーが発生した時トランザクションが開始したところまで巻き戻せる
      // $db->rollBack();
      // echo "エラーが発生しました";
      ?>
      <script language="javascript" type="text/javascript">
      window.location = '../../thanks.php?edit';
    </script>
    <?php
    }
  } else {
    exit;
  }
  // $db->beginTransaction();
  if (isset($_POST['new_target_student'])) {
    try {
      $stmt = $db->prepare(
        'UPDATE
          characteristic
        SET
          target_student_id = :target_student_id
        WHERE
          id = :id'
      );

      $stmt = $db->prepare('SELECT id FROM target_student where graduation_year = :graduation_year');
      $stmt->bindValue(':graduation_year', $_POST["new_target_student"]);
      $stmt->execute();
      $target_student_id = $stmt->fetchAll();



      $stmt->bindValue(':id', $id);
      $stmt->bindParam(':target_student_id', $target_student_id[0]['id']);
      $stmt->execute();
      $res = $db->commit();
    } catch (PDOException $e) {
  ?>
      <script language="javascript" type="text/javascript">
      window.location = '../../thanks.php?edit';
    </script>
    <?php
    }
  } else {
    exit;
  }
  // $db->beginTransaction();
  if (isset($_POST['agent_id'])) {
    try {
      $stmt = $db->prepare(
        'UPDATE
          characteristic
        SET
          agent_id = :agent_id
        WHERE
          id = :id'
      );

      $stmt->bindValue(':agent_id', $id);
      $stmt->bindParam(':id', $id);
      $stmt->execute();
      $res = $db->commit();
    } catch (PDOException $e) {
      // 	// エラーが発生した時トランザクションが開始したところまで巻き戻せる
      // $db->rollBack();
      // echo "エラーが発生しました";
      ?>
      <script language="javascript" type="text/javascript">
      window.location = '../../thanks.php?edit';
    </script>
    <?php
    }
  } else {
    exit;
  }
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>edit</title>
  <link rel="stylesheet" href="../../css/reset.css">
  <link rel="stylesheet" href="../../css/index.css">
</head>

<body>
  <?php include(dirname(__FILE__) . "/boozer_header.php"); ?>
  <div class="main">
    <h2 class="pagetitle">掲載内容修正</h2>
    <form action="edit.php" method="POST" class="inputform">
      <dd>会社名</dd>
      <dt><input name='new_name' type="text"></dt>
      <dd>企業サイトのURL</dd>
      <dt><input name='new_url' type="text"></dt>
      <dd>通知先メールアドレス</dd>
      <dt><input name='new_notification_email' type='email'></dt>
      <dd>電話番号</dd>
      <dt><input name='new_tel_number' type='tel'></dt>
      <dd>郵便番号</dd>
      <dt><input name='new_post_number' type="text"></dt>
      <dd>都道府県</dd>
      <dt><input name='new_prefecture' type="text"></dt>
      <dd>市区町村</dd>
      <dt><input name='new_municipalitie' type="text"></dt>
      <dd>町域・番地</dd>
      <dt><input name='new_address_number' type="text"></dt>
      <dd>得意な業種</dd>
      <dt>
        <select name='new_category'>
          <?php foreach ($categories as $index => $category) : ?>
            <option value="<?php print_r($categories[$index]['category_name']); ?>"><?php print_r($categories[$index]['category_name']); ?></option>
          <?php endforeach; ?>
        </select>
      </dt>
      <dd>対応エリア</dd>
      <dt>
        <select name='new_job_area'>
          <?php foreach ($job_areas as $index => $job_area) : ?>
            <option value="<?php print_r($job_areas[$index]['area']); ?>"><?php print_r($job_areas[$index]['area']); ?></option>
          <?php endforeach; ?>
        </select>
      </dt>
      <dd>対応学年</dd>
      <dt>
        <select name='new_target_student'>
          <?php foreach ($target_students as $index => $target_student) : ?>
            <option value="<?php print_r($target_students[$index]['graduation_year']); ?>"><?php print_r($target_students[$index]['graduation_year']); ?></option>
          <?php endforeach; ?>
        </select>
      </dt>
      <dd>アイコン画像</dd>
      <dt><input name='new_image' type="file"></dt>
      <dd>備考（アピールポイントなど）</dd>
      <dt><textarea name="new_detail" id="detail" cols="30" rows="10"></textarea></dt>
      </dl>
      <input type="submit" class="submitbtn ignore" name="edit_entry" value="修正完了">
      <input type="hidden" name="agent_id" value="<?php echo $_POST['agent_id']; ?>">
      <a href='javascript:history.back()' class="returnbtn">戻る</a>
    </form>
  </div>
  <?php include(dirname(__FILE__) . "/boozer_footer.php"); ?>
</body>

</html>