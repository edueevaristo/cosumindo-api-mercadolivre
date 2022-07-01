<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Plataforma_model extends CI_Model {

//     //LISTAR
    public function index() 
    {
        //$this->db->order_by("plataforma");
        //return $this->db->get("plataforma")->result_array();
        
    }


//     //INSERIR
//     public function inserir($plataforma)
//     {
//         return $this->db->insert("plataforma", $plataforma);
//     }


//     //ATUALIZAR
//     public function mostrar($id)
//     {
//         return $this->db->get_where('plataforma', array('id' => $id))->row_array();
//     }

    
//     public function editar($id, $plataforma)
//     {
//         //$this->db->update('plataforma', $id->'id');
//         $this->db->set($plataforma);
//         $this->db->where('id', $id);
//         $this->db->update('plataforma');
//     }

    
//     //DELETAR
//     public function deletar($id)
//     {
//         $this->db->where("id", $id);
//         return $this->db->delete('plataforma');
//     }

}
