
<div class="container">
    <div class="row">
        <div class="col-xs-12 edit-form">
        <?php
            echo $this->render('task/_taskForm',['user'=>$user,'task'=>$task]);
        ?>
        </div>
    </div>
</div>