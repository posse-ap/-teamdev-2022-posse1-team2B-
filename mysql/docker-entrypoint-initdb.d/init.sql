  -- 必要なデータ

-- 学生画面
-- 閲覧
--   月間ランキング
--     使用するテーブル : agents
--     抽出条件 : SUM(access_num)上から10 
--     抽出カラム : name, category, area
--   業種別ランキング
--     使用するテーブル : agents
--     抽出条件 : SUM(access_num)上から10 WHERE category = ?
--     抽出カラム : name, area
--   対応エリア別ランキング
--     使用するテーブル : agents
--     抽出条件 : SUM(access_num)上から10 WHERE area = ?
--     抽出カラム : name, category
--   こだわり条件別結果
--     使用するテーブル : agents
--     抽出条件 : どうやって抽出したらいいかわかりません!!!!!!!!!!!!!!!!!!!!!!!!!
--     抽出カラム : name
-- 使用
--   自分のデータ
--     使用するテーブル : students, coledge
--     登録カラム : id, name, dates, post_num, prefectures, municipalities, adress-numbers, mails, tell_num, coledge_id, graduation_year, error
--              : id, name, undergraduates, departments


-- エージェント管理画面
-- 閲覧
--   学生情報
--     使用するテーブル : students
--     抽出条件 : select * from students innerjoin 中間テーブル innnerjoin agents where student_id = student.id, agent_id = agents.id
--     抽出カラム : id以外のすべてのデータ
-- 使用
--   ログイン
--     使用するテーブル : managers
--     使用条件 : id, passwordが等しい
--   自分のデータ
--     使用するテーブル : agents, manage
--     登録カラム : id, name, urls, notification_mail, tel_num, post_num, prefectures, municipalities, adress-numbers
--     エラーがtrueになったら、そのIDを持ってるエージェントのerror_numがカウントされるとかしたい!!!!!!!!!!!!!!!!!
--              : id, user_id, passwords, agent_id, names, departments, mails, roll
   


-- boozer管理画面
-- 閲覧
--   掲載企業一覧
--     使用するテーブル : agents
--     抽出条件 : select * from agents
--     抽出カラム : name, access_num
--   学生情報
--     使用するテーブル : students, coledges
--     抽出条件 : where date = 今月
--     抽出カラム : name, coledges:name, undergraduates, departments
--   明細
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
  email VARCHAR(255) UNIQUE NOT NULL,
  password VARCHAR(255) NOT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO
  users
SET
  email = 'test@posse-ap.com',
  password = sha1('password');
  -- shaってなに？？？？？？？？？？？？？？？？？？？？

-- INSERT INTO users
--    (email, password)
-- VALUES
--   ('test@posse-ap.com', ),
  
    

-- students_table作成
DROP TABLE IF EXISTS students;
CREATE TABLE students (
  id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  student_name VARCHAR(255) NOT NULL,
  post_number VARCHAR(255) UNIQUE NOT NULL,
  prefecture VARCHAR(255) NOT NULL,
  municipalitie VARCHAR(255) NOT NULL,
  adress_number VARCHAR(255) UNIQUE NOT NULL,
  tel_number VARCHAR(255) UNIQUE NOT NULL,
  email VARCHAR(255) UNIQUE NOT NULL,
  coledge_id INT,
  undergraduate VARCHAR(255) NOT NULL,
  college_department VARCHAR(255) NOT NULL,
  graduation_year INT NOT NULL,
  valid TINYINT(1) NOT NULL DEFAULT '0',
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- ダミーデータ登録
INSERT INTO students
  (student_name, post_number, prefecture, municipalitie, adress_number, tel_number, email, coledge_id, undergraduate, college_department, graduation_year)
VALUES
  ('葛西志保', '222-2222', '神奈川県', '横浜市', '日吉1234-56', '08033464823', 'shiho.ks.keio.jp', 1, '医学部', '医学科', 26),
  ('千羽まりあ', '111-1111', '東京都', '港区', '広尾2345-67', '08099590435', 'moliaquu.co.jp', 1, '経済学部', 'ミクロ落単', 24),
  ('石川朝香', '333-3333', '神奈川県', '藤沢市', '亀井野1850-17', '08091865315', 'asaka.ishikawa@posse-ap.com', 1, '理工学部', 'システムデザイン工学科', 25);

DROP TABLE IF EXISTS colleges;
CREATE TABLE colleges (
  id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  college_name VARCHAR(255) NOT NULL
);

-- ダミーデータ登録
INSERT INTO
  colleges
SET
  college_name = '慶應義塾大学';


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
  category VARCHAR(255) UNIQUE NOT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO agents
   (agent_name, url, notification_email, tel_number, post_number, prefecture, municipalitie, adress_number, category)
VALUES
  (
    'リクナビ', 
    'https://www.r-agent.com/entry/ts/?param=a-brand-1007&vos=evnarag7000xac_2399729792_cm_1721857628_gp_68037326872_cr_569695960012_kw_kwd-2389242410_dv_c_sl_&gclid=CjwKCAjwx46TBhBhEiwArA_DjMyL9LHPfmYNJVUuNukw_Pv6a_ooBzMNomO4CGYCwB3CethPaS0YqRoCxawQAvD_BwE', 
    'rikunabi_boozer.com',
    '0120123456',
    234-5678, 
    '東京都',
    '品川区', 
    '大崎1-2-3',
    'IT業界'
  ),
  (
    '就活ジャーナル', 
    'https://journal.rikunabi.com/',
    'shukatsujournal_boozer.com',
    '0120789123',
    987-6543, 
    '東京都',
    '港区', 
    '表参道3-4-5',
    '飲食業界'
  );


DROP TABLE IF EXISTS managers;
CREATE TABLE managers (
  id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  agent_id INT NOT NULL,
  user_id INT NOT NULL,
  manager_name VARCHAR(255) NOT NULL,
  agent_department VARCHAR(255) NOT NULL,
  roll INT NOT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO managers
   (agent_id, user_id, manager_name, agent_department, roll)
VALUES
  (1, 2, '佐藤大暉', '人事部', 1),
  (1, 3, '高橋日菜', '営業部', 2),
  (2, 4, '吉沢亮', '人事部', 1),
  (2, 5, '横浜流星', '営業部', 2),
  (2, 6, 'bekhyon', '営業部', 2);



DROP TABLE IF EXISTS intermediate;
CREATE TABLE intermediate (
  id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  agent_id INT NOT NULL,
  student_id INT NOT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);