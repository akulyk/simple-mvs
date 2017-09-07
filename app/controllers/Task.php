<?php

namespace App\Controllers;

use \Core\View;
use \App\Models\Task as TaskModel;
use \App\Models\User as UserModel;
use Core\Paginator;
use Core\Sorter;
use App\Traits\ImageTrait;
/**
 * Task controller
 *
 * 
 */
class Task extends \Core\Controller
{
    use ImageTrait;
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
        
            
      return $this->render('home/index',['tasks'=>$tasks,'paginator'=>$paginator,'sorter'=>$sorter,
      'user'=>$user,'task'=>$task]);
    }/**/
    
    /*
    *
    */
    
    public function addAction(){
        
        if(!isset($_POST['User']) || !isset($_POST['Task'])){
          return $this->redirect('');  
        }
        
        $userModel = UserModel::findOrCreate($_POST['User']);
        $taskParams = array(
        'user_id'=>$userModel->id,
        'text' =>$_POST['Task']['text'],
        'is_completed'=>0
        );
        $taskModel = TaskModel::findOrCreate($taskParams);
      
       if($taskModel->validate()){
           
           $taskModel->save();


           $this->session->setFlash('success','New Task added!');
           return $this->redirect('task/view',['id'=>$taskModel->id]);
           
       }
       
       return $this->render('task/edit',['user'=>$userModel,'task'=>$taskModel]);
             
        
    }/**/
    /*
     * @param $id;
     */
    public function viewAction($id){
		$id = (int)$id;
        $model = TaskModel::findOne($id);
         
    if(!$model ){
        return $this->redirect('');
    }
         return $this->render('task/view',['model'=>$model]);
    }/**/

    /*
     *
     *
     */
    public function previewAction(){
        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $data = new \stdClass();
            $params = [];
            $data->name = "";
            $data->email = "";
            $data->task ="";
            if(isset($_POST['User']['name'])) {
                $data->name = $_POST['User']['name'];
                $params['name'] = $data->name;
            }
            if(isset($_POST['User']['email'])) {
                $data->email = $_POST['User']['email'];
                $params['email'] = $data->email;
            }
            if(isset( $_POST['Task']['text'])) {
                $data->task = $_POST['Task']['text'];
                $params['task'] = $data->task;
            }


            $task = new TaskModel;

            // little hack for clear preview
            $params = $task->clearParams($params);
           foreach($params as $k =>$v){
               $data->{$k} = $v;
           }

            $data->image = '/images/'.$this->getUploadedImage();


           $view = new View();
           echo $view->render('task/_preview',['data'=>$data]);
           exit;
        }

    }/**/


    
}/* end of Controller */
