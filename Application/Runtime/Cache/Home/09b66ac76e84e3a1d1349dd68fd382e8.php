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
            <a href="/hwxxtj/index.php/Home/Index/proSet/<?php echo ($schoolYear['schoolYear']); ?>/<?php echo ($schoolYear['term']); ?>" class="week"><?php echo ($schoolYear['schoolYear']); ?>（<?php echo ($t); ?>）</a>
            <?php } else{ ?>
            <div class="week" style="border-color: #002a80; color: #002a80;"><?php echo ($schoolYear['schoolYear']); ?>（<?php echo ($t); ?>）</div>
            <?php } } ?>
        </div>
       <div class="weeks">
           <?php
 foreach($weeks as $week){ if($week['week']!=$pro[0]['week']){ ?>
                <a href="/hwxxtj/index.php/Home/Index/proSet/<?php echo ($pro[0]['schoolYear']); ?>/<?php echo ($pro[0]['term']); ?>/<?php echo ($week['week']); ?>" class="week"><?php echo ($week['week']); ?></a>
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
            <form method="post" action="/hwxxtj/index.php/Home/Index/proSetDeal1/<?php echo ($pro[0]['schoolYear']); ?>/<?php echo ($pro[0]['term']); ?>/<?php echo ($pro[0]['week']); ?>">
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
                <td width="4%">操作</td>
            </tr>
            <tr align="center"  class="special1">
                <td></td>
                <td></td>
                <td><?php echo ($special['proName']); ?></td>
                <td colspan="4"><?php echo ($special['part5']); ?></td>
                <td colspan="2"><?php echo ($special['people']); ?></td>
                <td><?php echo ($special['place']); ?></td>
                <td><?php echo ($special['remark']); ?></td>
                <td>
                    <button type="button" class="button1">修改</button>
                </td>
            </tr>
            <tr align="center"  class="special2">
                <td></td>
                <td></td>
                <td><textarea name="proName"><?php echo ($special['proName']); ?></textarea></td>
                <td colspan="4"><textarea name="part5"><?php echo ($special['part5']); ?></textarea></td>
                <td colspan="2"><textarea name="people"><?php echo ($special['people']); ?></textarea></td>
                <td><textarea name="place"><?php echo ($special['place']); ?></textarea></td>
                <td><textarea name="remark"><?php echo ($special['remark']); ?></textarea></td>
                <td>
                    <button type="submit">保存</button>
                </td>
            </tr>
            </form>
            <?php foreach($pro as $proj){ $User=M('User'); $captain=$User->where('id='.$proj['captain'])->field('name')->select(); $captain=$captain[0]['name']; if($proj['people']=='null'){ $people='无'; $peo=null; } else{ $peo=json_decode($proj['people']); foreach($peo as $key=>$p){ $peop=$User->where('id='.$p)->field('name')->select(); if($key==0) $people=$peop[0]['name']; else $people.="、".$peop[0]['name']; } } ?>
            <form method="post" name="change" action="/hwxxtj/index.php/Home/Index/proSetDeal2/<?php echo ($proj['id']); ?>">
            <tr align="center" class="showTr">
                <td><?php echo (date('Y-m-d',$work['doneTime'])); ?></td>
                <td><?php echo ($proj['unit']); ?></td>
                <td><?php echo ($proj['proName']); ?></td>
                <td><?php echo ($proj['useDate']); ?></td>
                <td><?php echo (date('Y-m-d',$work['useDate'])); ?></td>
                <td><?php echo ($proj['tel']); ?></td>
                <td><?php echo ($proj['device']); ?></td>
                <td><?php echo ($people); ?></td>
                <td><?php echo ($captain); ?></td>
                <td><?php echo ($proj['place']); ?></td>
                <td><?php echo ($proj['remark']); ?></td>
                <td>
                    <button type="button" class="CB">修改</button>
                    <button type="submit" class="DB">删除</button>
                    <input type="hidden" name="operate" value="1">
                </td>
            </tr>
            <tr  align="center" class="changeTr">
                <td><input name="doneTime" class="time-txt" value="<?php echo (date('m/d/Y',$work['doneTime'])); ?>"/></td>
                <td>
                    <select name="unit" class="sel" onchange="eachSelect()">
                        <option value="请选择">请选择</option>
                        <option value="自填">自填</option>
                        <?php foreach($unit as $u){ if($u['name']==$proj['unit']){ ?>
                             <option value="<?php echo ($u['name']); ?>" selected="selected"><?php echo ($u['name']); ?></option>

                        <?php } else { ?>
                            <option value="<?php echo ($u['name']); ?>" ><?php echo ($u['name']); ?></option>
                         <?php } } ?>
                    </select>
                    <textarea name="otherUnit" class="otherUnit"><?php echo ($proj['unit']); ?></textarea>
                </td>
                <td><textarea name="proName"><?php echo ($proj['proName']); ?></textarea></td>
                <td><input name="useDate" class="time-txt" value="<?php echo (date('m/d/Y',$work['useDate'])); ?>"/></td>
                <td><textarea name="useTime" class="setTime"><?php echo ($proj['useTime']); ?></textarea></td>
                <td><textarea name="tel"><?php echo ($proj['tel']); ?></textarea></td>
                <td>
                    <textarea name="device"><?php echo ($proj['device']); ?></textarea>
                </td>
                <td align="left">
                    <?php $i=0; foreach($member as $people){ ?>
                    <span style="margin-left: 10px;"><input type="checkbox" name="people[]" <?php if($people['id']==$peo[$i]){ ?> checked <?php $i+=1; } ?> value="<?php echo ($people['id']); ?>"><?php echo ($people['name']); ?></span><br/>
                    <?php } ?>
                </td>
                <td align="left">
                    <?php foreach($cap as $people){ ?>
                    <span style="margin-left: 10px;"><input type="radio" name="captain" <?php if($people['id']==$proj['captain']) echo 'checked'; ?> value="<?php echo ($people['id']); ?>"><?php echo ($people['name']); ?></span><br/>
                    <?php } ?>
                </td>
                <td><textarea name="place"></textarea></td>
                <td><textarea name="remark"></textarea></td>
                <td>
                    <button type="submit" class="changeSub">保存</button>
                </td>
            </tr>
            </form>
            <?php } ?>
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