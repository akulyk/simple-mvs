<form action="/task/add" method="post">
  <div class="form-group">
    <label for="name">User name</label>
    <input type="text" required name="User[name]" class="form-control" id="user_name" aria-describedby="emailHelp" placeholder="Enter your name">
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>
  <div class="form-group">
    <label for="email">Email address</label>
    <input type="email" required name="User[email]" class="form-control" id="user_emal" aria-describedby="emailHelp" placeholder="Enter email">
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>
  <div class="form-group">
    <label for="text">Task text</label>
    <textarea class="form-control" required id="task-text" name="Task[text]" rows="5"></textarea>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>