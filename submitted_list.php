<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>M.Quizzes || SUMMARY </title>
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <link rel="stylesheet" href="css/bootstrap-theme.min.css"/>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/font.css">
    <script src="js/jquery.js" type="text/javascript"></script>

    <script src="js/bootstrap.min.js" type="text/javascript"></script>
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>



    <script>
        $(function () {
            $(document).on('scroll', function () {
                console.log('scroll top : ' + $(window).scrollTop());
                if ($(window).scrollTop() >= $(".logo").height()) {
                    $(".navbar").addClass("navbar-fixed-top");
                }

                if ($(window).scrollTop() < $(".logo").height()) {
                    $(".navbar").removeClass("navbar-fixed-top");
                }
            });
        });</script>
</head>
<body style="background:#eee;">
<div class="header">
    <div class="row">
        <div class="col-lg-6">
            <span class="logo">M.Quizzes</span>
        </div>
    </div>
</div>
<!-- header close-->
<!--navigation menu-->
<nav class="navbar navbar-default title1">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li <?php if (@$_GET['q'] == 0) echo 'class="active"'; ?>><a href="dash.php?q=0">Home<span
                                class="sr-only">(current)</span></a></li>
                <li <?php if (@$_GET['q'] == 1) echo 'class="active"'; ?>><a href="dash.php?q=1">User</a></li>
                <li <?php if (@$_GET['q'] == 2) echo 'class="active"'; ?>><a href="dash.php?q=2">Ranking</a></li>
                <li <?php if (@$_GET['q'] == 3) echo 'class="active"'; ?>><a href="dash.php?q=3">Feedback</a></li>
                <li class="dropdown <?php if (@$_GET['q'] == 4 || @$_GET['q'] == 5) echo 'active"'; ?>">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false">Quiz<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="dash.php?q=4">Add Quiz</a></li>
                        <li><a href="dash.php?q=5">Remove Quiz</a></li>
                    </ul>
            </ul>
            <?php
            include_once 'dbConnection.php';
            session_start();
            $email = $_SESSION['email'];
            if (!(isset($_SESSION['email']))) {
                header("location:index.php");

            } else {
                $name = $_SESSION['name'];;

                include_once 'dbConnection.php';
                echo '<span class="pull-right top title1" ><span class="log1"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;&nbsp;&nbsp;&nbsp;</span> <a href="dash.php" class="log log1">' . $name . '</a>&nbsp;|&nbsp;<a href="logout.php?q=account.php" class="log"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>&nbsp;Signout</button></a></span>';
            } ?>
        </div><!-- /.navbar-collapse -->

    </div><!-- /.container-fluid -->
</nav>
<!--navigation menu closed-->
<!--Start summary table-->
<div class="container">
    <div class="col-md-6">
<?php if (@$_GET['summary'] == 1) {
    $eid = @$_GET['eid'];
    $qid = @$_GET['qid'];
    $email = @$_GET['email'];
    $optionid = @$_GET['optionid'];

    $result = mysqli_query($con, "SELECT options.option AS optt ,count(summary.optionid) AS tot_count  FROM options inner join summary on summary.optionid=options.optionid where options.qid='$qid' group by options.option,options.qid") or die('Error');

    //  $opname = mysqli_query($con, "SELECT option FROM `options` WHERE optionid='$optionid'") or die('Error');

    echo '<div class="panel"><div class="table-responsive"><table class="table table-striped title1">
<tr><td><b>Option</b></td><td><b>Option count</b></td></tr>';
    $c = 1;
    while ($row = mysqli_fetch_array($result)) {
        $option = $row['optt'];
        $tot_count = $row['tot_count'];

            echo '<tr>


<td>' . $option . '</td><td>' . $tot_count . '</td></tr>';


    }
    echo '</table></div></div>';

}
?>
</div>
</div>
<!--<style>-->
<!--    * {box-sizing: border-box}-->
<!---->
<!--    .container {-->
<!--        width: 100%;-->
<!--        background-color: #ddd;-->
<!--    }-->
<!---->
<!--    .skills {-->
<!--        text-align: right;-->
<!--        padding-top: 10px;-->
<!--        padding-bottom: 10px;-->
<!--        color: white;-->
<!--    }-->
<!---->
<!--    .html { background-color: #04AA6D;}-->
<!--    .css { background-color: #2196F3;}-->
<!--    .js {width: 65%; background-color: #f44336;}-->
<!--    .php {width: 60%; background-color: #808080;}-->
<!--</style>-->
<!--<div class="container">-->
<!--    <div class="col-md-12">-->
<!---->
<!--        <h1>My Skills</h1>-->
<!---->
<!--        <p>HTML</p>-->
<!--        <div class="container">-->
<!--            <div class="skills html" style="width:'--><?php //$tot_count ?><?php //$tot_count ?><!--</div>-->
<!--        </div>-->
<!---->
<!--        <p>CSS</p>-->
<!--        <div class="container">-->
<!--            <div class="skills css" style="width:--><?php //$tot_count ?><?php //$tot_count ?><!--</div>-->
<!--        </div>-->
<!---->
<!--        <p>JavaScript</p>-->
<!--        <div class="container">-->
<!--            <div class="skills js">65%</div>-->
<!--        </div>-->
<!---->
<!--        <p>PHP</p>-->
<!--        <div class="container">-->
<!--            <div class="skills php">60%</div>-->
<!--        </div>-->
<!--    </div>-->
<!--    </div>-->
<!--</div>-->
<!--End summary table-->
</body>
</html>