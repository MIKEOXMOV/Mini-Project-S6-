<?php
	$conn=new PDO('mysql:host=localhost; dbname=project1', 'root', '') or die(
        die("An error occurred: Unable to execute query. Please try again later."));
	if(isset($_POST['submit'])!=""){
	  $name=$_FILES['file']['name'];
	  $size=$_FILES['file']['size'];
	  $type=$_FILES['file']['type'];
	  $temp=$_FILES['file']['tmp_name'];
	  $fname = date("YmdHis").'_'.$name;
	  $chk = $conn->query("SELECT * FROM  upload where name = '$name' ")->rowCount();
	  if($chk){
	    $i = 1;
	    $c = 0;
		while($c == 0){
	    	$i++;
	    	$reversedParts = explode('.', strrev($name), 2);
	    	$tname = (strrev($reversedParts[1]))."_".($i).'.'.(strrev($reversedParts[0]));
	    	$chk2 = $conn->query("SELECT * FROM  upload where name = '$tname' ")->rowCount();
	    	if($chk2 == 0){
	    		$c = 1;
	    		$name = $tname;
	    	}
	    }
	}
	 $move =  move_uploaded_file($temp,"upload/".$fname);
	 if($move){
	 	$query=$conn->query("insert into upload(name,fname)values('$name','$fname')");
		if($query){
		header("location:fileupload.php");
		}
		else {
            die("An error occurred: Unable to execute query. Please try again later.");
        }
	 }
	}
	?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="screen">
        <link rel="stylesheet" type="text/css" href="css/DT_bootstrap.css">

        <style>

body {
            background-color: #f8f9fa; /* Light gray background */
            font-family: Arial, sans-serif;
        }

        .container {
            margin-top: 150px;
            margin-right:100px;
        }

        input[type="file"] {
            background-color: #edf2f7; /* Light gray input background */
            border: none;
            padding: 10px;
            border-radius: 5px;
            width: 300px;
        }

        input[type="submit"] {
            background-color: #3498db; /* Blue submit button */
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        table {
            background-color: #ffffff; /* White table background */
        }

        th, td {
            border: 1px solid #dee2e6; /* Light gray borders for table headers and cells */
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #3498db; /* Blue header background */
            color: white;
        }

        .btn-download {
            background-color: #4caf50; /* Green download button */
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .btn-download:hover {
            background-color: #45a049; /* Darker green on hover */
        }

            </style>
</head>
<script src="js/jquery.js" type="text/javascript"></script>
	<script src="js/bootstrap.js" type="text/javascript"></script>
	
	<script type="text/javascript" charset="utf-8" language="javascript" src="js/jquery.dataTables.js"></script>
	<script type="text/javascript" charset="utf-8" language="javascript" src="js/DT_bootstrap.js"></script>

<body>
    <div class="container">
    <form enctype="multipart/form-data" action="" name="form" method="post">
		Select File
			<input type="file" name="file" id="file" /></td>
			<input type="submit" name="submit" id="submit" value="Submit" />
	</form>
    <hr>
    <br>
    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
			<thead>
				<tr>
					<th width="90%" align="center">Files</th>
					<th align="center">Action</th>	
				</tr>
			</thead>
			<?php
			$query=$conn->query("select * from upload order by id desc");
			while($row=$query->fetch()){
				$name=$row['name'];
			?>
			<tr>
				<td>
					&nbsp;<?php echo $name ;?>
				</td>
				<td>
					<button class="alert-success"><a href="download.php?filename=<?php echo $name;?>&f=<?php echo $row['fname'] ?>">Download</a></button>
				</td>
			</tr>
			<?php }?>
		</table>
</div>
</body>
</html>