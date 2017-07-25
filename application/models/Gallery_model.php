<?php

class Gallery_model extends CI_Model {
  public $limit;
    public $offset;
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function dohvatiSlike() {
                $string = "";
        if (isset($this->limit)) {
            $string .= " LIMIT " . $this->limit;
        }
        if (isset($this->offset)) {
            $string .= " OFFSET " . $this->offset;
        }
        $query = $this->db->query('SELECT * FROM korisnik'. $string);

        return $query->result();
    }
    public function brojSlika() {
        $query = $this->db->query("SELECT * FROM  korisnik");

        return $query->num_rows();
    }
}
