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

<div class="wrappertool">
<div class="wrapper">
  <div class="accordion_wrap accordion_1">
    <div class="accordion_header">
      JavaScript
    </div>
    <div class="accordion_body">
      <p>JS is a lightweight, interpreted, or just-in-time compiled programming language with first-class functions. JavaScript allows developers to implement features like:
        <li>Showing and hiding menus or information</li>
        <li>Adding hover effects</li>
        <li>Creating image galleries</li>
        <li>Playing audio or video on a web page</li>
        <li>Creating drop down and hamburger-style menus</li>
      </p>
    </div>
  </div>
  <div class="accordion_wrap accordion_2">
    <div class="accordion_header">
      PHP/CSS
    </div>
    <div class="accordion_body">
      <p>CSS represents the style and the appearance of content like font, color, margin, padding, etc. PHP is used for server-side programming which will interact with databases to retrieve information, storing, email sending, and provides content to HTML pages to display on the screen.</p>
    </div>
  </div>
  <div class="accordion_wrap accordion_3">
    <div class="accordion_header">
      Minimap2
    </div>
    <div class="accordion_body">
      <p>Minimap2 is a fast sequence mapping and alignment program that can find overlaps between long noisy reads, or map long reads or their assemblies to a reference genome optionally with detailed alignment </p>
    </div>
  </div>
   <div class="accordion_wrap accordion_4">
    <div class="accordion_header">
      MUMMER
    </div>
    <div class="accordion_body">
      <p>Mummer is an algorithm that finds maximal exact matches of the minimum length between two input sequences. The output of mummer can be used to generate alignment dotplots, or can be passed on to the clustering algorithms for the identification of longer non-exact regions of conservation. </p>
    </div>
  </div>
   <div class="accordion_wrap accordion_5">
    <div class="accordion_header">
      Linux CentOS 8 server
    </div>
    <div class="accordion_body_5">
      <p>
      CentOS Server may be the better choice between the different operating systems because, it's more secure and stable than Ubuntu, due to the reserved nature and the lower frequency of its updates. Additionally, CentOS also provides support for cPanel which Ubuntu lacks. </p>
    </div>
  </div>
</div>  
</div>
</body>
</html>
