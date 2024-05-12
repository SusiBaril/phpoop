<?php

    require_once('classes/database.php');
    $con = new database();

    $id=$_POST['id'];
    if(empty($id)){
        header('location:index.php');
    } else {
        $row=$con->viewdata($id);
    }
    
    if(isset($_POST['update'])){
      $id = $_POST['id'];
      if($con->update($id)){
        header('location:index.php');
      } else{
        echo "Something went wrong";
      }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update Page</title>
  <link rel="stylesheet" href="./bootstrap-5.3.3-dist/css/bootstrap.css">
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

  <style>
    .custom-container{
        width: 800px;
    }
    body{
    font-family: 'Roboto', sans-serif;
    }
  </style>

</head>
<body>

<div class="container custom-container rounded-3 shadow my-5 p-3 px-5">
  <h3 class="text-center mt-4"> Update Form</h3>
  <form method="post">
    <!-- Personal Information -->
    <div class="card mt-4">
      <div class="card-header bg-info text-white">Personal Information</div>
      <div class="card-body">
        <div class="form-row">
          <div class="form-group col-md-6 col-sm-12">
            <label for="firstName">First Name:</label>
            <input type="text" class="form-control" name="firstname" id="firstName" placeholder="Firstname" value="<?php echo $row['firstname']; ?>">
          </div>
          <div class="form-group col-md-6 col-sm-12">
            <label for="lastName">Last Name:</label>
            <input type="text" class="form-control" name="lastname" id="lastName" placeholder="Lastname" value="<?php echo $row['lastname']; ?>" >
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="birthday">Birthday:</label>
            <input type="date" class="form-control" name="birthday" id="birthday" placeholder="Birthday" value="<?php echo $row['birthday']; ?>" >
          </div>
          <div class="form-group col-md-6">
            <label for="sex">Sex:</label>
            <select class="form-control" name="gender" id="gender" placeholder="Gender" >
              <option selected>Select Sex</option>
              <option value="Male"<?php if($row ['gender'] === 'Male') echo 'selected' ?>>Male</option>
              <option value="Female"<?php if($row['gender'] === 'Female') echo 'selected' ?>>Female</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label for="username">Username:</label>
          <input type="text" class="form-control" name="user" id="username" placeholder="Username" value="<?php echo $row['user']; ?>" >
        </div>
        <div class="form-group">
          <label for="password">Password:</label>
          <input type="password" class="form-control" name="password" id="password" placeholder="Enter password" value="<?php echo $row['password']; ?>">
        </div>
        <div class="form-group">
          <label for="password">Confirm Password:</label>
          <input type="password" class="form-control" name="c_pass" id="c_pass" placeholder="Enter password" value="<?php echo $row['password']; ?>">
        </div>
      </div>
    </div>
    
    <!-- Address Information -->
    <div class="card mt-4">
      <div class="card-header bg-info text-white">Address Information</div>
      <div class="card-body">
        <div class="form-group">
          <label for="street">Street:</label>
          <input type="text" class="form-control" name="street" id="street" placeholder="Street" value="<?php echo $row['street']; ?>" >
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="barangay">Barangay:</label>
            <input type="text" class="form-control" name="barangay" id="barangay" placeholder="Barangay" value="<?php echo $row['barangay']; ?>" >
          </div>
          <div class="form-group col-md-6">
            <label for="city">City:</label>
            <input type="text" class="form-control" name="city" id="city" placeholder="City" value="<?php echo $row['city']; ?>" >
          </div>
        </div>
        <div class="form-group">
          <label for="province">Province:</label>
          <input type="text" class="form-control" name="province" id="province" placeholder="Province" value="<?php echo $row['province']; ?>" >
        </div>
      </div>
    </div>
    
    <!-- Submit Button -->
    
    <div class="container">
    <div class="row justify-content-center gx-0">
        <div class="col-lg-3 col-md-4"> 
            <input type="hidden" name="id" value="<?php echo $rows['user_id']; ?>">
            <input type="submit" name="Update" class="btn btn-outline-primary btn-block mt-4" value="Update">
        </div>
        <div class="col-lg-3 col-md-4"> 
            <a class="btn btn-outline-danger btn-block mt-4" href="index.php">Go Back</a>
        </div>
    </div>
</div>


  </form>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="./bootstrap-5.3.3-dist/js/bootstrap.js"></script>
<!-- Bootsrap JS na nagpapagana ng danger alert natin -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
