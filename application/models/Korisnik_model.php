<?php

class Korisnik_model extends CI_Model {

    public $id_korisnik;
    public $id_uloga;
    public $Email;
    public $FirstName;
    public $LastName;
    public $datum_registracije;
    public $Password;
    public $status;
    public $avatar;
    public $code;
    public $id_friend;
    public $id_friends;

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function proveri() {
        $query = $this->db->query("SELECT FirstName,LastName,id_korisnik,email,password,uloga,avatar FROM korisnik inner join uloga ON korisnik.id_uloga=uloga.id_uloga WHERE email='" . $this->email . "' AND password='" . $this->password . "' AND status=1"); //password='".md5($this->password). "'
        $row = $query->row();

        return $row;
    }

    function email() {
        return $this->db->get_where("korisnik", "email='" . $this->email . "'")->row();
    }

    public function avatar() {
        return $this->db->get_where("korisnik", "email='" . $this->email . "'")->result();
    }

    public function izmeniKorisnika() {
        $podaci = array(
            'FirstName' => $this->FirstName,
            'LastName' => $this->LastName,
            'email' => $this->email,
            'password' => $this->password,
            'email' => $this->email,
            'status' => $this->status,
            'datum_registracije' => date("Y-m-d H:i:s"),
            'code' => $this->code,
            'id_uloga' => $this->id_uloga
        );
        $this->db->where('id_korisnik', $this->id_korisnik);
        $this->db->update('korisnik', $podaci);
    }

    public function registracijaKorisnika() {
        $podaci = array(
            'FirstName' => $this->FirstName,
            'LastName' => $this->LastName,
            'email' => $this->Email,
            'password' => $this->Password,
            'datum_registracije' => date("Y-m-d H:i:s"),
            'status' => 0,
            'code' => $this->code,
            'id_uloga' => 2
        );
        if ($this->db->insert('korisnik', $podaci)) {
            return true;
        } else {
            return false;
        }
    }

    public function promeniStatus() {
        $uslov = array('Email' => $this->Email, 'code' => $this->code);
        $this->db->where($uslov);
        $status = array('status' => 1);

        if ($this->db->update('korisnik', $status)) {
            return true;
        } else {
            return false;
        }
    }

    public function vratiSveOKorisnikuUsername() {
        $query = $this->db->query('SELECT * FROM korisnik WHERE id_korisnik="' . $this->id_korisnik . '"');

        return $query->row();
    }

    public function promeniAvatar() {
        $uslov = array('email' => $this->Email);
        $this->db->where($uslov);
        $status = array('avatar' => $this->avatar);


        if ($this->db->update('korisnik', $status)) {
            return true;
        } else {
            return false;
        }
    }

    public function dodajPrijatelja() {
        $podaci = array(
            'id_korisnik' => $this->id_korisnik,
            'id_friend' => $this->id_friend
        );
        if ($this->db->insert('friends', $podaci)) {
            return true;
        } else {
            return false;
        }
    }

    public function dohvatiPrijatelja() {
        $query = $this->db->query('SELECT * FROM korisnik INNER JOIN friends ON korisnik.id_korisnik=fiends.id_korisnik');

        return $query->result();
    }

    function subscribed($idk, $idf) {
        return $this->db->get_where("friends", "id_korisnik='" . $idk . "' AND id_friend='" . $idf . "'")->row();
    }

    function subscribedNumber($idk) {
        //return $this->db->get_where("friends", array("id_korisnik"=>$idk))->num_rows();
        return $this->db->where('id_korisnik', $idk)
                        ->count_all_results('friends');
    }

    function subscribedUseri($idk) {
        $query = $this->db->query('SELECT k.id_korisnik as id_korisnik, k.avatar as avatar, k.FirstName as FirstName, k.LastName as LastName FROM korisnik k WHERE k.id_korisnik IN (SELECT f.id_friend FROM friends f WHERE f.id_korisnik="' . $idk . '")');

        return $query->result();
    }

}
