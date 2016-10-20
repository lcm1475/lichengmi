<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>里程密开源博客系统 安装</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- Le styles -->
        <link href="/lichengmi/Public/Install/css/bootstrap.css" rel="stylesheet">
        <link href="/lichengmi/Public/Install/css/bootstrap-responsive.css" rel="stylesheet">
        <link href="/lichengmi/Public/Install/css/install.css" rel="stylesheet">

        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="assets/js/html5shiv.js"></script>
        <![endif]-->
        <script src="/lichengmi/Public/Install/css/jquery-1.10.2.min.js"></script>
        <script src="/lichengmi/Public/Install/css/bootstrap.js"></script>
    </head>
    <style>
        #step li a{
            color: #fff;
        }
        #step li{
            margin-top: 5px;
        }
        .active{
            margin-top: 5px;
        }
        .active a{
            background: #ED5565 !important;
            border-radius: 10%;
        }
    </style>
    <body data-spy="scroll" data-target=".bs-docs-sidebar">
        <!-- Navbar
        ================================================== -->
        <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="navbar-inner" style="background:#1AB394;">
                <div class="container">
                    <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="brand" target="_blank" href="http://www.lcm.wang/">里程密</a>
                    <div class="nav-collapse collapse">
                    	<ul id="step" class="nav">
                    		
    <li class="active"><a href="javascript:;">安装协议</a></li>
    <li><a href="javascript:;">环境检测</a></li>
    <li><a href="javascript:;">创建数据库</a></li>
    <li><a href="javascript:;">安装</a></li>
    <li><a href="javascript:;">完成</a></li>

                    	</ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="jumbotron masthead">
            <div class="container">
                
    <h1>里程密开源博客系统 安装协议</h1>
    <p>序言：里程密最初只是我的私人博客作品，后来发现大家很喜欢，所以就开源化，我希望每个人都有一个心灵栖息的地方，从工作到感情，心中那份小而美一直存在。</p>
    <p>
    感谢：本套程序使用了ThinkPHP,BootStrap,以及网络上一些插件，在这里感谢ThinkPHP,BootStrap的开源，为本套博客带来了很强大的程序基础，也感谢为里程密提出建议，提供优化的广大网友，谢谢！
    </p>
    <p>1.里程密官网网址：<a href="http://www.lcm.wang/">里程密</a> 作者：MonkeyCode</p>
    <p>2.感谢您选择里程密，希望我们的努力能为您提供一个简单、强大的博客系统。</p>
    <p>3.如果您对里程密有BUG提交或者功能建议 可以发送邮件到作者邮箱lcm1475@aliyun.com或者在官网留言</p>
    <p>4.我们希望您在使用过程中可以加入里程密讨论群分享使用经验（交流群在官网查看）</p>
    <p>5.里程密是一个开源产品，简单的一句话，懂的都懂，不懂的就不懂</p>
    <p>6.我们希望与大家把里程密变得更好</p>
    <p>7.用户须知：本协议是您与顶想公司之间关于您使用里程密产品及服务的法律协议。无论您是个人或组织、盈利与否、用途如何（包括以学习和研究为目的），均需仔细阅读本协议，包括免除或者限制顶想责任的免责条款及对您的权利限制。请您审阅并接受或不接受本服务条款。如您不同意本服务条款及/或顶想随时对其的修改，您应不使用或主动取消里程密。否则，您的任何对里程密的相关服务的注册、登陆、下载、查看等使用行为将被视为您对本服务条款全部的完全接受，包括接受顶想对服务条款随时所做的任何修改。</p>

            </div>
        </div>


        <!-- Footer
        ================================================== -->
        <footer class="footer navbar-fixed-bottom">
            <div class="container">
                <div>
                	
    <a class="btn btn-primary btn-large" href="<?php echo U('Install/step1');?>">同意安装协议</a>
    <a class="btn btn-large" href="http://www.lcm.wang/">不同意</a>

                </div>
            </div>
        </footer>
    </body>
</html>