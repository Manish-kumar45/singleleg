<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class BankWithdraw extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email', 'pagination', 'Excel'));
        $this->load->model(array('Main_model'));
        $this->load->helper(array('admin', 'security'));
        $this->accessToken = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjNlZWVhMWIxNzkyMzUxYTIxODEyOWYwYWFiOGQ1MzBlMjhhMmU3N2MxM2U3ZjFjYTY5NDMzMzM0ZDgwMWUwMmVhY2EwNTU4ZDZiN2ZiN2E2In0.eyJhdWQiOiIxIiwianRpIjoiM2VlZWExYjE3OTIzNTFhMjE4MTI5ZjBhYWI4ZDUzMGUyOGEyZTc3YzEzZTdmMWNhNjk0MzMzMzRkODAxZTAyZWFjYTA1NThkNmI3ZmI3YTYiLCJpYXQiOjE1OTYyMTg3NjgsIm5iZiI6MTU5NjIxODc2OCwiZXhwIjoxNjI3NzU0NzY4LCJzdWIiOiIzMTYiLCJzY29wZXMiOltdfQ.AjEt3P6vhcdGa9LkaJNXN1zMr9m3hcMKZw_6D7KWYWd06Nkwxd5Q1A6yjofM9n0Oo9z2_WcbhUa3wlWq2CA-uCSnVS0Mkh0orGLCMSe-4RHozBTbLH8y_8JAWcYO0l9VAb2OzGxJU-P3yQjICvV__JkWqw1Enf72en9XQtXCJzPtxm1O1GLdod4vw483DVbBitpayfqd7sZkgw2GWoyzkguruVNBE33gHDCLMvR7z1IymkzXttPX4X4PuEbFbsDx_ZNL73Yv7ehCDiuBeI69g-P0dPSjawmFtJ7VqzELI68-ik7-QEtliPcIhtFI5cmb9k_KODvpsqL6BmIPjVAjLWoLpXiuiTi3c3Sn1EqHFdFPqvOoEPt7LkMUIMldrNIR6f2CWhaF6-70F-uMhTjM0cxlQYNaYx_91uVY_ObA15MCEwa2vSddhQfJ9dZV4GvFwysm0pQvHbBHqB2YiQNs6ciyFXkyggi9v4290MGmZ9nqYxWXRD1UXmS4cElki00p3-SYoLY4yZiidn0exK7PqpbgLYn4ebDnTXx4lS7gcs0A6kv3lCcfXXsvFLnxJEr-Veo-0QdTD5ehCocqgDY-n1-i00O44PQEjkjPwGkeghTUR-opuOKL6byPl6iUOg13LdR5RqEpyEz7UDulrNpC36R0Zua1KQJ0qWzamyp2EOc';
        // //$this->accessToken = '';
        if(!empty($_SESSION["otp_time"])){
            if(time()-$_SESSION["otp_time"] > 120){ 
                unset($_SESSION["otp_time"]);    
            }
        }
    }

    public function index() {
        die('Try Another Way.');
    }

    public function getBeneficary(){
        if(is_admin()) {
            $key = $this->accessToken;
            $parameters = array(
                'mobile_number' => 7532035000,
            );
            $header = ["Accept:application/json", "Authorization:Bearer " . $key];
            $method = 'POST';
            $url = 'https://api.pay2all.in/v1/money/beneficiary';
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
            curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($parameters));
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_URL, $url);
            $response2 = curl_exec($ch);
            $response = json_decode(curl_exec($ch), true);
            pr($response, true);
            // $response['beneficiary'] = [];
            // if (empty($response['errors'])) {
            //     if ($response['status'] == 0) {
            //         $response['beneficiary'] = $response['data'];
            //     } else {
            //         $this->session->set_flashdata('message', $response['message']);
            //     }
            // }
            // $this->load->view('beneficiary_list', $response);
        }else{
            redirect('Admin/Management/login');
        }
    }

}