<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>agentslist</title>
</head>
<body>
  <h2>掲載企業一覧</h2>
  <?php foreach ($hoges as $hoge) : ?>
  <div>
    <img src="" alt="">
    <h3>エージェントA</h3>
    <a href="edit.php">編集</a>
    <!-- これを押したらedit.phpのこのモーダルってやり方がわかりません。。。。。
    edit.phpの一覧からならボタンのIDから出せるんですけど、別ファイルからってなるとイメージつかないです。。。。 -->
    <button>削除</button>
  </div>
  <?php endforeach; ?>
</body>
</html>

Ajax
編集をクリックしたらモーダルを出す
編集というボタンにIDをもたせて、非同期処理でエージェント情報を引っ張ってくる
＜もって着方＞
phpをhtmlで出すってことを今まではしていた
代わりに、phpでジェイソン(編集にあるIDに紐づくエージェント情報を整形して、ジェイソン形式で返す)を返すようにしてあげる

それをAPIで呼び出せるようにしておいて、それに対してクリックしたらFetchを使って呼び出して、モーダルで表示してみる

Slackでも！！！！！！！！！！！！