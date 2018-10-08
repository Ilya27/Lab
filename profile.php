<!DOCTYPE html>
<?php
    include 'connection.php';
    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
    if ( null==$id ) {
        header("Location: index.php");
    }

    if ( !empty($_POST)) {
        $roleError = null;
        $loginError = null;
        $passwordError = null;
        $nameError = null;
        $surnameError =null;

        $role=$_POST['role'];
        $login = $_POST['login'];
        $name=$_POST['name'];
        $surname=$_POST['surname'];
        $password = $_POST['password'];


        // validate input
        $valid = true;
        if (empty($role)) {
            $roleError = 'Please enter Role';
            $valid = false;
        }
        if (empty($login)) {
            $loginError = 'Please enter Login';
            $valid = false;
        }
        if (empty($name)) {
            $nameError = 'Please enter Name';
            $valid = false;
        }
        if (empty($surname)) {
            $surnameError = 'Please enter Surname';
            $valid = false;
        }

        if (empty($password)) {
            $passwordError = 'Please enter Password';
            $valid = false;
        }

        // update data
        if ($valid) {
            $query ="UPDATE login SET role ='$role',username='$login', password='$password', name='$name', surname='$surname' WHERE id='$id'";
            $result = mysqli_query($mysqli, $query) or die("Error " . mysqli_error($mysqli));
            header("Location: index.php");

            }
    } else {
      $query ="SELECT * FROM login WHERE id='$id'";
      $result = mysqli_query($mysqli, $query) or die("Error " . mysqli_error($mysqli));
      $data=mysqli_fetch_assoc($result);
      $role=$data['role'];
      $login = $data['username'];
      $name=$data['name'];
      $surname=$data['surname'];
      $password = $data['password'];
    }
?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">

                <div class="span10 offset1">
                    <div class="row">
                        <h3>Update a Customer</h3>
                    </div>
                    <form class="form-horizontal" action="update.php?id=<?php echo $id?>" method="post">
                      <div class="control-group <?php echo !empty($roleError)?'error':'';?>">
                        <label class="control-label">Role</label>
                        <div class="controls">
                            <input name="role" type="text" readonly="readonly" placeholder="Role" value="<?php echo !empty($role)?$role:'';?>">
                            <?php if (!empty($roleError)): ?>
                                <span class="help-inline"><?php echo $roleError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($loginError)?'error':'';?>">
                        <label class="control-label">Login</label>
                        <div class="controls">
                            <input name="login" type="text"readonly="readonly"  placeholder="Login" value="<?php echo !empty($login)?$login:'';?>">
                            <?php if (!empty($loginError)): ?>
                                <span class="help-inline"><?php echo $loginError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($nameError)?'error':'';?>">
                        <label class="control-label">Name</label>
                        <div class="controls">
                            <input name="name" type="text" readonly="readonly"  placeholder="Name" value="<?php echo !empty($name)?$name:'';?>">
                            <?php if (!empty($nameError)): ?>
                                <span class="help-inline"><?php echo $nameError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($surnameError)?'error':'';?>">
                        <label class="control-label">Surname</label>
                        <div class="controls">
                            <input name="surname" type="text"readonly="readonly"  placeholder="Surname" value="<?php echo !empty($surname)?$surname:'';?>">
                            <?php if (!empty($surnameError)): ?>
                                <span class="help-inline"><?php echo $surnameError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($passwordError)?'error':'';?>">
                        <label class="control-label">Password</label>
                        <div class="controls">
                            <input name="password" type="text" readonly="readonly" placeholder="Password" value="<?php echo !empty($password)?$password:'';?>">
                            <?php if (!empty($passwordError)): ?>
                                <span class="help-inline"><?php echo $passwordError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="form-actions">
                          <a class="btn" href="index.php">Back</a>
                        </div>
                    </form>
                </div>

    </div> <!-- /container -->
  </body>
</html>
