<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/huabanshe\Application\Home\View\Aboutus\css\normalize.css">
    <link rel="stylesheet" href="/huabanshe\Application\Home\View\Aboutus\css\main.css">
    <title>崛起滑板社</title>
</head>

<body>
    <div class="main-wrapper">


        <header>
            <!-- header begin -->
            <nav>
                <div class="logo"><a href="#">滑板交易网</a></div>
            </nav>
            <div id="banner">
                <div class="inner">
                    <h1>崛起滑板社</h1>
                    <p>滑板，更多的时候是不甘平庸的信仰</p>
                    <button type="button" name="button" onclick="jump()">所有滑板</button>
                </div>

            </div>

        </header>
        <!-- header end-->
        <script type="text/javascript">
            function jump() {
                //    window.open("<?php echo U('/list');?>");
                window.location.href = "<?php echo U('/list');?>";
            }
        </script>
        <div class="content">
            <!-- content begin -->
            <section class="green-section">
                <div class="wrapper">
                    <div>
                        <h2>About us</h2>
                        <div class="hr"></div>
                        <p class="sub-heading">我们 只有开始 没有结束</p>
                    </div>
                    <div class="icon-group">
                        <span class="icon">疯狂</span>
                        <span class="icon">刺激</span>
                        <span class="icon">个性</span>
                    </div>
                </div>
            </section>
            <section class="gray-section">
                <div class="article-preview">
                    <div class="img-section">
                        <img src="/huabanshe/Public/img1/pic02.jpg" alt="">
                    </div>
                    <div class="text-section">
                        <p>说我们爱显摆也好，愿意做作也罢，起码我们在板上是自由的。<br> 所有人都在观望，我们孤独的在挣扎，跌倒后不想要有人攀扶，<br>只想有这样的伙伴,大笑着踢过来我的板子，“来嘛，再试试”。 <br> 没有人可以笑你，你就跳过一个台阶，等着他们讪讪的笑。 <br> 没人配说你哪里不好，你就拼命考到他的前头，等着他吃瘪的脸。 <br> 滑板社，倔强的青春，凭什么我做不到。 <br> 来嘛，再试试。
                        </p>
                    </div>
                </div>
                <div class="article-preview">
                    <div class="text-section">
                        <h2>幸福</h2>
                        <p>莫过于脚下尚有一块滑板以及一块可以踩板的地</p>
                    </div>
                    <div class="img-section">
                        <img src="/huabanshe/Public/img1/pic05.jpg" alt="">
                    </div>
                </div>
                <div class="article-preview">
                    <div class="img-section">
                        <img src="/huabanshe/Public/img1/pic08.jpg" alt="">
                    </div>
                    <div class="text-section">
                        <p>不要笑我们玩板的人倒地的一瞬间，因为你连触碰滑板的勇气都没有
                        </p>
                    </div>
                </div>
            </section>
        </div>
        <!--content end -->
        <footer>
            <div class="copy">&copy LingHS 2017</div>
        </footer>
</body>
</div>

</html>