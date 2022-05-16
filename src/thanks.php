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
  $user_name = "admin";
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

// 見た目が一緒→見た目の部分だけファイル作って、includeで出力。
// 共通部分だけ同じファイル。→urlが違うなら、別ファイルにする
// コンタクトページ→サンクスページの場合はcontact/thanksみたいになるはず
// どこのページから送ったかが定かな方がいい→エージェントと学生両方のアカウントを持っていて、両方から送って平きっぱにしてた場合、どっちで何送ったっけ？になる
// リロードしても～が完了しました、の～の部分が変わらなければ大丈夫
// 余裕があれば別ファイルにする
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
  <?php if(isset($_POST[""]))
  <?php include (dirname(__FILE__) . "/" . $user_name . "/" . $user_name . "_header.php");?>
  <span><?php print_r($action);?>完了</span>
  <div>
  <p><?php print_r($action);?>が完了しました</p>
  <a href="./index.php">Top画面に戻る</a>
  </div>
  <?php include (dirname(__FILE__) . "/" . $user_name . "/" . $user_name . "_footer.php");?>
</body>
</html>

