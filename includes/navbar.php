
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<li class="nav-item">
         <a href="home.php"> <img src="app-images/download.jpg" style="width:100px;height:100px;border-radius:50%"/></a>
        </li>
  <div class="container" style="padding-left:700px">
  <!--  <a class="navbar-brand" href="#">Navbar</a>-->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
     <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="home.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " aria-current="page" href="user-list.php">Authenticated Users</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " aria-current="page" href="index.php">Stored Users</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " aria-current="page" href="add-contact.php">Add User</a>
        </li>
      
      
        <?php if(!isset($_SESSION['verified_user_id'])) : ?>
        <li class="nav-item">
          <a class="nav-link " aria-current="page" href="register.php">Register</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " aria-current="page" href="login.php">Login</a>
        </li>
        <?php else : ?>
          <li class="nav-item dropdown">
            <?php
            $uid=$_SESSION['verified_user_id'];
             $user = $auth->getUser($uid);
           
            ?>
          <a class="nav-link btn btn-primary dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <?=   $user->displayName; ?>
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="my-profile.php">My Profile</a></li>
            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
          
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link " aria-current="page" href="logout.php">Logout</a>
        </li>
      <?php endif; ?>
       <ul>
    </div>
  </div>
</nav>