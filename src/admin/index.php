<?php
session_start();
// セッション　コンピュータのサーバ側に一時的にデータを保存する仕組み
// session_start() セッション処理開始し、保存できる
require('../dbconnect.php'); //外部ファイルの読み込み
if (isset($_SESSION['user_id']) && $_SESSION['time'] + 60 * 60 * 24 > time()) { // もしuser_idというセッション変数に値がセットされていて、時間が1日経過していなかったら
    // isset関数 変数に値がセットされていて、かつNULL出ないときにTRUEを返す
    // $_SESSION[''] セッション変数を呼び出す

    $_SESSION['time'] = time(); //セッション変数に登録

    //もしPOST送信された場合、titleというname属性のついたformに入力された値をeventsテーブルのtitleカラムに追加する。そして指定したページに遷移する。そうでなかった場合は、指定したページに遷移する
    if (!empty($_POST)) { //POST送信された場合
        // empty関数 変数や配列の値が0あるいは空、NULLの時にTRUEを返す
        $stmt = $db->prepare('INSERT INTO events SET title=?'); // eventsテーブルにデータを追加する
        $stmt->execute(array(
            $_POST['title']  //titleというname属性の付いたHTML POSTメソッドに入力された値を受け取る
            // ポスト変数。HTTP POSTメソッドで送信された値を取得する。HTML入力フォームの値を受信する
        ));

        header('Location: http://' . $_SERVER['HTTP_HOST'] . '/admin/index.php');
        // header関数 HTTPヘッダー情報を送信。第1引数はヘッダ文字列を指定
        // HTTPヘッダー HTTPによるリクエスト→レスポンスの流れで、どのような情報をリクエストしてどのようなコンテンツを受け取るかを定義するためのもの
        // header(Location: ) 指定したページにリダイレクト。リダイレクトする際には、以降のコードが実行されないようにexit()を指定して処理を終了する
        exit();
    }
} else {
    header('Location: http://' . $_SERVER['HTTP_HOST'] . '/admin/login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理者ログイン</title>
</head>

<body>
    <div>
        <h1>管理者ページ</h1>
        <form action="/admin/index.php" method="POST">
            イベント名：<input type="text" name="title" required>
            <input type="submit" value="登録する">
        </form>
        <a href="/index.php">イベント一覧</a>
    </div>
</body>

</html>