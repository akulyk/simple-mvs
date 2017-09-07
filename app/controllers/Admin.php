<?php

namespace App\Controllers;


use \Core\View;
use \App\Models\Task as TaskModel;
use \App\Models\User as UserModel;
use \App\Models\Admin as AdminModel;
use Core\Paginator;
use Core\Sorter;
use App\Traits\ImageTrait;

/**
 * Admin controller
 *
 */
class Admin extends \Core\Controller
{

    public function __construct($route_params)
    {
        parent::__construct($route_params);

    }/**/


    public function before(){

       if(!$this->session->get('admin_id') && !in_array('login',func_get_args())){
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

        $paginator = new Paginator($totalItems, $itemsPerPage, $currentPage,'page=(:num)','admin/index');
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

    public function viewAction($id){

        $model = TaskModel::findOne($id);

        if(!$model ){
            $this->session->setFlash('danger','Such task does not exist!');
            return $this->redirect('admin/index');
        }
        return $this->render('admin/view',['model'=>$model]);

    }/**/

    public function updateStatusAction($id,$status){
        if($status){
            $data =[
            'spanClass' =>"text-success",
            'linkTitle' => "Open Task Again",
                'text' =>'Complete'

            ];
        } else{
            $data =[
                'spanClass' =>"text-danger",
                'linkTitle' => "Close Task",
                'text' =>'In work'

            ];
        }
        $data['linkHref'] = '/admin/update-status?id='.$id.'&status='.!$status;
        $task = TaskModel::findOne((int)$id);
        $task->is_completed = (int)$status;
        $task->update(['is_completed'=>$task->is_completed]);

        echo json_encode($data);
    }/**/

    public function loginAction(){

        $admin = AdminModel::create($this->request->post('Admin'));
     //   var_dump($admin);die;
        if($admin->login) {
            if ($admin->login()) {

                $this->session->set('admin_id',$admin->id);
                $this->session->setFlash('success','Welcome to Admin Area!');
                return $this->redirect('admin/index');
            } else{
                $this->session->setFlash('danger','Wrong login or password!');
            }
        } else {
            $this->session->setFlash('warning', 'You should login to enter Admin area!');

        }

        return $this->render('admin/login',['admin'=>$admin]);
    }/**/

    public function logoutAction(){

        $this->session->unsetVal('admin_id');
        $this->session->setFlash('warning', 'You have been logout from Admin Area');
        return $this->redirect('');
    }/**/



}/* end of Admin Controller */
