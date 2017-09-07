<?php

namespace App\Controllers;


use \Core\View;
use \App\models\Task as TaskModel;
use \App\models\User as UserModel;
use Core\Paginator;
use Core\Sorter;
use App\traits\ImageTrait;

/**
 * Home controller
 *
 * PHP version 7.0
 */
class Admin extends \Core\Controller
{

    public function __construct($route_params)
    {
        parent::__construct($route_params);
        if(!isset($_SESSION)){
            session_start();
        }
    }/**/


    public function before(){

       if(!isset($_SESSION['admin_id']) && !in_array('login',func_get_args())){
            $this->redirect('admin/login');
       }

    }/**/

    /**
     * Show the index page
     *
     * @return void
     */
    public function indexAction()
    {
        $page = 1;
        $criteria = [];
        $criteria['limit'] = 3;
        if(isset($_GET['page'])){
            $page = (int)$_GET['page'];
            $criteria['offset'] = $criteria['limit'] * ($page-1);
        }

        $totalItems = TaskModel::countAll();
        $itemsPerPage = $criteria['limit'];
        $currentPage = $page;

        $paginator = new Paginator($totalItems, $itemsPerPage, $currentPage);
        $sorter = new Sorter();
        $criteria['join'] = $sorter->join;
        $criteria['order_by'] = $sorter->orderBy;

        $tasks = TaskModel::findAll($criteria);
        $task = new TaskModel();
        $user = new UserModel;
      return $this->render('admin/index',
          ['tasks'=>$tasks,'paginator'=>$paginator,'sorter'=>$sorter,
      'user'=>$user,'task'=>$task]);
    }/**/

    public function loginAction(){
        $admin = new \stdClass();
        $admin->login = '';
        $admin->password ='';

        return $this->render('admin/login',['admin'=>$admin]);
    }/**/

    public function logoutAction(){

    }/**/



}/* end of Admin Controller */
