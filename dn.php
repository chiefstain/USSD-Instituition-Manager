<?php
include ("database.php");
// Reads the variables sent via POST from our gateway
$sessionId   = $_POST["sessionId"];
$serviceCode = $_POST["serviceCode"];
$phoneNumber = $_POST["phoneNumber"];
$text        = $_POST["text"];

if ($text == "") {
    // This is the first request. Note how we start the response with CON
	$response = "CON ";
    $query = "SELECT last_name FROM students where tel_no =".$phoneNumber;
    $res= mysqli_query($con,$query);
    while($row = $res->fetch_assoc()){
    	$response .= 'Hey, '.$row['last_name'].". \n";
    }

    $response .= "Welcome to MMARAU Instituition Manager. \n";
    $response .= "1. Fees Ballance \n";
    $response .= "2. Hostel Status \n";
    $response .= "3. Exam Status \n";
    $response .= "4. Report Session \n";
    $response .= "5. Unit Registration \n";
    $response .= "6. Book Hostel \n";

} else if ($text == "1") {
   

     $query = "SELECT last_name, first_name, fee_ball, reg_no FROM students where tel_no =".$phoneNumber;

    $res= mysqli_query($con,$query);
    while($row = $res->fetch_assoc()){
    	$response = 'CON '. $row['first_name'].' '.$row['last_name']." \n";
    	$response .= 'Reg No. '.$row['reg_no']." \n";
    	$response .= 'Fee Ballance. '.$row['fee_ball']." \n";
    	$response .= "------------------------------\n";
	   
	    $response .= "2. Hostel Status \n";
	    $response .= "3. Exam Status ";
    }

} 

else if ( $text == "1*2" ) {
   $query = "SELECT last_name, first_name, residence_status, reg_no FROM students where tel_no =".$phoneNumber;
	$res= mysqli_query($con,$query);
    while($row = $res->fetch_assoc()){
    	$response = 'END '. $row['first_name'].' '.$row['last_name']." \n";
    	$response .= 'Reg No. '.$row['reg_no']." \n";
    	$response .= 'Room. '.$row['residence_status']." \n";
    	$response .= "------------------------------\n";
    	}
}

else if($text == "1*3") { 
    $query = "SELECT r.unit_code, r.grade FROM results r LEFT JOIN students s ON r.tel_no = s.tel_no where r.tel_no =".$phoneNumber;
	$res= mysqli_query($con,$query);
	$response = 'END ';
    while($row = $res->fetch_assoc()){
    	$response .= $row['unit_code'].' '.$row['grade']." \n";
    	// $response = 'END '.$row['unit_code'].' '.$row['grade']." \n";
    	
    
    	
}
	
} 

else if ($text == "2") {
   
	$query = "SELECT last_name, first_name, residence_status, reg_no FROM students where tel_no =".$phoneNumber;
	$res= mysqli_query($con,$query);
    while($row = $res->fetch_assoc()){
    	$response = 'CON '. $row['first_name'].' '.$row['last_name']." \n";
    	$response .= 'Reg No. '.$row['reg_no']." \n";
    	$response .= 'Room. '.$row['residence_status']." \n";
    	$response .= "------------------------------\n";
    	$response .= "2. Fee Ballance \n";
	    $response .= "3. Exam Status ";

}
} 

else if ($text == "2*2") {
   
     $query = "SELECT last_name, first_name, fee_ball, reg_no FROM students where tel_no =".$phoneNumber;

    $res= mysqli_query($con,$query);
    while($row = $res->fetch_assoc()){
    	$response = 'CON '. $row['first_name'].' '.$row['last_name']." \n";
    	$response .= 'Reg No. '.$row['reg_no']." \n";
    	$response .= 'Fee Ballance. '.$row['fee_ball']." \n";
    	$response .= "------------------------------\n";
	   $response .= "3. Exam Status ";
    }

}

else if($text == "2*3") { 

	$query = "SELECT r.unit_code, r.grade FROM results r LEFT JOIN students s ON r.tel_no = s.tel_no where r.tel_no =".$phoneNumber;
	$res= mysqli_query($con,$query);
	$response = 'END ';
    while($row = $res->fetch_assoc()){
    	$response .= $row['unit_code'].' '.$row['grade']." \n";
    	
    
    	
}
	// $response .= " ";
} 

