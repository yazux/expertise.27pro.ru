# Развертка проекта

- Перенести и распаковать архив с сайтом на требуемый VPS
- Установить права 777 на папку ./storage
- Созать symlink папки ./storage в папке ./public
- Выполнить команду composer install
- Выполнить команду npm install
- Выполнить команду php composer dump-autoload
- В файле .env установить настройки БД и ключей **APP_DEBUG**, **APP_URL** (Пример можно смотреть в файле .env.example)
- В файле .env установить значение ключа **YA_API_KEY**, требуется установить действительный ключ сервиса Яндекс.Карты (Пример можно смотреть в файле .env.example)
- Требуется в конфигурации сервера изменить настройки сервера БД, установить повышенные тайминги, размер кеша сортировки, максимальный размер пакета, размер буфера чтения так как во время импорта из БД будут доставаться большие объемы данных

# Требования к серверу

## Основные параметры

- VPS, обычный шаред хостинг не подойдет
- CPU 2 ядра и более
- RAM 2гб и более
- SSD 30гб и более (HDD не использовать, сильно скажется на скорости отрисовки карты)
- OS Ubuntu 18.*
- ISP панель (Vesta/ISPManager)
- MySql 5.*
- php 7.1
- Composer
- npm
- Доступ к серверу по SSH

## Расширения на сервере

- PHP OpenSSL
- PHP PDO
- PHP Mbstring
- PHP Tokenizer
- PHP XML

# Как вносить изменения в Frontend часть

- Выполнить команду **npm run watch**
- Далее можно вносить изменения
- Frontend выполнен на Vue.js
- Находится в папке resources/js
- Компоненты Vue.js находятся в resources/js/components
- Регистрация компонентов выполняется в resources/js/components/app.js
- При использовании компонента в blade шаблонах обязательно указывать его id, иначе инициализация не произайдет