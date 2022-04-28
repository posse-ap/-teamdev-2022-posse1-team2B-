<?php
// もしname属性がformの送信ボタンを押したら、この文言を出力する
$action = "";
$user_name ="";
if(isset($_POST['new_entry'])){
  $action = "エージェンシー企業の掲載";
  $user_name = "admin";
  // create_contents.php
} else if (isset($_POST['edit'])) {
  $action = "登録情報の修正";
  $user_name = "adming";
  // edit.php
} else if (isset($_POST['registration'])) {
      $action = "会員登録";
      $user_name = "agency";
  // account.php 
} else if (isset($_POST['create'])) {
    $action = "掲載の申請";
    $user_name = "agency";
    // createcontents.php
} else if (isset($_POST['fix'])) {
    $action = "掲載情報の修正依頼";
    $user_name = "agency";
    // fixcontents.php
} else if (isset($_POST['contact_reset'])) {
    $action = "学生によるお問い合わせの取り消し申請";
    $user_name = "agency";
    // student.php
}  else if (isset($_POST['contact'])) {
    $action = "お問い合わせフォームの送信";
    $user_name = "student";
};
// } else if (isset($_POST[''])) {
//   $action = "学生によるお問い合わせの取り消し申請";
// } else if (isset($_POST[''])) {
//   $action = "お問い合わせフォームの送信";
// };
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
<?php include (dirname(__FILE__) . "/" . $user_name . "/student_header.php");?>
  <span><?php print_r($action);?>完了</span>
  <div>
  <p><?php print_r($action);?>が完了しました</p>
  <a href="./index.php">Top画面に戻る</a>
  </div>
  <?php include (dirname(__FILE__) . "/" . $user_name . "udent/student_footer.php");?>
</body>
</html>

