<?php

session_start();

if(!isset($_SESSION['name'])){
	header('location:login.php');
}

$server = "localhost";
$username = "root";
$password = "";
$db = "mydata";

$conn = mysqli_connect($server, $username, $password, $db);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Page</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="index.css" />
    <link rel="stylesheet" type="text/css" href="signin.css">
</head>
<body>
    <div class="container-fluid banner">
		<div class="row">
			<div class="col-md-12">
				<nav class="navbar navbar-md">
					<div class="navbar-brand">CRYPTSHARE</div>
					<ul class="nav">
						<li class="nav-item">
							<a class="nav-link" href="home.php">Dashboard</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="profile.php">Profile</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="login.php">Log Out</a>
						</li>
					</ul>
				</nav>
			</div>
			<section class="wrapper">
                <div class="container">
                    <div class="col-sm-8 offset-sm-2 col-lg-6 offset-lg-3 col-xl-6 offset-xl-3 text-center">
                        <form action="upload.php" method="post" enctype="multipart/form-data" class="rounded bg-white shadow p-5">
                            <h3 class="text-dark fw-bolder fs-4 mb-2">CRYPTSHARE</h3>
                            <div class="fw-normal text-muted mb-4">
                                Fill All the FIELDS
                            </div>
                            <hr>
                            

                            <div class="s_input text-start mb-2">
                                <br>
                                <div>
                                    <label for="attach">Attach Your Document Here</label>
                                    <input name="file" class="form-control form-control-lg mt-2 " id="formFileLg" type="file">
                                </div>
                                <br>
                                <hr>

                                <br>
                                <div>
                                    <label for="keySelect">Select a key to Encrypt</label><br>
                                    <input class="form-check-input m-2 p-2" type="radio" value="AES" name="flexRadioDefault" id="flexRadioDefault1">
                                    <label class="form-check-label mt-2" for="flexRadioDefault1">
                                        AES
                                    </label><br>
                                    <input class="form-check-input m-2 p-2" type="radio" value="RSA" name="flexRadioDefault" id="flexRadioDefault2">
                                    <label class="form-check-label mt-2" for="flexRadioDefault2">
                                        RSA
                                    </label>
                                    <input class="form-check-input m-2 p-2" type="radio" value="NONE" name="flexRadioDefault" id="flexRadioDefault2">
                                    <label class="form-check-label mt-2" for="flexRadioDefault2">
                                        NONE
                                    </label>
                                </div>
                                <br>
                                <hr>

                                <br>
                                <div>
                                    <!-- <label for="selectBranch">Select Branch</label> -->
                                    <select name="branch" id="branch" class="form-control selectpicker" data-live-search="true">
                                        <option selected disabled>Select Branch of Receiver</option>
                                        <option value="Gujarat/India">Gujarat/India</option>
                                        <option value="Toronto/Canada">Toronto/Canada</option>
                                    </select>
                                </div>
                                <br>

                                <div>
                                    <!-- <label for="selectPostion">Select Position</label> -->
                                    <select name="role" id="role" class="form-control selectpicker" onchange="fast('branch',this.id,'receiver')" data-live-search="true">
                                        <option selected disabled>Select Position of Receiver</option>
                                        <option value="CEO">CEO</option>
                                        <option value="HR">HR</option>
                                        <option value="SDE1">SDE1</option>
                                        <option value="SDE2">SDE2</option>
                                        <option value="IT SUPPORT">IT SUPPORT</option>
                                    </select>
                                </div>
                                <br>

                                <div>
                                    <!-- <label for="selectPerson">Select Person</label> -->
                                    <select name="receiver" id="receiver" class="form-control selectpicker" data-live-search="true">
                                        <option selected disabled>Select Receiver</option>
                                    </select>
                                </div>
                                <br>
                                <hr>
                            </div>
                            <button type="submit" name="upload" class="btn btn-primary submit_btn my-4">Submit</button>
                        </form>
                    </div>
                </div>
            </section>
		</div>
	</div>

    <script>

        function fast(s1,s2,s3)
        {
            var s1 = document.getElementById(s1);
            var s2 = document.getElementById(s2);
            var s3 = document.getElementById(s3);

            s3.innerHTML = "";

            if(s1.value == "Gujarat/India" && s2.value == "CEO")
            {
                var optionArray = ['Rehankumar Chaudhari|','Siddharth Hirani|','rehan|'];
            }

            for(var option in optionArray)
            {
                var pair = optionArray[option].split("|");
                var newoption = document.createElement("option");

                newoption.value = pair[0];
                newoption.innerHTML = pair[0];
                s3.options.add(newoption);
            }
        }

    </script>

</body>
</html>