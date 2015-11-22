<?php
    class SQL_Manager {
        public $koneksi;
        public $database;
        public $collection;

        /*----------  setting database MongoDB  ----------*/
        public function get_KoneksiMongoDB()
           {
               try {
                    // bila berhasil
                   $this->koneksi = new Mongo();
               } catch (Exception $e) {
                    // bila problem
                   die($e->getMessage());
               }
           }

        // setting nama databse
        public function set_MongoDatabase($database_name) {
            if(($this->database_name = $database_name) == NULL) {
                echo "Parameter database NotFound";
            } else {
                return $this->database = $this->koneksi->selectDB($database_name);
            }
        }

        // setting nama collection
        public function get_Collection($collection_name) {
            if (($this->collection_name = $collection_name) == NULL) {
                echo "Parameter collection NotFound";
            } else {
                return $this->collection = $this->database->selectCollection($collection_name);
            }
        }
    }

    /*----------  testing  ----------*/
    $sql = new SQL_Manager();
    $sql->get_KoneksiMongoDB();
    $sql->set_MongoDatabase("backend_mongodb");
    $collection_create = $sql->get_Collection("collection_mongodb");

    $data = array('nama' => "Akbar Bondan Permana", "nim" => 125410148);
    $repost = $collection_create->insert($data);
    if(!$repost) {
        die("data not insert");
    }
    echo "<pre>";
        var_dump($data);
    echo "</pre>";
?>
