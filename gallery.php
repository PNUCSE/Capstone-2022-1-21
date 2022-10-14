<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>Gallery</title>
    <link rel="stylesheet" href="gallery.css">
</head>
<body>
    <div id="container" class="container">
        <?php
            include("database.php");
            $db = $conn;
            $query="SELECT * from aligns";
            $exec=mysqli_query($db, $query);
            if(mysqli_num_rows($exec)>0) $row= mysqli_fetch_all($exec, MYSQLI_ASSOC);
            for ($i = 0; $i < count($row); $i++) {
                $file1 = pathinfo($row[$i]['file_1']);
                $file2 = pathinfo($row[$i]['file_2']);
                $paf_file = pathinfo($row[$i]['paf']);
                $mummer_file = pathinfo($row[$i]['mummer']);
                if(empty($row[$i]['file_1']) or empty($row[$i]['file_2'])) {
                    if (($row[$i]['paf'])) $align_name = $paf_file['filename'];
                    else if ($row[$i]['mummer']) $align_name = $mummer_file['filename'];
                } else {
                    $align_name = $file1['filename'] . " VS " . $file2['filename'];
                }
                if ($row[$i]['PNG'] && strlen($align_name) <= 40) {
                    echo "<div id='card-container'>";
                    // if(empty($row[$i]['file_1']) or empty($row[$i]['file_2']))
                    // {
                    //     echo "<p id='align-name'>" . $paf_file['filename'] ."</p>";
                    //     if(empty($row[$i]['paf']))
                    //         echo "<p id='align-name'>" . $mummer_file['filename'] ."</p>";
                    // }
                    // else
                    echo "<p id='align-name'>" . $align_name . "</p>";
                    echo "<a href=" . $row[$i]['result'] . "><div id='card' style='background-image:url(" . $row[$i]['PNG'] . ")'></div></a>";
                    echo "</div>";
                }
            }
        ?>
    </div>
</body>
</html>