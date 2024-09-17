<p align="center">
  <img src="https://i.ibb.co/n8mNTNr/Screenshot-1.png" alt="accessibility text">
</p>

<h1>About this project</h1>

This is WEB version of [OciXCrom's Rank System](https://amxx-bg.info/forum/viewtopic.php?t=4478) with following stuff:

> Bootstrap latest version

> Bootstrap Icons

> Pagination

> Mobile friendly (Responsive)

> Search Bar

<p></p>

<h1>Installation</h1>

1. Change `database.php` information:<br>
```    
    $host = 'localhost'; // Адресът на базата данни
    $db_name = 'ranks'; // Името на базата данни
    $username = 'root'; // Потребителското име за вход
    $password = ''; // Паролата за вход
```
2. In `index.php` edit following lines:
```
// Име на таблицата в базата данни
$dbTable = "CRXRanks_bb2";

// Брой записи на страница
$records_per_page = 10;
```
