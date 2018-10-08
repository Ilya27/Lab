<?php session_start(); ?>
<html>
<head>
    <title>Homepage</title>
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
    <link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
    <?php
    if(isset($_SESSION['valid'])) {
        include("connection.php");
        $result = mysqli_query($mysqli, "SELECT * FROM login");
    ?>
        Welcome, <?php echo $_SESSION['name'] ?> ! <a href='logout.php'>Logout</a><br/>
        <br/>
        <table class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th>Id</th>
                        <th>Login</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
      <?php
      if (($_SESSION["role"])=="admin") {
                foreach ($result as $row) {
                         echo '<tr>';
                         echo '<td>'. $row['id'] . '</td>';
                         echo '<td>'. $row['username'] . '</td>';
                         echo '<td width=250>';
                         echo '<a class="btn btn-success" href="update.php?id='.$row['id'].'">Update</a>';
                         echo ' ';
                         echo '<a class="btn btn-danger" href="delete.php?id='.$row['id'].'">Delete</a>';
                         echo '</tr>';
                }} else {
                  foreach ($result as $row) {
                           echo '<tr>';
                           echo '<td>'. $row['id'] . '</td>';
                           echo '<td>'. $row['username'] . '</td>';
                           echo '<td width=250>';
                           if ($_SESSION["id"]==$row['id']) {
                            echo '<a class="btn btn-success" href="update.php?id='.$row['id'].'">Update</a>';
                           }
                           else {
                          echo '<a class="btn" href="profile.php?id='.$row['id'].'">Read</a>';
                           }
                }}?>
              </tbody>
        </table>
        <br/><br/>
    <?php
    } else {
        echo "You must be logged in to view this page.<br/><br/>";
        echo "<a href='login.php'>Login</a>";
        //| <a href='register.php'>Register</a>";
    }
    ?>
</body>
