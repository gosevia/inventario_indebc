<?php
    class User extends CI_Controller{
        public function index(){
            $this->load->view('header');
            $this->load->view('login');
            $this->load->view('footer');
        }
        public function login(){
            
        }
    }
