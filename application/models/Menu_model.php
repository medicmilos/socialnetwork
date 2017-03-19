<?php

class Menu_model extends CI_Model {

    public $id_oblast;
    public $oblast;
    public $slika;
    public $description;
    public $username;
    public $id_korisnik;
    public $place;

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function menuSajta() {
        $query = $this->db->query(sprintf("SELECT * FROM menu WHERE menu_place=%d", $this->place));

        return $query->result();
    }

}
