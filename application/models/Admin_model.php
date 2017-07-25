<?php

class Admin_model extends CI_Model {

    public $id;
    public $tabela;
    public $kolona;
    public $limit;
    public $offset;
	
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function dohvatiUsere() {
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
    public function brojKorisnika() {
        $query = $this->db->query("SELECT * FROM  korisnik");

        return $query->num_rows();
    }
    public function dohvatiMenu() {
        $query = $this->db->query('SELECT * FROM menu');

        return $query->result();
    }

    public function dohvatiPoll() {
        $query = $this->db->query('SELECT * FROM poll');

        return $query->result();
    }

    public function dohvatiPostove() {
        $query = $this->db->query('SELECT * FROM posts');

        return $query->result();
    }

    public function dohvatiKomentare() {
        $query = $this->db->query('SELECT * FROM comments');

        return $query->result();
    }

    public function delete() {
        $this->db->where($this->kolona, $this->id);

        return $this->db->delete($this->tabela);
    }

    public function dohvatiKorisnika($id) {
        return $this->db->select("*")
                        ->from("korisnik k")
                        ->join("uloga u", "k.id_uloga=u.id_uloga")
                        ->where("k.id_korisnik", $id)
                        ->get()->row(); //ne preba foreach jer je jedan red pa koristimo ROW
    }

    public function urediKorisnika($id, $value) {
        $this->db->where("id_korisnik", $id);
        return $this->db->update("korisnik", $value);
    }

    public function dohvatiMenu1($id) {
        return $this->db->select("*")
                        ->from("menu")
                        ->where("id_menu", $id)
                        ->get()->row(); 
    }

    public function urediMenu($id, $value) {
        $this->db->where("id_menu", $id);
        return $this->db->update("menu", $value);
    }

    public function dohvatiPoll1($id) {
        return $this->db->select("*")
                        ->from("poll p")
                        ->join("poll_answers pa", "p.id_poll=pa.id_poll", 'right outer')
                        ->where("p.id_poll", $id)
                        ->get()->row();
    }

    public function urediPoll($id, $value) {
        $this->db->where("id_poll", $id);
        return $this->db->update("poll", $value);
    }

    public function dohvatiPost($id) {
        return $this->db->select("*")
                        ->from("posts")
                        ->where("id_post", $id)
                        ->get()->row(); 
    }

    public function urediPost($id, $value) {
        $this->db->where("id_post", $id);
        return $this->db->update("posts", $value);
    }

    public function dohvatiComment($id) {
        return $this->db->select("*")
                        ->from("comments")
                        ->where("id_comment", $id)
                        ->get()->row(); 
    }

    public function urediComment($id, $value) {
        $this->db->where("id_comment", $id);
        return $this->db->update("comments", $value);
    }

    public function dodajKorisnika($value) {
        return $this->db->insert("korisnik", $value);
    }

    public function dodajMenu($value) {
        return $this->db->insert("menu", $value);
    }

    public function dodajPoll($value) {
        $this->db->insert("poll", $value);
        $insert_id = $this->db->insert_id();

        return $insert_id;
    }

    public function dodajQ1($valueA1, $idPoll) {
        $data = array(
            'id_poll' => $idPoll,
            'answer' => $valueA1
        );

        return $this->db->insert("poll_answers", $data);
    }

    public function dodajQ2($valueA2, $idPoll) {
        $data = array(
            'id_poll' => $idPoll,
            'answer' => $valueA2
        );

        return $this->db->insert("poll_answers", $data);
    }

    public function dodajPost($value) {
        return $this->db->insert("posts", $value);
    }

    public function dodajComment($value) {
        return $this->db->insert("comments", $value);
    }

}
