<html>
    <head>
        <title>WINK HOMEPAGE</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <?php include_once('include/properties.php');?>
    </head>

    <body id="top">
        <!-- top header / 최상단 헤더 -->
        <div class="wrapper row0">
            <div id="topbar" class="hoc clear">
                <div class="fl_left">
                    <ul class="nospace">
                        <li><i class="fa fa-phone"></i> 담당 교수님 02)910-4794</li>
                        <li><i class="fa fa-envelope-o"></i> kshahn@kookmin.ac.kr</li>
                    </ul>
                </div>
                <div class="fl_right">
                    <ul class="nospace">
                        <li><a href="<?php echo $HOME_PATH;?>"><i class="fa fa-lg fa-home"></i></a></li>
                        <li><a href="#">About</a></li>
                        <li><a href="#">Contact</a></li>
                        <li><a href="<?php echo $PAGE_PATH;?>login/login.php">Login</a></li>
                        <li><a href="#">Register</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="bgded overlay" style="background-image:url('images/demo/backgrounds/검정색배경.jpg');">
            <!-- logo & menu / 로고 & 메뉴 -->
            <div class="wrapper row1">
                <header id="header" class="hoc clear">
                    <div id="logo" class="fl_left">
                        <a href="<?php echo $HOME_PATH;?>">
                            <img src="<?php echo $IMAGE_PATH;?>logo.png" style="width:100px" align="center">
                        </a>
                    </div>
                    <nav id="mainav" class="fl_right">
                        <ul class="clear">
                            <li class="active"><a href="<?php echo $HOME_PATH?>">Home</a></li>
                            <li><a class="drop no-href">Pages</a>
                                <ul>
                                    <li><a href="<?php echo $PAGE_PATH;?>gallery.php">Gallery</a></li>
                                </ul>
                            </li>
                            <li><a class="drop" href="#">History</a>
                                <ul>
                                    <li><a href="<?php echo $PAGE_PATH;?>gallery.php">Gallery</a></li>
                                </ul>
                            <li><a class="drop" href="#">Q & A</a></li>
                            <li><a class="drop" href="<?php echo $PAGE_PATH;?>board/list.php">Notice</a></li>
                        </ul>
                    </nav>
                </header>
            </div>

            <!-- Rolling Banner / 롤링배너 -->
            <div id="pageintro" class="hoc clear">
                <div class="flexslider basicslider">
                    <ul class="slides">
                        <li>
                            <article>
                                <h3 class="heading">'윙크'에 오신 여러분을 환영합니다.</h3>
                                <p>국민대학교 웹 동아리, WINK</p>
                            </article>
                        </li>
                        <li>
                            <article>
                                <h3 class="heading">웹이란?</h3>
                                <p>보통 WWW(World Wide Web)이라고 불린다. 제공하는 정보 검색 서비스로 텍스트만 제공했던 기존의 정보 서비스와는 달리 그림, 동화상, 소리 등도 모두 지원하고
                                    있다.
                                    또 하이퍼텍스트 개념을 도입하여 쉽게 원하는 정보와 관련된 정보를 찾아볼 수 있는 특징을 갖고 있다.
                                    그래픽 환경으로 손쉬운 사용법이 현재 인터넷이 급부상하게 된 하나의 원인이다.</p>
                            </article>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- header.php <div class="bgded overlay"> 종료태그 -->
        </div>

        <div class="at-main">