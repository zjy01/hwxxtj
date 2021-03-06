<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>会务信息统计系统</title>
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
        <form method="post" action="/hwxxtj/index.php/Home/Index/proAddDeal" name="proAdd">
            <?php
 if(date('m')<=8){ $schoolYear=(date('20y')-1)."-".date('20y'); $term=2; } else{ $schoolYear=date('20y')."-".(date('20y')+1); $term=1; } ?>
            <table cellspacing="0"  border="1" width="99.5%">
                <tr height="20">
                    <td colspan="11"></td>
                </tr>
                <tr align="center">
                    <td colspan="11" align="center"><h2>工作安排登记表（<input type="text" name="schoolYear" value="<?php echo ($schoolYear); ?>" size="10">学年
                        <select name="term">
                            <option value="1" <?php if( $term==1 ) { ?> selected = "selected" <?php } ?> >上半学期</option>
                            <option value="2" <?php if( $term==2 ) { ?> selected = "selected" <?php } ?>>下半学期</option>
                        </select>
                        第 <input type="text" name="week" size="2" value="<?php echo ($week); ?>"> 周）</h2></td>
                </tr>

                <tr  align="center">
                    <td width="4.06%">收单时间</td>
                    <td width="5.69%">单位</td>
                    <td width="11.38%">项目名称</td>
                    <td width="6.91%">使用日期</td>
                    <td width="7.31%">使用时间（起止）</td>
                    <td width="10.16%">联系人/联系电话</td>
                    <td width="10.97%">使用设备</td>
                    <td width="9%">负责人</td>
                    <td width="9%">人员(除负责人)</td>
                    <td width="13%">地点</td>
                    <td width="11.58%">备注</td>
                </tr>
                <tr  align="center">
                    <td width="4.06%"><input name="doneTime" class="time-txt"/></td>
                    <td width="5.69%">
                        <select name="unit" id="sel" onchange="select()">
                            <option value="请选择">请选择</option>
                            <option value="自填">自填</option>
                            <?php foreach($unit as $u){ ?>
                            <option value="<?php echo ($u['name']); ?>"><?php echo ($u['name']); ?></option>
                            <?php } ?>
                        </select>
                        <textarea name="otherUnit" class="otherUnit"></textarea>
                    </td>
                    <td width="11.38%"><textarea name="proName"></textarea></td>
                    <td width="6.91%"><input name="useDate" class="time-txt" /></td>
                    <td width="7.31%"><textarea name="useTime" id="useTime" class="setTime"></textarea></td>
                    <td width="10.16%"><textarea name="tel"></textarea></td>
                    <td width="10.97%" align="left">
                        <span style="margin-left: 10px;"><input type="checkbox" name="device[]" value="音响">音响</span><br/>
                        <span style="margin-left: 10px;"><input type="checkbox" name="device[]" value="录像">录像</span><br/>
                        <span style="margin-left: 10px;"><input type="checkbox" name="device[]" value="投影机">投影机</span><br/>
                        <span style="margin-left: 10px;"><input type="checkbox" name="device[]" value="无线麦克风">无线麦克风</span><br/>
                        <span style="margin-left: 10px;"><input type="checkbox" name="device[]" value="有线麦克风">有线麦克风</span><br/>
                        <textarea name="device[]" class="device" placeholder="其他更多"></textarea>
                    </td>
                    <td width="9%" align="left">
                        <?php foreach($captain as $people1){ ?>
                        <span style="margin-left: 10px;"><input type="radio" name="captain" value="<?php echo ($people1['id']); ?>"><?php echo ($people1['name']); ?></span><br/>
                        <?php } ?>
                    </td>
                    <td width="9%" align="left">
                        <?php foreach($people as $people){ ?>
                           <span style="margin-left: 10px;"><input type="checkbox" name="people[]" value="<?php echo ($people['id']); ?>"><?php echo ($people['name']); ?></span><br/>
                        <?php } ?>
                    </td>
                    <td width="13%">
                        <select name="place" class="selP" onchange="placeSelect(this)">
                            <option value="">请选择</option>
                            <option value="自填">自填</option>
                            <option value="大会堂">大会堂</option>
                            <option value="B8报告厅">B8报告厅</option>
                            <option value="八角楼">八角楼</option>
                            <option value="小剧场">小剧场</option>
                            <option value="行政楼103">行政楼103</option>
                            <option value="图书馆报告厅">图书馆报告厅</option>
                            <option value="E409">E409</option>
                        </select>
                        <textarea class="area"></textarea>
                    </td>
                    <td width="11.58%">
                        <textarea name="remark"></textarea>
                    </td>
                </tr>
                <tr align="center" height="30">
                    <td colspan="11"> <input type="submit" value="提交" style="width:50px;" onclick="return weekCheck()"></td>
                </tr>
            </table>
        </form>
    </div>

    <Script>
        textArea();
    </Script>
    <div class="footer">会务信息统计系统 Copyright©<a href="http://www.quantacenter.com">2015Quanta</a></div>
<script src="/hwxxtj/Public/js/jquery.min.js"></script>
<script src="/hwxxtj/Public/js/setTime.js"></script>
<script src="/hwxxtj/Public/js/jquery-ui.min.js"></script>
<script src="/hwxxtj/Public/js/jqjs.js"></script>
</div>
</body>
</html>