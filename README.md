Welcome to CodeIgniter Rest application!
========================================

1. Download
-----------

`https://github.com/tommal-sys/ci_rest`

or clone:

`https://github.com/tommal-sys/ci_rest.git`

* * * * *

2. Install
----------

Send files on server or localhost. Set url config and conncet to database in:

`application/config/config.php                     application/config/database.php                 `

By phpmyadmin import structure database ci\_rest.sql

* * * * *

3. Use
------

GET user:

`https://your_website/index.php/rest/get/{id}`

ADD user
 by POST:

`https://your_website/index.php/rest/add/`

UPDATE user
 by POST:

`https://your_website/index.php/rest/update/{id}`

DELETE user:

`https://your_website/index.php/rest/delete/{id}`

Application return in JSON and show error message.

In file send.php is simply form to add/update data.

* * * * *

