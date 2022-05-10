<!-- 後で消す -->
<?php
// エージェンシー企業宛ての自動送信メール
// →届かない、、、、、なぜ？

// if(isset($_POST["completion_of_registration"])) {
//     //もし登録完了ボタンが押されたら、自動でメールを送信
//    	// 変数とタイムゾーンを初期化
//     $header = null;
//     $auto_reply_subject = null;
//     $auto_reply_text = null;
//     date_default_timezone_set('Asia/Tokyo');
    
//     // ヘッダー情報を設定
//     $header = "MIME-Version: 1.0\n";
//     $header .= "From: CRAFT <masamari53@gmail.com>\n";
//     $header .= "Reply-To: CRAFT <masamari53@gmail.com>\n";
//     // 件名を設定
//     $auto_reply_subject = 'CRAFTのアカウントの登録が完了しました。';

//     // 本文を設定
//     $auto_reply_text = "この度は、CRAFTのアカウントを登録頂き誠にありがとうございます。
//   下記の内容で登録されました。\n\n";
//     $auto_reply_text .= "お問い合わせ日時：" . date("Y-m-d H:i") . "\n";
//     $auto_reply_text .= "氏名：" . $_POST['company_name'] . "\n";
//     $auto_reply_text .= "CRAFT by 就活.com";

// 	// メール送信
// 	mb_send_mail( $_POST['login_email_address'], $auto_reply_subject, $auto_reply_text, $header);
//   }
// if(isset($_POST["completion_of_registration"])) {
//   $admin_reply_subject = null;
//   $admin_reply_text = null;
//   $header = "MIME-Version: 1.0\n";
//       $header .= "From: CRAFT <masamari53@gmail.com>\n";
//       $header .= "Reply-To: CRAFT <masamari53@gmail.com>\n";
//     // 運営側へ送るメールの件名
//   $admin_reply_subject = "お問い合わせを受け付けました";
      
//   // 本文を設定
//   $admin_reply_text = "下記の内容でお問い合わせがありました。\n\n";
//   $admin_reply_text .= "お問い合わせ日時：" . date("Y-m-d H:i") . "\n";
//   $admin_reply_text .= "氏名：" . $_POST['company_name'] . "\n";
//   $admin_reply_text .= "メールアドレス：" . $_POST['login_email_address'] . "\n\n";

//   // 運営側へメール送信
//   mb_send_mail( 'semba200112@gmail.com', $admin_reply_subject, $admin_reply_text, $header);

// }
//   //変数の初期化
//   // 入力画面や確認画面の表示をスイッチするフラグ
//   // 0→入力画面 1→確認画面
//   $page_flag = 0;
//   // もし会員登録ボタンがおされたら＝フォームデータの中に$_POST[""membership registration"]が含まれていたら→page_flag変数の値を1にする＝確認画面に表示を変える
//   if(isset($_POST["membership_registration"])) {
//     $page_flag = 1;
//     //言語、内部エンコーディングを指定
//     mb_language("japanese");
//     mb_internal_encoding("UTF-8");
//     $admin_reply_subject = null;
//     $admin_reply_text = null;
//     $header = "MIME-Version: 1.0\n";
//         $header .= "From: CRAFT <masamari53@gmail.com>\n";
//         $header .= "Reply-To: CRAFT <masamari53@gmail.com>\n";
//       // 運営側へ送るメールの件名
//     $admin_reply_subject = "お問い合わせを受け付けました";
        
//     // 本文を設定
//     $admin_reply_text = "下記の内容でお問い合わせがありました。\n\n";
//     $admin_reply_text .= "お問い合わせ日時：" . date("Y-m-d H:i") . "\n";
//     $admin_reply_text .= "氏名：" . $_POST['company_name'] . "\n";
//     $admin_reply_text .= "メールアドレス：" . $_POST['login_email_address'] . "\n\n";
  
//     // 運営側へメール送信
//     mb_send_mail( 'masamari53@gmail.com', $admin_reply_subject, $admin_reply_text, $header);
  
//   } 
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
  <p>thanks!</p>
</body>
</html>