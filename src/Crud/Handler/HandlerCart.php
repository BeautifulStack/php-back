<?php

class HandlerCart extends Handler
{
    protected function readAll(array $pathArr): array
    {
        if (isset($_SESSION["id"])) {
            $result = $this->object->where(["idUser" => $_SESSION["id"]]);
            return $result;
        } else {
            echo json_encode(array("errors" => [
                "Please Login Before"
            ]));
            exit();
        }
    }

    public function route(array $pathArr): array
    {
        if ($pathArr[1] === "Content") return $this->getCart($pathArr);
        return parent::route($pathArr);
    }

    protected function getCart(): array

    {
        // Ici j'aurai bien utiliser la DB de cart à la place mais elle est en protected
        $db = new Database();
        $object = new Product($db->conn);

        $handler = new HandlerProduct($object);
        $results = $handler->object->where(["idCart" => $_GET['id']]);

        return array("content" => $results);
    }
}
