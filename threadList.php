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
</head>

<body>
    <?php  include 'includes/_dbconnect.php' ?>
    <?php  include 'includes/_header.php' ?>
    <?php
        $id = $_GET['cat_id'];
        $sql = "SELECT * FROM `category` WHERE category_id=$id";
      
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)){
            $cat_name = $row['category_name'];
            $cat_desc = $row['category_desc'];
        }
    ?>

    <?php
        $showAlert = false;
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == 'POST') {
            // Insert into thread db 
            $th_title = $_POST['title'];
            $th_desc = $_POST['desc'];

            $th_title = str_replace("<", "&lt;", $th_title);
        $th_title = str_replace(">", "&gt;", $th_title); 

        $th_desc = str_replace("<", "&lt;", $th_desc);
        $th_desc = str_replace(">", "&gt;", $th_desc);

            $sno = $_POST['sno'];
            $sql = "INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES ('$th_title', '$th_desc', '$id', '$sno', current_timestamp()); ";
            $result = mysqli_query($conn, $sql);
            $showAlert = true;
            if ($showAlert) {   
               echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
               <strong>Success!</strong> Your thread has been added! Please wait fro community to respond.
               <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
             </div>';
            }
        }

    ?>

    <!-- Category container starts here  -->
    <div class="container my-3">

        <div class="container-fluid bg-success  rounded w-75">
            <div class="container bg-dark p-3 rounded ">
                <h1 class="display-6 text-light">Welcome to <?php echo $cat_name;?> Forum </h1>
                <p class="text-secondary"><?php echo $cat_desc;?> </p>
                <hr class="my-4 text-secondary">
                <p class="text-warning">This is peer to peer forum. No Spam / Advertising / Self-promote in the forums
                    not allwoed. Do not post “offensive” posts, links or images. Remain respectful of other members at
                    all times.</p>
                <a class="btn btn-outline-success" href="#" role="button">Learn more</a>
            </div>
        </div>


        <?php 
            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                echo ' <div class="container my-3 w-75">
                <h2 class="py-2">Start Disscussion</h2>
    
                <form action=" '. $_SERVER["REQUEST_URI"] .' " method="post">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Problems Title</label>
            <input type="text" class="form-control" id="title" name="title" aria-describedby="title">
            <div id="title" class="form-text">Keep your title as short crisp as possible</div>
        </div>
        <input type="hidden" name="sno" value="'. $_SESSION["sno"]. '">
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Elaborate your concern</label>
            <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
        </div>

        <button type="submit" class="btn btn-outline-success">Submit</button>
        </form>
    </div>';
    }else{
        echo ' <div class="container my-3 w-75">
        <h2 class="py-2">Start Disscussion</h2>
        <h6 >You are not logged in ! Login first to start discussion.</h6>
    </div>';
    }
    ?>

        <div class="container mt-3 w-75 mb-5" style="min-height:445px;">
            <h2 class="py-2">Browse Questions</h2>

            <?php
                    $id = $_GET['cat_id'];
                    $sql = "SELECT * FROM `threads` WHERE thread_cat_id=$id";
                    $result = mysqli_query($conn, $sql);
                    $noResult = true;
                    while($row = mysqli_fetch_assoc($result)){
                        $noResult = false;
                        $id = $row['thread_id'];
                        $title = $row['thread_title'];
                        $desc = $row['thread_desc']; 
                        $thread_time = $row['timestamp']; 
                        $thread_user_id = $row['thread_user_id']; 
                        $sql2 = "SELECT user_email FROM `users` WHERE sno='$thread_user_id'";
                        $result2 = mysqli_query($conn, $sql2);
                        $row2 = mysqli_fetch_assoc($result2);


            echo '<div class="d-flex border p-2">
            <img src="https://cdn.pixabay.com/photo/2016/11/18/23/38/child-1837375_960_720.png" alt="John Doe"
                class="flex-shrink-0 me-3 mt-3 rounded-circle" style="width:60px;height:60px;">
            <div>
            <h5><a href = "thread.php?threadid=' . $id . '"> ' . $title . '</a></h5>
            <p>' . $desc . '</p>
            <h6>Asked by: ' . $row2['user_email'] . ' <small> on  '.$thread_time.'</small></h6>
            </div>
            </div>';
          }

         if ($noResult) {
            echo '<div class=" my-4">
            <div class="card-body text-center">
            <h3 class="display-4">No threads found</h3>
              Be the first person to ask a question in this '.$cat_name.' forum.
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