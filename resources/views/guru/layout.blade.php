<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>@yield('title')</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

    <link href="/lib/lightslider/src/css/lightslider.css" rel="stylesheet">

    <!-- Optional theme -->
    <!--link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css"-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        body{
            background-color: #e5e5e5;
            /*background-image: url(/img/bg-1.jpg);*/
            background-size: 20%;
            background-attachment: fixed;
        }
        .micro-post-item{
            margin-bottom: 20px;
            background-color: white;
            border-radius: 2px;
            border: 1px solid #d8d8d8;
            border-bottom-width: 2px;
        }
        .micro-post-wrapper{
            margin: 5px;
        }
        .micro-post-title{
            line-height: 10px;
            font-size: 14px;
            font-weight: bold;
            color: black;
        }
    </style>
</head>
<body>
<div class="container">
    @yield('container')
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

<script src="/lib/lightslider/src/js/lightslider.js"></script>
<script>
    $(document).ready(function() {
        $('.image-prime-gallery').lightSlider({
            gallery:true,
            item:1,
            loop:false,
            thumbItem:7,
            slideMargin:0,
            enableDrag: true,
            currentPagerPosition:'center'
        });
    });
</script>

<!--LiveInternet counter--><script type="text/javascript"><!--
document.write("<a href='//www.liveinternet.ru/click' "+
        "target=_blank><img src='//counter.yadro.ru/hit?t29.6;r"+
        escape(document.referrer)+((typeof(screen)=="undefined")?"":
        ";s"+screen.width+"*"+screen.height+"*"+(screen.colorDepth?
                screen.colorDepth:screen.pixelDepth))+";u"+escape(document.URL)+
        ";"+Math.random()+
        "' alt='' title='LiveInternet: показано количество просмотров и"+
        " посетителей' "+
        "border='0' width='88' height='120'><\/a>")
//--></script><!--/LiveInternet-->

</body>
</html>