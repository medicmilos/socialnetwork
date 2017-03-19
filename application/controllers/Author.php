<?php

class Author extends MY_Controller {

    private $podaci = array();

    public function __construct() {
        parent::__construct();

        $this->podaci['title'] = "Network | Author";

        if ($this->session->userdata('ulogovan')) {
            $menu = $this->ucitajLeviMenuSajta();
            $this->podaci['leviMenu'] = $menu;
        }

        $menu = $this->ucitajDesniMenuSajta();
        $this->podaci['desniMenu'] = $menu;
        $menu = $this->ucitajFooterMenuSajta();
        $this->podaci['footerMenu'] = $menu;
    }

    public function index() {
        $this->load->view('header');
        $this->load->view('author', $this->podaci);
        $this->load->view('footer');
    }

}
