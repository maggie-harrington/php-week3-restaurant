<?php
    class Cuisine
    {
        private $id;
        private $name;
        private $link;

        function __construct($new_name, $new_link, $id = null)
        {
            $this->setName($new_name);
            $this->setLink($new_link);
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

        function save()
        {
            $GLOBALS['DB']->exec(
                "INSERT INTO cuisines (name, link) VALUES
                    ('{$this->getName()}', '{$this->getLink()}');"
            );
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        function update()
        {

        }

        function delete()
        {

        }

        static function getAll()
        {
            $output = array();
            $results = $GLOBALS['DB']->query("SELECT * FROM cuisines ORDER BY name;");
            foreach ($results as $result) {
                $new_cuisine = new Cuisine(
                    $result['name'],
                    $result['link'],
                    $result['id']
                );
                array_push($output, $new_cuisine);
            }
            return $output;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec(
                "DELETE FROM cuisines
                    WHERE id NOT IN (SELECT cuisine_id FROM restaurants);"
            );
        }
    }

?>
