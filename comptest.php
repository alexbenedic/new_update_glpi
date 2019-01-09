<?php
include('login/db_configs.php');
  date_default_timezone_set('Asia/Kuala_Lumpur');
 $last30days = date("Y-m-d",strtotime('-30 days'));
$mnum = date("m");
$month = date('F');
$year = date ('Y');
$months = date('m');
$month = 'April';
if ($month == 'January' || $month == 'February' || $month == 'March'  )
{
  $monthyear =   date('F-Y',  strtotime($year.'-01 -3 month'));
  $from = date('Y-m',  strtotime($year.'-01 -3 month'));
$to = date('Y-m',  strtotime($year.'-01 -1 month'));
 $type = 'Q4';
}
else if ($month == 'April'|| $month == 'May' || $month == 'June')
{
 $monthyear =   date('F-Y',  strtotime($year.'-04 -3 month'));
 $type = 'Q1';
  $from = date('Y-m',  strtotime($year.'-04 -3 month'));
$to = date('Y-m',  strtotime($year.'-04 -1 month'));
}
else if ($month == 'July' || $month == 'August' || $month == 'September')
{
 $monthyear =   date('F-Y',  strtotime($year.'-06 -3 month'));
  $from = date('Y-m',  strtotime($year.'-06 -3 month'));
$to = date('Y-m',  strtotime($year.'-06 -1 month'));
 $type = 'Q2';
}
else if ($month == 'October' || $month == 'November' || $month == 'December')
{
  $monthyear =   date('F-Y',  strtotime($year.'-10 -3 month'));
  $from = date('Y-m',  strtotime($year.'-10 -3 month'));
$to = date('Y-m',  strtotime($year.'-10 -1 month'));
 $type = 'Q3';
}

$from = $from."-01";
$to = $to."-31";


$sql = "SELECT `glpi_computers`.`name`,`glpi_computers`.`id`,`glpi_domains`.`name` AS domain 
FROM `glpi_computers`
INNER JOIN `glpi_domains`
ON `glpi_computers`.`domains_id` = `glpi_domains`.`id`
WHERE `glpi_computers`.`is_deleted` = 0  and `glpi_domains`.`id` ='7'  order by `glpi_computers`.`id` ASC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	
    // output data of each row
	$total = $result->num_rows;
    while($row = $result->fetch_assoc()) {
	$name[] = $row['name'];
	$id[] = $row['id'];
	//echo $name ."<br>";
        
} 
}

 else {
    echo "0 resultsaaa";
}
 $data1 = "";
$data1 .= "Hostname;Software Name;Version\n";
for ($x=0; $x<$total; $x++)
{
	     $sql = "SELECT `glpi_softwares`.`name` AS softname,
                       `glpi_softwareversions`.`name` AS version,
                       `glpi_computers_softwareversions`.`date_install` AS dateinstall
                FROM `glpi_computers_softwareversions`
                LEFT JOIN `glpi_softwareversions`
                     ON (`glpi_computers_softwareversions`.`softwareversions_id`
                           = `glpi_softwareversions`.`id`)
                LEFT JOIN `glpi_states`
                     ON (`glpi_states`.`id` = `glpi_softwareversions`.`states_id`)
                LEFT JOIN `glpi_softwares`
                     ON (`glpi_softwareversions`.`softwares_id` = `glpi_softwares`.`id`)
                WHERE `glpi_computers_softwareversions`.`computers_id` = ".$id[$x]."
                      AND `glpi_computers_softwareversions`.`is_deleted` = 0
                ORDER BY `softname`, `version`";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
 $data1 .= $name[$x].";".$row['softname'].";".$row['version']."\n";
      //echo  ."---". $row['softname']."---". $row['version']."<br>";
    }
} else {
    echo "0 resultsqq";
}
}
$csv_handler = fopen ('ListOfSofware.csv','w');
fwrite ($csv_handler,$data1);
fclose ($csv_handler);


