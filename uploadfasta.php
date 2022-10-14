<?php
// uploading fasta file

if (isset($_POST['btnSubmitfasta'])) {
include "database.php";
  $img_name = array($_FILES['file1']['name'], $_FILES['file2']['name']);
  $img_size = array($_FILES['file1']['size'], $_FILES['file2']['size']);
  $tmp_name = array($_FILES['file1']['tmp_name'], $_FILES['file2']['tmp_name']); //tmp location where file is saved
  $error = array($_FILES['file1']['error'], $_FILES['file2']['error']);

  $data = []; //data to be put into db
  
  // move the files into FASTAs folder if there is no error
  if ($error[0] == 0 && $error[1] == 0) {
    for ($i = 0; $i < 2; $i++) {
      $img_ex = pathinfo($img_name[$i], PATHINFO_EXTENSION);
      $new_img_name = uniqid("FASTA-", true).'.'.strtolower($img_ex);
      $img_uploads_path = "FASTAs/".$img_name[$i];
      $filenames[$i] = pathinfo($img_uploads_path);
      move_uploaded_file($tmp_name[$i], $img_uploads_path);
      $data[$i] = $img_uploads_path;
    }
  } else {
    echo "unknown error occured";
  }

  // erase the show info content for new information about the uploaded file
  echo '<script type="text/javascript">
    document.getElementById("similarity").innerHTML = "";
    document.getElementById("nucleo").innerHTML = "";
    </script>';


  //minimap2  -->  creation of PAF file from two fasta files
  // print_r($filenames);
  $out = array();
  $minimap2_path = "/opt/homebrew/Cellar/minimap2/2.24/bin/minimap2";
  $paf_name = $img_name[0]. "_" .$img_name[1]. ".minimap2.paf";
  $command_paf = $minimap2_path . " -x asm5 FASTAs/" . $filenames[0]['basename'] . " FASTAs/" . $filenames[1]['basename'] . " > PAFs/" . $paf_name;

  echo exec($command_paf);
  $data[2] = "PAFs/" . $paf_name;
  
  // dotplotly --> drawing dot plot graph and move the results into the dotplots folder
  $dotplotly_path = "dotPlotly/pafCoordsDotPlotly.R";
  $plot_name = pathinfo($paf_name)['filename'];
  $output_path = "dotplots/" . $plot_name;
  
  $command_dotplot = "/usr/local/bin/Rscript " . $dotplotly_path . " -i PAFs/" . $paf_name . " -o " . $plot_name . " -m 6000 -q 200000 -k 10 -s -t -l -p 12";
  echo exec($command_dotplot);
  exec("mkdir " . $output_path);
  exec("mv " . $plot_name . "_files " . $output_path);
  exec("mv " . $plot_name . ".html " . $output_path);
  exec("mv " . $plot_name . ".png " . $output_path);
  exec("cp PAFs/" . $paf_name . " " .$output_path);
  exec("zip -r " . $output_path . "/" . $plot_name . ".zip " . $output_path);
  exec("rm -r " . $plot_name . "_files");
  $data[3] = $output_path . "/" . $plot_name . ".html";
  $data[4] = $output_path . "/" . $plot_name . ".png";
  $data[5] = $output_path . "/" . $plot_name . ".zip";
  $sql = "INSERT INTO aligns(file_1, file_2, paf, result, PNG, zip, mummer) VALUES('$data[0]', '$data[1]', '$data[2]', '$data[3]', '$data[4]', '$data[5]', '')";
  if (mysqli_query($conn, $sql)) {
    echo "";
  } else echo "fail";

  $file_1_path = $filenames[0]['dirname']."/".$filenames[0]['basename'];
  $file_2_path = $filenames[1]['dirname']."/".$filenames[1]['basename'];
    // count nucleotides in the query and target sequences
    $countA = 0;
    $countT = 0;
    $countG = 0;
    $countC = 0;
    $fh = fopen($file_1_path, 'r');
    while(!feof($fh)){
        $fr = fread($fh, 8192);
        $countA += substr_count($fr, 'A');
        $countT += substr_count($fr, 'T');
        $countG += substr_count($fr, 'G');
        $countC += substr_count($fr, 'C');
    }
    fclose($fh);



    $countA2 = 0;
    $countT2 = 0;
    $countG2 = 0;
    $countC2 = 0;
    $fh2 = fopen($file_2_path, 'r');
    while(!feof($fh2)){
        $fr2 = fread($fh2, 8192);
        $countA2 += substr_count($fr2, 'A');
        $countT2 += substr_count($fr2, 'T');
        $countG2 += substr_count($fr2, 'G');
        $countC2 += substr_count($fr2, 'C');
    }
    fclose($fh2);

    

    // show the counting result in the table
  echo 

'<script> document.getElementById("nucleo").innerHTML += `<table>
            <tr>
                <td></td>
                <th scope="col">File1</th>
                <th scope="col">File2</th>
              </tr>
            <tr>
            <th scope="row">Adenine</th>
            <td>'.$countA.'</td>
            <td>'.$countA2.'</td>
            </tr>
            <tr>
            <th scope="row">Thymine</th>
            <td>'.$countT.'</td>
            <td>'.$countT2.'</td>
            </tr>
            <tr>
            <th scope="row">Guanine</th>
            <td>'.$countG.'</td>
            <td>'.$countG2.'</td>
            </tr>
            <tr>
            <th scope="row">Cytosine</th>
            <td>'.$countC.'</td>
            <td>'.$countC2.'</td>
            </tr>
              
              
        </table>`;</script>';


  $myfile = fopen("".$file_1_path."", "r") or die("Unable to open file!");
  $myfile2 = fopen("".$file_2_path."", "r") or die("Unable to open file!");

  $arr = array();
  $arr2 = array();
  $num = 0;
  $num2 = 0;
  while (!feof($myfile)) {
      array_push($arr, fgets($myfile));
      
  }
  for ($i = 1; $i < count($arr); $i++) {
      $num += strlen($arr[$i]);
  }   

  while (!feof($myfile2)) {
      array_push($arr2, fgets($myfile2));
  }
   for ($i = 1; $i < count($arr2); $i++) {
      $num2 += strlen($arr2[$i]);
  }  
  $query_seq_len = $num;
  $target_seq_len = $num2;

  fclose($myfile);
  fclose($myfile2);
    echo '<script type="text/javascript">
    document.getElementById("similarity").innerHTML += "Query sequence length: ";
    document.getElementById("similarity").innerHTML += "'.$query_seq_len.'";
     document.getElementById("similarity").innerHTML += "<br>";
     document.getElementById("similarity").innerHTML += "Target sequence length: ";
    document.getElementById("similarity").innerHTML += "'.$target_seq_len.'";
    </script>';

    $result = $sqla->query($sql) or exit("Error code ({$sqla->errno}): {$sqla->error}");
       
}

?>

