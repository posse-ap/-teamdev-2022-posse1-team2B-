<?php
require("../../dbconnect.php");


$stmt = $db->prepare('select * from agents');
// $stmt->bindValue(':agent_id', $agent['id']);
  // bindevalueの１が？の１個めってこと。これがあれば何個でもはてなつけられる！1,2とかだとわかりにくいから、「:agent_id」を設定する
  $stmt->execute();
  $agents = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>agentslist</title>
  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
</head>
<body>
  <?php include (dirname(__FILE__) . "/boozer_header.php");?>
  <h2>掲載企業一覧</h2>
  <?php foreach ($agents as $index => $agent) : ?>
  <div>
    <!-- <a href="./edit.php?agent_name=<?php //echo $index + 1; ?>"> -->
    <form method="POST" action="edit.php">
      <img src="" alt="">
      <h3><?=$agent['agent_name'] ?></h3>
      <input type="hidden" name="agent_id" value="<?php Echo $index+1; ?>">
      <input type="submit" name="edit" value="編集">
      <input type='submit' formaction='delete.php' name='delete' value ='削除'>
    <!-- </a> -->
    </form>
  </div>
  <?php endforeach; ?>
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

