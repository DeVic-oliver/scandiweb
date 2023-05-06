<?php
    class Product{
        
        public static function getAllProducts(){
            $sql = "SELECT * FROM products";
            $conn = self::getConnection();
            $products = $conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
            return $products;
        }

        private static function getConnection(){
            $credentials = parse_ini_file(PROJECT_ROOT . 'config/.conf');
            $host = $credentials['host'];
            $dbname = $credentials['dbname'];
            $user = $credentials['username'];
            $pass = $credentials['password'];
            $conn = new PDO("mysql:dbname=$dbname;host=$host", $user, $pass);   
            return $conn;
        }

    }