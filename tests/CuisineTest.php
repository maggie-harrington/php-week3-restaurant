<?php
/**
* @backupGlobals disabled
* @backupStaticAttributes disabled
*/

require_once "src/Cuisine.php";

$server = 'mysql:host=localhost:8889;dbname=restaurants_test';
$username = 'root';
$password = 'root';
$DB = new PDO($server, $username, $password);

class CuisineTest extends PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        Cuisine::deleteAll();
    }

    function test_new_Cuisine()
    {
        $this->assertEquals(1, 1);
    }

}


?>
