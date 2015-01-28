# PHP MYSQL USER AUTH SYSTEM WITH POWERED BY AJAX

DESCRIPTION:

This is simple php mysql user auth system with nice ajax designed. Very easy to use.

HOW TO:
1. You need download it and put entire folder into the directory you want

2. To setup your database, go to your database and import "user_auth_db.sql" file, then your database is setup.

3. Modify config.php, and put your database information (db_host, db_name, db_user, db_password), anything else should not be changed. After saving and uploading, your auth system is up now! 

Please use it as your own risk:

In this system, password is not hashed even if in database, there is a column called 'pwHash', for long term security, you should evaluate your own hash algorithm for encryption. 

We have put decent filter to prevent sql injection.
