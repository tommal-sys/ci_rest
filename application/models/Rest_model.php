<?php

Class Rest_model extends CI_Model {
    /*     * ******************************************************************
      Rest functions
     * ****************************************************************** */

    function get_user($id) {
        $this->db->where('id', $id);
        $result = $this->db->get('rest')->row();

        return $result;
    }

    function save($data) {
        if ($data['id']) {
            $this->db->where('id', $data['id']);
            $this->db->update('rest', $data);
            return $data['id'];
        } else {
            $this->db->insert('rest', $data);
            $this->db->insert_id();
            $id = $this->db->insert_id();
            return $id;
        }
    }

    function delete_user($id) {
        //delete the user
        $this->db->where('id', $id);
        $this->db->delete('rest');
    }

}
