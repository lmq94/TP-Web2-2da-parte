<?php

require_once "./models/MainModel.php";


class ClientModel extends Model {
  

    public function __construct() {
        parent::__construct();
        

    }

    public function getClientById($id){
        $query = $this->db->prepare("SELECT* FROM client WHERE client.id_client = ?");
        $query->execute([$id]);
        $client = $query->fetch(PDO::FETCH_OBJ);
        return $client;
    }

    
    public function clientsByOrdenAsc($col){
        $query = $this->db->prepare("SELECT * FROM client ORDER BY $col ASC");
        $query->execute();
        $clients = $query->fetchall(PDO::FETCH_OBJ);
        return $clients;
    }
    

    public function clientsByOrdenDesc($col){
        $query = $this->db->prepare("SELECT * FROM client ORDER BY $col DESC");
        $query->execute();
        $clients = $query->fetchall(PDO::FETCH_OBJ);
        return $clients;
    }


    public function insertClient($dni, $alias, $city) {
        $query = $this->db->prepare("INSERT INTO client (dni, alias, city) VALUES (?, ?, ?)");
        $query->execute([$dni, $alias, $city]);

        return $this->db->lastInsertId();
    }


    function deleteClientById($id) {
        $query = $this->db->prepare('DELETE FROM client WHERE id_client = ?');
        $query->execute([$id]);
    }

    function updateClient($id_client, $dni, $alias, $city){
        $query = $this->db->prepare('UPDATE client SET dni = ?, alias = ?, city = ?  WHERE id_client = ?');
        $query->execute([$dni, $alias, $city, $id_client]);

    }







    




}