else if($text == "3") { 

	$query = "SELECT r.unit_code, r.grade FROM results r LEFT JOIN students s ON r.tel_no = s.tel_no where r.tel_no =".$phoneNumber;
	$res= mysqli_query($con,$query);
	$response = 'END ';
    while($row = $res->fetch_assoc()){
    	$response .= $row['unit_code'].' '.$row['grade']." \n";
    	// $response = 'END '.$row['unit_code'].' '.$row['grade']." \n";
    	
    
    	
}
	// $response .= " ";
} 
 else if ($text == "4") {

    // Business logic for first level response
    $response = "CON ";
    $query = "SELECT last_name, first_name FROM students where tel_no =".$phoneNumber;
    $res= mysqli_query($con,$query);
    while($row = $res->fetch_assoc()){
    	$response .= $row['last_name'].' '.$row['first_name']." \n";
    }

    $response .= "Report for Session. \n";
    $response .= "1.Yes \n";
    $response .= "2. No";
}
   
if ($text == "4*1") {
    // This is the first request. Note how we start the response with CON
	$response = "END ";

    $query = "SELECT report_session FROM students where tel_no =".$phoneNumber;
    $res= mysqli_query($con,$query);
     while($row = $res->fetch_assoc()){
    	$report_session= $row['report_session'];
    
}


if ($report_session==1) {
	$query = "SELECT last_name, first_name FROM students where tel_no =".$phoneNumber;
      $res= mysqli_query($con,$query);    
     while($row = $res->fetch_assoc()){
$response .= 'Sorry, '.$row['first_name'].".You have already reported";

	# code...
}}
else{


	$query = "UPDATE students SET report_session=1 WHERE tel_no=".$phoneNumber;
	// $query = "SELECT last_name, first_name FROM students where tel_no =".$phoneNumber;

    
    $res= mysqli_query($con,$query);
    
    if ($res) {
     $query = "SELECT last_name, first_name FROM students where tel_no =".$phoneNumber;
      $res= mysqli_query($con,$query);    
     while($row = $res->fetch_assoc()){
    	$response .= 'Congratulations, '.$row['first_name'].".You have succesfully reported for session";
     
}}

}}
if ($text == "5") {


            $response = "CON ";
    // $query = "SELECT p.course_name from program p LEFT JOIN units u ON p.prog_id = u.prog_id "
   $query = "SELECT u.unit_code FROM units u LEFT JOIN students s ON u.prog_id = s.prog_id AND u.year=s.year_of_study where s.tel_no =".$phoneNumber;
    // $query = "SELECT unit_code FROM units where prog_id ="prog_id" AND year="year_of_study" ;
    $res= mysqli_query($con,$query);
    while($row = $res->fetch_assoc()){
       
     // $response .= 'Congratulations, '.$row['p.course_name'].".You have succesfully reported for session";   
        $response .= $row["unit_code"]."\n";
    }
    $response .= "-------------------\n";
    $response .= "1.Yes \n";
    $response .= "2. No";
  
}
  
if ($text == "5*1") {
    // This is the first request. Note how we start the response with CON
    $response = "END ";


    $query = "SELECT unit_reg FROM students where tel_no =".$phoneNumber;
    $res= mysqli_query($con,$query);
     while($row = $res->fetch_assoc()){
        $unit_reg= $row['unit_reg'];
    
}


if ($unit_reg==1) {
    $query = "SELECT last_name, first_name FROM students where tel_no =".$phoneNumber;
      $res= mysqli_query($con,$query);    
     while($row = $res->fetch_assoc()){
$response .= 'Sorry, '.$row['first_name'].".You have already registered";

    # code...
}}
else{


    $query = "UPDATE students SET unit_reg=1 WHERE tel_no=".$phoneNumber;
    // $query = "SELECT last_name, first_name FROM students where tel_no =".$phoneNumber;

    
    $res= mysqli_query($con,$query);
    
    if ($res) {
     $query = "SELECT last_name, first_name FROM students where tel_no =".$phoneNumber;
      $res= mysqli_query($con,$query);    
     while($row = $res->fetch_assoc()){
        $response .= 'Congratulations, '.$row['first_name'].".You have succesfully registered";
     
}}

}}
if ($text == "6") {
      $response = "CON ";
    
   $query = "SELECT h.hostel_name FROM hostel h LEFT JOIN students s ON h.gender = s.gender where s.tel_no =".$phoneNumber;
   $res= mysqli_query($con,$query);
   $i = 1.;
    while($row = $res->fetch_assoc()){
      
        $response .= $i.' '.$row["hostel_name"]."\n";
 $i++;
}}
// Echo the response back to the API
header('Content-type: text/plain');
echo $response;