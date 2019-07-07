# CodeIgniter-User-Authentication-System
Creating User Authentication System in CodeIgniter with User Registration, Login, Reset Password features. 
All forms are with CSRF Prorection.

## Setup the Script
1. Download the Script
2. Extract it into web directory
3. Create a Database with the name of **ciauth** & import the SQL file into the database
4. Configure the Database Credentials in **database.php** file located under **application/config/database.php**. You will find this code after line number 78
```php	
	'hostname' => 'localhost',
	'username' => 'root',
	'password' => '',
	'database' => 'ciauth',
	'dbdriver' => 'mysqli',
```
5. If you are using any other name for the main directory, then update the path in **config.php** file located under **application/config/config.php**. You will find this statement on line number 26
```php
$config['base_url'] = 'http://localhost/CodeIgniter-User-Authentication-System/';
```

## After the above steps, your code should as expected.

## For Sending Emails Follow these steps

Update these lines with your SMTP login credentials in **User.php** file located under **application/controllers/User.php** on line numbers **70 to 73** and **130 to 132**
```php
	$config['smtp_host'] = 'smtp.sendgrid.net';
	$config['smtp_user'] = 'your-smtp-user-here';
	$config['smtp_pass'] = 'your-smtp-pass-here';
```
Note : If you don't have an account, register a free sendgrid account or Amazon SES (paid) account to use SMTP.

## Updating Routes

To Update the URLS, Scroll to bottom of the page on **routes.php** file located under **application/config/routes.php**

## Problem with URL's & 404 Error

Finaly if you have any problem with URL's, create a file with the name of **.htaccess** and put this code in that file
```
RewriteEngine On 
RewriteCond %{REQUEST_FILENAME} !-f 
RewriteCond %{REQUEST_FILENAME} !-d 
RewriteRule ^(.*)$ index.php/$1 [L]
```

# For Complete text Article and Video Tutorials checkout these links
<a href="https://codingcyber.org/user-authentication-system-codeigniter-login-register-6970/">Complete User Authentication System in CodeIgniter</a>

<a href="https://www.udemy.com/codeigniter-user-authentication-system/?couponCode=GITHUB">Complete User Authentication Course on Udemy</a>
