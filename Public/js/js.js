/**
 * Created by Administrator on 2015/3/12.
 */
function textArea(){
    var textArea=$('textarea');
    var td=textArea.closest('tr').height();
    textArea.css({
        'height':td+'px'
    });
    $('.device').height(0.3*td);
    $('.otherUnit').height(0.6*td);
    textArea.focus(function(){
        $(this).css('background','#c8ecf1');
    });
    textArea.focusout(function(){
        $(this).css('background','#ffffff');
    });

}
function check(){
    if(register.name.value==''){
        alert("用户名不能为空！请重新输入");
        register.name.focus();
        return false;
    }
    else if(register.number.value==''){
        alert("职工号不能为空！请重新输入");
        register.number.focus();
        return false;
    }
}
function change(){
    if(changeP.oldPassword.value==''){
        alert("原密码不能为空！请重新输入");
        changeP.oldPassword.focus();
        return false;
    }
    else if(changeP.newPassword.value==''){
        alert("新密码不能为空！请重新输入");
        changeP.newPassword.focus();
        return false;
    }
    else if(changeP.rePassword.value==''){
        alert("重输密码框不能为空！请重新输入");
        changeP.rePassword.focus();
        return false;
    }
    else if(changeP.newPassword.value!=changeP.rePassword.value){
        alert("两次新密码输入不一致！请重新输入");
        changeP.newPassword.value=changeP.rePassword.value='';
        changeP.newPassword.focus();
        return false;
    }
}

function weekCheck(){
    if(proAdd.schoolYear.value==''){
        alert('学年不能为空');
        proAdd.week.focus();
        return false;
    }
    if(proAdd.term.value==''){
        alert('学期不能为空');
        proAdd.week.focus();
        return false;
    }
    if(proAdd.week.value==''){
        alert('周数不能为空');
        proAdd.week.focus();
        return false;
    }
    if(proAdd.proName.value==''){
        alert('项目名称不能为空');
        proAdd.week.focus();
        return false;
    }
    var time=document.getElementById('useTime');
    var status=0;
    for(var j=0;j<time.value.length;j++){
        if(time.value.charCodeAt(j)>255){
            alert('“使用时间”含有中文或中文符号（例如：），格式不符合！');
            return false;
        }
        if(time.value.charAt(j)=='-') status=1;
    }
    if(status==0){
        alert('请两个时间段点，并用“-”隔开！例如（08:00-17:00）');
        return false;
    }
    var people=document.getElementsByName('people[]');
    var captain=document.getElementsByName('captain');
    var a=0;
    for(var i=0; i < people.length;i++){
        if(people[i].checked==true && captain[i].checked==true){
            alert('队长不必在人员中勾选！请消除');
            return false;
        }
        if(captain[i].checked==true){
            a=1;
        }
    }
    if(a==0){
        alert('你没有选择负责人！');
        return false;
    }
}

function select(){
    var obj=document.getElementById('otherUnit');
    var sel=document.getElementById('sel');
    if(sel.value=="自填"){
        obj.style.display='block';
    }
    else{
        obj.style.display='none';
    }
}

function eachSelect() {
    var obj = $('.otherUnit');
    var sel = $('.sel');
    sel.each(function (index) {
        if (sel.eq(index).val() == '自填') {
            obj.eq(index).show();
        }
        else {
            obj.eq(index).hide();
        }
    });
}
function proSet(){
    var tr=$('tr');
    var obj=$('.otherUnit');
    var sel=$('.sel');
    tr.eq(3).height(tr.eq(2).height());
    tr.eq(6).height(tr.eq(5).height());
    sel.each(function(index){
       if(sel.eq(index).val()=='请选择'){
           sel.eq(index).val('自填');
           obj.eq(index).show();
       }
    });
    $('.changeSub').click(function(){
       var time= $(this).closest('tr').find('textarea[name=useTime]');
       var status=0;
        for(var j=0;j<time.val().length;j++){
            if(time.val().charCodeAt(j)>255){
                alert('“使用时间”含有中文或中文符号（例如：），格式不符合！');
                return false;
            }
            if(time.val().charAt(j)=='-') status=1;
        }
        if(status==0){
            alert('请两个时间段点，并用“-”隔开！例如（08:00-17:00）');
            return false;
        }
    });
}
function proChange(){
    $('.special1  .button1').click(function(){
        $('.special2').show();
        $('.special1').hide();
        $('.changeTr').hide();
        $('.showTr').show();
    });
    var db=$('.DB');
    var cb=$('.CB');
    db.click(function(){
        $(this).next().val(0);
    });
    cb.click(function(){
        $('.changeTr').show();
        $('.showTr').hide();
        $(this).closest('tr').hide();
        $(this).closest('tr').next().show();
        $('.special1').show();
        $('.special2').hide();
    });

}
function proLead(){
    var tr=$('tr');
    var obj=$('.otherUnit');
    var sel=$('.sel');
    sel.each(function(index){
        if(sel.eq(index).val()=='请选择'){
            sel.eq(index).val('自填');
            obj.eq(index).show();
        }
    });
    $('.changeSub').click(function(){
        var time= $(this).closest('tr').find('textarea[name=useTime]');
        var status=0;
        for(var j=0;j<time.val().length;j++){
            if(time.val().charCodeAt(j)>255){
                alert('“使用时间”含有中文或中文符号（例如：），格式不符合！');
                return false;
            }
            if(time.val().charAt(j)=='-') status=1;
        }
        if(status==0){
            alert('请两个时间段点，并用“-”隔开！例如（08:00-17:00）');
            return false;
        }
    });
}
function indexTable(){
    $('tr:odd').css('backgroundColor','#dddddd');
    $('tr:even').css('backgroundColor','#66CCFF');
    $('tr#title').css({
        'backgroundColor':'lightsalmon'
    });
    $('tr#title td').css('borderLeft','0');
}
