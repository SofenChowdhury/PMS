# PMS #
#Require version
Node.js -v 16+
PHP -v 8+
NPM -v 8+
Composer 2.4+
#After git pull
cmd: mv .example.env .env
(From .env)
[
    DB_DATABASE=pmsdb
    DB_USERNAME=root
    DB_PASSWORD=
]
cmd: composer i
cmd: npm i
cmd: php artisan migrate
cmd: php artisan db:seed
cmd: php artisan passport:install
cmd: npm run dev
cmd: php artisan serve
#Admin Credential Access for CRUD Products
{
    'email' => 'md.rabby.mahmud@gmail.com',
    'password' => 'password',
    'phone' => '01719272223',
    'name' => 'Admin'
}
#User Credential Access ONLY VIEW Products
{
    'name' => 'User',
    'email' => 'user@gmail.com',
    'password' => 'password',
    'phone' => '01700718852',
}
###END###
