<?php

class Anketa_model extends CI_Model {

    public $id_anketa;
    public $userIP;
    public $id_poll;

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function dohvatiAnketu() {
        //SELECT * FROM poll INNER JOIN poll_answers ON poll.id_poll=poll_answers.id_poll LEFT JOIN poll_votes ON poll_answers.id_answers=poll_votes.id_answers
        $query = $this->db->query("SELECT * FROM poll WHERE active=1");

        return $query->result_array();
    }

    public function dohvatiOdgovoreAnkete() {
        $query = $this->db->query("SELECT * FROM poll_answers WHERE id_poll=1");

        return $query->result_array();
    }

    public function dohvatiUserIP() {
        $query = $this->db->query("SELECT id_votes FROM poll_votes WHERE id_address='" . $this->userIP . "'");

        return $query->num_rows();
    }

    public function dohvatiOdredjenuAnketu() {
        //SELECT * FROM poll INNER JOIN poll_answers ON poll.id_poll=poll_answers.id_poll LEFT JOIN poll_votes ON poll_answers.id_answers=poll_votes.id_answers
        $query = $this->db->query("SELECT * FROM poll_answers WHERE id_poll='" . $this->id_poll . "'");

        return $query->result_array();
    }

    public function getactivepoll() {
        $data = array();

        $this->db->select("*");
        $this->db->from("poll");
        $this->db->where("active", 1);
        $this->db->order_by("", "RANDOM");
        $this->db->limit(1);
        $data["question"] = $this->db->get()->row();

        if ($data["question"]) {
            $this->db->select("*");
            $this->db->from("poll_answers");
            $this->db->where("id_poll", $data["question"]->id_poll);
            $data["answers"] = $this->db->get()->result();
        } else {
            return false;
        }
        return $data;
    }

    public function didhewote($id, $ip) {
        $this->db->select("id_poll");
        $this->db->from("poll_answers");
        $this->db->where("id_answers", $id);
        $question = $this->db->get()->row();

        $this->db->select("id_poll");
        $this->db->from("poll_votes");
        $this->db->where("id_poll", $question->id_poll);
        $this->db->where("id_address", $ip);
        $vote = $this->db->get()->num_rows();
        if ($vote) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function writevote($id, $ip) {
        $this->db->select("id_poll");
        $this->db->from("poll_answers");
        $this->db->where("id_answers", $id);
        $question = $this->db->get()->row();

        $this->db->set('votes', 'votes+1', FALSE);
        $this->db->where('id_answers', $id);
        $this->db->update('poll_answers');

        return $this->db->insert("poll_votes", array(
                    "id_poll" => $question->id_poll,
                    "id_answers" => $id,
                    "id_address" => $ip
        ));
    }

    public function getPercentOfVotes($id) {
        $this->db->select("id_poll");
        $this->db->from("poll_answers");
        $this->db->where("id_answers", $id);
        $questionId = $this->db->get()->row()->id_poll;

        $this->db->select("answer,votes");
        $this->db->from("poll_answers");
        $this->db->where("id_poll", $questionId);
        $res = $this->db->get()->result();

        $votesum = 0;
        foreach ($res as $row) {
            $votesum += $row->votes;
        }

        $onepercent = 100 / $votesum;
        $value = array();

        foreach ($res as $row) {
            $value[] = array($row->answer, $row->votes * $onepercent);
        }

        return $value;
    }

}
