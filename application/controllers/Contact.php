<?php

class Contact extends MY_Controller {

    private $podaci = array();

    public function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
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
        $this->initform();

        $this->load->view('header');


        $this->form_validation->set_rules('tbName', 'Full Name', 'trim|required|min_length[3]|max_length[50]');
        $this->form_validation->set_rules('tbEmail', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('taMessage', 'Message', 'trim|required|min_length[3]|max_length[1000]');

        $this->form_validation->set_message('required', 'The %s field is required');
        $this->form_validation->set_message('min_length', 'The %s field must have more than 3 characters');
        $this->form_validation->set_message('max_length', 'The %s field must have less than 1000 characters');
        $this->form_validation->set_message('valid_email', 'Please enter valid email address');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('contact', $this->podaci);
            $this->load->view('footer');
        } else {
            $FullName = $this->input->post('tbName');
            $email = $this->input->post('tbEmail');
            $taMessage = $this->input->post('taMessage');

            $message = "<!DOCTYPE html><html><head><style type='text/css'>.table-fill{background:#fff;border-radius:3px;border-collapse:collapse;height:320px;margin:auto;max-width:600px;padding:5px;width:100%;box-shadow:0 5px 10px rgba(0,0,0,0.1);animation:float 5s infinite}th{color:#D5DDE5;background:#1b1e24;border-bottom:4px solid #9ea7af;border-right:1px solid #343a45;font-size:23px;font-weight:100;padding:24px;text-align:left;text-shadow:0 1px 1px rgba(0,0,0,0.1);vertical-align:middle}th:first-child{border-top-left-radius:3px}th:last-child{border-top-right-radius:3px;border-right:none}tr{border-top:1px solid #C1C3D1;border-bottom-:1px solid #C1C3D1;color:#666B85;font-size:16px;font-weight:400;text-shadow:0 1px 1px rgba(256,256,256,0.1)}tr:hover td{background:#4E5066;color:#FFF;border-top:1px solid #22262e;border-bottom:1px solid #22262e}tr:first-child{border-top:none}tr:last-child{border-bottom:none}tr:nth-child(odd) td{background:#EBEBEB}tr:nth-child(odd):hover td{background:#4E5066}tr:last-child td:first-child{border-bottom-left-radius:3px}tr:last-child td:last-child{border-bottom-right-radius:3px}td{background:#FFF;padding:20px;text-align:left;vertical-align:middle;font-weight:300;font-size:18px;text-shadow:-1px -1px 1px rgba(0,0,0,0.1);border-right:1px solid #C1C3D1}td:last-child{border-right:0}th.text-left{text-align:left}th.text-center{text-align:center}th.text-right{text-align:right}td.text-left{text-align:left}td.text-center{text-align:center}td.text-right{text-align:right}</style></head><body><table class='table-fill'><thead><tr><th class='text-left'>Name</th><th class='text-left'>Email</th><th class='text-left'>Message</th></tr></thead><tbody class='table-hover'><tr><td class='text-left'>" . $FullName . "</td><td class='text-left'>" . $email . "</td><td class='text-left'>" . $taMessage . "</td></tr></tbody></table></body></html>";
            $this->load->library('email');
            $this->email->set_mailtype("html");
            $this->email->set_newline("\r\n");
            $this->email->from($email, 'Social network');
            $this->email->to('milos.medic.130.14@ict.edu.rs');
            $this->email->subject('Social network | Contact form');
            $this->email->message($message);
            if ($this->email->send()) {
                //NEKA PORUKA DA JE MAIL USPESNO POSLAT
                redirect("Contact");
            } else {
                show_error($this->email->print_debugger());
            }
        }
    }

    private function initform() {
        $form_tag_atributi = array('name' => 'login', 'id' => 'contact'); //,'onSubmit'=>'return provera();'
        $this->podaci['form_tag_atributi'] = $form_tag_atributi;
        $fullName_atributi = array('id' => 'tbName', 'name' => 'tbName', 'placeholder' => 'Your name', 'value' => set_value('tbName'));
        $this->podaci['fullName_atributi'] = $fullName_atributi;
        $email_atributi = array('id' => 'tbEmail', 'name' => 'tbEmail', 'placeholder' => 'Your Email Address', 'value' => set_value('tbEmail'));
        $this->podaci['email_atributi'] = $email_atributi;
        $textarea_atributiReg = array('id' => 'taMessage', 'name' => 'taMessage', 'placeholder' => 'Type your message here...', 'value' => set_value('taMessage'));
        $this->podaci['textarea_atributiReg'] = $textarea_atributiReg;
        $submit_atributi = array('name' => 'btnSubmit', 'class' => 'btn btn-primary', 'id' => 'contact-submit', 'value' => 'Submit');
        $this->podaci['submit_atributi'] = $submit_atributi;
    }

}
