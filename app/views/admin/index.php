<?php

use Core\View;
use Core\Session;

?>
    <div class="container">
        <div class="row>">
            <div class="col-xs-12 content">
             <h1>Task managment system</h1>
                <h1>Admin Area</h1>
            </div>
            <?php echo Session::renderAlertsStatic();?>
        </div>
        <?php echo $this->render('admin/_tasksTable',['tasks'=>$tasks,'paginator'=>$paginator,'sorter'=>$sorter]);?>
    </div>


