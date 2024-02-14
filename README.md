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
php builder.php
```

**4.** Once you have created them, data can be inserted (or updated) whenever needed by:

```sh
php main.php && php extra.php
```

**5.** To check the last time the ETL scripts were executed, use the `check.php` script:

```sh
php check.php
```

**6.** Finally, if you'd like to drop all tables, you may run:

```sh
php drop.php
```