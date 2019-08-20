<?php
    namespace app\models;
    class OrderModel extends Models{
        public function insertOrder($order){
            $orderNumber = time();
            $lines = $order['cart']['lines'];
            
            $this->db->pdo->beginTransaction();
            $this->db->insert('orders', [
                'orderNumber' => $orderNumber,
                'orderDate' => date('Y-m-d', time()),
                'requiredDate' => date('Y-m-d', time()),
                'status' => 'In Process',
                'customerNumber' => '496',
            ]);
            foreach($lines as $key => $li){
                $this->db->insert('orderdetails', [
                    'orderNumber' => $orderNumber,
                    'productCode' => $li['product']['productCode'],
                    'quantityOrdered' => $li['quantity'],
                    'priceEach' => $li['product']['MSRP'],
                    'orderLineNumber' => $key + 1
                ]);
            }
            if(!is_null($this->db->error()[1])){
                $this->db->pdo->rollBack();
                return array(
                    'error' => true,
                    'description' => $this->db->error()[2]
                );
            }
            $this->db->pdo->commit();
            return array(
                'success' => true,
                'description' => 'order registered'
            );
        }

        function selectOrders() {
            $sth = $this->db->pdo->prepare('SELECT o.orderNumber, p.productName, od.quantityOrdered, p.MSRP  FROM orders o INNER JOIN orderdetails od on od.orderNumber = o.orderNumber INNER JOIN products p on p.productCode = od.productCode');
            $sth->execute();
            $result = $sth->fetchAll(\PDO::FETCH_ASSOC);
            
            if($sth->errorInfo()[1]) {
                return array(
                    'error' => true,
                    'description' => $sth->errorInfo()[2]
                );
            } else if(empty($result)) {
                return array(
                    'notFound' => true,
                    'description' => 'The result is empty'
                );
            }
            return array(
                'success' => true,
                'description' => 'The customers were found',
                'orders' => $result
            );
        }
    }
?>