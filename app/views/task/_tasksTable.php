<div class="row">
            <div class="col-lg-12 col-xs-12">
                <?php if(count($tasks)>0):?>
                <table class="table">
                <thead>
                <th>ID</th>
                <th>Hash</th>
                <th>User Name 
                    <div class="sort">
                        <a href="/?sort=name+asc" class="<?=($sorter->getSort()=="name asc")?"active":"";?>">
                            <i class="fa fa-chevron-up" aria-hidden="true"></i>
                        </a>
                        <a href="/?sort=name+desc" class="<?=($sorter->getSort()=="name desc")?"active":"";?>">
                            <i class="fa fa-chevron-down" aria-hidden="true"></i>
                        </a>
                    </div>
                </th>
                <th>User Email <div class="sort">
                        <a href="/?sort=email+asc" class="<?=($sorter->getSort()=="email asc")?"active":"";?>">
                            <i class="fa fa-chevron-up" aria-hidden="true"></i>
                        </a>
                        <a href="/?sort=email+desc" class="<?=($sorter->getSort()=="email desc")?"active":"";?>">
                            <i class="fa fa-chevron-down" aria-hidden="true"></i>
                        </a>
                    </div></th>
                <th>Text</th>
                <th>Status <div class="sort">
                        <a href="/?sort=status+asc" class="<?=($sorter->getSort()=="status asc")?"active":"";?>">
                            <i class="fa fa-chevron-up" aria-hidden="true"></i>
                        </a>
                        <a href="/?sort=status+desc" class="<?=($sorter->getSort()=="status desc")?"active":"";?>">
                            <i class="fa fa-chevron-down" aria-hidden="true"></i>
                        </a>
                    </div></th>
                </thead>
                <tbody>
                <?php foreach($tasks as $task):?>
                <tr>
                <td><?=$task->id;?></td>
                <td><?=mb_substr($task->hashString,0,5);?>...</td>
                <td><?=$task->user->name;?></td>
                <td><?=$task->user->email;?></td>
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