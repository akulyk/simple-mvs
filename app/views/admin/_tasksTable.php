

<div class="row">
            <div class="col-lg-12 col-xs-12">
                <?php if(count($tasks)>0):?>
                <table class="table">
                <thead>
                <th>ID</th>
                <th>Hash</th>
                <th>User Name 
                    <div class="sort">
                        <a href="<?=$this->createURl('/admin/index',['sort'=>'name+asc']);?>" class="<?=($sorter->getSort()=="name asc")?"active":"";?>">
                            <i class="fa fa-chevron-up" aria-hidden="true"></i>
                        </a>
                        <a href="<?=$this->createURl('/admin/index',['sort'=>'name+desc']);?>" class="<?=($sorter->getSort()=="name desc")?"active":"";?>">
                            <i class="fa fa-chevron-down" aria-hidden="true"></i>
                        </a>
                    </div>
                </th>
                <th>User Email <div class="sort">
                        <a href="<?=$this->createURl('/admin/index',['sort'=>'email+asc']);?>" class="<?=($sorter->getSort()=="email asc")?"active":"";?>">
                            <i class="fa fa-chevron-up" aria-hidden="true"></i>
                        </a>
                        <a href="<?=$this->createURl('/admin/index',['sort'=>'email+desc']);?>" class="<?=($sorter->getSort()=="email desc")?"active":"";?>">
                            <i class="fa fa-chevron-down" aria-hidden="true"></i>
                        </a>
                    </div></th>
                <th>Text</th>
                <th>Image</th>
                <th>Status <div class="sort">
                        <a href="<?=$this->createURl('/admin/index',['sort'=>'status+asc']);?>" class="<?=($sorter->getSort()=="status asc")?"active":"";?>">
                            <i class="fa fa-chevron-up" aria-hidden="true"></i>
                        </a>
                        <a href="<?=$this->createURl('/admin/index',['sort'=>'status+desc']);?>" class="<?=($sorter->getSort()=="status desc")?"active":"";?>">
                            <i class="fa fa-chevron-down" aria-hidden="true"></i>
                        </a>
                    </div></th>
                </thead>
                <tbody>
                <?php foreach($tasks as $task):?>
                <tr>
                <td><a href="<?=$this->createURl('/admin/view',['id'=>$task->id]);?>"><?=$task->id;?></a></td>
                <td><?=mb_substr($task->hashString,0,5);?>...</td>
                <td><?=$task->user->name;?></td>
                <td><?=$task->user->email;?></td>
                <td><?=$task->text;?></td>
                <td><a class="fancybox" rel="task-images" href="<?=$task->getImage();?>">
                        <img src="<?=$task->getImage();?>" class="img-thumbnail small">
                    </a></td>
                <td>
                    <span class="text-<?=$task->is_completed?"success":"danger";?>">
                        <?=$task->getStatus();?>
                    </span>
                    <a class="change-task-status" href="<?=$this->createURl('/admin/update-status',
                        ['id'=>$task->id,'status'=>!$task->is_completed]);?>"
                       <?php if($task->is_completed):?>
                       title="Open Task Again"
                        <?php else:?>
                           title="Close Task"
                        <?php endif;?>
                        >
                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                    </a>
                </td>
                </tr>
                <?php endforeach;?>
                </tbody>
                </table>
               
                <?php echo $paginator;?>
               
                <?php endif;?>
               
            </div>
        </div>