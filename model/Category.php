<?php

class Category {

    public function __construct() {
        $this->db = new Database();
    }

    public function getAllCategories() {
        $this->db->query('select * from categoria');

        return $this->db->resultSet();
    }

    public function getProductCategories($idProduto) {
        $this->db->query('select * from grupo_categoria where id_produto = :id ');
        $this->db->bind(':id', $idProduto);

        return $this->db->resultSet();
    }

    public function setProductCategoria($idProduto, $categorias) {
        if(sizeof($categorias) <= 1) {
            $this->db->query('insert into categoria set id_categoria = :id_categoria , id_produto = :id_produto');
            $this->db->bind(':id_categoria', $categorias[0]);
            $this->db->bind(':id_produto', $idProduto);

            return $this->db->execute();
        } else {
            $error = array();
            foreach($categorias as $categoria) {
                $this->db->query('insert into categoria set id_categoria = :id_categoria , id_produto = :id_produto');
                $this->db->bind(':id_categoria', $categoria);
                $this->db->bind(':id_produto', $idProduto);

                if(!$this->db->execute()) {
                    $error['msg'] = 'Error adding category';
                }
            }

            if(!sizeof($error) < 1) {
                return true;
            } else return false;

        }
    }
}