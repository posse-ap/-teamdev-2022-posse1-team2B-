--   こだわり条件別結果
--     使用するテーブル : agents
--     抽出条件 : select name, area, category from agents innerjoin access;
--     どうやって抽出したらいいかわかりません!!!!!!!!!!!!!!!!!!!!!!!!!
-- データベースのカラムにカンマ区切りは良くないから使わないようにしましょう
-- 1つずつのカラムを作る必要がない
-- feature,tagみたいなテーブルを作って、そこに「大企業紹介」「体育会系」などをマスターデータでおいておく。そのタグとエージェントがn:nで用意する感じ
-- それが存在してる分だけ、取ってくるみたいにできる

-- 使用
--   ログイン
--     使用するテーブル : managers
--     使用条件 : id, passwordが等しい   


-- boozer管理画面
-- 閲覧
-- -   明細
--     使用するテーブル : agents, 中間, students
--     抽出条件 : SUM(access_num) where date = 今月
--     抽出カラム : name, mails
-- 使用
--   ログイン
--     使用するテーブル : admin
--     使用条件 : id, passwordが等しい
--   掲載作成・編集
--     使用するテーブル : agents
--     登録カラム : 上で登録していいけど、認証済みかどうかというカラムで、trueのものだけ学生画面に表示

DROP SCHEMA IF EXISTS shukatsu;

CREATE SCHEMA shukatsu;

USE shukatsu;

DROP TABLE IF EXISTS users;

