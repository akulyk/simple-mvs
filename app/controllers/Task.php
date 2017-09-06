<?php

namespace App\Controllers;

use \Core\View;
use \App\models\Task as TaskModel;
use \App\models\User as UserModel;
use Core\Paginator;
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
        $criteria['limit'] = 1;
        if(isset($_GET['page'])){
            $page = (int)$_GET['page'];
            $criteria['offset'] = $criteria['limit'] * ($page-1);
        }
      
        $totalItems = TaskModel::countAll();
        $itemsPerPage = $criteria['limit'];
        $currentPage = $page;
      //  $urlPattern = 'page=(:num)';
     //   var_dump($criteria);die;

        $paginator = new Paginator($totalItems, $itemsPerPage, $currentPage);
        $tasks = TaskModel::findAll($criteria);
        
      
        
      return $this->render('Home/index',['tasks'=>$tasks,'paginator'=>$paginator]);
    }/**/
    
    
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
             
        
    }/**/
    public function viewAction(int $id){
          $model = TaskModel::findOne($id);
         return $this->render('task/view',['model'=>$model]);
      }
    
}/* end of Controller */
