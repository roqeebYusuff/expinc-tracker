<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use DateInterval;
use DateTime;

class Reset extends BaseController
{
    function __construct()
    {
        $this->resetModel = model('App\Models\Reset');
        $this->userModel = model('App\Models\User');
    }

    public function index()
    {
        echo view('auth/forgotpassword');
    }

    public function forgotpassword(){
        $data = $this->request->getPost();
        $email = $data['email'];
        $check = $this->userModel->where(['email' => $email])->findAll();

        if(sizeof($check) > 0){
            $data['user_id'] = $check[0]->user_id;
            $token = bin2hex(random_bytes(50));
            $data['token'] = hash('sha256', $token);

            $expires = new DateTime('NOW');
            $expires->add(new DateInterval('PT01H'));

            $data['expires_at'] = $expires->format('Y-m-d\TH:i:s');
            $res = $this->resetModel->save($data);
            if($res){
                try {
                    $this->sendMail($data);
                    echo 'success';
                } catch (\Exception $e) {
                    die($e->getMessage());
                }
            }
            else{
                echo $res;
            }
        }
        else{
            echo 'email does not exist';
        }
    }

    public function resetpass(){
        $token = $this->request->uri->getSegment(3);
        $check = $this->resetModel->query("SELECT * FROM `password_reset` WHERE `token` = '$token' AND `expires_at` >= NOW() AND `password_reset`.`deleted_at` IS NULL")->getResult();
        if(!empty($check)){
            $this->resetModel->delete($check[0]->id);
            $data['userid'] = $check[0]->user_id; 
            echo view('auth/resetpassword', $data);
        }
        else{
            echo view('auth/expired');
        }
    }

    public function savepass(){
        $data = $this->request->getPost();
        $data['user_id'] = $data['user'];
        unset($data['user']);
        unset($data['conpassword']);
        $res = $this->userModel->save($data);
        if($res){
            echo 'success';
        }
        else{
            echo 'error';
        }
    }

    public function sendMail($data){
        $email = \Config\Services::email();
        $email->setTo($data['email']);

        $email->setSubject('Password Recovery - Expinc Tracker');

        $html = '<h3>Hello,</h3> <br /><p>We are sending you this email because you requested a password reset. Click on th button to create a new password</p> <br />
            <a href="'.base_url().'auth/reset-password/'.$data['token'].'">Reset Password</a> <br /> <p>This link will expire in 1 hour. After that, you will need to submit a new request in order to reset your password <br/> <p><b>NOTE:</b> The link wiil still be still be valid within one hour until it is clicked</p> If you did not request a password reset, you can simply ignore this email. Your password will not be changed</p>
            <br/> <br /> <p>Thanks,</p> <span>Expinc Tracker</span>
            ';
        $email->setMessage($html);

        if($email->send()){
            return true;
        }
        else{
            $data = $email->printDebugger(['headers']);
            throw new \Exception('error');
        }
    }
}
