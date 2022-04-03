<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Auth extends BaseController
{
    function __construct()
    {
        $this->userModel = model('App\Models\User');
    }

    public function signin()
    {
        $message = '';
        if($this->request->getMethod() == 'post'){
            $dat = $this->request->getPost();
            //Check if username or email exists
            $field = $dat['email'];
            $user = $this->userModel->where(['email' => $field])->orWhere(['user_name' => $field])->findAll();

            if(sizeof($user) > 0){
                //Verify password
                $dat['hash'] = $user[0]->password;
                $verify = $this->userModel->verifyPassword($dat);
                if($verify){
                    // set session
                    $this->session->set('bdgUser', $user[0]);
                    return redirect()->to(site_url('user/dashboard'));

                }
                else{
                    $message = 'Invalid Password';
                }
            }
            else{
                $message = 'Invalid username or password';
            }
        }

        $dat['message'] = $message;
        echo view('auth/signin', $dat);
    }

    public function signup()
    {
        echo view('auth/signup');
    }

    public function register(){
        $data = $this->request->getPost();

        //Check if username exists
        $usernameExists = $this->userModel->where(['user_name' => $data['user_name']])->findAll();
        if(sizeof($usernameExists) > 0){
            echo 'Username exists';
        }
        else{
            //CHeck if email exists
            $emailExists = $this->userModel->where(['email' => $data['email']])->findAll();
            if(sizeof($emailExists) > 0){
                echo 'Email exists';
            }
            else{
                $res = $this->userModel->save($data);
                if($res){
                    echo 'success';
                }
                else{
                    echo $res;
                }
            }
        }
    }

    public function signout(){
        $this->user_logout();
        return redirect()->to(site_url('auth/signin'));
    }
}
