<?php
           $servername = "YOUR_SERVER_NAME"; //add your Atributes
          $username = "YOUR_USER_NAME";
          $password = "YOUR_PASSWORD_NAME";
          $dbname = "YOUR_DB_NAME"; 
          $connect = new mysqli($servername, $username, $password, $dbname); //Connect PHP to MySQL Database
            if ($connect->connect_error) {
                die("Connection failed: " . $connect->connect_error);
                                        } 
          $query = ''; // 0 QUERY
          $filename = "EXAMPLE_JSON.json"; //PATH TO YOUR JSON YOU CAN MODIFY IT TO EX. SELECT JSON FROM SERVER FORM ETC..
          $data = file_get_contents($filename); //READ JSON
          $array = json_decode($data, true); //CONVERT JSON 
          foreach($array as $row) //ADD ARRAYS BY FOREACH LOOP
          {
          //////CHANGE "TABLE_NAME" TO YOUR "TABLE"////
           $query .= "INSERT INTO TABLE_NAME(data_campaign_id, data_amount, data_currency, data_status, data_created_at, data_updated_at) 
           VALUES ('".$row["campaign_id"]."', '".$row["amount"]."', '".$row["currency"]."', '".$row["status"]."',
           '".$row["created_at"]."', '".$row["updated_at"]."'); "; 
          } /////// CHECK EXAMPLE_JSON.json TO SEE OUR JSON SCHEMA !
          
          // NOW REMOVE DUPLICATES WITHOUT LOOP, CHANGE "TABLE_NAME" TO YOUR "TABLE" || CHANGE "ID_ID" TO YOUR SORTING ATRIBUTE //
        $query .="CREATE TABLE TABLE_NAME_temp LIKE TABLE_NAME;";
            $query .="INSERT INTO TABLE_NAME_temp SELECT * FROM TABLE_NAME GROUP BY ID_ID;";
            $query .="DROP TABLE TABLE_NAME;";
            $query .="ALTER TABLE TABLE_NAME_temp RENAME TO TABLE_NAME;";
            
           if(mysqli_multi_query($connect, $query)) //RUN MULTIPLE QUERY 
    {
     echo '<h3>ADD VALUES</h3><br />';
     echo '<h3>DUPLICATES REMOVED</h3><br />'
             
          }  
            
            ?>
