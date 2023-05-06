<?php
    class Product{
        
        public static function getAllProducts(){
            $sql = "SELECT * FROM products";
            $conn = self::getConnection();
            $products = $conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
            return $products;
        }

        public static function saveProduct($args = []){
            $sql = "INSERT INTO `products`(`sku`, `name`, `price`, `type`, `size`, `weight`, `height`, `width`, `length`) 
            VALUES (:sku, :product_name, :price, :product_type, :size, :product_weight, :product_height, :product_width, :product_length);";
            $conn = self::getConnection();
            $stmt = $conn->prepare($sql);
            try {
                $stmt = self::getBindedParamsWithStatment($args, $stmt);
                $stmt->execute();
            } catch (\PDOStatement $th) {
                echo $th;
            }
        }

        private static function getBindedParamsWithStatment($args = [], PDOStatement $stmt){
            $stmt->bindParam(':sku', $args['product_sku']);
            $stmt->bindParam(':product_name', $args['product_title']);
            $stmt->bindParam(':price', $args['product_price']);
            $stmt->bindParam(':product_type', $args['product_type']);
            $stmt->bindParam(':size', $args['size']);
            $stmt->bindParam(':product_weight', $args['weight']);
            $stmt->bindParam(':product_height', $args['height']);
            $stmt->bindParam(':product_width', $args['width']);
            $stmt->bindParam(':product_length', $args['length']);
            return $stmt;
        }

        public static function deleteProducts($arr = []){
            $sql = "DELETE from products WHERE sku IN (:skuslist);";
            $skuList = '';
            foreach ($arr as $value) {
                $skuList .= "'$value',";
            }
            $skuList = rtrim($skuList, ',');
            
            $sql = str_replace(':skuslist', $skuList, $sql);

            $conn = self::getConnection();
            try {
                $stmt = $conn->prepare($sql);
                $stmt->execute();
            } catch (\PDOStatement $th) {
                echo $th;
            }
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