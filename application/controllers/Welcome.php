<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index(){
	    $this->load->view('login');
	}

	public function login(){
        // carico la libreria di validazione
	    $this->load->library('form_validation');

	    // faccio il controllo sui campi
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if($this->form_validation->run() == FALSE){
            // se la validazione fallisce richiamo il metodo index e vengono passati i messaggi di errore
            $this -> index();
        }else{
            // se la validazione è andata a buonfine recupero email e password dal form e interrogo il db
            // per sapere se c'è un utente con queste credenziali

            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $user = $this->model->validate_credentials($email, $password);

            if($user){
                //se l'utente è presente salvo in sessione i suoi dati e redirigo alla nostra app
                $data = array(
                    'id' => $user->id,
                    'email' => $user->email,
                    'logged-in' => true
                );
                $this->session->set_userdata($data);
                redirect('app');
            }else{
                redirect('welcome');
            }
        }

    }
}
