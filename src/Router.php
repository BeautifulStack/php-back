<?php

class Router
{

    public function route(string $path)
    {
        $pathArr = explode('/', $path);

        if (empty($pathArr) || count($pathArr) < 2 || empty($pathArr[1])) {
            echo json_encode(array("errors" => [
                    "None or invalid path indicated !"
                ])
            );
            exit;
        }

        // Deals with it handler
        switch ($pathArr[0]) {

            case "Association":
                $db = new Database();
                $object = new Association($db->conn);
                $handler = new HandlerLogo($object, "name");
                echo json_encode($handler->route($pathArr));
                break;

            case "Brand":
                $db = new Database();
                $brand = new Brand($db->conn);
                $handler = new HandlerLogo($brand, "brandName");
                echo json_encode($handler->route($pathArr));
                break;

            case "Cart":
                $db = new Database();
                $object = new Cart($db->conn);
                $handler = new Handler($object);
                echo json_encode($handler->route($pathArr));
                break;

            case "Category":
                $db = new Database();
                $object = new Category($db->conn);
                $handler = new Handler($object);
                echo json_encode($handler->route($pathArr));
                break;

            case "Offer":
                $db = new Database();
                $object = new Offer($db->conn);
                $handler = new HandlerImage($object);
                echo json_encode($handler->route($pathArr));
                break;

            case "Order":
                $db = new Database();
                $object = new Order($db->conn);
                $handler = new Handler($object);
                echo json_encode($handler->route($pathArr));
                break;

            case "Product":
                $db = new Database();
                $object = new Product($db->conn);
                $handler = new Handler($object);
                echo json_encode($handler->route($pathArr));
                break;

            case "ProductModel":
                $db = new Database();
                $object = new ProductModel($db->conn);
                $handler = new HandlerModel($object);
                echo json_encode($handler->route($pathArr));
                break;

            case "Project":
                $db = new Database();
                $object = new Project($db->conn);
                $handler = new Handler($object);
                echo json_encode($handler->route($pathArr));
                break;

            case "Promotion":
                $db = new Database();
                $object = new Promotion($db->conn);
                $handler = new Handler($object);
                echo json_encode($handler->route($pathArr));
                break;

            case "Transfer":
                $db = new Database();
                $object = new Transfer($db->conn);
                $handler = new Handler($object);
                echo json_encode($handler->route($pathArr));
                break;

            case "User":
                $db = new Database();
                $object = new User($db->conn);
                $handler = new HandlerUser($object);
                echo json_encode($handler->route($pathArr));
                break;

            case "Warehouse":
                $db = new Database();
                $object = new Warehouse($db->conn);
                $handler = new Handler($object);
                echo json_encode($handler->route($pathArr));
                break;

            case "Inventory":
                if ($pathArr[1] == "sendInventory") echo Inventory::upload_inventory();
                else echo Inventory::handle_daily($pathArr);
                break;

            case "data":
                $temp = explode('.', $path);
                $extension = end($temp);
                if ($extension == "jpg") $extension = "jpeg";
                header("Content-Type: image/$extension");
                echo file_get_contents($path);
                break;

            default:
                echo json_encode(array("errors" => [
                        "None or invalid path indicated !"
                    ])
                );
                exit;
        }

    }

}