<?php
session_start();
if (!$_SESSION['id']) {
   header("location: loginRedirect.php");
   exit;
}

include_once "../classes/user.php";

$user = new User;
$userList = $user->getUsers($_SESSION['id']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <meta name="Description" content="Enter your description here" />
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css">
   <link rel="stylesheet" href="assets/css/style.css">
   <title>Dashboard</title>
</head>

<body>
   <nav class="navbar navbar-expand-md navbar-dark bg-dark">
      <a href="dashboard.php" class="navbar-brand">
         <h1 class="h3">The Company</h1>
      </a>

      <div class="ml-auto">
         <ul class="navbar-nav">
            <li class="nav-item">
               <a href="#" class="nav-link"><?= $_SESSION['username'] ?></a>
            </li>
            <li class="nav-item">
               <a href="logout.php" class="nav-link">Logout</a>
            </li>
         </ul>
      </div>
   </nav>
   <main class="container" style="padding-top: 80px;">
      <div class="row">
         <div class="col-6">
            <div class="card">
               <div class="card-body">
                  <form action="../actions/register.php" method="post">
                     <label for="firstName">First Name</label>
                     <input type="text" name="firstName" id="firstName" class="form-control mb-2" required autofocus>

                     <label for="lastName">Last Name</label>
                     <input type="text" name="lastName" id="lastName" class="form-control mb-2" required>

                     <label for="username">Username</label>
                     <input type="text" name="username" id="username" class="form-control mb-2" maxlength="15" required>

                     <label for="password">Password</label>
                     <input type="password" name="password" id="password" class="form-control mb-5" required>

                     <button type="submit" name="btnRegister" value="dashboard" class="btn btn-success btn-block">Add User</button>
                  </form>
               </div>
            </div>
         </div>
         <div class="col-6">
            <table class="table table-hover">
               <thead class="thead-light">
                  <th>#</th>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Username</th>
                  <th></th>
               </thead>
               <tbody>
                  <?php
                  while ($user = $userList->fetch_assoc()) {
                  ?>
                     <tr>
                        <td><?= $user['id'] ?></td>
                        <td><?= $user['first_name'] ?></td>
                        <td><?= $user['last_name'] ?></td>
                        <td><?= $user['username'] ?></td>
                        <td>
                           <a href="editUser.php?userID=<?= $user['id'] ?>" class="btn btn-outline-warning btn-sm">Edit</a>
                           <a href="removeUser.php?userID=<?= $user['id'] ?>" class="btn btn-outline-danger  btn-sm">Remove</a>
                        </td>
                     </tr>
                  <?php
                  }
                  ?>
               </tbody>
            </table>
         </div>
      </div>
   </main>

   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>