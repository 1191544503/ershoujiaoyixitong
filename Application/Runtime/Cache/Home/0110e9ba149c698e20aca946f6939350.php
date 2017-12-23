<?php if (!defined('THINK_PATH')) exit();?><html>


<body>
    <h1 align="center">商品列表</h1>
    <table align="center" width="1300" cellspacing="12" border="1">
        <tr>
            <td>卖家</td>
            <td>商品名字</td>
            <td width="100px" height="50">简介</td>
            <td>价格</td>
            <td>卖家联系方式</td>
            <td>图片</td>
        </tr>
        <?php if(is_array($data)): foreach($data as $key=>$li): ?><tr>
                <td><?php echo ($li["username"]); ?></td>
                <td><?php echo ($li["goodsname"]); ?></td>
                <td><?php echo ($li["introduce"]); ?></td>
                <td><?php echo ($li["price"]); ?></td>
                <td><?php echo ($li["phone"]); ?></td>
                <td><img src="/huabanshe/Public/image/<?php echo ($li["image"]); ?>"></td>
                <td>
                    <a href="<?php echo U('Home/Store/Delete',array('id'=>$li['id'],'username'=>$li['username']));?>">删除</a>
                </td>
            </tr><?php endforeach; endif; ?>
    </table>

</body>

</html>