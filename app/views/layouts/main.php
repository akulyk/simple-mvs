<?php
use Core\Session;
?>
<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>App title</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
   
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/assets/css/font-awesome.min.css">

    <!-- Fancybox -->
    <link rel="stylesheet" href="/assets/js/fancybox/jquery.fancybox.min.css">
   
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <header>

                <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark container">
                
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="<?=$this->createUrl('');?>">Tasks <span class="sr-only"></span></a>
                            </li>
                            <?php if(Session::getInstance()->get('admin_id')):?>
                                <li class="nav-item active">
                                    <a class="nav-link" href="<?=$this->createUrl('/admin/index');?>">Admin <span class="sr-only"></span></a>
                                </li>
                                <li class="nav-item active">
                                    <a class="nav-link" href="<?=$this->createUrl('/admin/logout');?>">Logout <span class="sr-only"></span></a>
                                </li>
                            <?php else:?>
                                <li class="nav-item active">
                                    <a class="nav-link" href="<?=$this->createUrl('/admin/login');?>">Login <span class="sr-only"></span></a>
                                </li>
                            <?php endif;?>
                        </ul>
                    </div>
                </nav>
        
    </header>
  <?php echo $content;?>
  <footer>
  <div class="container">
            <div class="row pull-right">
                <div class="col-xs-12">
                <p>Simple MVC for task manegment</p>
                <p>Author: Alexander Kulyk</p>
                <p>Email: <a href="mailTo:akulyk@outlook.com">akulyk@outlook.com</a></p>
                <p>GitHub: <a href="https://github.com/akulyk/simple-mvs">akulyk/simple-mvs</a></p>
                </div>
            </div>
        </div>
  </footer>
  <!-- Bootstrap JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
    <script src="/assets/js/fancybox/jquery.fancybox.min.js"></script>
    <!-- Custom JavaScript -->
 <script src="/assets/js/custom.js"></script>
</body>
</html>
