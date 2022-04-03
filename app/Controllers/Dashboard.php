<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    function __construct()
    {
        $this->categoryModel = model('App\Models\Categories');
        $this->entryModel = model('App\Models\Entry');
    }

    public function index()
    {
        $data['categories'] = $this->categoryModel->get_categories();
        $data['user'] = $this->session->get('bdgUser');
        echo view('index', $data);
    }

    public function fetchAmounts($id){
        $income = $this->entryModel->selectSum('amount')->where(['user_id' => $id, 'type' => 'income'])->findAll();
        $expense = $this->entryModel->selectSum('amount')->where(['user_id' => $id, 'type' => 'expense'])->findAll();

        $data = [
            'income' => $income,
            'expense' => $expense
        ];

        echo json_encode($data);
    }

    public function fetchIncome($id){
        $data = $this->entryModel->where(['user_id' => $id, 'type' => 'income'])->findAll();
        echo json_encode($data);
    }

    public function fetchExpense($id){
        $data = $this->entryModel->where(['user_id' => $id, 'type' => 'expense'])->findAll();
        echo json_encode($data);
    }

    public function fetchIncomeData($id){
        $data = $this->entryModel->select('category')->selectSum('amount')->groupBy('category')->where(['user_id' => $id, 'type' => 'income'])->findAll();
        echo json_encode($data);
    }
    
    public function fetchExpenseData($id){
        $data = $this->entryModel->select('category')->selectSum('amount')->groupBy('category')->where(['user_id' => $id, 'type' => 'expense'])->findAll();
        echo json_encode($data);
    }

    public function saveEntry(){
        $data = $this->request->getPost();
        $data['user_id'] = $this->session->get('bdgUser')->user_id;

        $res = $this->entryModel->save($data);

        if($res){
            echo 'success';
        }
        else{
            echo $res;
        }
    }

    public function deleteEntry($id){
        $res = $this->entryModel->delete($id);

        if($res){
            echo 'success';
        }
        else{
            echo $res;
        }   
    }
}
