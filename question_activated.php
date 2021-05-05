<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>M.Quizzes || DASHBOARD </title>
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
<!--New added activating questions-->

<?php if (@$_GET['act'] == 1) {
    $qid = @$_GET['qid'];
    $eid = @$_GET['eid'];

    $result = mysqli_query($con, "UPDATE questions SET Qst='A' WHERE eid='$eid' AND qid='$qid'") or die('Error');

//    print_r($result);

    header("Location:/question_activated.php?stat=1&eid='$eid'", '', '200');

}
?>
<!--End New added activating questions -->
<!--New added deactivating questions-->
<?php if (@$_GET['act'] == 2) {
    $qid = @$_GET['qid'];
    $eid = @$_GET['eid'];

    $result = mysqli_query($con, "UPDATE questions SET Qst='D' WHERE eid='$eid' AND qid='$qid'") or die('Error');

    print_r($result);

    header("Location:/question_activated.php?stat=2&eid='$eid'");

}
?>
<!--End New added deactivating questions -->

<!--start view table-->
<?php if (@$_GET['stat'] == 1) {
$eid = @$_GET['eid'];
$qid = @$_GET['qid'];

$result = mysqli_query($con, "SELECT * FROM questions WHERE eid='$eid'") or die('Error');
echo '<div class="panel"><div class="table-responsive"><table class="table table-striped title1">
<tr><td><b>Questions</b></td></td><td><b>Status</b></td><td></td><td></td><td></td></tr>';
$c = 1;
while ($row = mysqli_fetch_array($result)) {
    $qid = $row['qid'];
    $qns = $row['qns'];
    $Qst = $row['Qst'];
    $st = 'Activated';
    if ($Qst == 'A') {
        $st = 'Activated';
    } else if ($Qst == 'D') {
        $st = 'Deactivated';
    }


        echo '<tr>
<td>' . $qns . '</td><td>' . $st . '</td><td><button class="btn btn-warning"><a href="question_activated.php?act=1&qid=' . $qid . '&eid=' . $eid . '" style="color: seashell"><b>ACTIVATE</b></a></button></td><td><button class="btn btn-danger"><a href="question_activated.php?act=2&qid=' . $qid . '&eid=' . $eid . '" style="color: seashell">DEACTIVATE</a></button></td><td><button class="btn btn-info"><a href="submitted_list.php?summary=1&email=' . $email . '&eid=' . $eid . '&qid=' . $qid .'" style="color: white">SUMMARY</a></button></td></tr>';


    }
    echo '</table></div></div>';

}
?>

<!--end view table-->
</body>
</html>