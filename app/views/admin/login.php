
<div class="container">
    <div class="row">
        <div class="col-xs-12 content">
            <form id="login-form">
                <div class="form-group">
                    <label for="name">Login</label>
                    <input type="text" value="<?=$admin->login;?>" required name="Admin[login]" class="form-control" id="user_name" aria-describedby="emailHelp" placeholder="Enter your name">
                    <span class="text-danger"><?//$admin->getError('login');?><span>
                </div>
                <div class="form-group">
                    <label for="name">Password</label>
                    <input type="password" value="<?=$admin->password;?>" required name="Admin[password]" class="form-control" id="user_name" aria-describedby="emailHelp" placeholder="Enter your name">
                    <span class="text-danger"><?//$admin->getError('password');?><span>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>