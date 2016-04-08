<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends Auth_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('task_model');
        $this->load->model('project_model');
    }

    public function index()
    {
        $this->data['latest_tasks'] = $this->task_model->where(['closed'=>'0','user_id'=>$_SESSION['user_id']])->order_by('due','ASC')->limit(5)->get_all();
        $this->data['latest_projects'] = $this->project_model->where(['finished'=>'0','user_id'=>$_SESSION['user_id']])->with_tasks('fields:*count*|where:`closed`=\'0\'')->order_by('due','ASC')->limit(5)->get_all();
        $this->render('welcome/index_view');
    }
}