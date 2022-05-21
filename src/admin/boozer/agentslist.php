<?php
require("../../dbconnect.php");

$stmt = $db->prepare('select * from agents');
// $stmt->bindValue(':agent_id', $agent['id']);
  // bindevalueの１が？の１個めってこと。これがあれば何個でもはてなつけられる！1,2とかだとわかりにくいから、「:agent_id」を設定する
  $stmt->execute();
  $agents = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>agentslist</title>
  <link rel="stylesheet" href="../../css/reset.css">
  <link rel="stylesheet" href="../../css/index.css">
</head>
<body>
  <?php include (dirname(__FILE__) . "/boozer_header.php");?>
  <div class="main">
   <h2 class="pagetitle">掲載企業一覧</h2>
   <?php foreach ($agents as $agent) : ?>
   <div>
     <img src="" alt="">
     <h3><?=$agent['agent_name'] ?></h3>
     <a href="edit.php" class="editbtn">編集</a>
     <!-- これを押したらedit.phpのこのモーダルってやり方がわかりません。。。。。
     edit.phpの一覧からならボタンのIDから出せるんですけど、別ファイルからってなるとイメージつかないです。。。。 -->
     <button class="deletebtn">削除</button>
   </div>
   <?php endforeach; ?>
  </div>
  <?php include (dirname(__FILE__) . "/boozer_footer.php");?>
</body>
</html>

<!-- Ajax
編集をクリックしたらモーダルを出す
編集というボタンにIDをもたせて、非同期処理でエージェント情報を引っ張ってくる
＜もって着方＞
phpをhtmlで出すってことを今まではしていた
代わりに、phpでジェイソン(編集にあるIDに紐づくエージェント情報を整形して、ジェイソン形式で返す)を返すようにしてあげる

それをAPIで呼び出せるようにしておいて、それに対してクリックしたらFetchを使って呼び出して、モーダルで表示してみる

Slackでも！！！！！！！！！！！！ -->