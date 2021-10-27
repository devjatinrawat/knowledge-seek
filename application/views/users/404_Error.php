<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Page Title</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link href="<?php echo base_url().'public/css/bootstrap.min.css'; ?>" rel="stylesheet">
    <style>
        /*======================
    404 page
=======================*/

        .page_404 {
            margin-top: 10px;
            padding: 40px 0;
            background: #fff;
            font-family: "Arvo", serif;
        }

        .page_404 img {
            width: 100%;
        }

        .four_zero_four_bg {
            background-image: url("<?php echo base_url().'public/images/404.gif' ?> ");
            height: 450px;
            background-position: center;
        }

        .four_zero_four_bg h1 {
            font-size: 80px;
        }

        .four_zero_four_bg h3 {
            font-size: 80px;
        }

        .link_404 {
            color: #fff !important;
            padding: 10px 20px;
            background: #39ac31;
            margin: 20px 0;
            display: inline-block;
        }

        .contant_box_404 {
            margin-top: -50px;
        }
    </style>
</head>

<body>
    <section class="page_404 d-flex justify-content-center">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-1 col-sm-offset-1  text-center"></div>
                <div class="col-sm-10 col-sm-offset-1  text-center">
                    <div class="four_zero_four_bg">
                        <h1 class="text-center ">404</h1>
                    </div>

                    <div class="contant_box_404">
                        <h3 class="h2">
                            Look like you're lost
                        </h3>

                        <p>the page you are looking for not avaible!</p>

                        <a href="<?php echo base_url(); ?>" class="link_404">Go to Home</a>
                    </div>
                </div>
                <div class="col-sm-1 col-sm-offset-1  text-center"></div>
            </div>
        </div>
        </div>
    </section>


</body>

</html>