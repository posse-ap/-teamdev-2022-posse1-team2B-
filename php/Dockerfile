FROM php:8.1-fpm
RUN docker-php-ext-install pdo_mysql

FROM mysql:8.0

# COPY my.cnf /etc/mysql/conf.d/my.cnf

# wgetをインストールするよう修正
RUN apt-get update && apt-get install -y wget

# ホスト環境で作ったmailhog.iniをコンテナにコピー
COPY mailhog.ini /usr/local/etc/php/conf.d/mailhog.ini

# mhsendmailコマンドのインストール。CURLでダウンロードしてインストールします。
RUN curl -sSL https://github.com/mailhog/mhsendmail/releases/download/v0.2.0/mhsendmail_linux_amd64 -o mhsendmail \
    && chmod +x mhsendmail \
    && mv mhsendmail

# 日本語環境を追加
RUN apt-get update && apt-get install -y locales \
    && sed -i -e 's/# \(ja_JP.UTF-8\)/\1/' /etc/locale.gen \
    && locale-gen \
    && update-locale LANG=ja_JP.UTF-8
# ここまで

ENV LC_ALL ja_JP.UTF-8

ENV TZ Asia/Tokyo
ENV LANG=ja_JP.UTF-8

CMD ["mysqld"]

EXPOSE 3306
