<?php

class Category extends CrudClass implements CrudInterface
{
    protected $name = "category";
    protected $key = "idCategory";
    protected $attributes = [
        "idCategory",
        "categoryName"
    ];

    public function create(array $args)
    {
        $args = $this->check_attributes_create($args, count($this->attributes)-1);

        $query = $this->conn->prepare("INSERT INTO category(categoryName) VALUES (?); SELECT LAST_INSERT_ID() as id;");
        $query->execute([
            $args["categoryName"]
        ]);
        //return $query->fetch(PDO::FETCH_ASSOC);
    }
}
