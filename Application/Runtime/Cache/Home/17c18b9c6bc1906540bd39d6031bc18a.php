<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>会务信息统计系统--负责的项目</title>
    <link href="/hwxxtj/Public/css/css.css" rel="stylesheet">
    <script src="/hwxxtj/Public/js/jquery-2.1.3.min.js"></script>
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
        <?php if(empty($schoolY)){ ?>
        <h1 style="text-align: center; margin-top: 100px;">暂无负责的项目</h1>
        <?php } else{ ?>
        <div class="weeks">
            <?php
 foreach($schoolY as $schoolYear){ if($schoolYear['term']==1) $t='上'; else $t='下'; if($schoolYear['schoolYear']!=$pro[0]['schoolYear'] || $schoolYear['term']!=$pro[0]['term']){ ?>
            <a href="/hwxxtj/index.php/Home/Index/proLead/<?php echo ($schoolYear['schoolYear']); ?>/<?php echo ($schoolYear['term']); ?>" class="week"><?php echo ($schoolYear['schoolYear']); ?>（<?php echo ($t); ?>）</a>
            <?php } else{ ?>
            <div class="week" style="border-color: #002a80; color: #002a80;"><?php echo ($schoolYear['schoolYear']); ?>（<?php echo ($t); ?>）</div>
            <?php } } ?>
        </div>
        <div class="weeks">
            <?php
 foreach($weeks as $week){ if($week['week']!=$pro[0]['week']){ ?>
            <a href="/hwxxtj/index.php/Home/Index/proLead/<?php echo ($pro[0]['schoolYear']); ?>/<?php echo ($pro[0]['term']); ?>/<?php echo ($week['week']); ?>" class="week"><?php echo ($week['week']); ?></a>
            <?php } else{ ?>
            <div class="week" style="border-color: #002a80; color: #002a80;"><?php echo ($week['week']); ?></div>
            <?php } } ?>
        </div>
        <div class="weeks">
            <?php
 foreach($pro as $proList){ if($proList['id']!=$proL['id']){ ?>
            <a href="/hwxxtj/index.php/Home/Index/proLead/<?php echo ($pro[0]['schoolYear']); ?>/<?php echo ($pro[0]['term']); ?>/<?php echo ($pro[0]['week']); ?>/<?php echo ($proList['id']); ?>" class="week"><?php echo ($proList['proName']); ?></a>
            <?php } else{ ?>
            <div class="week" style="border-color: #002a80; color: #002a80;"><?php echo ($proList['proName']); ?></div>
            <?php } } ?>
        </div>
        <?php if(!isset($wc)){ ?>
        <div class="pro_empty">
            <h3>加班统计表还未生成</h3>
            <a href="/hwxxtj/index.php/Home/Index/createTable/<?php echo ($proL['id']); ?>/">生成加班表</a>
        </div>
        <?php } else{ ?>

        <table cellspacing="0"  border="1" width="99.5%" id="proSetTable">
            <tr height="36">
                <td colspan="8" align="center"><h3><a href="/hwxxtj/index.php/Home/Excel/workExcel/<?php echo ($wc[0]['proId']); ?>" class="tableDown" target="_blank">点击下载</a></h3></td>
            </tr>
            <tr align="center">
                <td colspan="8" align="center"><h2>加班统计表</h2></td>
            </tr>
            <tr align="left">
                <td colspan="8" align="left"><h3>服务单位：<?php echo ($proL['unit']); ?></h3></td>
            </tr>
            <tr align="center">
                <th width="8%">日期</th>
                <th width="12%">地点</th>
                <th width="16%">加班时段</th>
                <th width="4%">加班时数</th>
                <th width="20%">加班内容</th>
                <th width="16">值班人员</th>
                <th width="20%">备注</th>
                <th width="4%">操作</th>
            </tr>
            <?php foreach($wc as $key => $work){ $User=M('User'); $worker=$User->where('id="'.$work['worker'].'"')->select(); ?>
            <form name="proLead" method="post" action="/hwxxtj/index.php/Home/Index/proLeadDeal/<?php echo ($work['id']); ?>">
            <tr align="center" class="showTr">
                <td><?php echo (date('Y-m-d',$work['useDate'])); ?></td>
                <td><?php echo ($work['place']); ?></td>
                <td><?php echo ($work['useTime']); ?></td>
                <td><?php echo ($work['workTime']); ?></td>
                <td><?php echo ($work['proName']); ?></td>
                <td><?php echo ($worker[0]['name']); ?></td>
                <td><?php echo ($work['remark']); ?></td>
                <td>
                    <button type="button" class="CB">修改</button>
                    <button type="submit" class="DB">删除</button>
                    <input type="hidden" name="operate" value="1">
                    <input type="hidden" name="url" value="/hwxxtj/index.php/Home/Index/proLead">
                </td>
            </tr>
            <tr align="center"  class="changeTr">
                <td><input name="useDate" class="time-txt" value="<?php echo (date('m/d/Y',$work['useDate'])); ?>"/></td>
                <td><textarea name="place"><?php echo ($work['place']); ?></textarea></td>
                <td><textarea name="useTime" class="setTime"><?php echo ($work['useTime']); ?></textarea></td>
                <td><textarea name="workTime"><?php echo ($work['workTime']); ?></textarea></td>
                <td><textarea name="proName"><?php echo ($work['proName']); ?></textarea></td>
                <td><?php echo ($worker[0]['name']); ?></td>
                <td><textarea name="remark"><?php echo ($work['remark']); ?></textarea></td>
                <td>
                    <button type="submit" class="changeSub">保存</button>
                </td>
            </tr>
            </form>
            <?php } ?>
        </table>
        <?php } } ?>
    </div>
    <div class="footer">会务信息统计系统 Copyright©<a href="http://www.quantacenter.com">2015Quanta</a></div>
<script src="/hwxxtj/Public/js/jquery.min.js"></script>
<script src="/hwxxtj/Public/js/setTime.js"></script>
<script src="/hwxxtj/Public/js/jquery-ui.min.js"></script>
<script src="/hwxxtj/Public/js/jqjs.js"></script>
    <script>
        $(document).ready(function(){
            proLead();
            textArea();
            proChange();
        });
    </script>
</div>
</body>
</html>