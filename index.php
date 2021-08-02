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

    <!-- Slider starts here  -->
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="img/slider2.jpg" style="width:800px; height:400px;" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="img/slider.jpg" style="width:800px; height:400px;" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="img/zeroday.jpg" style="width:800px; height:400px;" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <!-- Slider ends  -->

    <!-- Category container starts here  -->
    <div class="container my-4 ">
        <h2 class="text-center my-4"> ShForum - Browse Categories </h2>
        <div class="row my-4">

            <!-- use a for loop to iterate through categories and fetch category here -->

            <?php 
        $sql = "SELECT * FROM `category`" ; 
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
          // echo $row['category_id'];

          $id = $row['category_id'];
          $cat = $row['category_name'];
          $desc = $row['category_desc'];
          echo '<div class="col-md-4">
          <div class="card my-2" style="width: 18rem;">
          <img src="img/card-'.$id. '.jpg" class="card-img-top" alt="image for this category">
              <div class="card-body text-secondary">
                  <h5 class="card-title"> <a href = "threadList.php?cat_id=' . $id . '">' . $cat . '</a></h5>
                  <p class="card-text">' . substr($desc, 0, 150) . '...</p>
                  <a href="threadList.php?cat_id=' . $id . '" class="btn btn-primary">Explore Threads</a>
              </div>
          </div>
      </div>';
        }
        
        ?>



        </div>
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