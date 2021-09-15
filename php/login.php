<!--LOGIN PAGE TO ENTER INTO DASHBOARD/MAIN SITE CLEARANCE)-->
<!--mysqli: A driver / function which allows to access database server-->

<?php
//contains a form that allows users to enter username and password.
    require('db.php');   //require fucntion to access the file and halt the script incase of any error.
    session_start();     // A php session gets created or a temporary file is created in a directory in the server.

    // CHECKING AND CREATING USER SESSION-------------------------------------------------
    //isset function - to return true for a value
    if (isset($_POST['username']))   //POST method to enter information into a server . This is more secure than GET
    {
        $username = stripslashes($_REQUEST['username']);    // Removes backlashes to prevent hacking into database and retrieving all data which contains quotes , backslashes etc in their passwords.
        $username = mysqli_real_escape_string($con, $username); 
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);                                                             
        // Check user is exist in the database

        $query  = "SELECT * FROM `users` WHERE username='$username'AND password='" . md5($password) . "'"; //md5 to encrypt the password while storing
        //Step 1: Select all data from database
        $result = mysqli_query($con, $query) or die(mysql_error()); //execute sql queries
        $rows = mysqli_num_rows($result);
        if ($rows == 1)   
        {   //check if any data is there in the database
            $_SESSION['username'] = $username;  //for storing data
            // Redirect to user dashboard page
            header("Location: dashboard.php");  //Pass to page header when logged in
        } 
        else //No such data present with your username. Relogin
        {
            echo "<div class='form'>
                  <h3>Incorrect Username/password.</h3><br/>
                  <p class='link'>Click here to <a href='login.php'>Login</a> again.</p>
                  </div>";
        }
    } 
    //FORM SUBMISSION----------------------------------------------------------------------------------
    else //Fill form
    {
?>
   
    <!--HTML PART COMPLETE-->
<?php
    }
?>
