<?php

class Ajax extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("Anketa_model", "ajax");
    }

    public function index() {
        echo "usao radi";
    }

    public function pollVote() {

        if ($this->input->post('vote')) {
            $id = $this->input->post('vote');
            if ($this->ajax->didhewote($id, $this->input->ip_address())) {
                echo "<div class='alert alert-danger'role='alert'>You have already voted.</div>";
                $res = $this->ajax->getPercentOfVotes($id);
                foreach ($res as $r) {
                    echo "<span>" . $r[0] . "</span> <div class='progress progress-striped active'><div class='progress-bar progress-bar-striped' role='progressbar' data-transitiongoal='" . number_format($r[1], 1) . "'>" . number_format($r[1], 1) . "%</div> </div> ";
                }
            } else {
                if ($this->ajax->writevote($id, $this->input->ip_address())) {
                    echo "<div class='alert alert-success'role='alert'>Thank you for voting.</div>";

                    $res = $this->ajax->getPercentOfVotes($id);
                    foreach ($res as $r) {
                        echo "<span>" . $r[0] . "</span> <div class='progress progress-striped active'><div class='progress-bar progress-bar-striped' role='progressbar' data-transitiongoal='" . number_format($r[1], 1) . "'>" . number_format($r[1], 1) . "%</div> </div> ";
                    }
                } else {
                    echo "<div class='alert alert-danger'role='alert'>Oh snap!We did something wrong.</div>";
                }
            }
        } else {
            echo "<div class='alert alert-warning'role='alert'>Next time select answer</div>";
        }
    }

    public function dodajLike($id = NULL) {

        $this->load->model('Posts_model');
        $this->Posts_model->id_post = $id;
        $this->Posts_model->id_korisnik = $this->session->userdata('id_korisnik');
        $brojLajkova = $this->Posts_model->dodajLikeVise();

        if ($id != NULL) {
            $this->load->view("ajax_test", array('brojLajkova' => $brojLajkova));
        } else {
            $this->load->view("ajax_test", array('brojLajkova' => 'error'));
        }
    }

}
