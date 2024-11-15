<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>
<p align="center"><a href="https://vuejs.org/"><img src="https://www.mindinventory.com/blog/wp-content/uploads/2023/05/vuejs-logo.webp" alt="vue.js"></a></p>

<p align="center">
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
</p>

---   
# Laravel 9 + Vue 3 + Vite = SPA
---  

### Create api routes file
`php artisan install:api`

### Для создания файла smart-grid.less || smart-grid.less используй команду
`node smartgrid.js`

### Оптимизация и Очистка кэша
`composer dumpautoload -o`  
`php artisan config:cache & php artisan route:cache & php artisan cache:clear & php artisan config:clear & php artisan view:cache`

### Фронт разработка:
##### Версия Node.js  v16.14.2

- создай зависимости  
  `npm install`  || `yarn install`
- разработка  
  `php artisan serve`   
  &    
  `npm run dev`  || `yarn run dev`
- сборка проекта  
  `npm run build`  || `yarn run build`

### Выполнить миграции
`php artisan migrate`


### Создание лайтовой ссылки для хранилища
`php artisan storage:link`


### Генерация ключа для .env
`php artisan key:generate`


### Что бы работали роли
`php artisan db:seed`


### Для создания файла smart-grid.less используй команду
`node smartgrid.js`


### Создать критический и ассинхронный css файлы
`node critical.js`


### В случае 500 - ой ошибки проверь
`.htaccess`  
`routes`  
`.env`  
`миграции`


### Узнать занятый порт:
`sudo lsof -t -i:80`  
`sudo kill 22940`

### Дать разрешения
`sudo chown -R $USER:$USER /var/www/html/public`  
`chmod 755 project/`  
`chmod 755 project/public/`  
`chmod 644 project/public/index.php`  
`sudo apachectl -t -D DUMP_MODULES | grep rewrite`

### Работать с ssl -> https
`./ngrok http 8000`

>Крайний случай!!!    
`chmod -R 777 storage`  
`chmod -R 777 bootstrap/cache`  
`chmod -R 0777 storage/`
