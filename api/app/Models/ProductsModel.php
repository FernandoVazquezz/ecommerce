<?php

    namespace app\models;
    
    class ProductsModel extends Models {

        public function getByIdProducts($productCode){
            $result = $this->db->select('products',[
                'productCode',
                'productName',
                'productLine',
                'productScale',
                'productVendor',
                'productDescription',
                'quantityInStock',
                'buyPrice',
                'MSRP'
            ],[
                "productCode" => $productCode
            ]
        );

        if(!is_null($this->db->error()[1])){
            return array(
                'error' => true,
                'description' => $this->db->error()[2]
            );
        } else if (empty($result)){
            return array(
                'notFound' => true,
                'description' => 'The result is empty'
            );
        }
        return array(
            'success' => true,
            'description' => 'The product were found',
            'product' => $result
        );
        }
        
        public function selectProducts(){
            /*$result = $this->db->select('products', [
                'productCode',
                'productName',
                'productLine',
                'productScale',
                'productVendor',
                'productDescription',
                'quantityInStock',
                'buyPrice',
                'MSRP'
            ]);*/
            $cons = $this->db->pdo->prepare('SELECT * FROM products');
            $cons->execute();
            $result = $cons->fetchAll( \PDO::FETCH_ASSOC);
            if(!is_null($this->db->error()[1])){
                return array(
                    'error' => true,
                    'description' => $this->db->error()[2]
                );
            } else if (empty($result)){
                return array(
                    'notFound' => true,
                    'description' => 'The result is empty'
                );
            }
            return array(
                'success' => true,
                'description' => 'The products were found',
                'products' => $result
            );
        }
        public function insertProducts($product){
            /*$result = $this->db->insert('products', [
                'productCode' => $product['productCode'],
                'productName' => $product['productName'],
                'productLine' => $product['productLine'],
                'productScale' => $product['productScale'],
                'productVendor' => $product['productVendor'],
                'productDescription' => $product['productDescription'],
                'quantityInStock' => $product['quantityInStock'],
                'buyPrice' => $product['buyPrice'],
                'MSRP' => $product['MSRP']
            ]);*/
            $result = $this->db->pdo->prepare('INSERT INTO products 
            VALUES (:productCode, :productName, :productLine, :productScale, :productVendor, :productDescription, :quantityInStock, :buyPrice, :MSRP);');
            $result->bindParam(':productCode', $product['productCode'],  \PDO::PARAM_STR);
            $result->bindParam(':productName', $product['productName'],  \PDO::PARAM_STR);
            $result->bindParam(':productLine', $product['productLine'], \PDO::PARAM_STR );
            $result->bindParam(':productScale', $product['productScale'],  \PDO::PARAM_STR);
            $result->bindParam(':productVendor', $product['productVendor'],  \PDO::PARAM_STR);
            $result->bindParam(':productDescription', $product['productDescription'],  \PDO::PARAM_STR);
            $result->bindParam(':quantityInStock', $product['quantityInStock'], \PDO::PARAM_INT );
            $result->bindParam(':buyPrice', $product['buyPrice'],  \PDO::PARAM_INT);
            $result->bindParam(':MSRP', $product['MSRP'],  \PDO::PARAM_INT);
            $result->execute();
            if(!is_null($this->db->error()[1])){
                return array(
                    'success' => false,
                    'description' => $this->db->error()[2]
                );
            }else if(!is_null($result)){
                return array(
                    'success' => false,
                    'description' => $result->errorInfo()
                );
            }
            return array(
                'success' => true,
                'description' => 'The product was inserted'
            );
        }
        public function updateProducts($product){
            /*$result = $this->db->update('products', [
                'productName' => $product['productName'],
                'productLine' => $product['productLine'],
                'productScale' => $product['productScale'],
                'productVendor' => $product['productVendor'],
                'productDescription' => $product['productDescription'],
                'quantityInStock' => $product['quantityInStock'],
                'buyPrice' => $product['buyPrice'],
                'MSRP' => $product['MSRP']
            ],[
                'productCode[=]' => $product['productCode'],
            ]);*/
            $result = $this->db->pdo->prepare('UPDATE products SET
            productName = :productName,
            productLine = :productLine,
            productScale = :productScale,
            productVendor = :productVendor,
            productDescription = :productDescription,
            quantityInStock = :quantityInStock,
            buyPrice = :buyPrice,
            MSRP = :MSRP
            WHERE productCode = :productCode');
            $result->bindParam(':productCode', $product['productCode'],  \PDO::PARAM_STR);
            $result->bindParam(':productName', $product['productName'],  \PDO::PARAM_STR);
            $result->bindParam(':productLine', $product['productLine'],  \PDO::PARAM_STR);
            $result->bindParam(':productScale', $product['productScale'],  \PDO::PARAM_STR);
            $result->bindParam(':productVendor', $product['productVendor'],  \PDO::PARAM_STR);
            $result->bindParam(':productDescription', $product['productDescription'],  \PDO::PARAM_STR);
            $result->bindParam(':quantityInStock', $product['quantityInStock'], \PDO::PARAM_INT );
            $result->bindParam(':buyPrice', $product['buyPrice'], \PDO::PARAM_INT );
            $result->bindParam(':MSRP', $product['MSRP'],  \PDO::PARAM_INT);
            $result->execute();
            if(!is_null($this->db->error()[1])){
                return array(
                    'success' => false,
                    'description' => $this->db->error()[2]
                );
            }
            return array(
                'success' => true,
                'description' => 'The product was updated'
            );
        }
    }
?>