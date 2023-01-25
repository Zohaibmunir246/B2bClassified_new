<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo SITE_NAME; ?></title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/frontend-mobile/css/bootstrap.css'); ?>">
    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="<?php echo base_url('assets/frontend-mobile/css/merge.css'); ?>">
</head>

<body>
<!-- Wrapper -->
<div class="wrapper">
    <!-- Header -->

    <!-- Main -->
    <main id="main">
        <div class="errormessage">
            <a href="<?php echo base_url(); ?>"><img src="<?php echo base_url('assets/frontend-mobile/images/error.png'); ?>" alt="error"></a>
            <div class="volgoerror">
                <div class="container-fluid">
                    <div class="logo">
                        <a href="<?php echo base_url(); ?>"><img src="<?php echo base_url('assets/frontend-mobile/images/Error404.png'); ?>" alt="logo" width="150" height="60"></a>

                    </div>

                    <div class="smalldiverror text-center">
                        <div class="container">
                            <h1>404</h1>
                            <h4>Sorry, The page Could not be found</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi a vehicula ex. Vestibulum placerat mi ex, sit amet.</p>
                            <a href="<?php echo base_url(); ?>" class="btn-warning">Back To Homepage</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>
</div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script type="text/javascript" src="<?php echo base_url('assets/frontend-mobile/js/jquery-3.3.1.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/frontend-mobile/js/popper.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/frontend-mobile/js/bootstrap.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/frontend-mobile/js/custom-scripts.js'); ?>"></script>

</body>

</html>