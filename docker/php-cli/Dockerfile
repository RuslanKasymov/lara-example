FROM registry.gitlab.com/wola-docker/php-alpine:8.2-cli-alpine

WORKDIR /app

RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

ARG SSH_PRIVATE_KEY
RUN mkdir /root/.ssh/
RUN echo "$SSH_PRIVATE_KEY" > /root/.ssh/id_rsa && chmod 600 /root/.ssh/id_rsa
RUN touch /root/.ssh/known_hosts
RUN ssh-keyscan gitlab.com >> /root/.ssh/known_hosts
