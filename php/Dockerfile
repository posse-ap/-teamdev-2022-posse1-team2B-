FROM php:8.1-fpm
RUN docker-php-ext-install pdo_mysql

# wgetをインストールするよう修正
RUN apt-get update && apt-get install -y wget

# RUN cp /usr/local/etc/php/php.ini-production /usr/local/etc/php/php.ini
COPY ./php.ini /usr/local/etc/php/php.ini

#mhsendmailのインストールを追加
RUN curl -sSL https://github.com/mailhog/mhsendmail/releases/download/v0.2.0/mhsendmail_linux_amd64 -o mhsendmail \
    && chmod +x mhsendmail \
    && mv mhsendmail /usr/local/bin/mhsendmail

# ホスト環境で作ったmailhog.iniをコンテナにコピー
# COPY mailhog.ini /usr/local/etc/php/conf.d/mailhog.ini

# FROM golang:1.15 AS builder
# RUN go get -d -v github.com/mailhog/mhsendmail \
#     && cd /go/src/github.com/mailhog/mhsendmail/ \
#     && GOOS=linux GOARCH=arm64 go build -o mhsendmail .

# FROM wordpress:php7.4-apache
# #  Install mhsendmail
# COPY --from=builder /go/src/github.com/mailhog/mhsendmail/mhsendmail /usr/local/bin/
# RUN chmod +x /usr/local/bin/mhsendmail \
#      && echo 'sendmail_path = "/usr/local/bin/mhsendmail --smtp-addr=mail:1025"' > /usr/local/etc/php/conf.d/sendmail.ini

# 日本語環境を追加
RUN apt-get update && apt-get install -y locales \
    && sed -i -e 's/# \(ja_JP.UTF-8\)/\1/' /etc/locale.gen \
    && locale-gen \
    && update-locale LANG=ja_JP.UTF-8
# ここまで

ENV LC_ALL ja_JP.UTF-8

ENV TZ Asia/Tokyo
ENV LANG=ja_JP.UTF-8

# CMD ["mysqld"]F

EXPOSE 3306
