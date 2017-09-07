

<form action="/task/add" method="post" id="task-form" enctype="multipart/form-data">
  <div class="form-group">
    <label for="name">User name</label>
    <input type="text" value="<?=$user->name;?>" required name="User[name]" class="form-control" id="user_name" aria-describedby="emailHelp" placeholder="Enter your name"> 
    <span class="text-danger"><?=$user->getError('name');?><span>
  </div>
  <div class="form-group">
    <label for="email">Email address</label>
    <input type="email" required value="<?=$user->email;?>" name="User[email]" class="form-control" id="user_emal" aria-describedby="emailHelp" placeholder="Enter email">
    <span class="text-danger"><?=$user->getError('email');?><span>
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>
  <div class="form-group">
    <label for="text">Task text</label>
    <textarea class="form-control" required id="task-text" name="Task[text]" rows="5"><?=$task->text;?></textarea>
    <span class="text-danger"><?=$task->getError('text');?><span>
  </div>
  <div class="form-group">
      <label for="text">Image</label>
      <input type="file" id="task-image" name="Task[image]" class="form-control-file" id="exampleFormControlFile1">
      <span class="text-danger"><?=$task->getError('image');?><span>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
    <button type="button" class="btn btn-defualt" data-toggle="modal" data-target="#taskModal">Preview</button>
</form>

<!-- Modal -->
<div class="modal fade" id="taskModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Task Preview</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>