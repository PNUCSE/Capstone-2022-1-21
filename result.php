<?php

?>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="stylee.css">
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script>
    $(document).ready(function(){
      $(".accordion_header").click(function(){
         $(".accordion_header").removeClass("active");
         $(this).addClass("active");
      });
    });
  </script>
</head>
<body>

<div class="wrapper">
  <div class="accordion_wrap accordion_1">
    <div class="accordion_header">
      Examples of input files
    </div>
    <div class="accordion_body">
      <div class="pics">
      <a href='download.php?path=./FASTAs/H_pylori26695_Eslice.fasta'><img src="img/fasta.png"></a>
    <a href='download.php?path=./PAFs/Brapa_Bnapus.minimap2.paf'><img src="img/paf.png"></a>
    <a href='download.php?path=./MUMMERs/mummer.mums'><img src="img/mummer.png"></a>
  </div>
    </div>
  </div>
  <div class="accordion_wrap accordion_2">
    <div class="accordion_header">
      Gallery
    </div>
    <div class="accordion_body_2">
       <iframe id='gallery' src='gallery.php' frameBorder='0' width = '100%' height = '500px' overflow='scroll'></iframe>
    </div>
  </div>
  <div class="accordion_wrap accordion_3">
    <div class="accordion_header">
      Video tutorial
    </div>
    <div class="accordion_body">
      <p>YouTube video is here</p>
    </div>
  </div>
</div>  

</body>
</html>
