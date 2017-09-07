<?php

use Core\View;


?>
    <div class="container">
        <div class="row>">
            <div class="col-xs-12">
             <h1>Task managment system</h1>
            </div>
        </div>
        <?php echo $this->render('task/_tasksTable',['tasks'=>$tasks,'paginator'=>$paginator,'sorter'=>$sorter]);?>
        <div class="row>">
            <div class="col-xs-12">
                <button class="btn btn-primary" id="add-task-button">Add new Task</button>
            </div>
        </div>

            <div class="row">
                <div class="col-md-6 col-xs-12">
                    <div id="add-new-task">
                <?php echo $this->render('task/_taskForm',['user'=>$user,'task'=>$task]);?>
                    </div>
                </div>
            </div>
    </div>


