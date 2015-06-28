<?php
namespace Home\Controller;
use Think\Cache\Driver\Memcache;
use Think\Controller;
class ExcelController extends Controller
{
    public function _initialize()
    {
        date_default_timezone_set('PRC');
        Vendor('Excel.PHPExcel');
    }

//    项目统计表的excel
    public function proExcel($schoolYear,$term,$week)
    {
        $pro = M('Schedule');
        $special = M('Special');
        $printPro = $pro->where('schoolYear="'.$schoolYear.'" and term="'.$term.'" and week="'.$week.'"')->select();
        $printSpe = $special->where('schoolYear="'.$schoolYear.'" and term="'.$term.'" and week="'.$week.'"')->select();
        if ($printPro[0]['term'] == 1) {
            $term = '上半学期';
        } else {
            $term = '下半学期';
        }
        $objPHPExcel = new \PHPExcel();

// Set document properties
//        设置excel的属性：
//        创建人
//        最后修改人
//        标题
//        题目
//        描述
//        关键字
//        种类
        $objPHPExcel->getProperties()->setCreator("hwtjxt")
            ->setLastModifiedBy("hwtjxt")
            ->setTitle("Office 2007 XLSX Test Document")
            ->setSubject("Office 2007 XLSX Test Document")
            ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
            ->setKeywords("office 2007 openxml php")
            ->setCategory("project");
//设置单元格长度
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(8.88);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(9.88);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(19.25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(12.65);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(14.88);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(21.88);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(24.13);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(26);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(35.75);

        $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(17.25);
        $objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(27.75);
        $objPHPExcel->getDefaultStyle()->getFont()->setName('宋体');
        $objPHPExcel->getDefaultStyle()->getFont()->setSize(12);
        //设置水平居中

        $objPHPExcel->getActiveSheet()->getStyle('A:J')->getAlignment()->setWrapText(true);
        //合并cell
        $objPHPExcel->getActiveSheet()->mergeCells('A1:J1');
        $objPHPExcel->getActiveSheet()->mergeCells('A2:J2');
        $objPHPExcel->getActiveSheet()->mergeCells('C3:G3');
        $objPHPExcel->getActiveSheet()->mergeCells('D5:G5');

        //加粗
        $objPHPExcel->getActiveSheet()->getStyle('A2:J2')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('C3:G3')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('A4:J4')->getFont()->setBold(true);

// Add some data
//        设置当前的sheet
//        设置单元格的值
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A2', '工作安排登记表（'.$printPro[0]['schoolYear'].'学年'.$term.'第'.$printPro[0]['week'].'周）')
            ->setCellValue('C3', $printSpe[0]['part1'])
            ->setCellValue('H3', $printSpe[0]['part2'])
            ->setCellValue('I3', $printSpe[0]['part3'])
            ->setCellValue('J3', $printSpe[0]['part4'])
            ->setCellValue('A4', '收单时间')
            ->setCellValue('B4', '单位')
            ->setCellValue('C4', '项目名称')
            ->setCellValue('D4', '使用日期')
            ->setCellValue('E4', '使用时间（起止）')
            ->setCellValue('F4', '联系人/联系电话')
            ->setCellValue('G4', '使用设备')
            ->setCellValue('H4', '人员')
            ->setCellValue('I4', '地点')
            ->setCellValue('J4', '备注')
            ->setCellValue('C5', $printSpe[0]['proName'])
            ->setCellValue('D5', $printSpe[0]['part5'])
            ->setCellValue('H5', $printSpe[0]['people'])
            ->setCellValue('I5', $printSpe[0]['place'])
            ->setCellValue('J5', $printSpe[0]['remark']);

// Miscellaneous glyphs, UTF-8
        for($i=0;$i<count($printPro);$i++){
            $User=M('User');
            $captain=$User->where('id='.$printPro[$i]['captain'])->field('name')->select();
            $people=$captain[0]['name'];
            $peo=json_decode($printPro[$i]['people']);
            foreach($peo as $p){
                $peop=$User->where('id='.$p)->field('name')->select();
                $people.="、".$peop[0]['name'];
            }
            $objPHPExcel->getActiveSheet(0)->setCellValue('A'.($i+6), date('Y-m-d',$printPro[$i]['doneTime']));
            $objPHPExcel->getActiveSheet(0)->setCellValue('B'.($i+6), $printPro[$i]['unit']);
            $objPHPExcel->getActiveSheet(0)->setCellValue('C'.($i+6), $printPro[$i]['proName']);
            $objPHPExcel->getActiveSheet(0)->setCellValue('D'.($i+6), date('Y-m-d',$printPro[$i]['useDate']));
            $objPHPExcel->getActiveSheet(0)->setCellValue('E'.($i+6), $printPro[$i]['useTime']);
            $objPHPExcel->getActiveSheet(0)->setCellValue('F'.($i+6), $printPro[$i]['tel']);
            $objPHPExcel->getActiveSheet(0)->setCellValue('G'.($i+6), $printPro[$i]['device']);
            $objPHPExcel->getActiveSheet(0)->setCellValue('H'.($i+6), $people);
            $objPHPExcel->getActiveSheet(0)->setCellValue('I'.($i+6), $printPro[$i]['place']);
            $objPHPExcel->getActiveSheet(0)->setCellValue('J'.($i+6), $printPro[$i]['remark']);
        }

//        表格加边框
        $count=count($printPro)+5;
        $objPHPExcel->getActiveSheet()->getStyle("A1:J$count")->applyFromArray(
            array('borders' => array(
                'allborders'        => array('style' => \PHPExcel_Style_Border::BORDER_MEDIUM)
            ),
                'alignment' => array (
                    'horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                    'vertical'=>\PHPExcel_Style_Alignment::VERTICAL_CENTER
                ),
        ));


// Rename worksheet
//        设置sheet的name
        $objPHPExcel->getActiveSheet()->setTitle('会务统计');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);


 //Redirect output to a client’s web browser (Excel5)
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="南校数字语言室第'.$printPro[0]['week'].'周安排（'.$printPro[0]['schoolYear'].'学年'.$term.'）.xls"');
        header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
        header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
        header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header ('Pragma: public'); // HTTP/1.0

        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
        exit;
    }

//    加班表的excel下载
    function workExcel($proId){
        $work=M('Workcount');
        $status=0;
        if ($wc=$work->where('proId='.$proId)->select()) {
            $status=1;
        }
        else{
            header("Content-Type:text/html;charset=utf-8");//编码处理
            echo "加班表获取失败";
        }
        if($status==1){
            $objPHPExcel = new \PHPExcel();

// Set document properties
//        设置excel的属性：
//        创建人
//        最后修改人
//        标题
//        题目
//        描述
//        关键字
//        种类
            $objPHPExcel->getProperties()->setCreator("hwtjxt")
                ->setLastModifiedBy("hwtjxt")
                ->setTitle("Office 2007 XLSX Test Document")
                ->setSubject("Office 2007 XLSX Test Document")
                ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
                ->setKeywords("office 2007 openxml php")
                ->setCategory("project");
//设置单元格长度
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(14);
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(19);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(24);
            $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(8);
            $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(26);
            $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(24);
            $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(26);
            $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(27.75);
            $objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(38);
            $objPHPExcel->getActiveSheet()->getStyle('A:G')->getAlignment()->setWrapText(true);
            $objPHPExcel->getDefaultStyle()->getFont()->setName('宋体');
            $objPHPExcel->getDefaultStyle()->getFont()->setSize(12);
            $objPHPExcel->getActiveSheet()->getStyle( 'A1')->getFont()->setSize(16);

            //设置水平居中
            $objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A2')->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_TOP);
            $objPHPExcel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
            //合并cell
            $objPHPExcel->getActiveSheet()->mergeCells('A1:G1');
            $objPHPExcel->getActiveSheet()->mergeCells('A2:G2');

            //加粗
            $objPHPExcel->getActiveSheet()->getStyle('A1:G2')->getFont()->setBold(true);

// Add some data
//        设置当前的sheet
//        设置单元格的值
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A1', '加班统计表')
                ->setCellValue('A2', '服务单位：')
                ->setCellValue('A3', '日期')
                ->setCellValue('B3', '地点')
                ->setCellValue('C3', '加班时段')
                ->setCellValue('D3', '加班时数')
                ->setCellValue('E3', '加班内容')
                ->setCellValue('F3', '值班人员')
                ->setCellValue('G3', '备注');

// Miscellaneous glyphs, UTF-8
            for($i=0;$i<count($wc);$i++){
                $User=M('User');
                $worker=$User->where('id='.$wc[$i]['worker'])->field('name')->select();
                $objPHPExcel->getActiveSheet(0)->setCellValue('A'.($i+4), date('Y-m-d',$wc[$i]['useDate']));
                $objPHPExcel->getActiveSheet(0)->setCellValue('B'.($i+4), $wc[$i]['place']);
                $objPHPExcel->getActiveSheet(0)->setCellValue('C'.($i+4), $wc[$i]['useTime']);
                $objPHPExcel->getActiveSheet(0)->setCellValue('D'.($i+4), $wc[$i]['workTime']);
                $objPHPExcel->getActiveSheet(0)->setCellValue('E'.($i+4), $wc[$i]['proName']);
                $objPHPExcel->getActiveSheet(0)->setCellValue('F'.($i+4), $worker[0]['name']);
                $objPHPExcel->getActiveSheet(0)->setCellValue('G'.($i+4), $wc[$i]['remark']);
            }

//        表格加边框
            $count=count($wc)+3;
            $objPHPExcel->getActiveSheet()->getStyle("A3:G$count")->applyFromArray(
                array('borders' => array(
                    'allborders'        => array('style' => \PHPExcel_Style_Border::BORDER_MEDIUM)
                ),
                    'alignment' => array (
                        'horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                        'vertical'=>\PHPExcel_Style_Alignment::VERTICAL_CENTER
                    ),
                ));
            $title=$wc[0]['proName'];
// Rename worksheet
//        设置sheet的name
            $objPHPExcel->getActiveSheet()->setTitle('加班表');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
            $objPHPExcel->setActiveSheetIndex(0);


            //Redirect output to a client’s web browser (Excel5)
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="加班统计表（'.$title.'）.xls"');
            header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
            header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
            header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
            header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
            header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
            header ('Pragma: public'); // HTTP/1.0

            $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
            $objWriter->save('php://output');
            exit;
        }
    }
}