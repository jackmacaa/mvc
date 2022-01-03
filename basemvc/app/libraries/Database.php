<?php
    /*
     * PDI DB class
     * connect to DB
     * create prepared statements
     * bind values
     * return rows and results
     */
    class Database
    {
        private $host = DB_HOST;
        private $user = DB_USER;
        private $pass = DB_PASS;
        private $dbname = DB_NAME;

        private $dbh;
        private $stmt;
        private $error;

        public function __construct()
        {
            // SET DSN
            $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
            $options = array(
                PDO::ATTR_PERSISTENT => true,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            );

            // Create PDO instance
            try {
                $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
            } catch (PDOException $e) {
                $this->error = $e->getMessage();
                echo $this->error;
            }
        }

        // Prepare statement with query
        public function query($sql)
        {
            $this->stmt = $this->dbh->prepare($sql);
        }

        // Bind values
        public function bind($param, $value, $type = null)
        {
            if (is_null($type)) {
                $type = match (true) {
                    is_int($value) => PDO::PARAM_INT,
                    is_bool($value) => PDO::PARAM_BOOL,
                    is_null($value) => PDO::PARAM_NULL,
                    default => PDO::PARAM_STR,
                };
            }
            $this->stmt->bindValue($param, $value, $type);
        }

        // Execute the prepared statement
        public function execute()
        {
            return $this->stmt->execute();
        }

        // Get results set as array of objects
        public function resultSet()
        {
            $this->execute();
            return $this->stmt->fetchAll(PDO::FETCH_OBJ);
        }

        // Get single record as object
        public function single()
        {
            $this->execute();
            return $this->stmt->fetch(PDO::FETCH_OBJ);
        }

        // Get row count
        public function rowCount()
        {
            return $this->stmt->rowCount();
        }
    }