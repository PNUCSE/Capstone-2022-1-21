<?php

include("database.php");
$db=$conn;
// fetch query
function fetch_data(){
 global $db;
  $query="SELECT * from aligns ORDER BY id DESC LIMIT 1";
  $exec=mysqli_query($db, $query);
  if(mysqli_num_rows($exec)>0){
    $row= mysqli_fetch_all($exec, MYSQLI_ASSOC);
    return $row;  
        
  }else{
    return $row=[];
  }
}
$fetchData= fetch_data();
show_data($fetchData);

function show_data($fetchData){
 if(count($fetchData)>0){
      $sn=1;
      foreach($fetchData as $data){    
  $sn++; 
 echo '<iframe src="' . $data['result'] . '" height="95%" width="100%"></iframe>';

     }
}else{
  echo "<tr>
        <td colspan='7'>No Data Found</td>
       </tr>"; 
}
  echo "</table>";
}

?>