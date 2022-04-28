<?php
// もしname属性がformの送信ボタンを押したら、この文言を出力する
$action = "";
if(isset($_POST['form'])){
  $action = "エージェンシー企業の掲載";
};
$user_name = "student";
// else if (isset($_POST[''])) {
//   $action = "登録情報の修正";
// } else if (isset($_POST[''])) {
//   $action = "掲載の申請";
// } else if (isset($_POST[''])) {
//   $action = "掲載情報の修正依頼";
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
  <!-- include で別ディレクトリのファイルを持ってこようとすると、エラーを履く→どうすればいい？ -->
  <span><?php print_r($action);?>完了</span>
  <div>
  <p><?php print_r($action);?>が完了しました</p>
  <a href="./index.php">Top画面に戻る</a>
  </div>
</body>
</html>

