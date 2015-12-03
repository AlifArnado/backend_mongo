<?php
    class SQL_Manager {

        /**
         * definisi variabel
         */
        public $koneksi; // variabel untuk koneksi MongoDB
        public $database;
        public $collection;
        public $recod; // variabel untuk insert data


        /**
         * membuat koneksi MongoDB
         * dengan mengunakan class Mongo() dan MongoClient()
         */

        public function mongoCreateKoneksi()
        {
            try {
                // bikin objek koneksi MongoDB
                $this->koneksi = new Mongo(); // konek default
                $this->koneksi = new MongoClient(); // konek pada localhost:27017
                $this->koneksi = new MongoClient('mongodb://localhost'); // konek pada host yang di kendalikan (default port: 27017)

                // jika localhost memiliki settingan port maka dapat mengaktifkan fungsi ini
                // $this->koneksi = new MongoClient("mongodb://localhost:12345"); // konek pada port host yang diatur port dapat diubah
            /*
                $this->koneksi = new MongoClient('mongodb://localhost', array(
                        'username' => 'root',
                        'password' => 'abc@123',
                        'db' => 'db_name'
                    ));
            */
            } catch (MongoConnectionException $e) {
                // ambil kesalahan jika gagal koneksi
                die($e->getMessage());
            } catch (Exception $e) {
                // ambil kesalahan jika salah pada bagian try
                die($e->getMessage());
            }
            return $this->koneksi; // mengembalikan nilai
        }

        public function getMongoKoneksi() {
            return $this->koneksi;
        }
        /*----------  end fungsi membuat koneksi mongodb  ----------*/

        /**
         * fungsi membuat database mongoDB
         *
         */
        public function mongoCreateDatabase($database_name)
        {
            if (($this->database_name = $database_name) == NULL) { // jika parameter nama database tiak diisi
                die("check database parameter null".mysql_error());
            } else {
                // jika parameter diisi
                return $this->database = $this->koneksi->selectDB($database_name); // memilih database
            }
        }

        public function getMongoCreateDB() {
            return $this->database;
        }

        /*----------  end fungsi membuat database  ----------*/

        /**
         * fungsi membuat collection mongoDB
         *
         */
        public function mongoCreateCollection($collection_name)
        {
            if (($this->collection_name = $collection_name) == NULL) {
                die("check collection parameter null".mysql_error());
            } else {
                return $this->collection = $this->database->selectCollection($collection_name);
            }
        }

        public function getMongoCreateCollection() {
            return $this->collection;
        }

        /*----------  end fungsi membuat collection  ----------*/

        /**
         * fungsi untuk insert data
         * $recod = array("json parse");
         */
        public function mongoInsert($data_recod) {
        // try insert data MongoDB
            try {
                if (($this->recod = $data_recod) == NULL) { // cek kesalahan jika data kosong
                    die("data recod not found");
                } else {
                    return $this->recod = $this->getMongoCreateCollection()->insert($recod);
                }
                // cek data inputan
                var_dump($recod);
            } catch (Exception $e) { // cek kesalahan
                die("Terdapat kesalahan". $e->getMessage());
            } catch (MongoCursorException $e) {
                die("Vailed dalam insert data". $e->getMessage());
            }
        }
        /*----------  end fungsi untuk insert data  ----------*/

        /**
         * fungsi untuk menampilkan data secara keseluruhan
         * find() , find().pretty() , find().limit()
         */
        public function mongoViewAll() { // find()

        }

        public function mongoViewJson() { // find().pretty()

        }

        public function mongoViewLimit($limit_number) { // find().limit()

        }
        /*----------  fungsi edit data  ----------*/
        /*----------  fungsi delete data  ----------*/
        /*----------  fungsi find data  ----------*/



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
            return $this->database_name;
        }

        //problem
        public function get_CollectionName() {
            return $this->collection_name;
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
    var_dump($sql->mongoCreateKoneksi());
    // $sql->database = "backendMongo";
    // $sql->collection = "alif_backend";

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
