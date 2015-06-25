<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>会务信息统计系统--项目管理</title>
    <link href="/hwxxtj/Public/css/css.css" rel="stylesheet">
    <script src="/hwxxtj/Public/js/jquery-2.1.3.min.js"></script>
    <script src="/hwxxtj/Public/js/js.js"></script>
    <script>
        $(document).ready(function(){
            proSet();
            proChange();
        });
    </script>
</head>
<body>
<div class="page">
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
        <?php if(empty($schoolY)){ ?>
        <h1 style="text-align: center; margin-top: 100px;">暂无无项目</h1>
        <?php } else{ ?>
        <div class="weeks">
            <?php
 foreach($schoolY as $schoolYear){ if($schoolYear['term']==1) $t='上'; else $t='下'; if($schoolYear['schoolYear']!=$pro[0]['schoolYear'] || $schoolYear['term']!=$pro[0]['term']){ ?>
            <a href="/hwxxtj/index.php/Home/Index/tableDown/<?php echo ($schoolYear['schoolYear']); ?>/<?php echo ($schoolYear['term']); ?>" class="week"><?php echo ($schoolYear['schoolYear']); ?>（<?php echo ($t); ?>）</a>
            <?php } else{ ?>
            <div class="week" style="border-color: #002a80; color: #002a80;"><?php echo ($schoolYear['schoolYear']); ?>（<?php echo ($t); ?>）</div>
            <?php } } ?>
        </div>
        <div class="weeks">
            <?php
 foreach($weeks as $week){ if($week['week']!=$pro[0]['week']){ ?>
            <a href="/hwxxtj/index.php/Home/Index/tableDown/<?php echo ($pro[0]['schoolYear']); ?>/<?php echo ($pro[0]['term']); ?>/<?php echo ($week['week']); ?>" class="week"><?php echo ($week['week']); ?></a>
            <?php } else{ ?>
            <div class="week" style="border-color: #002a80; color: #002a80;"><?php echo ($week['week']); ?></div>
            <?php } } ?>
        </div>
        <table cellspacing="0"  border="1" width="99.5%" id="proSetTable">
            <tr height="36">
                <td colspan="11" align="center"><h3><a href="/hwxxtj/index.php/Home/Excel/proExcel/<?php echo ($pro[0]['schoolYear']); ?>/<?php echo ($pro[0]['term']); ?>/<?php echo ($pro[0]['week']); ?>" class="tableDown" target="_blank">点击下载</a></h3></td>
            </tr>
            <tr align="center">
                <?php
 if($proj[0]['term']==1) $term='上半学期'; else $term='下半学期'; ?>
                <td colspan="11" align="center"><h2>工作安排登记表（<?php echo ($pro[0]['schoolYear']); ?>学年<?php echo ($term); ?>第 <?php echo ($pro[0]['week']); ?> 周）</h2>
            </tr>
            <tr align="center" class="special1">
                    <td></td>
                    <td></td>
                    <td colspan="5"><strong><?php echo ($special['part1']); ?></strong></td>
                    <td><?php echo ($special['part2']); ?></td>
                    <td colspan="2"><?php echo ($special['part3']); ?></td>
                    <td colspan="2"><?php echo ($special['part4']); ?></td>
                </tr>
                <tr align="center" class="special2">
                    <td></td>
                    <td></td>
                    <td colspan="5"><textarea style="font-weight: bold;" name="part1"><?php echo ($special['part1']); ?></textarea></td>
                    <td><textarea name="part2"><?php echo ($special['part2']); ?></textarea></td>
                    <td colspan="2"><textarea name="part3"><?php echo ($special['part3']); ?></textarea></td>
                    <td colspan="2"><textarea name="part4"><?php echo ($special['part4']); ?></textarea></td>
                </tr>
                <tr  align="center">
                    <td width="4.06%">收单时间</td>
                    <td width="5.69%">单位</td>
                    <td width="11.38%">项目名称</td>
                    <td width="6.91%">使用日期</td>
                    <td width="7.31%">使用时间（起止）</td>
                    <td width="10.16%">联系人/联系电话</td>
                    <td width="10.97%">使用设备</td>
                    <td width="9%">人员(除负责人)</td>
                    <td width="9%">负责人</td>
                    <td width="9%">地点</td>
                    <td width="11.58%">备注</td>
                </tr>
                <tr align="center"  class="special1">
                    <td></td>
                    <td></td>
                    <td><?php echo ($special['proName']); ?></td>
                    <td colspan="4"><?php echo ($special['part5']); ?></td>
                    <td colspan="2"><?php echo ($special['people']); ?></td>
                    <td><?php echo ($special['place']); ?></td>
                    <td><?php echo ($special['remark']); ?></td>
                </tr>
                <tr align="center"  class="special2">
                    <td></td>
                    <td></td>
                    <td><textarea name="proName"><?php echo ($special['proName']); ?></textarea></td>
                    <td colspan="4"><textarea name="part5"><?php echo ($special['part5']); ?></textarea></td>
                    <td colspan="2"><textarea name="people"><?php echo ($special['people']); ?></textarea></td>
                    <td><textarea name="place"><?php echo ($special['place']); ?></textarea></td>
                    <td><textarea name="remark"><?php echo ($special['remark']); ?></textarea></td>
                </tr>
            <?php foreach($pro as $proj){ $User=M('User'); $captain=$User->where('id='.$proj['captain'])->field('name')->select(); $captain=$captain[0]['name']; if($proj['people']=='null'){ $people='无'; $peo=null; } else{ $peo=json_decode($proj['people']); foreach($peo as $key=>$p){ $peop=$User->where('id='.$p)->field('name')->select(); if($key==0) $people=$peop[0]['name']; else $people.="、".$peop[0]['name']; } } ?>
                <tr align="center" class="showTr">
                    <td><?php echo ($proj['doneTime']); ?></td>
                    <td><?php echo ($proj['unit']); ?></td>
                    <td><?php echo ($proj['proName']); ?></td>
                    <td><?php echo ($proj['useDate']); ?></td>
                    <td><?php echo ($proj['useTime']); ?></td>
                    <td><?php echo ($proj['tel']); ?></td>
                    <td><?php echo ($proj['device']); ?></td>
                    <td><?php echo ($people); ?></td>
                    <td><?php echo ($captain); ?></td>
                    <td><?php echo ($proj['place']); ?></td>
                    <td><?php echo ($proj['remark']); ?></td>
                </tr>
            <?php } ?>
        </table>
        <?php } ?>
    </div>
    <div class="footer">会务信息统计系统 Copyright©<a href="http://www.quantacenter.com">2015Quanta</a></div>
</div>
</body>
</html>