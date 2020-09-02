# da_laravel
По мотивам: https://youtu.be/gH_QA_APPq8 <br>

1.  Устанавливаем composer. Переходим в каталог проекта и выполняем:<br>
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"<br>
php -r "if (hash_file('sha384', 'composer-setup.php') === '8a6138e2a05a8c28539c9f0fb361159823655d7ad2deecb371b04a83966c61223adc522b0189079e3e9e277cd72b8897') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"<br>
php composer-setup.php<br>
php -r "unlink('composer-setup.php');"<br><br>

2.  Глобальная установка (если впервые) <br>
php composer.phar global require laravel/installer <br><br>

3.  Локальная установка <br>
php composer.phar create-project --prefer-dist laravel/laravel blog

