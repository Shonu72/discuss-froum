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
        $id = $_GET['threadid'];
        $sql = "SELECT * FROM `threads` WHERE thread_id=$id";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)){
            $title = $row['thread_title'];
            $desc = $row['thread_desc'];
            $thread_user_id = $row['thread_user_id'];
        // Query the users table to find out the name of OP
        $sql2 = "SELECT user_email FROM `users` WHERE sno='$thread_user_id'";
        $result2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($result2);
        $posted_by = $row2['user_email'];
        }
    ?>

    <?php
        $showAlert = false;
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == 'POST') {
            // Insert into comment db 
            $comment = $_POST['comment'];

            $comment = str_replace("<", "&lt;", $comment);
            $comment = str_replace(">", "&gt;", $comment);

            $sno = $_POST['sno'];
            $sql = "INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_by`, `comment_time`) VALUES ('$comment', '$id', '$sno', current_timestamp());";
            $result = mysqli_query($conn, $sql);
            $showAlert = true;
            if ($showAlert) {
               echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
               <strong>Success!</strong> Your comment has been added.
               <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
             </div>';
            }
        }

    ?>

    <!-- Category container starts here  -->
    <div class="container my-3">

        <div class="container-fluid bg-success  rounded w-75">
            <div class="container bg-dark p-3 rounded ">
                <h3 class=" display-6 text-light"> <?php echo $title;?> </h3>
                <p class="text-light"><?php echo $desc;?> </p>
                <hr class=" text-secondary">
                <h6 class=" text-secondary">Posted by: <?php echo $posted_by ?> </h6>
            </div>
        </div>

        <?php 
            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        echo '<div class="container my-3 w-75">
            <h2 class="py-2">Post a Comment</h2>
            <form action="'. $_SERVER['REQUEST_URI'] .'" method="post">
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Type your comment</label>
                    <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                    <input type = "hidden" name="sno" value='. $_SESSION['sno'].' >
                </div>
               <button type="submit" class="btn btn-outline-success">Post Comment</button>
            </form>
        </div>';
    }else{
        echo ' <div class="container my-3 w-75">
        <h2 class="py-2">Post a Comment</h2>
        <h6 >You are not logged in ! Login first to comment.</h6>
    </div>';

    }
    ?>


        <div class="container mt-3 w-75 mb-5" style="min-height:445px;">
            <h2 class="py-2">Disscussions</h2>

            <?php
                    $id = $_GET['threadid'];
                    $sql = "SELECT * FROM `comments` WHERE thread_id=$id";
                    $result = mysqli_query($conn, $sql);
                    $noResult = true    ;
                    while($row = mysqli_fetch_assoc($result)){
                        $noResult = false;
                        $id = $row['comment_id'];
                        $content = $row['comment_content'];
                        $comment_time = $row['comment_time'];
                        $thread_user_id = $row['comment_by'];
                        $sql2 = "SELECT user_email FROM `users` WHERE sno='$thread_user_id'";
                        $result2 =mysqli_query($conn, $sql2);
                        $row2 = mysqli_fetch_assoc($result2);
                

            echo '<div class="d-flex border p-2">
            <img src="https://cdn.pixabay.com/photo/2016/11/18/23/38/child-1837375_960_720.png" alt="John Doe"
                class="flex-shrink-0 me-3 mt-3 my-3 rounded-circle" style="width:60px;height:60px;">
            <div>
            
            ' . $content . '
            <h6 class="my-4 text-secondary">Comment by: '. $row2['user_email'] .' <small>Posted on  '.$comment_time.'</small></h6>
            </div>
            </div>';
          }
          if ($noResult) {
            echo '<div class=" my-4">
            <div class="card-body text-center">
            <h3 class="display-4">No threads found</h3>
              Be the first person to comment on this thread .
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