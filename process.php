<?php
// uploading paf file
if (isset($_POST['btnSubmit'])) {
include "database.php";
  $img_name = $_FILES['uploadImage']['name'];
  $img_size = $_FILES['uploadImage']['size'];
  $tmp_name = $_FILES['uploadImage']['tmp_name']; //tmp location where file is saved
  $error = $_FILES['uploadImage']['error'];

  $data = []; //data to be put into db
 
  // insert the uploaded file into the PAFs folder if there is no error
  if ($error == 0) {
      $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
      $img_uploads_path = "PAFs/".$img_name;
      $filename = pathinfo($img_uploads_path);
      if (move_uploaded_file($tmp_name, $img_uploads_path)) {
                echo "";
              } else echo "";
      }
   else {
    echo "unknown error occured";
  }


  // erase the contents of the show info for new information about the uploaded file
    echo '<script type="text/javascript">
    document.getElementById("similarity").innerHTML = "";
    document.getElementById("nucleo").innerHTML = "";
    </script>';



  //minimap2 
  $paf_name = $img_name;
  $data[0] = "PAFs/" . $paf_name;
  
  //dotplotly
  $dotplotly_path = "dotPlotly/pafCoordsDotPlotly.R";
  $plot_name = pathinfo($paf_name)['filename'];
  $output_path = "dotplots/" . $plot_name;
  // echo $plot_name;
  $command_dotplot = "/usr/local/bin/Rscript " . $dotplotly_path . " -i PAFs/" . $paf_name . " -o " . $plot_name . " -m 6000 -q 500000 -k 10 -s -t -l -p 12";
  echo exec($command_dotplot);
  exec("mkdir " . $output_path);
  exec("mv " . $plot_name . "_files " . $output_path);
  exec("mv " . $plot_name . ".html " . $output_path);
  exec("mv " . $plot_name . ".png " . $output_path);
  exec("zip -r " . $output_path . "/" . $plot_name . ".zip " . $output_path);
  exec("rm -r " . $plot_name . "_files");
  $data[1] = $output_path . "/" . $plot_name . ".html";
  $data[2] = $output_path . "/" . $plot_name . ".png";
  $data[3] = $output_path . "/" . $plot_name . ".zip";

  //insert into db
  $sql = "INSERT INTO aligns(file_1, file_2, paf, result, PNG, ZIP, mummer) VALUES('', '', '$data[0]', '$data[1]', '$data[2]', '$data[3]', '')";
  if (mysqli_query($conn, $sql)) {
    echo "";
  } else echo "fail";


  // show info:
  $myfile = fopen("".$data[0]."", "r") or die("Unable to open file!");
  $arr = array();
  $arr_new = array();

  while (!feof($myfile)) {
      array_push($arr, fgets($myfile));
  }

  for ($i = 0; $i < count($arr); $i++) {
      $arr_new[$i] = preg_split('/\s+/', $arr[$i]);;

  }   
  $query_name = $arr_new[0][0];
  $query_seq_len = $arr_new[0][1];
  
 // print info about the uploaded file
  echo '<script type="text/javascript">
      document.getElementById("similarity").innerHTML += "Query sequence name: ";
      document.getElementById("similarity").innerHTML += "'.$query_name.'";
     document.getElementById("similarity").innerHTML += "<br>";
    document.getElementById("similarity").innerHTML += "Query sequence length: ";
    document.getElementById("similarity").innerHTML += '.$query_seq_len.';
  </script>';
  $target_name = $arr_new[0][5];
$target_seq_len = $arr_new[0][6];
echo '<script>
  document.getElementById("nucleo").innerHTML += "Target sequence name: ";
  document.getElementById("nucleo").innerHTML += "'.$target_name.'";
  document.getElementById("nucleo").innerHTML += "<br>";
  document.getElementById("nucleo").innerHTML += "Target sequence length: ";
  document.getElementById("nucleo").innerHTML += '.$target_seq_len.';
  </script>';
    
 fclose($myfile);


  $result = $sqla->query($sql) or exit("Error code ({$sqla->errno}): {$sqla->error}");
       
}
?>