# SNHU-SGA-Penmen-Pride-Database
## SQL Scripts
### Run the Following SQL Scripts

### Change the SQL Conf File

### Add the following users with the following permissions

## Files to add
In order to use the system you must create a few files:
### /mysqlkeys.php
```php
<?php
$host="localhost";
$user="insideops";
$password="Create a Password";
$dbname="ppv0008003";

$mailfrom = "John Smith <johnsmith@example.com>";
$mailhost = "smtp.server.com";
$mailport = "587";
$mailusername = "johnsmith@example.com";
$mailpassword = "Create a Password";

$hashforkeys = "Create a Random Hash";
?>
```
### /public/publicmysqlkeys.php
```php
<?php
$host="localhost";
$user="publicops";
$password="Create a Password";
$dbname="ppv0008004";
?>
```
## File permissions
### Event Uploads
Chmod 775
chown www-data

## Mail System
We use PHP Mailer. See here: https://alexwebdevelop.com/phpmailer-tutorial/
/var/www/html/SGAPenmenPrideMainAppV1/phpmailer/vendor/phpmailer/phpmailer
