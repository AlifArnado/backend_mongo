<?php
    class SQL_Manager
    {

        /**
         * definisi variabel
         */
        public $koneksi; // variabel untuk koneksi MongoDB
        public $database;
        public $collection;
        public $recod; // variabel untuk insert data
        public $view_cursor; // variabel untuk find data

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
         * Insert data MongoDB
         *
         */

        public function mongoInsert($data_record) {
            try { // cek data
                if (($this->data_record = $data_record) == NULL) { // jika parameter null
                    die("data null parameter". mysql_error());
                } else {
                    return $this->getMongoCreateCollection()->insert($data_record);
                }
            } catch (MongoCursorException $e) {
                die("data insert vailed". $e->getMessage());
            } catch (Exception $e) {
                die("error data insert". $e->getMessage());
            }

        }
        /*----------  end fungsi insert data  ----------*/

        /**
         * fungsi untuk menampilkan dan mencari data mongodb
         * find(), findOne();
         *
         */

        public function mongoFindAll()
        {
            $view_cursor = $this->getMongoCreateCollection()->find();
            foreach ($view_cursor as $value) {
                var_dump($value); // coba tampilkan data
            }
        }
        /*----------  end fungsi find data  ----------*/






    } // end class SQL_Manager

    $test = new SQL_Manager(); // membuat objek dari class SQL_Manager
    var_dump($test->mongoCreateKoneksi()); // membuat koneksi
    echo "<br>";
    echo $test->getMongoKoneksi(); // test emanggil nilai koneksi localhost
    echo "<br>";

    var_dump($test->mongoCreateDatabase("backendmongo"));
    echo "<br>";
    echo $test->getMongoCreateDB();
    echo "<br>";

    var_dump($test->mongoCreateCollection("backendmongo"));
    echo "<br>";
    echo $test->getMongoCreateCollection();
    echo "<br>";
    echo "Insert data <br>";
    echo "<br>";
    /*----------  data yang dimasukan  ----------*/

    $recod_data1 = array('nama' => "Amelia Brenda SP", "nim" => 125410140);
    $recod_data2 = array('nama' => "Akbar Bondan Permana", "nim" => 123410148);
    $recod_data3 = array('nama' => "Alif Benden Arnado", "nim" => 125410148);

    // testing one recod
    //$cursor = $test->mongoInsert($recod_data); // masukan data
    //var_dump($cursor);


    // menggabungkan data menjadi  array index
    // $group_recod = array($recod_data1, $recod_data2, $recod_data3); // testing multi recod
    // looing insert ulit recode
    // foreach ($group_recod as $value) {
    //     $cursor = $test->mongoInsert($value); // masukan data
    //     echo "<pre>";
    //     var_dump($value);
    //     echo "</pre>";
    // }

    echo "Tampilkan data <br>";
    $test->mongoFindAll();


?>
