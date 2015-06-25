<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
	public function _initialize(){
		header("Content-Type:text/html;charset=utf-8");//编码处理
    	date_default_timezone_set('PRC');
		$thisUrl=__SELF__;
		$login=U('login');
		$loginVerify=U('loginVerify');
		$logout=U('logout');
		if (session('name')==null && $thisUrl!=$login && $thisUrl!=$loginVerify && $thisUrl!=$logout && $thisUrl) {
			echo "<script>location='".U('login')."'</script>";
		}
		else{
        	$this->assign('user',session());
		}
	}
    public function login(){
    	$this->display();
    } 
    public function loginVerify(){
    	$message=I('post.');
        $User=M("User");
        $number=$message['number'];
        if($UM=$User->where('number="'.$number.'"')->select()){
        	if ($UM[0]['password']==md5($message['password'])) {
        		session('id',$UM[0]['id']);
        		session('name',$UM[0]['name']);
        		session('number',$UM[0]['number']);
        		session('rank',$UM[0]['rank']);
        		echo "<script>location='".U("index")."'</script>";
        	}
        	else{
        		echo "<script>alert('密码错误，请重新输入');location='".U('login')."'</script>";
        	}
        }
        else{
        	echo "<script> alert('职工号不存在，请检查后再输入'); location='".U('login')."'</script>";
        }

    }
    public function logout(){
    	session(null);
		echo "<script>location='".U('login')."'</script>";

    }

    public function index(){
    	$pro=M('Schedule');
    	$special=M('Special');

    	$Y=$pro->distinct(true)->order('schoolYear,term asc')->field('schoolYear,term')->select();
		$W=$pro->distinct(true)->where('schoolYear="'.$Y[count($Y)-1]['schoolYear'].'" and term="'.$Y[count($Y)-1]['term'].'"')->field('week')->order('week asc')->select();
		$message=$pro->where('week="'.$W[count($W)-1]['week'].'" and schoolYear="'.$Y[count($Y)-1]['schoolYear'].'" and term="'.$Y[count($Y)-1]['term'].'"')->select();
		$sp=$special->where('week="'.$W[count($W)-1]['week'].'" and schoolYear="'.$Y[count($Y)-1]['schoolYear'].'" and term="'.$Y[count($Y)-1]['term'].'"')->select();

		$array['pro']=$message;
		$array['special']=$sp[0];
		$this->assign($array);
        $this->display();
    }
    public function userSet(){
    	$User=M('User');
    	$UM=$User->where('id!=1')->select();

    	$this->assign('users',$UM);
        $this->display();
    }
    public function userAdd(){
    	$User=M('User');

    	if ($User->where('number="'.$_POST['number'].'"')->select()) {
    		echo "<script>alert('本职工号已被注册'); history.back();</script>";
    	}
    	$data['name']=$_POST['name'];
    	$data['number']=$_POST['number'];
       	$data['password']=md5(111111);
    	$data['rank']=1;

    	$User->add($data);

    	header('Refresh:1;url='.U('userSet'));
    	echo "<span style='margin-top:100px;font-size:50px;text-align:center; display:block;'>:) 用户创建成功！</span>";
    }
    public function userDel(){
    	$del=$_POST['del'];

    	header('Refresh:2;url='.U('userSet'));

    	if(empty($del)){
    		echo "没有删除任何用户";
    	}
    	else{
    		$User=M("User");
	    	foreach($del as $id){
	    		$mes=$User->where('id='.$id)->select();
	    		black;
	    		if($User->where('id='.$id)->delete()){
	    			echo "<h4>成功删除 <span style='color:red;'>".$mes[0]['name']." ".$mes[0]['number']."</span></h4>";
	    		}
	    		else{
	    			echo "<h4>!!!!此记录删除失败 <span style='color:red;'>".$mes[0]['name']." ".$mes[0]['number']."</span></h4>";
	    		}
	    	}
    	}
    }
    public function password(){
    	$this->display();
    }
    public function userChange(){
    	$oldP=$_POST['oldPassword'];
    	$newP=$_POST['newPassword'];
    	$id=session('id');

    	$User=M("User");
    	$ps=$User->where('id='.$id)->getField('password');
    	if ($ps==md5($oldP)) {
    		if($User->where('id='.$id)->setField('password',md5($newP))){

    			header('Refresh:1;url='.U('login'));
    			session(null);
    			echo "<h3>密码修改成功，将跳转到登录界面</h3>";
    		}
    		else{
    			header('Refresh:1;url='.U('password'));
    			echo "<h3>密码修改失败</h3>";
    		}
    	}
    	else{
    		header('Refresh:0;url='.U('password'));
    		echo "<script>alert('原密码输入错误，无法修改密码!');</script></h3>";
    	}

    	$newP=$_POST['newPassword'];
    }
    public function proAdd(){
    	$User=M('User');
    	$pro=M('Schedule');
    	$unit=M('Unit')->select();
    	$array['unit']=$unit;

    	$UM=$User->where('id!=1')->select();
    	$array['people']=$UM;
    	$array['captain']=$UM;

    	$PM=$pro->field('week')->order('id desc')->select();
    	$array['week']=$PM[0]['week'];
    	$this->assign($array);
    	$this->display();
    }

    public function proAddDeal()
    {
        $pro = M('Schedule');
        $special = M('Special');

        $message = I('post.');

    	if ($message['unit']=='自填') {
    		$message['unit']=$message['otherUnit'];
    	}
    	elseif ($message['unit']=='请选择') {
    		$message['unit']='';
    	}
    	$schoolYear=$message['schoolYear'];
    	$term=$message['term'];
    	$week=$message['week'];
        $device='';
        foreach($message['device'] as $key=>$de){
            if($key==0){
                $device=$de;
            }
            else{
                $device.='、'.$de;
            }
        }
        $message['device']=$device;
    	if($special->where('schoolYear="'.$schoolYear.'" and term="'.$term.'" and week="'.$week.'"')->select()) ;
    	else{
    		$data['part1']="请大家做好安全工作，做好工作日志,在星期一交带签名的上星期的安全检查表，本周安全监督员：王淑芬";
    		$data['part2']="实验室开放，请大家锁好门窗、做好设备清单登记、日志登记、做好安全防火工作";
    		$data['part3']="梁俏/康翔可联系勤工俭学的学生参加，排在前面两位布场需要到场，布场最多不超过3人，实验室人员一般情况下是在5点下课以后到场";
    		$data['part4']="请做好大会堂、报告厅的活动使用情况登记，如有问题，请及时汇报";
    		$data['part5']="请大家继续做好安全工作，安全排查不能放松。每周二上午9:30安全大检查";
    		$data['proName']="注意电器漏电、防火，不要松懈、安全检查";
    		$data['people']="科室全体人员";
    		$data['place']="实验楼";
    		$data['remark']="黄伟波、孟令春到各实验室检查安全情况";
    		$data['schoolYear']=$schoolYear;
    		$data['term']=$term;
    		$data['week']=$week;

    		$special->add($data);
    	}

    	$message['people']=json_encode($message['people']);
    	unset($message['otherUnit']);
    	$pro->add($message);
    	header('Refresh:1;url='.U('proAdd'));
    	echo "<span style='margin-top:100px;font-size:50px;text-align:center; display:block;'>:) 项目创建成功！</span>";
    }
    public function proSet($schoolYear=0,$term=0,$week=0){
    	$pro=M('Schedule');
    	$special=M('Special');
    	$unit=M('Unit')->select();
    	$array['unit']=$unit;
    	$User=M('User');
    	$UM=$User->where('id!=1')->select();
    	$array['member']=$UM;
    	$array['cap']=$UM;

    	$Y=$pro->distinct(true)->order('schoolYear,term asc')->field('schoolYear,term')->select();
    	if ($schoolYear==0 && $term==0 && $week==0) {
    		$W=$pro->distinct(true)->where('schoolYear="'.$Y[count($Y)-1]['schoolYear'].'" and term="'.$Y[count($Y)-1]['term'].'"')->field('week')->order('week asc')->select();
    		$message=$pro->where('week="'.$W[count($W)-1]['week'].'" and schoolYear="'.$Y[count($Y)-1]['schoolYear'].'" and term="'.$Y[count($Y)-1]['term'].'"')->select();
    	}
    	elseif ($term!=0 && $week==0) {
    		$W=$pro->distinct(true)->where('schoolYear="'.$schoolYear.'" and term="'.$term.'"')->field('week')->select();
    		$message=$pro->where('week="'.$W[count($W)-1]['week'].'" and schoolYear="'.$schoolYear.'" and term="'.$term.'"')->select();
    	}
    	else{
    		$W=$pro->distinct(true)->where('schoolYear="'.$schoolYear.'" and term="'.$term.'"')->field('week')->select();
    		$message=$pro->where('week="'.$week.'" and schoolYear="'.$schoolYear.'" and term="'.$term.'"')->select();
    	}

    	$sp=$special->where('week="'.$message[0]['week'].'" and schoolYear="'.$message[0]['schoolYear'].'" and term="'.$message[0]['term'].'"')->select();
    	$array['weeks']=$W;
    	$array['schoolY']=$Y;
    	$array['pro']=$message;
    	$array['special']=$sp[0];

    	$this->assign($array);
    	$this->display();

    }

    function proSetDeal1($schoolYear,$term,$week){
    	$special=M('Special');
    	$po=I('post.');

        $special->add($po);
    	$special->where('week="'.$week.'" and schoolYear="'.$schoolYear.'" and term="'.$term.'"')->save($po);

    	header('Refresh:1;url='.U('proSet'));
    	echo "<span style='margin-top:100px;font-size:50px;text-align:center; display:block;'>:) 项目修改成功！</span>";

    }
    function proSetDeal2($proId){
    	$pro=M('Schedule');

    	$message=I('post.');
    	if($message['operate']==1){
    		if ($message['unit']=='自填') {
    			$message['unit']=$message['otherUnit'];
	    	}
	    	elseif ($message['unit']=='请选择') {
	    		$message['unit']='';
	    	}
	    	$schoolYear=$message['schoolYear'];
	    	$term=$message['term'];
	    	$week=$message['week'];

	    	$message['people']=json_encode($message['people']);
	    	unset($message['otherUnit']);

	    	header('Refresh:1;url='.U('proSet'));
	    	if($pro->where('id='.$proId)->save($message)){

	    	echo "<span style='margin-top:100px;font-size:50px;text-align:center; display:block;'>:) 项目修改成功！</span>";
	    	}
	    	else{

	    	echo "<span style='margin-top:100px;font-size:50px;text-align:center; display:block;'>:(项目修改成功！</span>";
	    	}
    	}
    	else{
    		
	    	header('Refresh:1;url='.U('proSet'));
    		if($pro->where('id='.$proId)->delete()){

	    	echo "<span style='margin-top:100px;font-size:50px;text-align:center; display:block;'>:) 项目删除成功！</span>";
    		}
    		else{

	    	echo "<span style='margin-top:100px;font-size:50px;text-align:center; display:block;'>:( 项目删除失败！请重试</span>";
    		}
    	}
    }
    function proLead($schoolYear=0,$term=0,$week=0,$proId=-1){
    	$pro=M('Schedule');
    	// 生成导航
    	if (session('rank')==0) {
    		$Y=$pro->distinct(true)->order('schoolYear,term asc')->field('schoolYear,term')->select();
	    	if ($schoolYear==0 && $term==0 && $week==0) {
	    		$W=$pro->distinct(true)->where('schoolYear="'.$Y[count($Y)-1]['schoolYear'].'" and term="'.$Y[count($Y)-1]['term'].'"')->field('week')->order('week asc')->select();
	    		$message=$pro->where('week="'.$W[count($W)-1]['week'].'" and schoolYear="'.$Y[count($Y)-1]['schoolYear'].'" and term="'.$Y[count($Y)-1]['term'].'"')->select();
	    	}
	    	elseif ($term!=0 && $week==0) {
	    		$W=$pro->distinct(true)->where('schoolYear="'.$schoolYear.'" and term="'.$term.'"')->field('week')->select();
	    		$message=$pro->where('week="'.$W[count($W)-1]['week'].'" and schoolYear="'.$schoolYear.'" and term="'.$term.'"')->select();
	    	}
	    	else{
	    		$W=$pro->distinct(true)->where('schoolYear="'.$schoolYear.'" and term="'.$term.'"')->field('week')->select();
	    		$message=$pro->where('week="'.$week.'" and schoolYear="'.$schoolYear.'" and term="'.$term.'"')->select();
	    	}
	    	if($proId==-1){
	    		$proL=$pro->where('id="'.$message[count($message)-1]['id'].'"')->select();
	    	}
	    	else{
	    		$proL=$pro->where('id="'.$proId.'"')->select();
	    	}
    	}
        else{
            $userId=session('id');
            $Y=$pro->distinct(true)->where('captain="'.$userId.'"')->order('schoolYear,term asc')->field('schoolYear,term')->select();
            if ($schoolYear==0 && $term==0 && $week==0) {
                $W=$pro->distinct(true)->where('schoolYear="'.$Y[count($Y)-1]['schoolYear'].'" and term="'.$Y[count($Y)-1]['term'].'"')->field('week')->order('week asc')->select();
                $message=$pro->where('week="'.$W[count($W)-1]['week'].'" and schoolYear="'.$Y[count($Y)-1]['schoolYear'].'" and term="'.$Y[count($Y)-1]['term'].'"')->select();
            }
            elseif ($term!=0 && $week==0) {
                $W=$pro->distinct(true)->where('schoolYear="'.$schoolYear.'" and term="'.$term.'" and captain="'.$userId.'"')->field('week')->select();
                $message=$pro->where('week="'.$W[count($W)-1]['week'].'" and schoolYear="'.$schoolYear.'" and term="'.$term.'" and captain="'.$userId.'"')->select();
            }
            else{
                $W=$pro->distinct(true)->where('schoolYear="'.$schoolYear.'" and term="'.$term.'" and captain="'.$userId.'"')->field('week')->select();
                $message=$pro->where('week="'.$week.'" and schoolYear="'.$schoolYear.'" and term="'.$term.'" and captain="'.$userId.'"')->select();
            }
            if($proId==-1){
                $proL=$pro->where('id="'.$message[count($message)-1]['id'].'"')->select();
            }
            else{
                $proL=$pro->where('id="'.$proId.'"')->select();
            }
        }

    	// 加班统计
    	$work=M('Workcount');
    	if ($wc=$work->where('proId="'.$proL[0]['id'].'"')->select()) {
    		$array['wc']=$wc;
    	}
        $unit=M('Unit')->select();
        $array['unit']=$unit;
    	$array['schoolY']=$Y;
    	$array['weeks']=$W;
    	$array['pro']=$message;
    	$array['proL']=$proL[0];
    	$this->assign($array);
    	$this->display();
    }

    function createTable($proId){
    	$wc=M('Workcount');
    	$pro=M('Schedule');

    	$message=$pro->where('id="'.$proId.'"')->select();
    	$w['proId']=$message[0]['id'];
        $w['useDate']=$message[0]['useDate'];
        $w['place']=$message[0]['place'];
    	$today=date('w',strtotime($w['useDate']));
    	if($today==0 || $today==6){
    		$w['useTime']=$message[0]['useTime'];
    	}
    	else{
//            $message[0]['useTime']=$time;
	    	$time=explode('-', $message[0]['useTime']);
            $time0=strtotime($time[0]);
            $time1=strtotime($time[1]);
            $time12=strtotime('12:00');
            $time14=strtotime('14:00');
            $time17=strtotime('17:30');
	    	if(($time0<=$time12 && $time1<=$time12) || ($time0>=$time14 && $time1<=$time17)){
	    		$w['useTime']='无';
	    	}
	    	elseif($time0<=$time12 && $time1<=$time14){
	    		$w['useTime']='12:00-'.$time[1];
	    	}
	    	elseif($time0>=$time12 && $time1<=$time17){
	    		$w['useTime']=$time[0].'-14:00';
	    	}
	    	elseif(($time0>$time12 && $time1<$time14) ||  $time0>=$time17){
	    		$w['useTime']=$message[0]['useTime'];
	    	}
	    	elseif ($time0>=$time12 && $time0<$time14 && $time1>$time17) {
	    		$w['useTime']=$time[0].'-14:00,17:30-'.$time[1];
	    	}
            elseif($time0<=$time12 && $time1>$time17){
                $w['useTime']='12:00-14:00,17:30-'.$time[1];
            }
	    	elseif($time0>$time14 && $time1>$time17){
	    		$w['useTime']='17:30-'.$time[1];
	    	}
	    	else{
	    		$w['useTime']='12:00-14:00';
	    	}
    	}
    	$w['proName']=$message[0]['proName'];
    	if($w['useTime']!='无'){
    		$interval=explode(',', $w['useTime']);
    		$workTime=0;
    		foreach ($interval as $key => $value) {
    			$time=explode('-', $value);
    			$BT=strtotime($time[0]);
    			$LT=strtotime($time[1]);
    			$workTime+=(($LT-$BT)/3600);
    		}
    	}
    	else{
    		$workTime=0;
    	}
    	$workTime=number_format($workTime,1);
//    	 echo '上班时间：'.$message[0]['useTime'].'<br/>';
//    	 echo '加班时间：'.$w['useTime'].'<br/>';
//    	 echo '加班时数：'.$workTime;
    	$w['workTime']=$workTime;
    	$w['worker']=$message[0]['captain'];
    	$wc->add($w);
    	$people=json_decode($message[0]['people']);
    	foreach ($people as $key => $value) {
    		$w['worker']=$value;
    		$wc->add($w);
    	}
    	echo "<script>self.location=document.referrer;</script>";
    }
    function proLeadDeal($workId){
        $wc=M('Workcount');

        $message=I('post.');
        if($message['operate']==1){
            if ($message['unit']=='自填') {
                $message['unit']=$message['otherUnit'];
            }
            elseif ($message['unit']=='请选择') {
                $message['unit']='';
            }
            unset($message['otherUnit']);

            header('Refresh:1;url='.$message['url']);
            if($wc->where('id='.$workId)->save($message)){

                echo "<span style='margin-top:100px;font-size:50px;text-align:center; display:block;'>:) 项目修改成功！</span>";
            }
            else{

                echo "<span style='margin-top:100px;font-size:50px;text-align:center; display:block;'>:(项目修改成功！</span>";
            }
        }
        else{

            header('Refresh:1;url='.$message['url']);
            if($wc->where('id='.$workId)->delete()){

                echo "<span style='margin-top:100px;font-size:50px;text-align:center; display:block;'>:) 项目删除成功！</span>";
            }
            else{

                echo "<span style='margin-top:100px;font-size:50px;text-align:center; display:block;'>:( 项目删除失败！请重试</span>";
            }
        }
    }

    function proJoin($schoolYear=0,$term=0,$week=0,$proId=-1){
        $pro=M('Schedule');
        // 生成导航
        $userId=session('id');
        $Y=$pro->distinct(true)->order('schoolYear,term asc')->field('schoolYear,term')->select();
        if ($schoolYear==0 && $term==0 && $week==0) {
            $W=$pro->distinct(true)->where('schoolYear="'.$Y[count($Y)-1]['schoolYear'].'" and term="'.$Y[count($Y)-1]['term'].'"')->field('week')->order('week asc')->select();
            $message=$pro->where('week="'.$W[count($W)-1]['week'].'" and schoolYear="'.$Y[count($Y)-1]['schoolYear'].'" and term="'.$Y[count($Y)-1]['term'].'"')->select();

        }
        elseif ($term!=0 && $week==0) {
            $W=$pro->distinct(true)->where('schoolYear="'.$schoolYear.'" and term="'.$term.'"')->field('week')->select();
            $message=$pro->where('week="'.$W[count($W)-1]['week'].'" and schoolYear="'.$schoolYear.'" and term="'.$term.'"')->select();
        }
        else{
            $W=$pro->distinct(true)->where('schoolYear="'.$schoolYear.'" and term="'.$term.'"')->field('week')->select();
            $message=$pro->where('week="'.$week.'" and schoolYear="'.$schoolYear.'" and term="'.$term.'"')->select();
        }
        foreach($message as $key=>$mes){

            $status=0;
            $peo=json_decode($mes['people']);
            foreach($peo as $peop){
                if($peop==$userId || $mes['captain']==$userId){
                    $status=1;
                    break;
                }
            }
            if($status==0){
                array_splice($message, $key, 1);
            }
        }
        if($proId==-1){
            $proL=$pro->where('id="'.$message[count($message)-1]['id'].'"')->select();
        }
        else{
            $proL=$pro->where('id="'.$proId.'"')->select();
        }

        // 加班统计
        $work=M('Workcount');
        if ($wc=$work->where('proId="'.$proL[0]['id'].'"')->select()) {
            $array['wc']=$wc;
        }
        $array['schoolY']=$Y;
        $array['weeks']=$W;
        $array['pro']=$message;
        $array['proL']=$proL[0];
        $this->assign($array);
        $this->display();
    }

    function tableDown($schoolYear=0,$term=0,$week=0){
        $pro=M('Schedule');
        $special=M('Special');
        $unit=M('Unit')->select();
        $array['unit']=$unit;
        $User=M('User');
        $UM=$User->where('id!=1')->select();
        $array['member']=$UM;
        $array['cap']=$UM;

        $Y=$pro->distinct(true)->order('schoolYear,term asc')->field('schoolYear,term')->select();
        if ($schoolYear==0 && $term==0 && $week==0) {
            $W=$pro->distinct(true)->where('schoolYear="'.$Y[count($Y)-1]['schoolYear'].'" and term="'.$Y[count($Y)-1]['term'].'"')->field('week')->order('week asc')->select();
            $message=$pro->where('week="'.$W[count($W)-1]['week'].'" and schoolYear="'.$Y[count($Y)-1]['schoolYear'].'" and term="'.$Y[count($Y)-1]['term'].'"')->select();
        }
        elseif ($term!=0 && $week==0) {
            $W=$pro->distinct(true)->where('schoolYear="'.$schoolYear.'" and term="'.$term.'"')->field('week')->select();
            $message=$pro->where('week="'.$W[count($W)-1]['week'].'" and schoolYear="'.$schoolYear.'" and term="'.$term.'"')->select();
        }
        else{
            $W=$pro->distinct(true)->where('schoolYear="'.$schoolYear.'" and term="'.$term.'"')->field('week')->select();
            $message=$pro->where('week="'.$week.'" and schoolYear="'.$schoolYear.'" and term="'.$term.'"')->select();
        }

        $sp=$special->where('week="'.$message[0]['week'].'" and schoolYear="'.$message[0]['schoolYear'].'" and term="'.$message[0]['term'].'"')->select();
        $array['weeks']=$W;
        $array['schoolY']=$Y;
        $array['pro']=$message;
        $array['special']=$sp[0];

        $this->assign($array);
        $this->display();

    }
//    function test(){
////    	$a=strtotime('12:00');
////    	$b=strtotime('13:40');
////    	$c=($b-$a)/3600;
////    	echo $c;
////        $today=date('w',strtotime('2015/03/21'));
////        echo $today;
//
//    }

}