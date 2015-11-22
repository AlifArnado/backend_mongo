<?php
    class SQL_Manager {
        public $koneksi;
        public $database;
        public $collection;

        public function get_Koneksi($database_name)
           {
               try {
                   $this->koneksi = new Mongo();
                   $this->database = $this->koneksi->selectDB($database_name);
                   echo "berhasil";
               } catch (Exception $e) {
                   die($e->getMessage());
               }
           }
        public function get_Collection($collection_name) {
            return $this->collection = $this->database->selectCollection($collection_name);
        }

    }

    /*----------  testing  ----------*/
    $sql = new SQL_Manager();
    $sql->get_Koneksi("backend_mongodb");
    $collection_create = $sql->get_Collection("collection_mongodb");

    $data = array('nama' => "Alif Benden Arnado", "nim" => 125410148);
    $repost = $collection_create->insert($data);
    if(!$repost) {
        die("data not insert");
    }
    echo "<pre>";
        var_dump($data);
    echo "</pre>";
?>