//
//$sql = "SELECT items_id,itemtype
//FROM `glpi_infocoms` 
//where decommission_date IS NOT NULL;";
//$result = $conn->query($sql);
//if ($result->num_rows > 0) {
//    while($row = $result->fetch_assoc()) {
//if ($row['itemtype'] == 'Computer')
//{
//    $compid[] = $row['items_id'];
////    $compdate[] = $row['decommission_date'];
//}
//    else if  ($row['itemtype'] == 'Printer')
//    {
//        $printerid[] = $row['items_id'];
////            $printerdate[] = $row['decommission_date'];
//
//    }
//    else if  ($row['itemtype'] == 'NetworkEquipment')
//    {
//        $netid[] = $row['items_id'];
////            $netdate[] = $row['decommission_date'];
//
//    }
//    }
//   
//    
//    
//}    
//else {
////    echo "0 results1";
//}
//$ttlcomp = sizeof($compid);
//$ttlprinter = sizeof($printerid);
//$ttlnet = sizeof($netid);
//// disposed
////computer
//
//for ($x=0; $x<$ttlcomp; $x++)
//{
//$sql = "SELECT `glpi_computers`.`name` as desktop,`glpi_computers`.`states_id`,`glpi_computers`.`is_deleted` as deleted,`glpi_computers`.`serial`,`glpi_computers`.`contact` as username, `glpi_operatingsystems`.`name`,`glpi_computertypes`.`name` as cat,`glpi_infocoms`.`decommission_date`
//FROM `glpi_computers`
//                LEFT JOIN `glpi_items_operatingsystems`
//                           ON (`glpi_items_operatingsystems`.`items_id`=`glpi_computers`.`id`)
//LEFT JOIN `glpi_operatingsystems`
//                           ON (`glpi_items_operatingsystems`.`operatingsystems_id`=`glpi_operatingsystems`.`id`)
//LEFT JOIN `glpi_computertypes`
//                           ON (`glpi_computertypes`.`id`=`glpi_computers`.`computertypes_id`)
//LEFT JOIN `glpi_infocoms`
//                           ON (`glpi_infocoms`.`items_id`=`glpi_computers`.`id`)
//where `glpi_computers`.`is_deleted` = '1' and `glpi_computers`.`states_id` = 3  and (`glpi_operatingsystems`.`name` LIKE '%server%' OR  `glpi_operatingsystems`.`name` LIKE '%RedHat%' 
//OR  `glpi_operatingsystems`.`name` LIKE '%VMware%' OR  `glpi_operatingsystems`.`name` LIKE '%AIX%' OR  `glpi_operatingsystems`.`name` LIKE '%Linux%' 
// OR  `glpi_operatingsystems`.`name` LIKE '%SunOS %' OR  `glpi_operatingsystems`.`name` LIKE '%CentOS%' ) and  `glpi_computers`.`id` = '".$compid[$x]."' and  `glpi_infocoms`.`decommission_date` >= date ('".$from."') and `glpi_infocoms`.`decommission_date` <= date ('".$to."')";
//$result = $conn->query($sql);
//if ($result->num_rows > 0) {
//    while($row = $result->fetch_assoc()) {
//        echo "Server ".$x." : ".$row["desktop"]."--".$row["states_id"]."--". $row["decommission_date"]."<br>";
//    }
//}
//    
//   $sql = "SELECT `glpi_computers`.`name` as desktop,`glpi_computers`.`states_id`,`glpi_computers`.`serial`,`glpi_computers`.`contact` as username, `glpi_operatingsystems`.`name`,`glpi_computertypes`.`name` as cat, `glpi_infocoms`.`decommission_date`
//FROM `glpi_computers`
//                LEFT JOIN `glpi_items_operatingsystems`
//                           ON (`glpi_items_operatingsystems`.`items_id`=`glpi_computers`.`id`)
//LEFT JOIN `glpi_operatingsystems`
//                           ON (`glpi_items_operatingsystems`.`operatingsystems_id`=`glpi_operatingsystems`.`id`)
//LEFT JOIN `glpi_computertypes`
//                           ON (`glpi_computertypes`.`id`=`glpi_computers`.`computertypes_id`)
//LEFT JOIN `glpi_states`
//                           ON (`glpi_states`.`id`=`glpi_computers`.`states_id`)
//LEFT JOIN `glpi_infocoms`
//                           ON (`glpi_infocoms`.`items_id`=`glpi_computers`.`id`)
//where  `glpi_computers`.`is_deleted` = 1 and  `glpi_computers`.`states_id` = 3 and `glpi_operatingsystems`.`name` LIKE '%Windows 7%'
// and (`glpi_computertypes`.`name` LIKE '%desktop%' or `glpi_computertypes`.`name` LIKE '%tower%'or `glpi_computertypes`.`name` LIKE '%Space-saving%') and `glpi_computers`.`id` ='".$compid[$x]."' and  `glpi_infocoms`.`decommission_date` >= date ('".$from."') and `glpi_infocoms`.`decommission_date` <= date ('".$to."')";
//$result = $conn->query($sql);
//if ($result->num_rows > 0) {
//    while($row = $result->fetch_assoc()) {
//        echo "Desktop ".$x." : ".$row["desktop"]."--".$row["states_id"]."--". $row["decommission_date"]."<br>";
//    }
//} 
//   
//        
//   $sql = "  SELECT `glpi_computers`.`name` as desktop,`glpi_computers`.`is_deleted` as deleted,`glpi_computers`.`serial`,`glpi_computers`.`contact` as username, `glpi_operatingsystems`.`name`,`glpi_computertypes`.`name` as cat,`glpi_infocoms`.`decommission_date`
//FROM `glpi_computers`
//                LEFT JOIN `glpi_items_operatingsystems`
//                           ON (`glpi_items_operatingsystems`.`items_id`=`glpi_computers`.`id`)
//LEFT JOIN `glpi_operatingsystems`
//                           ON (`glpi_items_operatingsystems`.`operatingsystems_id`=`glpi_operatingsystems`.`id`)
//LEFT JOIN `glpi_computertypes`
//                           ON (`glpi_computertypes`.`id`=`glpi_computers`.`computertypes_id`)
//LEFT JOIN `glpi_infocoms`
//                           ON (`glpi_infocoms`.`items_id`=`glpi_computers`.`id`)
//where  `glpi_computers`.`is_deleted` = 1 and  `glpi_computers`.`states_id` = 3 and `glpi_operatingsystems`.`name` LIKE '%Windows 7%' 
//and (`glpi_computertypes`.`name` LIKE '%notebook%' or `glpi_computertypes`.`name` LIKE '%laptop%' ) and `glpi_computers`.`id` = '".$compid[$x]."' and  `glpi_infocoms`.`decommission_date` >= date ('".$from."') and `glpi_infocoms`.`decommission_date` <= date ('".$to."')";
//$result = $conn->query($sql);
//if ($result->num_rows > 0) {
//    while($row = $result->fetch_assoc()) {
//        echo "Laptop ".$x." : ".$row["desktop"]."--".$row["states_id"]."--". $row["decommission_date"]."<br>";
//    }
//}
//    
//}
//
////printer
//
////for ($x=0; $x<$ttlprinter; $x++)
////{
////    $sql = "SELECT `glpi_printers`.*,`glpi_infocoms`.`decommission_date`
////FROM `glpi_printers`
////LEFT JOIN `glpi_infocoms`
////                           ON (`glpi_infocoms`.`items_id`=`glpi_printers`.`id`)
////where `glpi_printers`.`is_deleted` = 1 and `glpi_printers`.`states_id` = 3 and `glpi_printers`.`id` = '".$printerid[$x]."' and  `glpi_infocoms`.`decommission_date` >= date ('".$from."') and `glpi_infocoms`.`decommission_date` <= date ('".$to."')";
////    $result = $conn->query($sql);
////if ($result->num_rows > 0) {
////    while($row = $result->fetch_assoc()) {
////        echo "Printer ".$x." : ".$row["name"]."--".$row["states_id"]."--". $row["decommission_date"]."<br>";
////    }
////}
////    
////}
//
////network
//
////for ($x=0; $x<$ttlnet; $x++)
////{
////    $sql = "SELECT `glpi_networkequipments`.`name` as network,`glpi_networkequipments`.`states_id   `,`glpi_networkequipments`.`serial`, `glpi_networkequipmentmodels`.`name` AS model, `glpi_manufacturers`.`name` AS manufacture,`glpi_infocoms`.`decommission_date`
////FROM `glpi_networkequipments`
////                LEFT JOIN `glpi_networkequipmentmodels`
////                           ON (`glpi_networkequipmentmodels`.`id`=`glpi_networkequipments`.`id`)
////        LEFT JOIN `glpi_manufacturers`
////                           ON (`glpi_manufacturers`.`id`=`glpi_networkequipments`.`manufacturers_id`)
////
////LEFT JOIN `glpi_infocoms`
////                           ON (`glpi_infocoms`.`items_id`=`glpi_networkequipments`.`id`)
////where  `glpi_networkequipments`.`is_deleted` = 1 and `glpi_networkequipments`.`states_id` = 3 and `glpi_networkequipments`.`id` =  '".$netid[$x]."' and  `glpi_infocoms`.`decommission_date` >= date ('".$from."') and `glpi_infocoms`.`decommission_date` <= date ('".$to."')";
////    $result = $conn->query($sql);
////if ($result->num_rows > 0) {
////    while($row = $result->fetch_assoc()) {
////        echo "Network ".$x." : ".$row["network"]."--".$row["states_id"]."--". $row["decommission_date"]."<br>";
////    }
////}
////    
////}
//
//// decomm
//  $server = "";
//for ($x=0; $x<$ttlcomp; $x++)
//{
//$sql = "SELECT `glpi_computers`.`name` as desktop,`glpi_computers`.`states_id`,`glpi_computers`.`is_deleted` as deleted,`glpi_computers`.`serial`,`glpi_computers`.`contact` as username, `glpi_operatingsystems`.`name`,`glpi_computertypes`.`name` as cat,`glpi_infocoms`.`decommission_date`
//FROM `glpi_computers`
//                LEFT JOIN `glpi_items_operatingsystems`
//                           ON (`glpi_items_operatingsystems`.`items_id`=`glpi_computers`.`id`)
//LEFT JOIN `glpi_operatingsystems`
//                           ON (`glpi_items_operatingsystems`.`operatingsystems_id`=`glpi_operatingsystems`.`id`)
//LEFT JOIN `glpi_computertypes`
//                           ON (`glpi_computertypes`.`id`=`glpi_computers`.`computertypes_id`)
//LEFT JOIN `glpi_infocoms`
//                           ON (`glpi_infocoms`.`items_id`=`glpi_computers`.`id`)
//where `glpi_computers`.`is_deleted` = '1' and `glpi_computers`.`states_id` = 2  and (`glpi_operatingsystems`.`name` LIKE '%server%' OR  `glpi_operatingsystems`.`name` LIKE '%RedHat%' 
//OR  `glpi_operatingsystems`.`name` LIKE '%VMware%' OR  `glpi_operatingsystems`.`name` LIKE '%AIX%' OR  `glpi_operatingsystems`.`name` LIKE '%Linux%' 
// OR  `glpi_operatingsystems`.`name` LIKE '%SunOS %' OR  `glpi_operatingsystems`.`name` LIKE '%CentOS%' ) and  `glpi_computers`.`id` = '".$compid[$x]."' and  `glpi_infocoms`.`decommission_date` >= date ('".$from."') and `glpi_infocoms`.`decommission_date` <= date ('".$to."')";
//$result = $conn->query($sql);
//if ($result->num_rows > 0) {
//    $server_decom = $result->num_rows;
//  
//    while($row = $result->fetch_assoc()) {
//        echo "Server ".$x." : ".$row["desktop"]."--".$row["states_id"]."--". $row["decommission_date"]."<br>";
//            
// $server .= $row['desktop'].",".$row['serial'].",".$row['username'].",".$row['name'].",".$row['cat'].",".date('Y-m-d',  strtotime($row["decommission_date"]))."\n";
//    }
//}
// 
//    
//   $sql = "SELECT `glpi_computers`.`name` as desktop,`glpi_computers`.`states_id`,`glpi_computers`.`serial`,`glpi_computers`.`contact` as username, `glpi_operatingsystems`.`name`,`glpi_computertypes`.`name` as cat, `glpi_infocoms`.`decommission_date`
//FROM `glpi_computers`
//                LEFT JOIN `glpi_items_operatingsystems`
//                           ON (`glpi_items_operatingsystems`.`items_id`=`glpi_computers`.`id`)
//LEFT JOIN `glpi_operatingsystems`
//                           ON (`glpi_items_operatingsystems`.`operatingsystems_id`=`glpi_operatingsystems`.`id`)
//LEFT JOIN `glpi_computertypes`
//                           ON (`glpi_computertypes`.`id`=`glpi_computers`.`computertypes_id`)
//LEFT JOIN `glpi_states`
//                           ON (`glpi_states`.`id`=`glpi_computers`.`states_id`)
//LEFT JOIN `glpi_infocoms`
//                           ON (`glpi_infocoms`.`items_id`=`glpi_computers`.`id`)
//where  `glpi_computers`.`is_deleted` = 1 and  `glpi_computers`.`states_id` = 2 and `glpi_operatingsystems`.`name` LIKE '%Windows 7%'
// and (`glpi_computertypes`.`name` LIKE '%desktop%' or `glpi_computertypes`.`name` LIKE '%tower%'or `glpi_computertypes`.`name` LIKE '%Space-saving%') and `glpi_computers`.`id` ='".$compid[$x]."' and  `glpi_infocoms`.`decommission_date` >= date ('".$from."') and `glpi_infocoms`.`decommission_date` <= date ('".$to."')";
//$result = $conn->query($sql);
//if ($result->num_rows > 0) {
//    while($row = $result->fetch_assoc()) {
////        echo "Desktop ".$x." : ".$row["desktop"]."--".$row["states_id"]."--". $row["decommission_date"]."<br>";
//    }
//} 
//   
//        
//   $sql = "  SELECT `glpi_computers`.`name` as desktop,`glpi_computers`.`is_deleted` as deleted,`glpi_computers`.`serial`,`glpi_computers`.`contact` as username, `glpi_operatingsystems`.`name`,`glpi_computertypes`.`name` as cat,`glpi_infocoms`.`decommission_date`
//FROM `glpi_computers`
//                LEFT JOIN `glpi_items_operatingsystems`
//                           ON (`glpi_items_operatingsystems`.`items_id`=`glpi_computers`.`id`)
//LEFT JOIN `glpi_operatingsystems`
//                           ON (`glpi_items_operatingsystems`.`operatingsystems_id`=`glpi_operatingsystems`.`id`)
//LEFT JOIN `glpi_computertypes`
//                           ON (`glpi_computertypes`.`id`=`glpi_computers`.`computertypes_id`)
//LEFT JOIN `glpi_infocoms`
//                           ON (`glpi_infocoms`.`items_id`=`glpi_computers`.`id`)
//where  `glpi_computers`.`is_deleted` = 1 and  `glpi_computers`.`states_id` = 2 and `glpi_operatingsystems`.`name` LIKE '%Windows 7%' 
//and (`glpi_computertypes`.`name` LIKE '%notebook%' or `glpi_computertypes`.`name` LIKE '%laptop%' ) and `glpi_computers`.`id` = '".$compid[$x]."' and  `glpi_infocoms`.`decommission_date` >= date ('".$from."') and `glpi_infocoms`.`decommission_date` <= date ('".$to."')";
//$result = $conn->query($sql);
//if ($result->num_rows > 0) {
//    while($row = $result->fetch_assoc()) {
//        echo "Laptop ".$x." : ".$row["desktop"]."--".$row["states_id"]."--". $row["decommission_date"]."<br>";
//    }
//}
//    
//}
// 
//
////printer
//
////for ($x=0; $x<$ttlprinter; $x++)
////{
////    $sql = "SELECT `glpi_printers`.*,`glpi_infocoms`.`decommission_date`
////FROM `glpi_printers`
////LEFT JOIN `glpi_infocoms`
////                           ON (`glpi_infocoms`.`items_id`=`glpi_printers`.`id`)
////where `glpi_printers`.`is_deleted` = 1 and `glpi_printers`.`states_id` = 2 and `glpi_printers`.`id` = '".$printerid[$x]."' and  `glpi_infocoms`.`decommission_date` >= date ('".$from."') and `glpi_infocoms`.`decommission_date` <= date ('".$to."')";
////    $result = $conn->query($sql);
////if ($result->num_rows > 0) {
////    while($row = $result->fetch_assoc()) {
////        echo "Printer ".$x." : ".$row["name"]."--".$row["states_id"]."--". $row["decommission_date"]."<br>";
////    }
////}
////    
////}
//
////network
//
////for ($x=0; $x<$ttlnet; $x++)
////{
////    $sql = "SELECT `glpi_networkequipments`.`name` as network,`glpi_networkequipments`.`states_id   `,`glpi_networkequipments`.`serial`, `glpi_networkequipmentmodels`.`name` AS model, `glpi_manufacturers`.`name` AS manufacture,`glpi_infocoms`.`decommission_date`
////FROM `glpi_networkequipments`
////                LEFT JOIN `glpi_networkequipmentmodels`
////                           ON (`glpi_networkequipmentmodels`.`id`=`glpi_networkequipments`.`id`)
////        LEFT JOIN `glpi_manufacturers`
////                           ON (`glpi_manufacturers`.`id`=`glpi_networkequipments`.`manufacturers_id`)
////
////LEFT JOIN `glpi_infocoms`
////                           ON (`glpi_infocoms`.`items_id`=`glpi_networkequipments`.`id`)
////where  `glpi_networkequipments`.`is_deleted` = 1 and `glpi_networkequipments`.`states_id` = 3 and `glpi_networkequipments`.`id` =  '".$netid[$x]."' and  `glpi_infocoms`.`decommission_date` >= date ('".$from."') and `glpi_infocoms`.`decommission_date` <= date ('".$to."')";
////    $result = $conn->query($sql);
////if ($result->num_rows > 0) {
////    while($row = $result->fetch_assoc()) {
////        echo "Network ".$x." : ".$row["network"]."--".$row["states_id"]."--". $row["decommission_date"]."<br>";
////    }
////}
////    
////}
//
// $csv_handler = fopen ('net_decoms.csv','w');
//fwrite ($csv_handler,$server);
//fclose ($csv_handler); 
//echo "<br><br>";
//print_r ($server);
//echo "<br><br>";
$conn->close(); 

?>