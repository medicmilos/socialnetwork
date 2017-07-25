<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Logovanje extends MY_Controller {

    private $podaci = array();

    public function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->view('header');

        $menu = $this->ucitajFooterMenuSajta();
        $this->podaci['footerMenu'] = $menu;
    }

    public function index() {
        $this->initform();


        $this->form_validation->set_rules('tbFirstName', 'FirstName', 'trim|required|min_length[3]|max_length[30]');
        $this->form_validation->set_rules('tbLastName', 'LastName', 'trim|required|min_length[3]|max_length[30]');
        $this->form_validation->set_rules('tbEmail', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('tbPassword', 'Password', 'trim|required|min_length[5]|matches[tbPasswordConfirm]');
        $this->form_validation->set_rules('tbPasswordConfirm', 'Re-enter password', 'trim|required');
        $this->form_validation->set_rules('optradio', 'Gender', 'required');

        $this->form_validation->set_message('required', 'The %s field is required');
        $this->form_validation->set_message('min_length', 'The %s field must have more than 3 characters');
        $this->form_validation->set_message('max_length', 'The %s field must have mless than 30 characters');
        $this->form_validation->set_message('matches', 'Passwords must match');
        $this->form_validation->set_message('is_unique', 'The %s field must be unique');
        $this->form_validation->set_message('valid_email', 'Please enter valid email address');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('home', $this->podaci);
            $this->load->view('footer');
        } else {
            $FirstName = $this->input->post('tbFirstName');
            $LastName = $this->input->post('tbLastName');
            $Email = $this->input->post('tbEmail');
            $Password = $this->input->post('tbPassword');
            $Gender = $this->input->post('optradio');

            $this->load->model('Korisnik_model', 'korisnik');
            $this->korisnik->FirstName = $FirstName;
            $this->korisnik->LastName = $LastName;
            $this->korisnik->Email = $Email;
            $this->korisnik->Password = $Password;
            $x = $this->randomString(10);
            $this->korisnik->code = $x;

            if ($this->korisnik->registracijaKorisnika()) {
                $this->korisnik->Email = $Email;
                $this->korisnik->code = $x;

                $message = "<html><body><table ><tr><td></td><td width='600' style='display: block !important;max-width: 600px !important; margin: 0 auto !important;  clear: both !important; margin: 0; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box;font-size: 14px;'><div><table style=' background-color: #fff;border: 1px solid #e9e9e9;border-radius: 3px;' width='100%' cellpadding='0' cellspacing='0'><tr><td style='padding: 20px;'><table width='100%' cellpadding='0' cellspacing='0'><tr><td style='padding: 0 0 20px;'>Please confirm your email address by clicking the link below.</td></tr><tr><td style='padding: 0 0 20px;'>We may need to send you information about our service and it is important that we have an accurate email address.</td></tr><tr><td style='padding: 0 0 20px;'><a href='" . base_url() . "Logovanje/potvrdiEmail/" . $Email . "/" . $x . "' style='text-decoration: none;color: #FFF; background-color: #348eda; border: solid #348eda; border-width: 10px 20px;line-height: 2em;  font-weight: bold;  text-align: center; cursor: pointer; display: inline-block; border-radius: 5px;text-transform: capitalize;'>Confirm email address</a></td></tr><tr><td style='padding: 0 0 20px;'>&mdash;This is a generic email, so please do not answer.<br/>&mdash; The Social network Team</td></tr></table></td></tr></table></div></td><td></td></tr></table></body></html>";
                $this->load->library('email');
                $this->email->set_mailtype("html");
                $this->email->set_newline("\r\n");
                $this->email->from('milos.medic.pvt@gmail.com', 'Social network');
                $this->email->to($Email);
                $this->email->subject('Social network account registration');
                $this->email->message($message);
                if ($this->email->send()) {
                    $this->potreban = true;
                    $this->potvrditiAccount($Email, $x);
                } else {
                    show_error($this->email->print_debugger());
                }
            } else {
                echo "nismo ga registrovali";
				
                $this->podaci['greska_baza'] = "Sorry, we have a problem with your registration, please try again later.";
            }
        }
        
    }

    private function initform() {
        $form_tag_atributi = array('class' => 'form-inline', 'name' => 'login', 'id' => "regexpForm"); //,'onSubmit'=>'return provera();'
        $this->podaci['form_tag_atributi'] = $form_tag_atributi;
        $email_atributi = array('id' => 'exampleInputName2', 'name' => 'tbEmail', 'class' => 'form-control', 'placeholder' => 'Email', 'value' => set_value('tbEmail'));
        $this->podaci['email_atributi'] = $email_atributi;
        $password_atributi = array('id' => 'exampleInputEmail2', 'name' => 'tbPassword', 'class' => 'form-control', 'placeholder' => 'Password', 'value' => set_value('tbPassword'));
        $this->podaci['password_atributi'] = $password_atributi;
        $submit_atributi = array('name' => 'btnLogin', 'class' => 'btn btn-primary', 'value' => 'Log in');
        $this->podaci['submit_atributi'] = $submit_atributi;

        $form_tag_atributiReg = array('id' => 'formaRegistracija', 'class' => 'registerf form-inline', 'name' => 'formaRegistracija');
        //, 'onSubmit'=>'registracijaProvera();'
        $this->podaci['form_tag_atributiReg'] = $form_tag_atributiReg;
        $firstName_atributiReg = array('id' => 'tbFirstName', 'name' => 'tbFirstName', 'class' => 'form-control', 'placeholder' => 'Your first name', 'value' => set_value('tbFirstName'));
        $this->podaci['firstName_atributiReg'] = $firstName_atributiReg;
        $lastName_atributiReg = array('id' => 'tbLastName', 'name' => 'tbLastName', 'class' => 'form-control', 'placeholder' => 'Your last name', 'value' => set_value('tbLastName'));
        $this->podaci['lastName_atributiReg'] = $lastName_atributiReg;
        $email_atributiReg = array('id' => 'tbEmail', 'name' => 'tbEmail', 'class' => 'form-control', 'placeholder' => 'Email', 'value' => set_value('tbEmail'));
        $this->podaci['email_atributiReg'] = $email_atributiReg;
        $password_atributiReg = array('id' => 'tbPassword', 'name' => 'tbPassword', 'class' => 'form-control', 'placeholder' => 'Password', 'value' => set_value('tbPassword'));
        $this->podaci['password_atributiReg'] = $password_atributiReg;
        $password_confirm_atributiReg = array('id' => 'tbPasswordConfirm', 'name' => 'tbPasswordConfirm', 'class' => 'form-control', 'placeholder' => 'Re-enter password', 'value' => set_value('tbPasswordConfirm'));
        $this->podaci['password_confirm_atributiReg'] = $password_confirm_atributiReg;
        $male_atributiReg = array('name' => 'optradio', 'value' => 'male');
        $this->podaci['male_atributiReg'] = $male_atributiReg;
        $female_atributiReg = array('name' => 'optradio', 'value' => 'female');
        $this->podaci['female_atributiReg'] = $female_atributiReg;
        $submit_atributiReg = array('name' => 'btnRegister', 'class' => 'btn btn-success', 'value' => 'Sign up');
        $this->podaci['submit_atributiReg'] = $submit_atributiReg;
    }

    public function potvrditiAccount($Email, $x) {
        $this->podaci['Email'] = $Email;
        $this->podaci['code'] = $x;
        $this->load->view('potvrdiAccount', $this->podaci);
    }

    public function potvrdiEmail($email, $code) {
        $this->load->model('Korisnik_model', 'korisnik');
        $this->korisnik->Email = $email;
        $this->korisnik->code = $code;
        if ($this->korisnik->promeniStatus()) {
            //$this->session->set_flashdata(array('potvrdio'=>true, 'username'=>$username)); 
            $this->load->view("succesfuly_registered");
        } else {
            redirect('Logovanje/lostPassword');
        }
    }

    public function login() {
        $email = trim($this->input->post("tbEmail"));
        $password = trim($this->input->post("tbPassword"));

        if ($email != "" && $password != "") {
            $this->load->model('Korisnik_model', 'korisnik');
            $this->korisnik->email = $email;
            $this->korisnik->password = md5($password);
            $korisnik = $this->korisnik->proveri();

            if (count($korisnik) > 0) {
                $uloga = $korisnik->uloga;
                $id_korisnik = $korisnik->id_korisnik;
                $email = $korisnik->email;
                $FirstName = $korisnik->FirstName;
                $LastName = $korisnik->LastName;
                $avatar = $korisnik->avatar;

                switch ($uloga) {
                    case "admin":
                        $newdata = array(
                            'id_korisnik' => $id_korisnik,
                            'uloga' => $uloga,
                            'email' => $email,
                            'FirstName' => $FirstName,
                            'LastName' => $LastName,
                            'avatar' => $avatar,
                            'ulogovan' => TRUE
                        );
                        $this->session->set_userdata($newdata);
                        redirect("Feed");
                        exit();
                        break;

                    case "korisnik":
                        $newdata = array(
                            'id_korisnik' => $id_korisnik,
                            'uloga' => $uloga,
                            'email' => $email,
                            'FirstName' => $FirstName,
                            'LastName' => $LastName,
                            'avatar' => $avatar,
                            'ulogovan' => TRUE
                        );
                        $this->session->set_userdata($newdata);
                        redirect("Feed");
                        exit();
                        break;
                }
            } else {
                redirect("Logovanje");
            }
        } else {
            redirect("Logovanje");
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect("Logovanje");
    }

    public function lostPassword() {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_message('valid_email', 'Please enter valid email address');
        $this->form_validation->set_message('required', 'Please enter a valid email address');
        $this->form_validation->set_message('email_check', 'That email address does not exist in our database.');

        $email_atributi = array('id' => 'tbEmail', 'name' => 'tbEmail', 'class' => 'form-control', 'placeholder' => 'example@email.com');
        $this->podaci['email_atributi'] = $email_atributi;
        $submit_atributi = array('class' => 'btn btn-primary', 'name' => 'btnLogin', 'id' => 'btnLogin', 'value' => 'Send');
        $this->podaci['submit_atributi'] = $submit_atributi;

        $form_tag_atributi = array('id' => 'formaRegistracija', 'name' => 'formaRegistracija'); //,'onSubmit'=>'return provera();
        $this->podaci['form_tag_atributi'] = $form_tag_atributi;

        $rules = array(
            array('field' => 'tbEmail', 'label' => 'Email', 'rules' => 'trim|required|valid_email')
        );

        $this->form_validation->set_rules($rules);

        if ($this->form_validation->run()) {
            $email = $this->input->post('tbEmail');
            $this->load->model('Korisnik_model', 'korisnik');
            $this->korisnik->email = $email;
            $korisnik = $this->korisnik->email();

            $email2 = isset($korisnik) ? $korisnik->email : null;

            if ($email == $email2) {
                $new_password = $this->randomString(10);
                $this->korisnik->FirstName = $korisnik->FirstName;
                $this->korisnik->LastName = $korisnik->LastName;
                $this->korisnik->id_korisnik = $korisnik->id_korisnik;
                $this->korisnik->email = $korisnik->email;
                $this->korisnik->password = $new_password;
                $this->korisnik->email = $email;
                $this->korisnik->status = $korisnik->status;
                $this->korisnik->code = $korisnik->code;
                $this->korisnik->id_uloga = $korisnik->id_uloga;
                $this->korisnik->izmeniKorisnika();
                $email = $korisnik->email;

                $this->load->library('email');
                $this->email->from('milos.medic.pvt@gmail.com', 'Network');
                $this->email->to($email);
                $this->email->cc('milos.medic.pvt@gmail.com');
                $this->email->bcc('milos.medic.pvt@gmail.com');
                $this->email->subject('New Password');
                $this->email->message('This is your email - ' . $email . ' and your new password - ' . $new_password . '. Try to save it. ' . base_url() . '/Logovanje.');
                $this->email->send();

                $form_tag_atributi = array('class' => 'form-inline','id'=>'confirmform', 'name' => 'login'); //,'onSubmit'=>'return provera();'
                $this->podaci['form_tag_atributi'] = $form_tag_atributi;
                $email_atributi = array('id' => 'exampleInputName2', 'name' => 'tbEmail', 'class' => 'form-control', 'placeholder' => 'Email');
                $this->podaci['email_atributi'] = $email_atributi;
                $password_atributi = array('id' => 'exampleInputEmail2', 'name' => 'tbPassword', 'class' => 'form-control', 'placeholder' => 'Password');
                $this->podaci['password_atributi'] = $password_atributi;
                $submit_atributi = array('name' => 'btnLogin', 'class' => 'btn btn-primary', 'value' => 'Log in');
                $this->podaci['submit_atributi'] = $submit_atributi;
                $this->load->view("lost_password_confirm", $this->podaci);
            } else {
                $form_tag_atributi = array('class' => 'form-inline','id'=>'confirmform', 'name' => 'login'); //,'onSubmit'=>'return provera();'
                $this->podaci['form_tag_atributi'] = $form_tag_atributi;
                $email_atributi = array('id' => 'exampleInputName2', 'name' => 'tbEmail', 'class' => 'form-control', 'placeholder' => 'Email');
                $this->podaci['email_atributi'] = $email_atributi;
                $password_atributi = array('id' => 'exampleInputEmail2', 'name' => 'tbPassword', 'class' => 'form-control', 'placeholder' => 'Password');
                $this->podaci['password_atributi'] = $password_atributi;
                $submit_atributi = array('name' => 'btnLogin', 'class' => 'btn btn-primary', 'value' => 'Log in');
                $this->podaci['submit_atributi'] = $submit_atributi;
                $this->podaci['nepoznat_korisnik'] = "User with that email doesnt exist.";
                $this->load->view("lost_password", $this->podaci);
            }
        } else {
            $this->load->view("lost_password", $this->podaci);
        }
    }

    public function randomString($length) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

}
