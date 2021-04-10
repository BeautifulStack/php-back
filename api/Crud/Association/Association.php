<?php

require_once "api/Crud/CrudInterface.php";
require_once "api/Crud/CrudClass.php";

class Association extends CrudClass implements CrudInterface
{
    protected  $name = "association";
    protected  $key = "idAssociation";
    protected  $attributes = [
        "idAssociation",
        "name",
        "description",
        "logo"
    ];

    public function create(array $args)
    {
        $args = $this->check_attributes_create($args, count($this->attributes)-1);

        $query = $this->conn->prepare("INSERT INTO association(name, description, logo) VALUES (?, ?, ?)");
        $query->execute([
            $args["name"],
            $args["description"],
            $args["logo"]
        ]);
    }
}
