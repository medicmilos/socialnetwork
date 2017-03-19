<?php

class Posts_model extends CI_Model {

    public $id_post;
    public $id_korisnik;
    public $description;
    public $time;
    public $limit;
    public $offset;
    public $FirstName;
    public $LastName;
    public $avatar;
    public $Email;
    public $comment;

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function dohvatiKorisnikovePostove() {
        $query = $this->db->query('SELECT * FROM posts INNER JOIN korisnik ON posts.id_korisnik=korisnik.id_korisnik WHERE posts.id_korisnik="' . $this->id_korisnik . '" ORDER BY posts.time DESC');

        return $query->result();
    }

    public function dohvatiSvePostove() {
        $string = "";
        if (isset($this->limit)) {
            $string .= " LIMIT " . $this->limit;
        }
        if (isset($this->offset)) {
            $string .= " OFFSET " . $this->offset;
        }

        //$query = $this->db->query('SELECT * FROM posts INNER JOIN korisnik ON posts.id_korisnik=korisnik.id_korisnik ORDER BY posts.time DESC' . $string);
        //$query = $this->db->query('SELECT posts.likes as likes, korisnik.avatar as avatar,korisnik.FirstName as FirstName, korisnik.id_korisnik as id_korisnik,korisnik.LastName as LastName, posts.time as time,posts.description as description, posts.id_post as id_post FROM posts INNER JOIN korisnik ON posts.id_korisnik=korisnik.id_korisnik LEFT JOIN comments ON comments.id_post=posts.id_post ORDER BY posts.time DESC' . $string);
        $query = $this->db->query('SELECT posts.likes as likes, korisnik.avatar as avatar,korisnik.FirstName as FirstName, korisnik.id_korisnik as id_korisnik,korisnik.LastName as LastName, posts.time as time,posts.description as description, posts.id_post as id_post FROM posts INNER JOIN korisnik ON posts.id_korisnik=korisnik.id_korisnik '
                . 'WHERE posts.id_korisnik IN (SELECT id_friend FROM friends WHERE id_korisnik="' . $this->id_korisnik . '") ORDER BY posts.time DESC' . $string);
        //$query = $this->db->query('SELECT posts.likes as likes, korisnik.avatar as avatar,korisnik.FirstName as FirstName, korisnik.id_korisnik as id_korisnik,korisnik.LastName as LastName, posts.time as time,posts.description as description, posts.id_post as id_post FROM posts INNER JOIN korisnik ON posts.id_korisnik=korisnik.id_korisnik LEFT JOIN comments ON comments.id_post=posts.id_post ORDER BY posts.time DESC' . $string);

        return $query->result();
    }

    public function proveraLajkova() {
        $query = $this->db->query('SELECT COUNT(*) as broj FROM posts INNER JOIN posts_korisnik ON posts.id_post=posts_korisnik.id_post INNER JOIN korisnik ON posts_korisnik.id_korisnik=korisnik.id_korisnik WHERE posts_korisnik.id_korisnik="' . $this->id_korisnik . '"  AND posts_korisnik.id_post="' . $this->id_post . '"');

        return $query->row_array();
    }

    public function unosPosta() {
        $podaci = array(
            'id_korisnik' => $this->id_korisnik,
            'description' => $this->description
        );
        if ($this->db->insert('posts', $podaci)) {
            return true;
        } else {
            return false;
        }
    }

    public function brojPostova() {
        $query = $this->db->query("SELECT * FROM  posts");

        return $query->num_rows();
    }

    public function unosKomentara() {
        $podaci = array(
            'id_post' => $this->id_post,
            'email' => $this->Email,
            'comment' => $this->comment
        );
        if ($this->db->insert('comments', $podaci)) {
            return true;
        } else {
            return false;
        }
    }

    public function dodajLikeVise() {
        $query = $this->db->query("SELECT likes from posts WHERE id_post=" . $this->id_post);
        $broj = $query->row(0);

        $brojic = $broj->likes + 1;
        $podaci = array('likes' => $brojic);

        $this->db->where('id_post', $this->id_post);
        $this->db->update('posts', $podaci);


        $this->db->insert('posts_korisnik', array('id_korisnik' => $this->id_korisnik, 'id_post' => $this->id_post, 'likes' => 1));

        return $broj;
    }

    public function dalijeLajkovan() {
        $query = $this->db->query('SELECT * FROM posts_korisnik');

        return $query->result();
    }

    public function dohvatiKomentareKorisnik() {
        $query = $this->db->query('SELECT * FROM comments INNER JOIN korisnik ON korisnik.email=comments.email');

        return $query->result();
    }

    public function dohvatiPostoveKorisnik() {
        $query = $this->db->query('SELECT * FROM posts INNER JOIN korisnik ON korisnik.id_korisnik=posts.id_korisnik');

        return $query->result();
    }

}
