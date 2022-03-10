<?php

class Product {
    public function __construct() {
        $this->db = new Database();
    }

    public function getProducts() {
        $this->db->query('select * from produtos order by id desc');
        $results = $this->db->resultJSON();

        return $results;
    }

    public function getProductById($id) {
        $this->db->query('select * from produtos where id = :id');
        $this->db->bind(':id', $id);
        $results = $this->db->resultSingleJSON();

        return $results;
    }

    public function getProductByName($name) {
        $this->db->query('select * from produtos where name = :productName');
        $this->db->bind(':productName', $name);
        $results = $this->db->resultSingleJSON();

        return $results;
    }

    public function getNumProducts() {
        $this->db->query('select * from produtos');
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function createProduct($product) {
        $this->db->query('insert into produtos set name = :name , price = :price , thumbnail = :thumbnail , inStock = :inStock , amount = :amount , brand = :brand ');
        $this->db->bind(':name', $product->name);
        $this->db->bind(':price', $product->price);
        $this->db->bind(':thumbnail', $product->thumbnail);
        $this->db->bind(':inStock', $product->inStock ? $product->inStock : 0);
        $this->db->bind(':amount', $product->amount);
        $this->db->bind(':brand', $product->brand);

        return $this->db->execute();
    }

    public function editProduct($product) {
        $this->db->query('update produtos set name = :name , price = :price , thumbnail = :thumbnail , inStock = :inStock , amount = :amount , brand = :brand where id = :id ');
        $this->db->bind(':name', $product->name);
        $this->db->bind(':price', $product->price);
        $this->db->bind(':thumbnail', $product->thumbnail);
        $this->db->bind(':inStock', $product->inStock);
        $this->db->bind(':amount', $product->amount);
        $this->db->bind(':brand', $product->brand);
        $this->db->bind(':id', $product->id);

        return $this->db->execute();
    }
}