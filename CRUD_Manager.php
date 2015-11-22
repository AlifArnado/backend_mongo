<?php
    include_once 'SQL_Manager.php';

    /**
     * summary
     */

    class CRUD_Manager
    {

        public $sql_connect;
        public $collection_insert;
        public function set_insertRecordMongo($record)
        {
            $this->sql_connect = new SQL_Manager();

            // tes output problem
            echo $this->sql_connect->get_DatabaseName();
            echo $this->sql_connect->get_CollectionName();

            //$this->sql_connect->database = $this->$sql_connect->get_selectDBMongo_fex(); // definisi value database
            //$this->sql_connect->collection = $this->$sql_connect->get_Collection_fex(); // definisi value collection
            $this->sql_connect->set_connection_full(); // menggunakan fungsi koneksi full

            $this->collection_insert = $this->sql_connect->get_Collection_fex();
            $this->collection_insert->insert($record);
        }
    }

    /*----------  testing  ----------*/

    $insert = new CRUD_Manager();
    $data = array('nama' => "Akbar Brenda Arnado", "nim" => 125410148);
    //$repost = $insert->set_insertRecordMongo($data);

    echo "<pre>";
        //var_dump($data);
    echo "</pre>";
 ?>
