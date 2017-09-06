<?php

namespace App\Controllers;

use \Core\View;
use \App\models\Task as TaskModel;
use \App\models\User as UserModel;
use Core\Paginator;
use Core\Sorter;
/**
 * Home controller
 *
 * 
 */
class Task extends \Core\Controller
{

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
        
            
      return $this->render('Home/index',['tasks'=>$tasks,'paginator'=>$paginator,'sorter'=>$sorter,
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
        
        
        
           return $this->redirect('task/view',['id'=>$taskModel->id]);
           
       }
       
       return $this->render('task/edit',['user'=>$userModel,'task'=>$taskModel]);
             
        
    }/**/
    public function viewAction(int $id){
          $model = TaskModel::findOne($id);
         
    if(!$model ){
        return $this->redirect('');
    }
         return $this->render('task/view',['model'=>$model]);
      }
    
}/* end of Controller */
