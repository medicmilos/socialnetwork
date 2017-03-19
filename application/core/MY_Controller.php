<?php

class MY_Controller extends CI_Controller {

    private $podaci = array();

    public function __construct() {
        parent::__construct();

        $this->initHead();
        $this->load->view('head', $this->podaci);
        $this->load->library("pagination");
        
    }

    public function ucitajLeviMenuSajta() {
        $this->load->model('Menu_model');
        $this->Menu_model->place = 1;
        $menu = $this->Menu_model->menuSajta();

        return $menu;
    }

    public function ucitajDesniMenuSajta() {
        $this->load->model('Menu_model');
        $this->Menu_model->place = 2;
        $menu = $this->Menu_model->menuSajta();

        return $menu;
    }

    public function ucitajFooterMenuSajta() {
        $this->load->model('Menu_model');
        $this->Menu_model->place = 3;
        $menu = $this->Menu_model->menuSajta();

        return $menu;
    }

    public function initHead() {
        $this->podaci['meta'] = array(
            array('name' => 'viewport', 'content' => 'width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;'),
            array('name' => 'robots', 'content' => 'no-cache'),
            array('name' => 'description', 'content' => 'Sajt za php 2'),
            array('name' => 'keywords', 'content' => 'Neke reci'),
            array('name' => 'Content-type', 'content' => 'text/html; charset=utf-8', 'type' => 'equiv')
        );

        $this->podaci['base_url'] = base_url();
        $this->podaci['links'][] = link_tag('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css', 'stylesheet');
        $this->podaci['links'][] = link_tag('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css', 'stylesheet');
        $this->podaci['links'][] = link_tag('css/style.css');
        $this->podaci['links'][] = link_tag('css/lightbox.min.css');
    }

    function time_elapsed_string($datetime, $full = false) {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        
        $diff = $now->diff($ago);
        
        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full)
            $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }

}
