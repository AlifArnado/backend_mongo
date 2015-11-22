<?php
    class SQL_Manager {

        /**
         * definisi manual
         */
        public $database_name = "backendMongo";
        public $collection_name = "alif_backend";

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

        //problem
        public function get_DatabaseName() {
            return SQL_Manager::$this->database_name;
        }

        //problem
        public function get_CollectionName() {
            return SQL_Manager::$this->collection_name;
        }

        // definisi database select fleksibel if variabel value it
        public function get_selectDBMongo_fex() {
            return $this->koneksi->selectDB(SQL_Manager::get_MongoDatabase);
        }

        // call back value select database MongoDB
        public function get_MongoDatabase() {
            return $this->database;
        }

        // setting nama collection
        public function get_Collection($collection_name) {
            if (($this->collection_name = $collection_name) == NULL) {
                echo "Parameter collection NotFound";
            } else {
                return $this->collection = $this->database->selectCollection($collection_name);
            }
        }

        // definisi collection flexsibel if variabel value it
        public function get_Collection_fex() {
            return $this->database->selectCollection(SQL_Manager::get_MongoCollection());
        }

        // call back value select Collection MongoDB
        public function get_MongoCollection() {
            return $this->collection;
        }

        // setting set sql connec full
        public function set_connection_full() {
            try {
                $this->koneksi = new Mongo();
                return $this->database = $this->koneksi->selectDB(SQL_Manager::get_MongoDatabase());
                return $this->collection = $this->database->selectCollection(SQL_Manager::get_MongoCollection());
            } catch (MongoConnectionException $e) {
                die($e->getMessage());
            } catch (Exception $e) {
                throw $e;
                die($e->getMessage());
            }
        }
    }

    /*----------  testing  ----------*/
    $sql = new SQL_Manager();
    $sql->database = "backendMongo";
    $sql->collection = "alif_backend";

    // echo $sql->get_DatabaseName();
    // echo $sql->get_CollectionName();

    // $sql->set_connection_full();

    // $collection_create = $sql->get_Collection_fex();
    // $data = array('nama' => "Alif Benden Permana", "nim" => 125410148);
    // $repost = $collection_create->insert($data);
    // if(!$repost) {
    //     die("data not insert");
    // }
    // echo "<pre>";
    //     var_dump($data);
    // echo "</pre>";
?>
