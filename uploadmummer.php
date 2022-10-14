<?php
// uploading mummer file
if (isset($_POST['btnSubmitMummer'])) {
include "database.php";
  $img_name = $_FILES['mummerfile']['name'];
   $without_ext = basename($img_name, ".mums");
  $img_size = $_FILES['mummerfile']['size'];
  $tmp_name = $_FILES['mummerfile']['tmp_name']; //tmp location where file is saved
  $error = $_FILES['mummerfile']['error'];

  $data = []; //data to be put into db

  if ($error == 0) {
      $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
      $mummer_uploads_path = "MUMMERs/".$img_name;
      $filename = pathinfo($img_uploads_path);
      move_uploaded_file($tmp_name, $mummer_uploads_path);
      }
   else {
    echo "unknown error occured";
  }

    // erase the contents of the show info for information of the uploaded file   
    echo '<script type="text/javascript">
    document.getElementById("similarity").innerHTML = "";
    document.getElementById("nucleo").innerHTML = "";
    </script>';


    // mummer
    $mummerplot_path = "/Users/gulnazkaztayeva/Documents/MUMmer3.23/mummerplot";
    $command_mummer = $mummerplot_path . " --postscript --prefix=" .$without_ext. " "
    . $mummer_uploads_path;
   
   
    echo exec($command_mummer);
    $gnuplot_command = "/opt/homebrew/bin/gnuplot ".$without_ext.".gp";
    echo exec($gnuplot_command);
    // convert the postscript format plot into the png file
    $convert_command = "/opt/homebrew/bin/convert ".$without_ext.".ps ".$without_ext.".png";
    echo exec($convert_command);

    $graph = $without_ext.".png";
    exec("mkdir dotplots/".$without_ext);
    exec("mv " . $without_ext . ".gp dotplots/".$without_ext);
    exec("mv " . $without_ext . ".ps dotplots/".$without_ext);
    exec("mv " . $without_ext . ".png dotplots/".$without_ext);
    exec("mv " . $without_ext . ".fplot dotplots/".$without_ext);
    exec("mv " . $without_ext . ".rplot dotplots/".$without_ext);
    $result = "dotplots/".$without_ext."/".$without_ext.".png";
    exec("zip -r " . "dotplots/" . $without_ext . "/" . $without_ext . ".zip " . "dotplots/" . $without_ext);
    exec("rm -r " . $plot_name . "_files");
    $zip = "dotplots/" . $without_ext . "/" . $without_ext . ".zip";
    //insert into db
    $sql = "INSERT INTO aligns(file_1, file_2, paf, result, PNG, ZIP, mummer) VALUES('', '', '', '$result', '$result', '$zip', '$mummer_uploads_path')";
    if (mysqli_query($conn, $sql)) {
      echo "";
    } else echo "fail";

  // show info
  $myfile = fopen("".$mummer_uploads_path."", "r") or die("Unable to open file!");
  $arr = array();
  $arr_new = array();

  while (!feof($myfile)) {
      array_push($arr, fgets($myfile));
  }

  $max = 0;
  for ($i = 0; $i < count($arr); $i++) {
      $arr_new[$i] = preg_split('/\s+/', $arr[$i]);
      if($arr_new[$i][3] > $max)
          $max = $arr_new[$i][3];
  }   
  $query_name = $arr_new[0][1];
  
  $rev_line = exec("grep -n 'Reverse' ".$mummer_uploads_path." | head -n 1 | cut -d: -f1");

  $num_rev = count($arr) - $rev_line;
  // show information about the file: 
   echo '<script type="text/javascript">
     document.getElementById("similarity").innerHTML = "Query sequence name: ";
  document.getElementById("similarity").innerHTML += "'.$query_name.'";
     document.getElementById("similarity").innerHTML += "<br>";
    document.getElementById("similarity").innerHTML += "Maximum sequence length: ";
    document.getElementById("similarity").innerHTML += '.$max.';
     document.getElementById("similarity").innerHTML += "<br>";
    document.getElementById("similarity").innerHTML += "Number of reverse sequences: ";
    document.getElementById("similarity").innerHTML += '.$num_rev.';
  </script>';

  fclose($myfile);
 
 
  $result = $sqla->query($sql) or exit("Error code ({$sqla->errno}): {$sqla->error}");
  
        exit();
}
?>





