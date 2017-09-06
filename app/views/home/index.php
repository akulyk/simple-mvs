<?php

use Core\View;


?>
    <div class="container">
        <div class="row>">
            <div class="col-xs-12">
             <h1>Task managment system</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-xs-12">
                <?php if(count($tasks)>0):?>
                <table class="table">
                <thead>
                <th>ID</th>
                <th>Hash</th>
                <th>User</th>
                <th>Text</th>
                <th>Status</th>
                </thead>
                <tbody>
                <?php foreach($tasks as $task):?>
                <tr>
                <td><?=$task->id;?></td>
                <td><?=mb_substr($task->hashString,0,5);?>...</td>
                <td><?=$task->user->name;?><br/>
                    <?=$task->user->email;?>
                </td>
                <td><?=$task->text;?></td>
                <td><?=$task->getStatus();?></td>
                </tr>
                <?php endforeach;?>
                </tbody>
                </table>
               
                <?php echo $paginator;?>
               
                <?php endif;?>
               
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-xs-12">
            <?php echo $this->render('task/_taskForm');?>
            </div>
        </div>
    </div>


