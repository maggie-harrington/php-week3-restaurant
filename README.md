# Restaurants by Cuisine

#### Epicodus PHP Week 3 Lab, 2/22/2017

#### By Maggie Harrington and Benjamin T. Seaver

## Description

This lab is about using mySQL, Classes, TestClasses, Silex and Twig frameworks

## Setup/Installation Requirements
* See https://secure.php.net/ for details on installing _PHP_.  Note: PHP is typically already installed on Mac.
* See https://getcomposer.org/ for details on installing _composer_.
* See https://mamp.info/ for details on installing _MAMP_.
* Use MAMP `http://localhost:8888/phpmyadmin/` and `to_do.sql.zip` to import a `to_do` database.
* Use same MAMP website to copy to_do database to `to_do_test` database (if you would like to try PHPUnit tests).
* Start SQL at command prompt if desired with > `/Applications/MAMP/Library/bin/mysql --host=localhost -uroot -proot`
* Clone project
* From project root, run > `composer install --prefer-source --no-interaction`
* To run PHPUnit tests from root > `vendor/bin/phpunit tests`
* From web folder in project, Start PHP > `php -S localhost:8000`
* In web browser open `localhost:8000`

## Known Bugs
* No known bugs

## Support and contact details
* No support

## Technologies Used
* PHP
* MAMP
* mySQL
* Composer
* PHPUnit
* Silex
* Twig
* HTML
* CSS
* Bootstrap
* Git

## Copyright (c)
* 2017 Benjamin T. Seaver and Maggie Harrington

## License
* MIT

## Specifications

1. Create database (restaurants.zip).
2. Create empty Cuisine class with constructor, getters, setters, save, delete, update, getAll, deleteAll.
3. Iterate between CuisineTest and Cuisine classes to test all methods.
4. Create empty Restaurant class with constructor, getters, setters, save, delete, update, getAll, deleteAll.
5. Iterate between RestaurantTest and Restaurant classes to test all methods.
6. Silex framework with 'Hello' on home page (app.php, index.php).
7. Twig home Cuisine page (twig, app.php).
8. Twig Restaurant page (twig, app.php).
9. Basic Bootstrap styling.
10. Edit and delete for Cuisine and Restaurant.
11. Prevent dups and blanks.
12. Counts of restaurants by Cuisine.
13. Review class and test.
14. Add review page.
15. Incorporate reviews with restaurant page.

* End specifications
