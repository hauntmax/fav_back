# zorra_test
<h2>Необходимо установить docker и docker-compose</h2>

- <h3>Проверка версий </h2>
- docker -v
- doсker-compose -v

- <h3>Данный проект был собран используя следующие версии</h3>
- <code>Docker version 20.10.23, build 7155243</code>
- <code>docker-compose version 1.29.2, build 5becea4c</code>

<h2>После установки docker и docker-compose нужно выполнить команды из директории с проектом</h2>

- <code>cp .env.example .env</code>
- <code>docker-compose build --build-arg USER_ID="$(id -u)" --build-arg USER="$(whoami)"</code>
- <code>docker-compose up -d</code>
- <code>sudo -- sh -c -e "echo 127.0.0.1 zorra.test >> /etc/hosts"</code>
- <code>docker-compose exec app php artisan key:generate</code>
- <code>docker-compose exec app composer install</code>
- <code>docker-compose exec app php artisan migrate</code>