CREATE TABLE users (
  id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  login_email VARCHAR(255) UNIQUE NOT NULL,
  password VARCHAR(255) NOT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO
  users
SET
  login_email = 'test@posse-ap.com',
  password = sha1('password');
  
-- students_table作成
DROP TABLE IF EXISTS students;
CREATE TABLE students (
  id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  student_last_name VARCHAR(255) NOT NULL,
  student_first_name VARCHAR(255) NOT NULL,
  student_last_name_kana VARCHAR(255) NOT NULL,
  student_first_name_kana VARCHAR(255) NOT NULL,
  post_number VARCHAR(255) UNIQUE NOT NULL,
  prefecture VARCHAR(255) NOT NULL,
  municipality VARCHAR(255) NOT NULL,
  adress_number VARCHAR(255) UNIQUE NOT NULL,
  tel_number VARCHAR(255) UNIQUE NOT NULL,
  email VARCHAR(255) UNIQUE NOT NULL,
  college_name VARCHAR(255),
  undergraduate VARCHAR(255) NOT NULL,
  college_department VARCHAR(255) NOT NULL,
  graduation_year INT NOT NULL,
  valid TINYINT(1) NOT NULL DEFAULT '0',
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);


-- agents_table作成

DROP TABLE IF EXISTS agents;
CREATE TABLE agents (
  id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  agent_name VARCHAR(255) NOT NULL,
  url VARCHAR(255) UNIQUE NOT NULL,
  notification_email VARCHAR(255) UNIQUE NOT NULL,
  tel_number  VARCHAR(255) UNIQUE NOT NULL,
  post_number VARCHAR(255) UNIQUE NOT NULL,
  prefecture VARCHAR(255) NOT NULL,
  municipalitie VARCHAR(255) NOT NULL,
  adress_number VARCHAR(255) UNIQUE NOT NULL,
  category VARCHAR(255) NOT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);


DROP TABLE IF EXISTS managers;
CREATE TABLE managers (
  id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  agent_id INT NOT NULL,
  user_id INT NOT NULL,
  manager_last_name VARCHAR(255) NOT NULL,
  manager_first_name VARCHAR(255) NOT NULL,
  manager_last_name_kana VARCHAR(255) NOT NULL,
  manager_first_name_kana VARCHAR(255) NOT NULL,
  agent_department VARCHAR(255) NOT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

DROP TABLE IF EXISTS intermediate;
CREATE TABLE intermediate (
  id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  agent_id INT NOT NULL,
  student_id INT NOT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);


INSERT INTO students
  (student_last_name, student_first_name, student_last_name_kana, student_first_name_kana, post_number, prefecture, municipality, adress_number, tel_number, email, college_name, undergraduate, college_department, graduation_year)
VALUES
  ('葛西', '志保', 'カサイ', 'シホ', '222-2222', '神奈川県', '横浜市', '日吉1234-56', '08033464823', 'shiho.ks.keio.jp', '慶應義塾大学', '医学部', '医学科', 26),
  ('千羽', 'まりあ', 'センバ', 'マリア', '111-1111', '東京都', '渋谷区', '広尾2345-67', '08099590435', 'moliaquu.co.jp', '慶應義塾大学', '経済学部', 'ミクロ落単', 24),
  ('渡辺', '瑛貴', 'ワタナベ', 'エイキ', '444-4444', '神奈川県', '横浜市', '日吉2222-67', '08032178456', 'eikigenieikichan.co.jp', '慶應義塾大学', '経済学部', '線形代数落単', 24),
  ('石川', '朝香', 'イシカワ', 'アサカ', '333-3333', '神奈川県', '藤沢市', '亀井野1850-17', '08091865315', 'asaka.ishikawa@posse-ap.com', '慶應義塾大学', '理工学部', 'システムデザイン工学科', 25),
  ('佐藤', 'ゆうき', 'サトウ', 'ユウキ', '333-4444', '神奈川県', '妖精の里村', '夢の国コレクション12', '08011111111', 'satochan@posse-ap.com', '慶應義塾大学', '理工学部', 'システムデザイン工学科', 25),
  ('葛島', '将大', 'クズシマ', 'ショウタ', '333-5555', '山形県', '天国の丘町', '夢の国コレクション13', '08022222222', 'masamasa@posse-ap.com', '慶應義塾大学', '理工学部', 'システムデザイン工学科', 25),
  ('加藤', '水生', 'カトウ', 'ミウ', '333-6666', '北海道', '藤沢市', '夢の国コレクション14', '08033333333', 'miuparu@posse-ap.com', '北海道大学', '理工学部', 'システムデザイン工学科', 25),
  ('辻', 'ららん', 'ツジ', 'ララン', '333-7777', '広島県', '妖精の里村', '夢の国コレクション15', '08044444444', 'raran_juna@posse-ap.com', '早稲田大学', '理工学部', 'システムデザイン工学科', 25),
  ('小野里', '美晴', 'オノザト', 'ミハル', '333-8888', '神奈川県', '藤沢市', '夢の国コレクション16', '08055555555', 'hakumiharu@posse-ap.com', '慶應義塾大学', '理工学部', 'システムデザイン工学科', 25),
  ('西山', '愛乃', 'ニシヤマ', 'アイノ', '333-9999', '香川県', '天国の丘町', '夢の国コレクション17', '08066666666', 'micoaino@posse-ap.com', '早稲田大学', '理工学部', 'システムデザイン工学科', 25),
  ('戸川', '笑花', 'トガワ', 'エミカ', '333-1111', '神奈川県', '妖精の里村', '夢の国コレクション18', '08077777777', 'piaaaa@posse-ap.com', '早稲田大学', '理工学部', 'システムデザイン工学科', 25),
  ('坂田', '和哉', 'サカタ', 'カズヤ', '333-2222', '神奈川県', '藤沢市', '夢の国コレクション19', '08088888888', 'sabuya@posse-ap.com', '東京大学', '理工学部', 'システムデザイン工学科', 25),
  ('吉田', '晴', 'ヨシダ', 'セイ', '333-3334', '神奈川県', '藤沢市', '夢の国コレクション20', '08099999999', 'seiyoshida@posse-ap.com', '東京大学', '理工学部', 'システムデザイン工学科', 25),
  ('知念', '啓人', 'チネン', 'ケイト', '333-4445', '神奈川県', '妖精の里村', '夢の国コレクション21', '08000000000', 'keito.c@posse-ap.com', '北海道大学', '理工学部', 'システムデザイン工学科', 25),
  ('斎藤', '偲恩', 'サイトウ', 'シオン', '333-5556', '神奈川県', '天国の丘町', '夢の国コレクション22', '08012222222', 'shionol@posse-ap.com', '筑波大学', '理工学部', 'システムデザイン工学科', 25),
  ('平野', '隆二', 'ヒラノ', 'リュウジ', '333-6667', '東京都', '妖精の里村', '夢の国コレクション23', '08013333333', 'ryujiperu@posse-ap.com', '京都大学', '理工学部', 'システムデザイン工学科', 25),
  ('山田', '涼介', 'ヤマダ', 'リョウスケ', '333-7778', '沖縄県', '藤沢市', '夢の国コレクション34', '080144444444', 'ryousukechan@posse-ap.com', '京都大学', '理工学部', 'システムデザイン工学科', 25),
  ('坂本', '侑斗', 'サカモト', 'ユウト', '333-8889', '神奈川県', '藤沢市', '夢の国コレクション25', '08015555555', 'yutosakamoto@posse-ap.com', '慶應義塾大学', '理工学部', 'システムデザイン工学科', 25),
  ('鈴木', '理沙', 'スズキ', 'リサ', '333-9990', '鹿児島県', '妖精の里村', '夢の国コレクション43', '08016666666', 'risaaaaaa@posse-ap.com', '東京大学', '理工学部', 'システムデザイン工学科', 25),
  ('加藤', '尊', 'カトウ', 'タケル', '333-0000', '鳥取県', '藤沢市', '夢の国コレクション89', '08017777777', 'sontakeru@posse-ap.com', '慶應義塾大学', '理工学部', 'システムデザイン工学科', 25),
  ('石川', '究', 'イシカワ', 'キュウ', '333-1112', '神奈川県', '天国の丘町', '夢の国コレクション78', '08018888888', 'kyu@posse-ap.com', '北海道大学', '理工学部', 'システムデザイン工学科', 25),
  ('小野', '寛太', 'オノ', 'カンタ', '333-3324', '東京都', '藤沢市', '夢の国コレクション03', '08019999999', 'kanchanonoonigiriman@posse-ap.com', '東京大学', '理工学部', 'システムデザイン工学科', 25);

INSERT INTO agents
   (agent_name, url, notification_email, tel_number, post_number, prefecture, municipalitie, adress_number, category)
VALUES
  (
    'リクナビ', 
    'https://www.r-agent.com/entry/ts/?param=a-brand-1007&vos=evnarag7000xac_2399729792_cm_1721857628_gp_68037326872_cr_569695960012_kw_kwd-2389242410_dv_c_sl_&gclid=CjwKCAjwx46TBhBhEiwArA_DjMyL9LHPfmYNJVUuNukw_Pv6a_ooBzMNomO4CGYCwB3CethPaS0YqRoCxawQAvD_BwE', 
    'rikunabi_boozer.com',
    '0120123456',
    '234-5678', 
    '東京都',
    '品川区', 
    '大崎1-2-3',
    'IT業界'
  ),
  (
    '就活ジャーナル', 
    'https://journal.rikunabi.com/',
    'shukatsujounal_boozer.com',
    '0120789012',
    '987-1111', 
    '東京都',
    '港区', 
    '表参道3-4-5',
    '飲食業界'
  ),
  (
    '推しに会える世界線', 
    'https://oshiniaerusekaisen.com/',
    'oshiniaerusekaisen_boozer.com',
    '0120789013',
    '987-2222', 
    '東京都',
    '港区', 
    '表参道3-4-1',
    '飲食業界'
  ),
  (
    'コナンが黒の組織のリーダー', 
    'https://journalblack.konan.com/',
    'blackconan_boozer.com',
    '0120789014',
    '987-3333', 
    '東京都',
    '港区', 
    '表参道3-4-2',
    '飲食業界'
  ),
  (
    '推しと結婚したい', 
    'https://journal.oshikatsu.com/',
    'oshitokekkon_boozer.com',
    '0120789015',
    '987-4444', 
    '東京都',
    '港区', 
    '表参道3-4-3',
    '飲食業界'
  ),
  (
    '就活より推し活', 
    'https://journal.shukatsuoshikatsudocchi.com/',
    'oshikatsushukatsudocchi_boozer.com',
    '0120789016',
    '987-5555', 
    '東京都',
    '港区', 
    '表参道3-4-4',
    '飲食業界'
  ),
  (
    'エラーに苦戦中の藤間', 
    'https://journal.errorfujima.com/',
    'errorfujima_boozer.com',
    '0120789017',
    '987-6666', 
    '東京都',
    '港区', 
    '表参道3-4-6',
    '飲食業界'
  ),
  (
    '世界に１つだけのコンビニ', 
    'https://journal.onlyone.com/',
    'onluone_boozer.com',
    '0120789018',
    '987-7777', 
    '東京都',
    '港区', 
    '表参道3-4-7',
    '飲食業界'
  ),
  (
    '友達100人できるかな', 
    'https://journal.haundredfriends.com/',
    'haundredfriends_boozer.com',
    '0120789019',
    '987-8888', 
    '東京都',
    '港区', 
    '表参道3-4-8',
    '飲食業界'
  ),
  (
    '学校に推しがいるから毎日がバラ色です', 
    'https://journal.barairobarairosekaihaheiwa.com/',
    'barairobarairosekaihaheiwa_boozer.com',
    '0120789010',
    '987-9999', 
    '東京都',
    '港区', 
    '表参道3-4-9',
    '飲食業界'
  );
  

  INSERT INTO managers
   (agent_id, user_id, manager_last_name, manager_first_name, manager_last_name_kana, manager_first_name_kana, agent_department)
VALUES
  (1, 2, '佐藤','大暉', 'サトウ', 'ダイキ', '人事部'),
  (1, 3, '高橋','日菜', 'タカハシ', 'ヒナ', '営業部'),
  (2, 4, '吉沢','亮', 'ヨシザワ', 'リョウ', '人事部'),
  (2, 5, '横浜','流星', 'ヨコハマ', 'リュウセイ', '営業部'),
  (2, 6, 'beckhyon','backchan', 'ベッキョン', 'ベクチャン', '営業部'),
  (3, 7, '藤間','裕史', 'フジマ', 'ユウジ', '営業部'),
  (3, 8, '東','穂', 'ヒガシ', 'ミノリ', '営業部'),
  (4, 9, '松坂','桃李', 'マツサカ', 'トウリ', '営業部'),
  (4, 10, '小松','菜奈', 'コマツ', 'ナナ', '営業部'),
  (5, 11, 'xiumin', 'min', 'シウミン', 'ミン', '営業部'),
  (5, 12, 'Dicaplio', 'Leonardo', 'ディカプリオ', 'レオナルド', '営業部'),
  (6, 13, '佐藤','健', 'サトウ', 'タケル', '営業部'),
  (6, 14, '西川','航平', 'ニシカワ', 'コウヘイ', '営業部'),
  (7, 15, '金子','花蓮', 'カネコ', 'カレン', '営業部'),
  (7, 16, '田上','黎', 'タノウエ', 'レイ', '営業部'),
  (8, 17, '西山','直輝', 'ニシヤマ', 'ナオキ', '営業部'),
  (8, 18, '国本','たいき', 'クニモト', 'タイキ', '営業部'),
  (9, 19, 'Vaundy', 'さん', 'バウンディー', 'サン', '営業部'),
  (9, 20, '多田','かずき', 'ダダ', 'カズキ', '営業部'),
  (10, 21, 'Aespa', 'ちゃん', 'エスパ', 'チャン', '営業部'),
  (10, 22, 'ナタリー','ポートマン', 'ナタリー', 'ポートマン', '営業部'),
  (11, 23, '横浜','流星', 'ヨコハマ', 'リュウセイ', '営業部'),
  (11, 24, '坂本','龍馬', 'サカモト', 'リョウマ', '営業部');

INSERT INTO intermediate
  (student_id, agent_id)
VALUES
  (1,1),
  (2,1),
  (3,2),
  (4,3),
  (5,1),
  (6,3),
  (7,1),
  (8,3),
  (9,1),
  (10,3),
  (11,3),
  (12,1),
  (13,4),
  (14,2),
  (15,5),
  (16,9),
  (17,8),
  (18,9),
  (19,6),
  (20,10),
  (21,10),
  (22,2);

  