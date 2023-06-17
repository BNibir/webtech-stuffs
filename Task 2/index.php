<!DOCTYPE html>
<html>
<head>
<title>Contact Form</title>
</head>
<body>
<?php
$name = $email = $gender = $comment = $blood_group = $degree = $dob= "";
$selected_degrees = array();

if (isset($_POST['name'])) {

    if (empty($_POST['name'])) {
        echo "The name field is required.";
    } 
    else if (!preg_match("/^[a-zA-Z][a-zA-Z0-9.-]+$/", $_POST['name'])) {
        echo "The name must start with a letter and can only contain letters, numbers, periods, and dashes.";
    } 
    else {
        $name = $_POST['name'];
    }

    if (empty($_POST['email'])) {
        echo "The email field is required.";
    } 
    else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        echo "The email address is not valid.";
    } 
    else {
        $email = $_POST['email'];
    }

    if (empty($_POST['dob'])) {
        echo "The date of birth field is required.";
    } 
    else {
        $dob = $_POST['dob'];
        $date = DateTime::createFromFormat('Y-m-d', $dob);
        if ($date === false) {
            echo "The date of birth is not valid.";
        } 
        else {
            $dob = $date->format('Y-m-d');
        }
    }

    if (empty($_POST['gender'])) {
        echo "The gender field is required.";
    }

    if (empty($_POST['degree'])) {
        echo "The degree field is required.";
    } 
    else {
        $degrees = array('ssc', 'hsc', 'bsc', 'msc');
        $selected_degrees = array();
        foreach ($_POST['degree'] as $degree) {
            if (in_array($degree, $degrees)) {
                $selected_degrees[] = $degree;
            }
        }
        if (count($selected_degrees) < 2) {
            echo "At least two degrees must be selected.";
        }
    }

    if (empty($_POST['blood_group'])) {
        echo "The blood group field is required.";
    } 
    else {
        $blood_group = $_POST['blood_group'];
        if (!in_array($blood_group, array('A', 'B', 'AB', 'O'))) {
        echo "The blood group is not valid.";
        }
    }

    if (empty($_POST['gender'])) {
            echo "The gender field is required.";
        } 
        else {
            $gender = $_POST['gender'];
        }

}

?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
<label for="name">Name</label>
<input type="text" name="name" id="name" required minlength="2" pattern="[a-zA-Z][a-zA-Z0-9.-]+"><br><br>
<label for="email">Email</label>
<input type="email" name="email" id="email" required><br><br>
<label for="dob">Date of Birth</label>
<input type="date" name="dob" id="dob" required><br><br>
<label for="gender">Gender</label>
<input type="radio" name="gender" id="male" value="male" checked> Male
<input type="radio" name="gender" id="female" value="female"> Female
<input type="radio" name="gender" id="other" value="other"> Other<br><br>
<label for="degree">Degree</label>
<input type="checkbox" name="degree[]" id="ssc" value="ssc"> SSC
<input type="checkbox" name="degree[]" id="hsc" value="hsc"> HSC
<input type="checkbox" name="degree[]" id="bsc" value="bsc"> BSc
<input type="checkbox" name="degree[]" id="msc" value="msc"> MSc<br><br>
<label for="blood_group">Blood Group</label>
<select name="blood_group" id="blood_group"><br><br>
<option value="">Select Blood Group</option>
<option value="A">A</option>
<option value="B">B</option>
<option value="AB">AB</option>
<option value="O">O</option><br>
</select>
<input type="submit" value="Submit">
</form>

<?php
echo "<h2>Your Input:</h2>";
echo $name;
echo "<br>";
echo $email;
echo "<br>";
echo $dob;
echo "<br>";
echo $gender;
echo "<br>";
for ($i = 0; $i < count($selected_degrees); $i++) {
    echo $selected_degrees[$i] . ' ';
}
echo "<br>";
echo $blood_group;
?>
</body>
</html>
