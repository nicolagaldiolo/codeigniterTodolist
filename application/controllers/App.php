<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App extends CI_Controller {

    function __construct(){
        parent::__construct();

        $loggedIn = $this->session->userdata('logged-in');

        if(!isset($loggedIn) || $loggedIn != true){
            // Not logged In
            show_404();
        }
    }

    function index(){ // il metodo index viene automaticamente chiamato quando viene chiamato il path es: App
        $userId = $this->session->userdata('id');
        $data['todos'] = $this->model->ra_object('todo', $userId); // chiamo il modello e lo assegno ad un array
        $this->load->view('list', $data);
    }

    function new_todo(){
        // ricevo i dati via get dal form

        // carico la libreria per validate il form
        $this->load->library('form_validation');

        // imposto i ruoli per la validazione, per ogni campo che voglio validare, e passo al metodo set_rules in ordine:
        //      il nome del campo del form da validare,
        //      un alias del campo, es: che mi viene tornato ad esempio nell'eventuale messaggio di errore
        //      i controlli/operazioni da fare su quei campi
        $this->form_validation->set_rules('todo', 'Todo Text', 'trim|required');

        if($this->form_validation->run() == FALSE){ // se la validazione del form fallisce restituisco un errore
            // failed
            $this -> index(); // se la validazione fallisce viene chiamato il metodo index e a sistema vengono valorizzati
            // anche dei messaggi di errore che ottengo chiamando la funzione validation_errors() nella view.

        }else{ // altrimenti salvo i dati
            // creo l'array coni dati che mi interessano da passare al modello
            $data = array(
                'idUsers' => $this->session->userdata('id'),
                'text' => $this->input->post('todo'),
                'createdAt' => date('Y-m-d H:i:s')
            );
            $this->model->c_object('todo', $data); // chiamo il modello passando i dati

            redirect('app'); //ritorno da sono sono arrivato.
        }
    }

    function todo(){
        $id = $this->uri->segment(3);
        $userId = $this->session->userdata('id');
        $data['todo'] = $this->model->r_object('todo', $id, $userId);


        // controllo se mi viene passato un todovalido in quanto potrebbero venirmi richiesti todonon validi o non di mia proprietà
        if($data['todo']){
            $this->load->view('update_todo', $data);
        }else {
            show_404();
        }

    }

    function edit(){
        $id = $this->input->post('id');

        $data = array(
            'text' => $this->input->post('todo')
        );

        $userId = $this->session->userdata('id');
        $this->model->u_object('todo', $id, $data, $userId);

        redirect('app');

    }

    function check(){
        $id = $this->uri->segment(3); //con il metodo segment mi ricavo il terzo parametro dell'url
        $data = array(
            'completed' => 1
        );
        $userId = $this->session->userdata('id');
        $this->model->u_object('todo', $id, $data, $userId);

        redirect('app');
    }

    function uncheck(){
        $id = $this->uri->segment(3); //con il metodo segment mi ricavo il terzo parametro dell'url
        $data = array(
            'completed' => 0
        );
        $userId = $this->session->userdata('id');
        $this->model->u_object('todo', $id, $data, $userId);

        redirect('app');
    }

    function destroy_todo(){
        $id = $this->uri->segment(3); //con il metodo segment mi ricavo il terzo parametro dell'url che viene passato ossia l'id da eliminare

        $userId = $this->session->userdata('id');
        $this->model->d_object('todo', $id, $userId); // chiamo il metodo che fa la cancellazione del record

        redirect('app'); // faccio il recirect
    }

    function logout(){
        $this->session->sess_destroy();
        redirect('welcome');
    }
}
