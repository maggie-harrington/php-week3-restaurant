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
    protected function tearDown()
    {
        Cuisine::deleteAll();
    }

    function test_new_Cuisine()
    {
        // Arrange
        $new_cuisine = new Cuisine('Pub', 'link1');
        $new_cuisine2 = new Cuisine('Korean', 'link2');

        // Act
        $new_cuisine->save();
        $new_cuisine2->save();
        $all_cuisines = Cuisine::getAll();

        // Assert
        $this->assertEquals([$new_cuisine2, $new_cuisine], $all_cuisines);
    }

    function test_delete_Cuisine()
    {
        // Arrange
        $new_cuisine = new Cuisine('Pub', 'link1');
        $new_cuisine2 = new Cuisine('Korean', 'link2');

        // Act
        $new_cuisine->save();
        $new_cuisine->delete();
        $new_cuisine2->save();
        $all_cuisines = Cuisine::getAll();

        // Assert
        $this->assertEquals([$new_cuisine2], $all_cuisines);
    }

    function test_update_Cuisine()
    {
        // Arrange
        $new_cuisine = new Cuisine('Pub', 'link1');
        $new_cuisine2 = new Cuisine('Korean', 'link2');

        // Act
        $new_cuisine->save();
        $new_cuisine2->save();

        $new_cuisine->update('American', $new_cuisine->getLink());
        $new_cuisine2->update($new_cuisine2->getName(), 'link2update');

        $all_cuisines = Cuisine::getAll();

        // Assert
        $this->assertEquals([$new_cuisine, $new_cuisine2], $all_cuisines);
    }

    function test_find_Cuisine()
    {
        // Arrange
        $new_cuisine = new Cuisine('Pub', 'link1');
        $new_cuisine->save();
        $new_cuisine_id = $new_cuisine->getId();

        // Act
        $cuisine2 = Cuisine::findById($new_cuisine_id);

        // Assert
        $this->assertEquals($new_cuisine, $new_cuisine2);
    }
}
?>
