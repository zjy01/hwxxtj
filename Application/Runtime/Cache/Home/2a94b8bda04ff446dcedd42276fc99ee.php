<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>会务信息统计系统</title>
    <link href="/hwxxtj/Public/css/css.css" rel="stylesheet">
    <script src="/hwxxtj/Public/js/jquery-2.1.3.min.js"></script>
    <script src="/hwxxtj/Public/js/js.js"></script>
    <script language="JavaScript">
        window.onload=function(){
            indexTable();
        }
    </script>
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
                <li><a href="/hwxxtj/index.php/Home/Index/countTime">地点设备使用时间</a></li>
                <li>|</li>
            <?php } else{ ?>
                <li><a href="/hwxxtj/index.php/Home/Index/proLead">负责的项目</a></li>
                <li>|</li>
                <li><a href="/hwxxtj/index.php/Home/Index/countTime">地点设备使用时间</a></li>
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
        <table cellspacing="0"  border="0" width="100%" class="indexTable">
            <tr>
                <?php
 if($pro[0]['term']==1) $term='上半学期'; else $term='下半学期'; ?>
                <td colspan="10" align="center"><h2>工作安排登记表（<?php echo ($pro[0]['schoolYear']); ?>学年<?php echo ($term); ?>第 <?php echo ($pro[0]['week']); ?> 周）</h2></td>
            </tr>
            <tr align="center">
                <td></td>
                <td></td>
                <td colspan="5"><strong><?php echo ($special['part1']); ?></strong></td>
                <td><?php echo ($special['part2']); ?></td>
                <td><?php echo ($special['part3']); ?></td>
                <td><?php echo ($special['part4']); ?></td>
            </tr>
            <tr border="0" align="center" id="title">
                <th width="4.06%">收单时间</th>
                <th width="5.69%">单位</th>
                <th width="11.38%">项目名称</th>
                <th width="6.91%">使用日期</th>
                <th width="7.31%">使用时间（起止）</th>
                <th width="10.16%">联系人/联系电话</th>
                <th width="10.97%">使用设备</th>
                <th width="12.19%">人员</th>
                <th width="13%">地点</th>
                <th width="18.29%">备注</th>
            </tr>
            <tr align="center">
                <td></td>
                <td></td>
                <td><?php echo ($special['proName']); ?></td>
                <td colspan="4"><?php echo ($special['part5']); ?></td>
                <td><?php echo ($special['people']); ?></td>
                <td><?php echo ($special['place']); ?></td>
                <td><?php echo ($special['remark']); ?></td>
            </tr>
            <?php foreach($pro as $key=>$proj){ $User=M('User'); $captain=$User->where('id='.$proj['captain'])->field('name')->select(); $people=$captain[0]['name']; $peo=json_decode($proj['people']); foreach($peo as $p){ $peop=$User->where('id='.$p)->field('name')->select(); $people.="、".$peop[0]['name']; } ?>
            <tr align="center">
                <td><?php echo (date('Y-m-d',$proj['doneTime'])); ?></td>
                <td><?php echo ($proj['unit']); ?></td>
                <td><?php echo ($proj['proName']); ?></td>
                <td><?php echo (date('Y-m-d',$proj['useDate'])); ?></td>
                <td><?php echo ($proj['useTime']); ?></td>
                <td><?php echo ($proj['tel']); ?></td>
                <td><?php echo ($proj['device']); ?></td>
                <td><?php echo ($people); ?></td>
                <td><?php echo ($proj['place']); ?></td>
                <td><?php echo ($proj['remark']); ?></td>
            </tr>
            <?php } ?>
        </table>
    </div>
    <div class="footer">会务信息统计系统 Copyright©<a href="http://www.quantacenter.com">2015Quanta</a></div>
<script src="/hwxxtj/Public/js/jquery.min.js"></script>
<script src="/hwxxtj/Public/js/setTime.js"></script>
<script src="/hwxxtj/Public/js/jquery-ui.min.js"></script>
<script src="/hwxxtj/Public/js/jqjs.js"></script>
</div>
</body>
</html>