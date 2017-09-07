<?php

?>

<div class="container">
    <div class="row">
        <div class="col-xs-12">
        <ol class="breadcrumb content">
            <li class="breadcrumb-item"><a href="/">Tasks</a></li>
            <li class="breadcrumb-item active">Task Hash: <?=$model->hashString;?></li>
        </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <table class="table">
                <thead>
                <th>User Name</th>
                <th>User Email</th>
                <th>Task Image</th>
                <th>Task Description</th>
                <th>Status</th>
                </thead>
                <tbody>
                <tr>
                    <td><?=$model->user->name;?></td>
                    <td><?=$model->user->email;?></td>
                    <td><a class="fancybox" rel="task-images" href="<?=$model->getImage();?>">
                            <img src="<?=$model->getImage();?>" class="img-thumbnail small">
                        </a>
                    </td>
                    <td><?=$model->text;?></td>
                    <td><span class="<?=$model->is_completed?"text-success":"text-danger";?>">
                        <?php echo $model->getStatus();?>
                        </span>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>