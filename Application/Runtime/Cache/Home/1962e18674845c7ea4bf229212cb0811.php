<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>会务信息统计系统--用户管理</title>
    <link href="/hwxxtj/Public/css/css.css" rel="stylesheet">
    <script src="/hwxxtj/Public/js/js.js"></script>
</head>
<body>
<div class="page">
    <head>
    <link href="/hwxxtj/Public/css/jquery-ui.css" rel="stylesheet">
</head>
<div class="header">
    <span class="user_box">你好，<?php echo ($user['name']); ?> <a href="/hwxxtj/index.php/Home/Index/logout">[注销]</a></span>
    <div class="web_title">会务信息统计系统</div>
    <div class="nav_box">
        <ul>
            <li><a href="/hwxxtj/index.php/Home/Index/index">首页</a></li>
            <li>|</li>
            <?php if($user['rank']!=0){ ?>
                <li><a href="/hwxxtj/index.php/Home/Index/proJoin">参与的项目</a></li>
                <li>|</li>
                <li><a href="/hwxxtj/index.php/Home/Index/proLead">负责的项目</a></li>
                <li>|</li>
            <?php } else{ ?>
                <li><a href="/hwxxtj/index.php/Home/Index/proLead">负责的项目</a></li>
                <li>|</li>
                <li><a href="/hwxxtj/index.php/Home/Index/proAdd">项目添加</a></li>
                <li>|</li>
                <li><a href="/hwxxtj/index.php/Home/Index/proSet">项目处理</a></li>
                <li>|</li>
                <li><a href="/hwxxtj/index.php/Home/Index/userSet">用户管理</a></li>
                <li>|</li>
            <?php } ?>
            <li><a href="/hwxxtj/index.php/Home/Index/password">密码修改</a></li>
            <li>|</li>
            <li><a href="/hwxxtj/index.php/Home/Index/tableDown">统计表下载</a></li>
        </ul>
    </div>
</div>
    <div class="container">
        <div class="user_add">
            <h2>用户添加</h2>
            <form method="post" action="/hwxxtj/index.php/Home/Index/userAdd" name="register">
                <span>用户名：</span><input type="text" name="name"><br/><br/>
                <span>职工号：</span><input type="text" name="number"><br/><br/>
                <span>密码：初始密码为111111，请用户即时自行修改</span><br/>
                <input type="submit" value="注册" onclick="return check()">
            </form>
        </div>
        <div class="user_del">
            <h2>用户删除</h2>
            <form method="post" action="/hwxxtj/index.php/Home/Index/userDel" name="del">
                <table border="1" width="400">
                    <tr>
                        <th></th>
                        <th>用户名</th>
                        <th>职工号</th>
                    </tr>
                    <?php foreach($users as $user){ ?>
                    <tr>
                        <td align="center"><input type="checkbox" name="del[]" value="<?php echo $user['id']; ?>"></td>
                        <td><?php echo ($user['name']); ?></td>
                        <td><?php echo ($user['number']); ?></td>
                    </tr>
                    <?php } ?>
                    <tr>
                        <td colspan="3" align="center" valign="center"><input type="submit" value="删除所选"></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
    <div class="footer">会务信息统计系统 Copyright©<a href="http://www.quantacenter.com">2015Quanta</a></div>
<script src="/hwxxtj/Public/js/jquery.min.js"></script>
<script src="/hwxxtj/Public/js/setTime.js"></script>
<script src="/hwxxtj/Public/js/jquery-ui.min.js"></script>
<script src="/hwxxtj/Public/js/jqjs.js"></script>
</div>
</body>
</html>