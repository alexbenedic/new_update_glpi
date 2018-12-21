<?php


//$con = new mysqli($servername, $username, $password);
 
		if (isset ($_POST["Import"]) )
        { 
              
            		$filename=$_FILES["file"]["tmp_name"];		


		 if($_FILES["file"]["size"] > 0)
		 {
             if (($_POST["option"] === "Add" ) )
    
{             
		  	$file = fopen($filename, "r");
                 include 'report_config.php';
	        while (($getData = fgetcsv($file, 100000, ",")) !== FALSE)
	         {
$dbname = 'ocsweb';
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "INSERT INTO `hardware` (DEVICEID, NAME)
VALUES ('".$getData[0]."', '".$getData[1]."')";

if ($conn->query($sql) === TRUE) {
  $last_id = $conn->insert_id;
//    echo "New record created successfully";
    
    $sql = "INSERT INTO accountinfo (HARDWARE_ID, TAG)
VALUES ('".$last_id."', 'Manual_upload')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
    
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


$conn->close();
	        
	         }
			
	         fclose($file);	
}
             else if (($_POST["option"] === "Update" ) )
             {
                 echo "update page";
             }
		 }
            else
            {
                 echo "<script type=\"text/javascript\">
						alert(\"Please select file and try again\");
						window.location = \"manual.php\"
					</script>";
            }
            
        }
     

	
else{
		
echo "not yet";
	}	 



 ?>