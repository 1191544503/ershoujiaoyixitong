<?php if (!defined('THINK_PATH')) exit();?><html>

<body>

    <form action="<?php echo U('Home/Notice/addNotice');?>" method="post" enctype="multipart/form-data">
        <table height="400" width="500" align="center">
            <tr>
                <td>
                    <p>公告</p>
                    <textarea cols="60" rows="20" name="notice" ><?php echo ($notice); ?></textarea>
                    <input type="submit" name="submit" value="发布" />
                </td>
            </tr>
        </table>
    </form>
</body>

</html>