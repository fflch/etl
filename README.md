# ETL FFLCH

## Deployment instructions

**1.** First, have all the project's dependencies installed:

```sh
composer install
```

**2.** Make a copy of *.env.example* and configure your *.env*:

```sh
cp .env.example .env
```

**3.** After your database is set up, you may create (or recreate) the tables with

```sh
php build.php
```

**4.** Once you have created them, data can be inserted (or updated) whenever needed by:

```sh
php update.php && php lattes.php
```

If you want to recreate necessary tables before updating, you can use parameter `--rebuild`

&emsp;• `php update.php --rebuild` <br>
&emsp;• `php lattes.php --rebuild`

**5.** To check the last time the ETL scripts were executed, use the `check.php` script:

```sh
php check.php
```

**6.** Finally, if you'd like to drop all tables, you may run:

```sh
php drop.php
```