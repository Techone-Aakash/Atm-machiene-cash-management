<?php
session_start();
error_reporting(0);

 $_SESSION['c_id'] = 0;
    include "connect.php";

    if(!isset($_SESSION["c_transaction_details"])){
        $_SESSION["c_transaction_details"] = "";
    }

   function input_data($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;    
   }

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["find"]) ) {
$c_id = input_data($_POST["c_id"]);
//for checking customer details
$sql_user = "SELECT * FROM customer_detail WHERE c_id='$c_id' " ;
if($res = mysqli_query($conn,$sql_user)){
if(mysqli_num_rows($res) != 0){
$_SESSION['c_id'] = input_data($_POST["c_id"]);
header("location:print.php");
}else{
$error = "Invalid customer id";
}
}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find customer details</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="//use.fontawesome.com/releases/v5.0.7/css/all.css">
    <link href="favicon1.png" rel="icon" type="image/x-icon" />
    </head>
<style>
            * {
                margin: 0px;
                padding: 0px;
            }
    /*
            body {
                background: url("https://66.media.tumblr.com/2f2c930b91c4e54eb4f37e3a5da7f91a/tumblr_olmalfsAGi1uzwgsuo1_400.gifv") no-repeat;
                background-size: cover;
                }
    */
            a {
                text-decoration: none;
                cursor: pointer;
            }
            a:hover {
                color: rgb(0, 55, 144);
            }
    
            .container {
                position: relative;
                height: 99vh;
                border: 3px solid black;
                background-color: #4a4a4a25;
            }
    
            .form_div {
                margin: 0;
                position: absolute;
                top: 50%;
                left: 50%;
                -ms-transform: translate(-50%, -50%);
                transform: translate(-50%, -50%);
            }
    
            #registration {
                background: url("https://66.media.tumblr.com/2f2c930b91c4e54eb4f37e3a5da7f91a/tumblr_olmalfsAGi1uzwgsuo1_400.gifv") no-repeat;
                background-size: cover;
                height: auto;
                width: 500px;
                padding-bottom: 30px;
                border: 2px solid grey;
                border-radius:5px;
                color:darkslategray;
                text-align: center;
                box-shadow: 3px 3px 30px #6c787c;
            }
            input::-webkit-outer-spin-button,
            input::-webkit-inner-spin-button {
                -webkit-appearance: none;
                margin: 0;
            }
    
            label {
                display: block;
                letter-spacing: 3px;
                padding-top: 30px;
                text-align: center;
            }
    
            /* animation for the text to float up */
    
            label .reg_field {
                cursor: text;
                font-size: 13px;
                line-height: 20px;
                text-transform: uppercase;
                -moz-transform: translateY(-55px);
                -ms-transform: translateY(-55px);
                -webkit-transform: translateY(-55px);
                transform: translateY(-55px);
                transition: all 0.3s;
            }
    
            /* remove the input box styling */
            label input {
                background-color: transparent;
                border: 0;
                border-bottom: 2px solid #4A4A4A;
                color: black;
                font-size: 18px;
                letter-spacing: 1px;
                outline: 0;
                padding: 5px 20px;
                text-align: center;
                transition: all .3s;
                width: 250px;
            }
    
            /* once you click in the input the input width box animates */
    
            label input:focus {
                max-width: 100%;
                width: 280px;
                border-bottom: 2px solid #a51d1d;
            }
    
            /* the text floats up and turns white */
    
            label input:focus+.reg_field {
                color: #a51d1d;
                font-weight: 600;
                text-transform: capitalize;
                font-size: 12px;
                margin-top: 20px;
            }
    
            /* the text floats up during form validation */
    
            label input:focus+.reg_field {
                font-size: 13px;
                -moz-transform: translateY(-74px);
                -ms-transform: translateY(-74px);
                -webkit-transform: translateY(-74px);
                transform: translateY(-74px);
            }
    
            /* button styling */
    
            input[type="submit"] {
                background: transparent;
                margin: auto;
                border: 2px solid gray;
                font-size: 15px;
                letter-spacing: 2px;
                padding: 20px 75px;
                text-transform: uppercase;
                cursor: pointer;
                display: inline-block;
                -webkit-transition: all 0.4s;
                -moz-transition: all 0.4s;
                transition: all 0.4s;
            }
    
            input~label:hover,
            input~.reg_field:hover {
                background-color: transparent;
                color: #a51d1d;
            }
    
            input[type="submit"]:hover {
                background:rgba(47, 79, 79, 0.082);
                border: 2px solid #a51d1d;
            }
    
            .genderdiv {
                margin: 5px;
                letter-spacing: 2.5px;
                color: 333333;
                font-size: 1.1rem;
            }
            label[for="male"],
            [for="female"],
            [for="other"] {
                display: inline;
                cursor: pointer;
            }
    
            .fa {
                position: absolute;
            }
            .fa-eye {
                z-index: 2;
                margin-left: 280px;
                background-color: transparent;
                font-size: 1.4em;
                cursor: pointer;
                border: 0;
            }
            .regis_error{
                letter-spacing: 1.5px;
            } 
            h2{
             color: green;
            }     
            h3{
             color: blue;
            }       
    
            @media only screen and (max-width:318px) {
            #registration {
                width: 270px;
                padding-bottom: 20px;
                border-radius:15px;
            }
            form h2{
                font-size: medium;
            }
             label .reg_field {
                font-size: 12px;
     
            }
            label input {
                border-bottom: 1.2px solid #4A4A4A;
                font-size: 15px;
                padding: 2px 5px;
                width: 210px;
            }
    
            label input:focus {
                max-width: 100%;
                width: 230px;
                border-bottom: 1.2px solid #a51d1d;
            }
    
            label input:focus+.reg_field {
                margin-top: 30px;
            }

            input[type="submit"] {
                border: 1.2px solid gray;
                font-size: 14px;
                padding: 15px 45px;
            }
            input[type="submit"]:hover {
                background:rgba(47, 79, 79, 0.082);
                border: 1.2px solid #a51d1d;
            }
    
            .genderdiv {
                padding-top: 15px;
                letter-spacing:0;
            }
            label[for="male"],
            [for="female"],
            [for="other"] {
                letter-spacing:0;
            }
            .fa-eye {
                margin-left: 205px;
                font-size: 1em;
            }
            .regis_error{
                letter-spacing: .3px;
            }
            }
    
            @media only screen and (min-width:318px) and (max-width:350px) {
            #registration {
                width: 270px;
                padding-bottom: 20px;
                border-radius:15.5px;
            }
            form h2{
                font-size: medium;
            }
             label .reg_field {
                font-size: 12.5px;
            }
            label input {
                border-bottom: 1.2px solid #4A4A4A;
                font-size: 15px;
                padding: 2px 5px;
                width: 210px;
            }
    
            label input:focus {
                max-width: 100%;
                width: 230px;
                border-bottom: 1.2px solid #a51d1d;
            }
    
            label input:focus+.reg_field {
                margin-top: 30px;
            }

            input[type="submit"] {
                border: 1.2px solid gray;
                font-size: 14px;
                padding: 15px 45px;
            }
            input[type="submit"]:hover {
                background:rgba(47, 79, 79, 0.082);
                border: 1.2px solid #a51d1d;
            }
    
            .genderdiv {
                letter-spacing:0;
                margin-top: -15px;
            }
            label[for="male"],
            [for="female"],
            [for="other"] {
                letter-spacing:0;
            }
          .fa-eye {
                margin-left: 210px;
                font-size: 1em;
            }  
            .regis_error{
                letter-spacing: .3px;
            } 
    }
    
            @media only screen and (min-width: 351px) and (max-width: 370px) {
    
             #registration {
                width: 290px;
                border-radius:10px;
            }
            form h2{
                font-size: medium;
            }
             label .reg_field {
                font-size: 13px;
            }
            label input {
                border-bottom: 1.2px solid #4A4A4A;
                font-size: 15px;
                padding: 2px 5px;
                width: 210px;
            }
    
            label input:focus {
                max-width: 100%;
                width: 230px;
                border-bottom: 1.2px solid #a51d1d;
            }
    
            label input:focus+.reg_field {
                margin-top: 30px;
            }

            input[type="submit"] {
                border: 1.2px solid gray;
                font-size: 14px;
                padding: 15px 45px;
            }
            input[type="submit"]:hover {
                background:rgba(47, 79, 79, 0.082);
                border: 1.2px solid #a51d1d;
            }
    
            .genderdiv {
                letter-spacing:0;
            }
            label[for="male"],
            [for="female"],
            [for="other"] {
                margin-right:10px ;
                letter-spacing:0;
            }
          .fa-eye {
                margin-left: 210px;
                font-size: 1em;
            }  
            .regis_error{
                letter-spacing: .5px;
            }
        }

            @media only screen and (min-width: 371px) and (max-width:433px) {
    
              #registration {
                width: 320px;
                border-radius:10px;
            }
            form h2{
                font-size: 1.2em;
            }
             label .reg_field {
                font-size: 13px;
                line-height:25px;
            }
            label input {
                border-bottom: 1.4px solid #4A4A4A;
                font-size: 15px;
                padding: 2px 5px;
                width: 230px;
            }
    
            label input:focus {
                max-width: 100%;
                width: 250px;
                border-bottom: 1.4px solid #a51d1d;
            }
    
            label input:focus+.reg_field {
                margin-top: 25px;
            }

            input[type="submit"] {
                border: 1.2px solid gray;
                font-size: 14px;
                padding: 15px 45px;
            }
            input[type="submit"]:hover {
                background:rgba(47, 79, 79, 0.082);
                border: 1.2px solid #a51d1d;
            }
    
            .genderdiv {
                letter-spacing:0;
            }
            label[for="male"],
            [for="female"],
            [for="other"] {
                margin-right:10px ;
                letter-spacing:0;
            }
          .fa-eye {
                margin-left: 230px;
                font-size: 1em;
            }  
            .regis_error{
                letter-spacing: 1px;
            }            
        }
               @media only screen and (min-width: 434px) and (max-width:500px) {
            #registration {
                width: 350px;
                border-radius:8px;
            }
            form h2{
                font-size: 1.25em;
            }
             label .reg_field {
                font-size: 14px;
                line-height:22px;
            }
            label input {
                border-bottom: 1.4px solid #4A4A4A;
                font-size: 15px;
                padding: 2px 5px;
                width: 230px;
            }
    
            label input:focus {
                max-width: 100%;
                width: 250px;
                border-bottom: 1.4px solid #a51d1d;
            }
    
            label input:focus+.reg_field {
                margin-top: 25px;
            }

            input[type="submit"] {
                border: 1.2px solid gray;
                font-size: 14px;
                padding: 15px 45px;
            }
            input[type="submit"]:hover {
                background:rgba(47, 79, 79, 0.082);
                border: 1.2px solid #a51d1d;
            }
    
            .genderdiv {
                letter-spacing:0;
            }
            label[for="male"],
            [for="female"],
            [for="other"] {
                margin-right:10px ;
                letter-spacing:1px;
            }
          .fa-eye {
                margin-left: 230px;
                font-size: 1em;
            } 
            .regis_error{
                letter-spacing: 1.3px;
            }            
        }
       
            @media screen and (min-width:501px) and (max-width: 599px) {
    
              #registration {
                width: 400px;
                border-radius:6px;
            }
            form h2{
                font-size: 1.3em;
            }
             label .reg_field {
                font-size: 15px;
                line-height:22px;
            }
            label input {
                border-bottom: 1.4px solid #4A4A4A;
                font-size: 15px;
                padding: 2px 5px;
                width: 230px;
            }
    
            label input:focus {
                max-width: 100%;
                width: 250px;
                border-bottom: 1.4px solid #a51d1d;
            }
    
            label input:focus+.reg_field {
                margin-top: 25px;
            }

            input[type="submit"] {
                border: 1.5px solid gray;
                font-size: 15px;
                padding: 15px 45px;
            }
            input[type="submit"]:hover {
                background:rgba(47, 79, 79, 0.082);
                border: 1.5px solid #a51d1d;
            }
            .genderdiv {
                letter-spacing:0;
            }
            label[for="male"],
            [for="female"],
            [for="other"] {
                margin-right:15px ;
                letter-spacing:2px;
            }
          .fa-eye {
                margin-left: 250px;
                font-size: 1em;
            }
            .regis_error{
                letter-spacing: 1.5px;
            }     
                }
</style>    
    <body>
            <div class="container">
                <div class="form_div">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" id="registration" method="POST">
                        <h2
                            style="width:100%;text-decoration:underline; text-transform:uppercase; letter-spacing:4px; text-decoration:underline; color: #a51d1d; padding:35px 0;">
                           Find customer details</h2>
                        <?php
                        if ($error != "") {
                            echo "<p class='regis_error' style='color:red; text-transform:none; font-weight:bold;'>$error</p>";
                        }
                        if ($success != "") {
                            echo "<p class='regis_success' style='text-transform:none; font-weight:bold;'>$success</p></br>";
                            echo '<input type="submit" name="continue" value="Proceed" />';
                        }else{
                        ?>    

                        <label><i class="fa fa-user" aria-hidden="true"></i>
                            <input type="text" name="c_id" required autocomplete="off" />
                            <div class="reg_field">Customer Id</div>
                        </label></br>
                        
                        <input type="submit" name="find" value="Find" />
                        <label><a href="/index.php">Withdraw Cash</a></label></br>

                        <?php
                        }
                        ?>
                    </form>
                </div>
            </div>

</body>
</html>
<?php 
mysqli_close($conn);
?>

