<?php

class Order extends CrudClass implements CrudInterface
{
    protected $name = "order";
    protected $key = "idOrder";
    protected $attributes = [
        "idOrder",
        "totalPrice",
        "addressDest",
        "deliveryMode",
        "deliveryStatus",
        "isPaid",
        "orderDate",
        "idCart"
    ];
    protected $foreignKey = [
        "idCart" => ["cart", "idUser"]
    ];

    public function create(array $args)
    {
        $args = $this->check_attributes_create($args, $this->attributes, $this->key);

        $query = $this->conn->prepare("INSERT INTO `order`(totalPrice, addressDest, deliveryMode, deliveryStatus, isPaid, idCart) VALUES (?, ?, ?, ?, ?, ?)");
        $query->execute([
            $args["totalPrice"],
            $args["addressDest"],
            $args["deliveryMode"],
            $args["deliveryStatus"],
            $args["isPaid"],
            $args["idCart"]
        ]);

        $query = $this->conn->query("SELECT LAST_INSERT_ID() as id");
        return $query->fetch(PDO::FETCH_ASSOC);
    }
}
