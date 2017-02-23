<?php
    class Restaurant
    {
        private $id;
        private $name;
        private $link;
        private $location;
        private $cuisine_id;

        function __construct($new_name, $new_link, $new_location, $new_cuisine_id, $id = null)
        {
            $this->setName($new_name);
            $this->setLink($new_link);
            $this->setLocation($new_location);
            $this->setCuisineId($new_cuisine_id);
            $this->setId($id);
        }

        function getId()
        {
            return $this->id;
        }

        function getName()
        {
            return $this->name;
        }

        function getLink()
        {
            return $this->link;
        }

        function getLocation()
        {
            return $this->location;
        }

        function getCuisineId()
        {
            return $this->cuisine_id;
        }

        function setId($id)
        {
            $this->id = (int) $id;
        }

        function setName($new_name)
        {
            $this->name = (string) $new_name;
        }

        function setLink($new_link)
        {
            $this->link = (string) $new_link;
        }

        function setLocation($new_location)
        {
            $this->location = (string) $new_location;
        }

        function setCuisineId($new_cuisine_id)
        {
            $this->cuisine_id = (int) $new_cuisine_id;
        }

        function save()
        {
            $GLOBALS['DB']->exec(
                "INSERT INTO restaurants (name, link, location, cuisine_id) VALUES
                    ('{$this->getName()}', '{$this->getLink()}', '{$this->getLocation()}', {$this->getCuisineId()});"
            );
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        function update($new_name, $new_link, $new_location, $new_cuisine_id)
        {
            $this->setName($new_name);
            $this->setLink($new_link);
            $this->setLocation($new_location);
            $this->setCuisineId($new_cuisine_id);
            $GLOBALS['DB']->exec("UPDATE restaurants SET name = '{$this->getName()}', link = '{$this->getLink()}', location = '{$this->getLocation()}', cuisine_id = {$this->getCuisineId()} WHERE id = {$this->getId()};");
        }

        function delete()
        {
            $GLOBALS['DB']->exec(
                "DELETE FROM restaurants WHERE id = {$this->getId()};"
            );
        }

        static function getAll()
        {
            $output = array();
            $results = $GLOBALS['DB']->query("SELECT * FROM restaurants ORDER BY name;");
            foreach ($results as $result) {
                $new_restaurant = new Restaurant(
                    $result['name'],
                    $result['link'],
                    $result['location'],
                    $result['cuisine_id'],
                    $result['id']
                );
                array_push($output, $new_restaurant);
            }
            return $output;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec(
                "DELETE FROM restaurants;"
            );
        }
    }

?>
