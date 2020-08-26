<html>
<body>
  <style>
  body {
   text-align: left;
   background-color: rgba(20, 150, 40, 0.5);
 }
 .error {
   color: #FF0000;
 }

</style>
<main>

 <?php
 // define variables and set to empty values
 $nameErr = $emailErr = $genderErr = $numberErr = $F_dayErr = $FavfruitErr = "";
 $name = $email = $gender = $Favfruit = $comment = $F_day = $number = "";

 if ($_SERVER["REQUEST_METHOD"] == "POST") {
   if (empty($_POST["name"])) {
     $nameErr = "Name is required";
   } else {
     $name = test_input($_POST["name"]);
     // check if name only contains letters and whitespace
     if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
       $nameErr = "Only letters and white space allowed";
     }
   }

   if (empty($_POST["email"])) {
     $emailErr = "Email is required";
   } else {
     $email = test_input($_POST["email"]);
     // check if e-mail address is well-formed
     if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
       $emailErr = "Invalid email format";
     }
   }

   if (empty($_POST["number"])) {
     $number = "";
   } else {
     $number = test_input($_POST["number"]);
     // check if URL address syntax is valid (this regular expression also allows dashes in the URL)
     if (!preg_match("/[+^0-9]/",$number)) {
       $numberErr = "Invalid Number";
     }
   }

   if (empty($_POST["comment"])) {
     $comment = "";
   } else {
     $comment = test_input($_POST["comment"]);
   }

   if (empty($_POST["gender"])) {
     $genderErr = "Gender is required";
   } else {
     $gender = test_input($_POST["gender"]);
   }
   if (empty($_POST["F_day"])) {
     $F_dayErr = "fruit per day is required";
   } else {
     $F_day = test_input($_POST["F_day"]);
   }
 }


 function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
 }
 ?>

  <h1> Fruit Survey </h1>
<p> Fill The Following Information Correctly </p>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <p><span class="error">* required field</span></p>

  Name: <input type="text" name="name" value="<?php echo $name;?>">
  <span class="error">* <?php echo $nameErr;?></span>
  <br><br>
  E-mail: <input type="text" name="email" value="<?php echo $email;?>">
  <span class="error">* <?php echo $emailErr;?></span>
  <br><br>
  Number : <input type="text" name="number" maxlength="11" value="<?php echo $number;?>">
  <span class="error">* <?php echo $numberErr;?></span>
  <br><br>

  Gender:
  <select name="gender">
    <option></option>
    <option value="Male"> Male </option>
    <option value="Female"> Female </option>
    <option value="Other"> Other </option>
  </select>
  <span class="error">* <?php echo $genderErr;?></span><br>
<br>

  How many fruit do you eat per day:
  <span class="error">* <?php echo $F_dayErr;?></span><br>
  <input type="radio" name="F_day" value="0"> 0 <br>
  <input type="radio" name="F_day" value="1"> 1 <br>
  <input type="radio" name="F_day" value="2"> 2 <br>
  <input type="radio" name="F_day" value="2+"> More than 2

  <p> Choose your Favourite Fruit:
  <span class="error">* <?php echo $FavfruitErr;?></span><br>
  <input type="checkbox" name="Favfruit[]" value="apple"> Apple <br>
  <input type="checkbox" name="Favfruit[]" value="Banana"> Banana <br>
  <input type="checkbox" name="Favfruit[]" value="Pineapple"> Pineapple <br>
  <input type="checkbox" name="Favfruit[]" value="Watermelon"> Watermelon <br>
  <input type="checkbox" name="Favfruit[]" value="Orange"> Orange <br>
  <input type="checkbox" name="Favfruit[]" value="Mangoe"> Mangoe <br>
</p>
  Comment:
  <textarea name="comment" rows="5" cols="30"></textarea><br><br>
  <input type="submit" name="submit" value="Submit">

<?php
echo "<br>";
echo "<h2>Thank you For participating in our survey! <br><br> Your Input:</h2>";
echo "Name: $name";
echo "<br> Email:$email";
echo "<br>Number: $number";
echo "<br> Gender: $gender";
echo "<br> Fruit you eat per day: $F_day";
if (isset($_POST['submit'])){
  if (!empty($_POST['Favfruit'])){
    foreach ($_POST['Favfruit'] as $selected) {
      echo "<br>Favourite fruit: $selected";
    }
  }
}
echo "<br> Comment: $comment";
?>

</main>
</body>
</html>
