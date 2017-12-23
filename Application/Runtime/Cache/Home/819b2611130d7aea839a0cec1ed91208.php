<?php if (!defined('THINK_PATH')) exit();?><html>

<body>
    <form action="<?php echo U('Home/Usermin/toGiveAdmin');?>" method="post">
        账号:
        <INPUT type="text" name="username" />
        <input type="submit" name="submit" value="submit" />
    </form>
</body>

</html>