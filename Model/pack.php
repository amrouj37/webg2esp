<?php
class Pack {
    
    private $id_pack;
    private $type;
   

    // Constructeur de la classe quiz
    public function __construct($type) {
        $this->type = $type;
       
    }

    // Getters et Setters pour chaque propriété
    public function getId() {
        return $this->id_pack;
    }

    public function setId($id_pack) {
        $this->id_pack = $id_pack;
    }

    public function gettype() {
        return $this->type;
    }

    public function settype($type) {
        $this->type = $type;
    }

}  