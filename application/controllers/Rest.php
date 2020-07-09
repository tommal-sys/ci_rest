<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Rest extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->database();
        $this->load->model('Rest_model');
    }

    /**
     * Index Page for this controller.
     */
    public function index() {
        $this->load->view('rest_message');
    }

    public function get($id) {

        $user = $this->Rest_model->get_user($id);
        if ($user) {
            header('Content-Type: application/json');
            echo json_encode( $user );die;
        } else {
            header('Content-Type: application/json');
            $jsonobj = '{"message":error_user_not_found}';
            echo json_encode( $jsonobj );die;
        }
    }

    public function add() {


        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $this->form_validation->set_rules('first_name', 'lang:first_name', 'required|trim|max_length[32]');
        $this->form_validation->set_rules('last_name', 'lang:last_name', 'required|trim|max_length[32]');
        $this->form_validation->set_rules('age', 'lang:age', 'required|trim');
        $this->form_validation->set_rules('phone', 'lang:phone', 'required|trim|min_length[9]|max_length[25]');
        $this->form_validation->set_rules('email', 'lang:email', 'required|trim|valid_email|max_length[128]');
        $this->form_validation->set_rules('password', 'lang:password', 'required|min_length[4]|md5');
        $this->form_validation->set_rules('price', 'lang:price', 'required|trim');

        // Validate the form
        if ($this->form_validation->run() == false) {
            $this->form_validation->set_message('rule', 'Error Message');
            header('Content-Type: application/json');
            $jsonobj = '{"message":error_form_validation}';
            echo json_encode( $jsonobj );die;
        } else {

            $user['id'] = null;
            $user['first_name'] = $this->input->post('first_name');
            $user['last_name'] = $this->input->post('last_name');
            $user['age'] = $this->input->post('age');
            $user['phone'] = $this->input->post('phone');
            $user['email'] = $this->input->post('email');
            $user['password'] = $this->input->post('password');
            $user['price'] = $this->input->post('price');
            
            $user_id = $this->Rest_model->save($user);
            $new_user = $this->Rest_model->get_user($user_id);
            $new_user->massage = "Successful add user";
            header('Content-Type: application/json');
            echo json_encode( $new_user );die;
        }

        
        
        
    }

    public function update($id) {


        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $this->form_validation->set_rules('first_name', 'lang:first_name', 'required|trim|max_length[32]');
        $this->form_validation->set_rules('last_name', 'lang:last_name', 'required|trim|max_length[32]');
        $this->form_validation->set_rules('age', 'lang:age', 'required|trim');
        $this->form_validation->set_rules('phone', 'lang:phone', 'required|trim|min_length[9]|max_length[25]');
        $this->form_validation->set_rules('email', 'lang:email', 'required|trim|valid_email|max_length[128]');
        $this->form_validation->set_rules('password', 'lang:password', 'required|min_length[4]');
        $this->form_validation->set_rules('price', 'lang:price', 'required|trim');

        // Validate the form
        if ($this->form_validation->run() == false) {
            $this->form_validation->set_message('rule', 'Error Message');
            header('Content-Type: application/json');
            $jsonobj = '{"message":error_form_validation}';
            echo json_encode( $jsonobj );die;
        } else {

            $user['id'] = $id;
            $user['first_name'] = $this->input->post('first_name');
            $user['last_name'] = $this->input->post('last_name');
            $user['age'] = $this->input->post('age');
            $user['phone'] = $this->input->post('phone');
            $user['email'] = $this->input->post('email');
            $user['password'] = $this->input->post('password');
            $user['price'] = $this->input->post('price');
            
            $this->Rest_model->save($user);
            $update_user = $this->Rest_model->get_user($user['id']);
            $update_user->massage = "Successful update user";
            header('Content-Type: application/json');
            echo json_encode( $update_user );die;
        }

    }

    public function delete($id) {

        $user = $this->Rest_model->get_user($id);

        if ($user) {
            $this->Rest_model->delete_user($id);
            header('Content-Type: application/json');
            $jsonobj = '{"message":user_deleted}';
            echo json_encode( $jsonobj );die;
        } else {
           header('Content-Type: application/json');
            $jsonobj = '{"message":error_user_not_found}';
            echo json_encode( $jsonobj );die;
        }
    }

}
