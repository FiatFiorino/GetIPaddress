<?php

//this collects the IP address from your website visitor
function getUserIpAddr(){
            if(!empty($_SERVER['HTTP_CLIENT_IP'])){
                //ip from share internet
                $ip = $_SERVER['HTTP_CLIENT_IP'];
            }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
                //ip pass from proxy
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            }else{
                $ip = $_SERVER['REMOTE_ADDR'];
            }
            return $ip;
        }
        
//this starts the output buffer, collects the IP address and then coverts it into a php variable before empting the buffer
      ob_start(); 
        echo ''.getUserIpAddr();
        $IP_Address = ob_get_contents(); 
      ob_end_clean(); 

//MySQL Login
    $servername = " *server IP* ";
    $username = " *user* ";
    $password = " *Server Password* ";
    $dbname = " *Database Name* ";

// Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
// The key line of code that populates the MySQL database
$sql = "INSERT INTO *TableName* (IPdeliveryAddress )
VALUES ('" . $IP_Address . "' )";

if ($conn->query($sql) === TRUE) {
    echo " ";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
}

?>
