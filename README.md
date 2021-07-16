# VIDVIDAY
## Системные Требования

- PHP версии 7.4 и выше
- MYSQL версии 5.7 и выше
- NodeJS версии 12 и выше

## Установка

Переименуйте файл `.env.examle`  в корне проекта в файл `.env`

Установите пакеты с помощью [composer](https://getcomposer.org/)
вызвав команду `composer install` в консоли.

Установите пакеты с помощью [npm](https://www.npmjs.com/)
вызвав команду `npm install` в консоли.

Создайте свою базу данных на своем сервере и обновить в файле .env следующие строки:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

Сгенерируйте ключ безопастности с помощью команды  
`php artisan key:generate`

Запустите миграции базы данных с помощью команды  
`php artisan migrate`

Заполните базу данных:  
`php artisan db:seed`

После того, как ваш проект установлен, вы должны запустить команду, чтобы связать вашу общую папку хранилища для
загрузки файлов:  
`php artisan storage:link`


## Разработка

Попередження:
Після того як добавились нові "route":
`php artisan cache:clear`
`php artisan route:cache`

Файлы стилей и скриптов создаются с использованием Laravel Mix, который является оболочкой для многих инструментов и
работает с файлом webpack.mix.js в корне проекта.

Вы можете построить их с помощью команды:  
`npm run <command>`

Доступные команды перечислены в верхней части файла package.json под ключом «scripts».

## Панель администратора
Находится по адресу *http://stitename.com/admin*

Учетные данные администратора по умолчанию:  
**Username:** admin@vidviday.org.ua  
**Password:** secret12345


## Библиотеки и пакеты

- PHP Фреймворк [Laravel 8](https://laravel.com/)
- CSS Фреймворк [Bootstrap 5](https://getbootstrap.com/)
- JS фреймворк [Vue.js](https://vuejs.org/)
- Управление ролями и доступом [Laravel Permission](https://spatie.be/docs/laravel-permission/v4/introduction)
- Связывание всевозможных файлов с моделями [Laravel Medialibrary](https://spatie.be/docs/laravel-medialibrary/v7/introduction)
- Переводы моделей [Laravel Translatable](https://github.com/spatie/laravel-translatable)

#### В админке также подключены
- Фреймворк [Laravel Livewire](https://laravel-livewire.com/)
- Иконки [Feather](https://feathericons.com/)
- JS фреймворк [Alpine.js](https://github.com/alpinejs/alpine) (альтернатива vue.js)

#### Рекомендуемые пакеты
- В качестве альтернативы [Pusher](https://pusher.com/) можно использовать
  [Laravel WebSockets](https://beyondco.de/docs/laravel-websockets/getting-started/introduction)
  
### Fix Your Code
Fix your code with Laravel Coding Standards.

Syntax:
```
$ php artisan fixer:fix [options]
```

Example:
```
Usage:
  fixer:fix [options] [--] [<path>...]

Arguments:
  path                               The path. Can be a list of space separated paths

Options:
      --path-mode=PATH-MODE          Specify path mode (can be override or intersection). [default: "override"]
      --allow-risky=ALLOW-RISKY      Are risky fixers allowed (can be yes or no).
      --config=CONFIG                The path to a .php-cs-fixer.php file.
      --dry-run                      Only shows which files would have been modified.
      --rules=RULES                  The rules.
      --using-cache=USING-CACHE      Does cache should be used (can be yes or no).
      --cache-file=CACHE-FILE        The path to the cache file.
      --diff                         Also produce diff for each file.
      --format=FORMAT                To output results in other formats.
      --stop-on-violation            Stop execution on first violation.
      --show-progress=SHOW-PROGRESS  Type of progress indicator (none, dots).
  -h, --help                         Display help for the given command. When no command is given display help for the list command
  -q, --quiet                        Do not output any message
  -V, --version                      Display this application version
      --ansi                         Force ANSI output
      --no-ansi                      Disable ANSI output
  -n, --no-interaction               Do not ask any interactive question
      --env[=ENV]                    The environment the command should run under
  -v|vv|vvv, --verbose               Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug
  
```
