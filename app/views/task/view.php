<?php

?>

<div class="container">
    <div class="row">
        <div class="col-xs-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="/task">Tasks</a></li>
            <li class="breadcrumb-item active">Task Hash: <?=$model->hashString;?></li>
        </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="task-body">
            <p class="text-primary">Task Description</p>
                <p>
                <?php echo $model->text;?>
                </p>
            </div>
            <div class="task-user">
               <p class="text-primary">User name: 
                <span class="text-dark">
                <?php echo $model->user->name;?>
                </span><br/>
                  User email: 
                  <span class="text-dark">
                    <?php echo $model->user->email;?>
                  </span>
                </p>
            </div>
            <div class="task-status">
            <p>
              Task Status: <span class="<?=$model->is_completed?"text-success":"text-danger";?>">
              <?php echo $model->getStatus();?></span>
            </p>
            </div>
        </div>
    </div>
</div>