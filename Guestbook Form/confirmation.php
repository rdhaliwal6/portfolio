<?php
//$first = $_POST['firstName'];
//$last = $_POST['lastName'];
//$email = $_POST['email'];
//$method = $_POST['list'];
//$linkden = $_POST['linkUrl'];
//$hwm = $_POST['meetME'];
//$hwmOther = $_POST['other1'];
//$hwmArray[4] = ["Meetup","Jobfair","Not Yet Met","Other"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Guestbook Confirmation</title>
</head>
<body>
<pre>
<?php
$nameRegex = "/^([a-zA-Z' -]+)$/";
$basicTextRegex = "/^([a-zA-Z0-9'\", .()\r\n&!?-]+)$/";
$emailRegex = "/[a-z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+\/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/i";
$phoneRegex = "/^[(]{0,1}[0-9]{3}[)]{0,1}[-\s\.]{0,1}[0-9]{3}[-\s\.]{0,1}[0-9]{4}$/";

if (!empty($_POST)) {

    require "guestbookDBconnect.php";
    if ($cnxn) {

        $isValid = true;
        $first = $_POST['firstName'];
        $last = $_POST['lastName'];
        $email = $_POST['email'];
        $method = $_POST['list'];
        $linkden = $_POST['linkUrl'];
        $hwm = $_POST['meetMe'];
        $title = $_POST['title'];
        $company = $_POST['company'];
        $comment = $_POST['comment'];
        $list = $_POST['list'];
        $date = date('Y/m/d H:i:s');
        $hwmOther = $_POST['other1'];
        $emailType = $_POST['email-format'];


        if ($first == "") {
            echo "<p>Enter in a valid First Name</p>";
            $isValid = false;
        }

        if ($last == "") {
            echo "<p>Enter in a valid Last Name</p>";
            $isValid = false;
        }

        if ($method == "add" && $email == "") {
            echo "<p>Valid Email is Required</p>";
            $isValid = false;

        }

        if ($email != "" && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<p>Enter in a valid Email</p>";
            $isValid = false;
        }

        if ($linkden != "" && !preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $linkden)) {
            echo "<p>Enter in a valid linkedin Url</p>";
            $isValid = false;
        }

        if ($hwm == "none") {
            echo "<p>Enter a valid choice for how we met</p>";
            $isValid = false;
        }

// elseif (in_array($hwm, $hwmArray)) {
//
//    }

        if ($isValid) {
            echo "<p>Thank You</p>";
            echo "<p>Summary:</p>";
            echo "<p>First Name: $first</p>";
            echo "<p>Last Name: $last</p>";
            echo "<p>Email: $email</p>";
            echo "<p>Linkedln URl $linkden</p>";
            echo "<p>How we Met: $hwm</p>";
                if ($hwm == "other") {
                    $hwm = $hwm.' - '.$hwmOther;
                echo "<p>$hwmOther</p>";
                }

                if($list == "add"){
                    echo "<p>$list</p>";
                    $emailType2 = $emailType;
                }
                else
                $emailType2 = "No";
        }

        $sql = "INSERT INTO `guestbook` (`Name`, `Title`, `Company`, `LinkedIn`, `Email`, `Comment`, `EmailList`, `HowWeMet`, `Date`) 
                Values('$first.$last', '$title','$company','$linkden','$email','$comment','$emailType2','$hwm','$date')";

        $result = mysqli_query($cnxn, $sql);

    }
}

//}
?>
</pre>
</body>
</html>
