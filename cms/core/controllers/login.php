<?php

Class Login extends CI_Controller {

    function index()
    {

        $data['error'] = $this->session->flashdata('error');

        $this->load->view('includes/header');
        $this->load->view('login',$data);
        $this->load->view('includes/footer');

        if($this->session->flashdata('referrer') != ''){
            $this->session->set_flashdata('referrer', $this->session->flashdata('referrer'));
        }
    }

    function dologin(){

        $user = $this->input->post("user");
        $password = $this->input->post("password");

        $user_request = $this->auth->get_user($user,$password);

        //$user_request['result'] = 'success';
        if($user_request['result']=='success'){

            $user_data = array(
                'username'=>$user_request['username'],
                'nombre'=>$user_request['nombre'],
                'perfil'=>$user_request['perfil'],
                'islogged'=>TRUE
            );

            $this->session->set_userdata($user_data);
            if(! in_array($this->session->flashdata('referrer'), array('', base_url(), base_url().'login'))){
                redirect($this->session->flashdata('referrer'), 'refresh');

            }else{
                redirect(base_url().$this->config->item('controller_inicio'),'refresh');
            }

        }else{

            $this->session->set_flashdata('error', 'El usuario o la contrase&ntilde;a son incorrectos');

             if(! in_array($this->session->flashdata('referrer'), array('', base_url(),base_url().'login'))){
                $this->session->set_flashdata('referrer', $this->session->flashdata('referrer'));
            }

            redirect(base_url().'login','refresh');

        }

    }

    function logout(){
        $this->session->sess_destroy();

        redirect(base_url().'login','refresh');
    }

}
