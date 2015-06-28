<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>会务信息统计系统--项目管理</title>
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
            <h1 style="text-align: center; margin-top: 100px;">暂无无项目</h1>
         <?php } else{ ?>
        <div class="weeks">
            <?php
 foreach($schoolY as $schoolYear){ if($schoolYear['term']==1) $t='上'; else $t='下'; if($schoolYear['schoolYear']!=$pro[0]['schoolYear'] || $schoolYear['term']!=$pro[0]['term']){ ?>
            <a href="/hwxxtj/index.php/Home/Index/countTime/<?php echo ($schoolYear['schoolYear']); ?>/<?php echo ($schoolYear['term']); ?>" class="week"><?php echo ($schoolYear['schoolYear']); ?>（<?php echo ($t); ?>）</a>
            <?php } else{ ?>
            <div class="week" style="border-color: #002a80; color: #002a80;"><?php echo ($schoolYear['schoolYear']); ?>（<?php echo ($t); ?>）</div>
            <?php } } ?>
        </div>
       <div class="weeks">
           <?php
 foreach($weeks as $week){ if($week['week']!=$pro[0]['week']){ ?>
                <a href="/hwxxtj/index.php/Home/Index/countTime/<?php echo ($pro[0]['schoolYear']); ?>/<?php echo ($pro[0]['term']); ?>/<?php echo ($week['week']); ?>" class="week"><?php echo ($week['week']); ?></a>
           <?php } else{ ?>
                <div class="week" style="border-color: #002a80; color: #002a80;"><?php echo ($week['week']); ?></div>
           <?php } } ?>
       </div>
        <table cellspacing="0"  border="1" width="99.5%" id="proSetTable">
            <tr height="20">
                <td colspan="12"></td>
            </tr>
            <tr align="center">
                <?php
 if($proj[0]['term']==1) $term='上半学期'; else $term='下半学期'; ?>
                <td colspan="12" align="center"><h2>工作安排登记表（<?php echo ($pro[0]['schoolYear']); ?>学年<?php echo ($term); ?>第 <?php echo ($pro[0]['week']); ?> 周）</h2></td>
            </tr>
            <tr>
                <th>日期</th>
                <th>单位</th>
                <th>使用地点</th>
                <th>地点时间</th>
                <th>录像时间</th>
            </tr>
            <?php if(is_array($pro)): $i = 0; $__LIST__ = $pro;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                    <td align="center"><?php echo (date('Y-m-d',$vo['useDate'])); ?></td>
                    <td align="center"><?php echo ($vo['unit']); ?></td>
                    <td align="center"><?php echo ($vo['place']); ?></td>
                    <td align="center">
                        <?php
 $t=explode('-',$vo['useTime']); $c=strtotime($t[1])-strtotime($t[0]); $ti=substr(($c/3600),0,5).'小时'; echo $ti; ?>
                    </td>
                    <td align="center">
                        <?php
 if(stristr($vo['device'],'录像')!=''){ echo $ti; } else{ echo '无'; } ?>
                    </td>
                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </table>
     <?php } ?>
    </div>
    <script>
        $(document).ready(function(){
            proSet();
            proChange();
            textArea();
        });
    </script>
    <div class="footer">会务信息统计系统 Copyright©<a href="http://www.quantacenter.com">2015Quanta</a></div>
<script src="/hwxxtj/Public/js/jquery.min.js"></script>
<script src="/hwxxtj/Public/js/setTime.js"></script>
<script src="/hwxxtj/Public/js/jquery-ui.min.js"></script>
<script src="/hwxxtj/Public/js/jqjs.js"></script>
</div>
</body>
</html>