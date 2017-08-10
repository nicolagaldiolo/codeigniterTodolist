<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model extends CI_Model {

    function validate_credentials($email, $password){
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('email', $email);
        $this->db->where('password', sha1($password)); // sha1 è la funzione che mi permette di criptare la password.

        $query = $this->db->get();

        if($query && $query->num_rows() == 1) {
            return $query->result()[0];
        }else{
            return null;
        }
    }


    // CRUD - Acrononimo che viene utilizzato per indicare le operazioni classiche che vengono
    // eseguite su un set di informazioni.

    // C - Create
    function c_object($table, $data){
        $this->db->insert($table, $data);
    }

    // R - Read
    function ra_object($table, $user){

        // Chiamo il metodo query che effettivamente esegue la query (query lanciata in maniera manuale).
        //$query = $this->db->query('SELECT * FROM todo');

        // query lanciata con metodo Active Records
        $this->db->select('*');
        $this->db->from($table);
        if($user) {
            $this->db->where('idUsers', $user);
        }

        $query = $this->db->get();

        if($query->num_rows() > 0){ // chiamo il metodo num_rows per controllare se è presente almeno una riga
            foreach ($query->result() as $row){ // il metodo result() mi torna l'array dei risultati
                $data[] = $row;
            }
            return $data;
        }
    }

    function r_object($table, $id, $user){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where('id', $id);
        if($user) {
            $this->db->where('idUsers', $user);
        }

        $query = $this->db->get()->result();

        if($query) {
            return $query[0];
        }else{
            return null;
        }
    }

    // U - Update
    function u_object($table, $id, $data, $user){
        $this->db->where('id', $id);
        if($user) {
            $this->db->where('idUsers', $user);
        }
        $this->db->update($table, $data);
    }

    // D - Delete
    function d_object($table, $id, $user){
        $this->db->where('id', $id);
        if($user) {
            $this->db->where('idUsers', $user);
        }
        $this->db->delete($table);
    }

}