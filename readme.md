# SCOPE MVC

for live preview [Click me](https://scope-mvc.000webhostapp.com/)

 Scope-mvc: is mini php framework will help you to make your small website faster
 than make it native code, becouse it give you a prrety cool function to help you
 and easy database handler.

 > Notice: this the beta version if you see any bug
 share it to fix at the next version.

# Features!
  - DataBase Handler
  - small template engine
  - Validator helper
  - multi language [English - Arabic] you can add more if you want
  - Session Manager

### Installation

Scope-mvc requires apachi server and mysql [pdo drivers]
> recomended: install xampp, mamp, wamp

Install the dependencies and devDependencies and start the server.
For Xampp users

### 1. you need to make a virtual host in your machine
to make a virtual host open your browser and write this link
```
http://localhost/dashboard/docs/configure-vhosts.html
```
then follow the instructions
but make sure when you add the path of your project
in this case will be scope-mvc at [httpd-vhosts.conf]
make it point to the public directory like that

``` conf
<VirtualHost *:80>
       DocumentRoot "C:/xampp/htdocs/php/scope-mvc/public_html"
       ServerName scope.com
</VirtualHost>
```

### 2. Set the data Base
you will find the data base at the repository called [scope-mvc.sql]
open your phpmyadmin if you use xampp to import the data base

### 3. Set some options
open scope mvc in your editor then open [app/config/config.php]

if your OS  is windows let it [1] as default, and if you use mac or linux make it [2]

``` php
// IF your OS is windows set the value [1]
// IF your OS is Linux or mac set the value [2]
defined('SERVER_TYPE') ? null : define('SERVER_TYPE', 1);
```

Here you need to set your databse name in the local host, username, password
``` php
 // DataBase
 defined('DB_HOST_NAME')    ? null : define ('DB_HOST_NAME', 'localhost');
 defined('DB_USER_NAME')    ? null : define ('DB_USER_NAME', 'root');
 defined('DB_PASSWORD')     ? null : define ('DB_PASSWORD', '');
 defined('DB_NAME')      ? null : define ('DB_NAME', 'scope-mvc');
```

Finally open up your browser and write your virtual host in my case [scope.com]
and it should be like this :-)

![alt text](https://raw.githubusercontent.com/jojomak13/scope-mvc/master/scope.png "Home page")

After that click on [Dash Board]
> the default admin data is
Username: admin
password: 123456

when you logged successfully it will opened like that :)

![alt text](https://raw.githubusercontent.com/jojomak13/scope-mvc/master/dashborad.png)

---
