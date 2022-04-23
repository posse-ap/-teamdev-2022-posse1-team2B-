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
--     登録カラム : id, name, urls, notification_mail, tel_num, post_num, prefectures, municipalities, adress-numbers, access_num, erro_num  
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
--     抽出カラム : name, mails, access_num, error_num
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



    

-- students_table作成
DROP TABLE IF EXISTS students;
CREATE TABLE students (
  id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  student_name VARCHAR(255) NOT NULL,
  post_number VARCHAR(255) UNIQUE NOT NULL,
  prefecture VARCHAR(255) NOT NULL,
  municipalitie VARCHAR(255) NOT NULL,
  adress_number VARCHAR(255) UNIQUE NOT NULL,
  tel_number INT UNIQUE NOT NULL,
  email VARCHAR(255) UNIQUE NOT NULL,
  coledge_id INT,
  graduation_year INT NOT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

DROP TABLE IF EXISTS colleges;
CREATE TABLE colleges (
  id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  college_name VARCHAR(255) NOT NULL,
  undergraduate VARCHAR(255) NOT NULL,
  college_department VARCHAR(255) NOT NULL
);

-- agents_table作成

DROP TABLE IF EXISTS agents;
CREATE TABLE agents (
  id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  agent_name VARCHAR(255) NOT NULL,
  url VARCHAR(255) UNIQUE NOT NULL,
  notification_email VARCHAR(255) UNIQUE NOT NULL,
  tel_number INT UNIQUE NOT NULL,
  post_number VARCHAR(255) UNIQUE NOT NULL,
  prefecture VARCHAR(255) NOT NULL,
  municipalitie VARCHAR(255) NOT NULL,
  adress_number VARCHAR(255) UNIQUE NOT NULL,
  category VARCHAR(255) UNIQUE NOT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
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


DROP TABLE IF EXISTS intermediate;
CREATE TABLE intermediate (
  id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  agent_id INT NOT NULL,
  student_id INT NOT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);