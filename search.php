<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>ShForum - Disscuss Coding </title>
    <style>
    .container {
        min-height: 82vh;
        width: 750px;
    }
    </style>
</head>

<body>
    <?php  include 'includes/_dbconnect.php' ?>
    <?php  include 'includes/_header.php' ?>


    <div class="container my-3 ">
        <h4 class="py-2 text-primary">Search Results for "<?php echo $_GET['search'] ?>" </h4 class="py-2">
        <?php 
    
            $query = $_GET["search"];
            $noresults = true;
            $sql = "select * from threads where match (thread_title, thread_desc) against ('$query')"; 
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc($result)){
            $title = $row['thread_title'];
            $desc = $row['thread_desc'];
            $thread_id = $row['thread_id'];
            $url = "thread.php?threadid=". $thread_id;
            $noresults = false;

            
            // Displaying the search result 
            echo '  <div class="result my-3">
                    <h3><a href="'.$url.'" class="text-dark" style="text-decoration: none;">'. $title.' </a></h3>

                    <p> '. $desc .'</p>

                </div>';

        }
        if ($noresults) {
            echo '<div class=" my-4">
            <div class="card-body" style="background:#cccfcd;">
            <h6 class="display-4">No results found</h6>
            <p> <li>Try fewer keywords. </li>
            <li>Try different keywords. </li>
            <li>Try more general keywords. </li>
            <li>Make sure that all words are spelled correctly. </li> </p>
            </div>
          </div>';
        }
    
    ?>

    </div>


    <?php  include 'includes/_footer.php' ?>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>