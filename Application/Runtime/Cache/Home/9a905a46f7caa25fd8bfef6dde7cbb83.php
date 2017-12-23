<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>我的滑板</title>
    <link rel="stylesheet" type="text/css" href="/huabanshe\Application\Home\View\Index\semantic.min.css">
    <script src="/huabanshe\Application\Home\View\Index\jquery-3.2.1.min.js"></script>
    <script src="/huabanshe\Application\Home\View\Index\semantic.min.js"></script>
</head>

<body>
<div class="ui red raised very  text container segment">
    <h1 class="ui center aligned header">我的购物车</h1>
</div>
<div class="ui  text container compact">
    <div class="ui breadcrumb">
        <a class="section" href="<?php echo U('/main');?>">主页</a>
        <span class="divider">/</span>
        <div class="section">我的购物车</div>
    </div>
</div>
<div class="ui yellow raised very padded text container segment" style="margin-top:0;">
    <div class="ui special cards">
        <!-- 单个卡片开始 -->
        <?php if(is_array($data)): foreach($data as $key=>$li): ?><div class="card ">
                <div class="blurring dimmable image">
                    <div class="ui dimmer">
                        <div class="content">
                            <div class="center">
                                <a href="<?php echo U('/deletecart',array('id'=>$li['id']));?>">
                                    <div class="ui inverted button">删除</div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <img src="/huabanshe/Public/image/<?php echo ($li["image"]); ?>" style="height:290px;">
                </div>
                <div class="content">
                    <div class="header">类型:<?php echo ($li["goodsname"]); ?></div>
                    <div class="meta">
                        <span class="date">介绍:<?php echo ($li["introduce"]); ?></span>
                    </div>
                </div>
                <div class="extra content">
                    <div><i class="yen icon"></i>定价:<?php echo ($li["price"]); ?> </div>
                </div>
            </div><?php endforeach; endif; ?>

        <!-- 单个卡片结束 -->
        <!-- 单个卡片结束 -->
    </div>
</div>
<script type="text/javascript">
    $('.special.cards .image').dimmer({
        on: 'hover'
    });
    // $(document).ready(function() {
    //   $(".card").click(function() {
    //     $('.card')
    //     .transition({
    //       animation  : 'scale',
    //       duration   : '2s',
    //       onComplete : function() {
    //         $(".card").hide();
    //       }});
    //   });
    // });
</script>

</body>

</html>