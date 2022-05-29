<?php
session_start();
require('./dbconnect.php');
if (isset($_SESSION['user_id']) && $_SESSION['time'] + 60 * 60 * 24 > time()) {
  // SESSIONにuser_idカラムが設定されていて、SESSIONに登録されている時間から1日以内なら
  $_SESSION['time'] = time();
  // SESSIONの時間を現在時刻に更新
  $login = $_SESSION['login'];  //ログイン情報を保持
} else {
  // そうじゃないならログイン画面に飛んでね
  header('Location: http://' . $_SERVER['HTTP_HOST'] . '/admin/login.php');
  exit();
}
// もしname属性~の送信ボタンを押したら、この文言を出力する
// サンクスページに遷移する画面
// agency
  //1 アカウント作成完了：top account thanks////btn_confirm  
  // 2  掲載情報新規作成：createcontents thanks/////create //!!!!..
  // 3 掲載情報修正依頼：fixcontents thanks///fix//!!!!!!!..
  // 4 学生からのお問い合わせ取り消し依頼：students thanks////mischief_report//!!!!//
// boozer
  // 5  掲載情報編集：edit thanks///edit ///!!!!!!!!
  //6 掲載情報新規作成：create_contents thanks////new_entry!!

// student
 // 7 お問い合わせ：contact thanks////final_contact///!!!!

$action = "";
$user_name ="";
if(isset($_POST['btn_confirm'])){ // agency
    //1 アカウント作成完了：top account thanks////btn_confirm
  $action = "アカウントの作成";
  $user_name = "agency";
}  else if (isset($_POST['create'])) {
    // 2  掲載情報新規作成：createcontents thanks/////create
    $action = "掲載の新規作成";
    $user_name = "agency";
}   else if (isset($_POST['fix'])) {
    // 3 掲載情報修正依頼：fixcontents thanks///fix
    $action = "掲載情報の修正依頼";
    $user_name = "agency";
}  else if (isset($_GET['mischief_report'])) {
    // 4 学生からのお問い合わせ取り消し依頼：students thanks////mischief_report
    $action = "いらずらの報告";
    $user_name = "agency";
}  else if (isset($_GET['edit'])) { //boozer
    // 5  掲載情報編集：edit thanks///edit
    $action = "掲載情報の修正依頼";
    $user_name = "agency";
}  else if (isset($_GET['new_entry'])) {
    //6 掲載情報新規作成：create_contents thanks////new_entry
    $action = "掲載の新規作成";
    $user_name = "agency";
}  else if (isset($_GET['contact'])) { //student
   // 7 お問い合わせ：contact thanks////final_contact
    $action = "エージェンシー企業へのお問い合わせ";
    $user_name = "student";
} else if (isset($_GET['delete'])) { //student
   // 7 お問い合わせ：contact thanks////final_contact
    $action = "エージェンシー企業の掲載の削除";
    $user_name = "boozer";
} else if(isset($_GET['login'])) {
  $action = "アカウントの登録";
  $user_name = "new_agency";
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="./css/reset.css">
  <link rel="stylesheet" href="./css/index.css">
</head>
<body>
<?php 
    // if($user_name === "boozer" || $user_name === "agency") {
    //   include (dirname(__FILE__) . "/" . "admin/" . $user_name . "/" . $user_name . "_header.php");
    // }else{
    //   include (dirname(__FILE__) . "/" . $user_name . "/" . $user_name . "_header.php");
    // }
    ?>
  <header>
    <div class="headertitle">
      <p class="craft">CRAFT</p>
      <p class="craftby">by</p>
      <img src="../../img/syukatudotcom_logo_white.png" alt="就活.com">
    </div>
  </header>
  <div class="main">
    <h2 class="pagetitle"><?php print_r($action);?>完了</h2>
    <div>
      <p class="announce"><?php print_r($action);?>が完了しました</p>
      <a href="
        <?php if($user_name === "boozer"):?>
        ../admin/boozer/index.php
        <?php elseif($user_name === "agency"): ?>
        ../admin/agency/index.php
        <?php elseif($user_name === "new_agency"): ?>
          ../admin/agency/top.php
        <?php else : ?>
          ../student/index.php
        <?php endif;?>
      " class="returnbtn">Top画面に戻る</a>
    </div>
  </div>
  <footer>
    <img src="../../img/boozer_logo_white.png" alt="boozer">
  </footer>
  <?php 
  // if($user_name === "boozer" || $user_name === "agency") {
  //   // include (dirname(__FILE__) . "/" . "admin/" . $user_name . "/" . $user_name . "_footer.php");
  //   // echo('<script src="./admin/boozer/boozer.js"></script>');
  // } elseif($user_name === "agency") {
  //   include (dirname(__FILE__) . "/" . "admin/" . $user_name . "/" . $user_name . "_footer.php");
  //   // echo('<script src="../admin/agency/agency.js"></script>');
  // } else {
  //   include (dirname(__FILE__) . "/" . $user_name . "/" . $user_name . "_footer.php");
  //   // echo('<script src="../student/student.js"></script>');
  // }
  ?>
</body>
</html>

