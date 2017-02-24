<?php
/**
* @backupGlobals disabled
* @backupStaticAttributes disabled
*/

require_once "src/Cuisine.php";
require_once "src/Restaurant.php";

$server = 'mysql:host=localhost:8889;dbname=restaurants_test';
$username = 'root';
$password = 'root';
$DB = new PDO($server, $username, $password);

class RestaurantTest extends PHPUnit_Framework_TestCase
{
    protected function tearDown()
    {
        Restaurant::deleteAll();
        Cuisine::deleteAll();
    }

    function test_new_Restaurant()
    {
        // Arrange
        $new_cuisine = new Cuisine('Pub', 'link1');
        $new_cuisine->save();
        $new_restaurant = new Restaurant('Sasquatch', 'Link_Sas', 'Hillsdale', $new_cuisine->getId());
        $new_restaurant->save();

        $new_cuisine2 = new Cuisine('Fast Food', 'google.com?fastfood');
        $new_cuisine2->save();
        $new_restaurant2 = new Restaurant('McDonalds', 'mcdonalds.com?location=23222424', 'NE Portland', $new_cuisine2->getId());
        $new_restaurant2->save();

        $new_restaurant3 = new Restaurant('BurgerKing', 'bk.com?location=232424', 'NE Portland', $new_cuisine2->getId());
        $new_restaurant3->save();

        // Act
        $all_restaurants = Restaurant::getAll($new_cuisine2->getId());

        // Assert
        $this->assertEquals([$new_restaurant3, $new_restaurant2], $all_restaurants);
    }

    function test_delete_Restaurant()
    {
      // Arrange
      $new_cuisine = new Cuisine('Pub', 'link1');
      $new_cuisine->save();
      $new_restaurant = new Restaurant('Sasquatch', 'Link_Sas', 'Hillsdale', $new_cuisine->getId());
      $new_restaurant->save();

      $new_cuisine2 = new Cuisine('Fast Food', 'google.com?fastfood');
      $new_cuisine2->save();

      $new_restaurant2 = new Restaurant('McDonalds', 'mcdonalds.com?location=23222424', 'NE Portland', $new_cuisine2->getId());
      $new_restaurant2->save();

      $new_restaurant3 = new Restaurant('BurgerKing', 'bk.com?location=232424', 'NE Portland', $new_cuisine2->getId());
      $new_restaurant3->save();

      // Act
      $new_restaurant2->delete();
      $all_restaurants = Restaurant::getAll($new_cuisine2->getId());

      // Assert
      $this->assertEquals([$new_restaurant3], $all_restaurants);
    }

    function test_update_Restaurant()
    {
      // Arrange
      $new_cuisine = new Cuisine('Pub', 'link1');
      $new_cuisine->save();
      $new_restaurant = new Restaurant('Sasquatch', 'Link_Sas', 'Hillsdale', $new_cuisine->getId());
      $new_restaurant->save();

      $new_cuisine2 = new Cuisine('Fast Food', 'google.com?fastfood');
      $new_cuisine2->save();

      $new_restaurant2 = new Restaurant('McDonalds', 'mcdonalds.com?location=23222424', 'NE Portland', $new_cuisine2->getId());
      $new_restaurant2->save();

      $new_restaurant3 = new Restaurant('BurgerKing', 'bk.com?location=232424', 'NE Portland', $new_cuisine2->getId());
      $new_restaurant3->save();

      // Act
      $new_restaurant2->update($new_restaurant2->getName(), $new_restaurant2->getLink(), 'SE Portland', $new_restaurant2->getCuisineId());
      $new_restaurant3->update($new_restaurant3->getName(), 'bk.com?location=232428', $new_restaurant3->getLocation(), $new_restaurant3->getCuisineId());
      $new_restaurant2->update('Taco Bell', $new_restaurant2->getLink(), $new_restaurant2->getLocation(), $new_restaurant2->getCuisineId());
      $new_restaurant->update($new_restaurant->getName(), $new_restaurant->getLink(), $new_restaurant->getLocation(), $new_cuisine2->getId());

      $all_restaurants = Restaurant::getAll($new_cuisine2->getId());

      // Assert
      $this->assertEquals([$new_restaurant3, $new_restaurant, $new_restaurant2], $all_restaurants);
    }

    function test_find_Restaurant()
    {
      // Arrange
      $new_cuisine = new Cuisine('Pub', 'link1');
      $new_cuisine->save();

      $new_restaurant = new Restaurant('Sasquatch', 'Link_Sas', 'Hillsdale', $new_cuisine->getId());
      $new_restaurant->save();

      $new_cuisine2 = new Cuisine('Fast Food', 'google.com?fastfood');
      $new_cuisine2->save();

      $new_restaurant2 = new Restaurant('McDonalds', 'mcdonalds.com?location=23222424', 'NE Portland', $new_cuisine2->getId());
      $new_restaurant2->save();

      $new_restaurant3 = new Restaurant('BurgerKing', 'bk.com?location=232424', 'NE Portland', $new_cuisine2->getId());
      $new_restaurant3->save();

      // Act
      $found_restaurant = Restaurant::find($new_restaurant2->getId());

      // Assert
      $this->assertEquals($new_restaurant2, $found_restaurant);
    }
}
?>
