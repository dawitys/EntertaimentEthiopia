<?php
require_once('../app/bootstrap.php');
require_once('../app/views/inc/header.php');
//require_once('../app/views/inc/navbar.php');

$arrayOfArticles = $data['posts'];

$myarray = [
    ["title" => "News number 04", "content" => "sashdfakjslfhasdkfwh"],
    ["title" => "News number 03", "content" => "sashdfakjslfhasdkfwh"],
    ["title" => "News number 02", "content" => "sashdfakjslfhasdkfwh"],
    ["title" => "News number 01", "content" => "sashdfakjslfhasdkfwh"]
];

?>
<main role="main">


    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>


        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="first-slide" src="Grid.jpg" alt="First slide">


                <div class="carousel-caption text-left">
                    <h1>Example headline.</h1>

                    <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida
                        at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                    <p><a class="btn btn-lg btn-primary" href="#" role="button">Sign up today</a></p>
                </div>

            </div>
            <div class="carousel-item">
                <img class="second-slide" src="Ethiopia.png" alt="Second slide">

                <div class="carousel-capption">
                    <h1>Another example headline.</h1>
                    <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida
                        at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                    <p><a class="btn btn-lg btn-primary" href="#" role="button">Learn more</a></p>
                </div>

            </div>
            <div class="carousel-item">
                <img class="third-slide" src="hazard.png" alt="Third slide">

                <div class="carousel-capption text-right">
                    <h1>One more for good measure.</h1>
                    <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida
                        at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                    <p><a class="btn btn-lg btn-primary" href="#" role="button">Browse gallery</a></p>
                </div>

            </div>
        </div>
        <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>


    <!-- Marketing messaging and featurettes
    ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->

    <div class="container marketing">

        <!-- Three columns of text below the carousel -->


        <div class="row">
            <?php
            $counter = count($posts) - 1;

            while ($counter >= 0) {
                $articleObject = $arrayOfArticles[$counter];
                echo " <div class='col-lg-4'>";
                echo "<img class='' src='../resources/images/$articleObject->image' alt='Generic placeholder image' width='100%'' height='140'>";
                echo "<h2>$articleObject->title</h2>";
                echo "<p>$articleObject->content</p>";
                echo "<p><a class='btn btn-secondary' href='#' role='button'>View details &raquo;</a></p>";
                echo "</div>";
                $counter--;
            }
            ?>


        </div>


    </div><!-- /.container -->


    <!-- FOOTER -->
    <footer class="container">
        <p class="float-right"><a href="#">Back to top</a></p>
        <p>&copy; 2017-2018 Company, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
    </footer>
</main>
<?php
require_once('../app/views/inc/footer.php'); ?>
