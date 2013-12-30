
<html>
<head>
  <title>User login</title>
  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.css" />

  <style type="text/css" media="screen">
      #login_holder{
        margin-top: 30px;
      }
  </style>

</head>
<body>
    <div class="row">
        <div class="col-sm-4 col-sm-offset-4 well" id="login_holder">
            <?php echo form_open("auth/login" , array('role' => 'form'));?>

                <div class="form-group">
                    <label for="identity">Email address</label>
                    <input type="email" class="form-control" id="identity" name="identity" placeholder="Enter email">
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                </div>
                <div class="checkbox">
                    <label>
                      <input id="remember" type="checkbox" value="1" name="remember"> Remeber me
                    </label>
                </div>

                <input type="submit" name="submit" value="Login" class="btn btn-default" />
            <?php echo form_close();?>
              
            <?php if(isset($message)): ?>
              <div class="error">
                  <?php echo $message; ?>
              </div>
            <?php endif;?>
            
        </div>
    </div>
</body>
</html>

