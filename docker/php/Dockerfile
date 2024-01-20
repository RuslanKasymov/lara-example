FROM registry.gitlab.com/wola-docker/php-alpine:8.2-cli-alpine

RUN apk add  --no-cache \
    nodejs \
    npm \
    graphviz

RUN pecl install -o -f xdebug &&  rm -rf /tmp/pear && \
    docker-php-ext-enable xdebug

WORKDIR /app


RUN npm install -g --save-dev chokidar
ENV NODE_PATH="/usr/local/lib/node_modules"

RUN git config --system --add safe.directory '*'

EXPOSE 6001
EXPOSE 6002
EXPOSE 8080
