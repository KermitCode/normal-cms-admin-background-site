<?php

/*
 *Author:Kermit
 *Time:2013-9-3
 *Note:make Microsoft Excel File for Hospital
 */

class Excelclass{
	
	public $objExcel=null;
	
	public $objWriter=null;
	
	//construct
	
	public function __construct(){
		
		if($this->objExcel) return;
		
		$this->objExcel = new PHPExcel();
		
		
		//设定缓存模式为经gzip压缩后存入cache
		 
		$cacheMethod = PHPExcel_CachedObjectStorageFactory::cache_in_memory_gzip;

		$cacheSettings = array();
		
		PHPExcel_Settings::setCacheStorageMethod($cacheMethod,$cacheSettings);  


		$this->objWriter = new PHPExcel_Writer_Excel5($this->objExcel);

	}
		
	//create excel
	
	public function CreateExcel($title,$data,$filename='',$sheetname=''){
		
		if($filename=='') $filename=date('Y-m-d');
		
		$this->objExcel->setActiveSheetIndex(0);       

		$objActSheet = $this->objExcel->getActiveSheet();   
     
		$sheetname && $objActSheet->setTitle($sheetname); 

		//$objActSheet->getColumnDimension('D')->setWidth(100);
    
		$Column_arr=range('A', 'Z');
		
		if(empty($title)) exit('ERROR:no title');

		foreach($title as $key=>$value){
			
			//$objStyle = $objActSheet ->getStyle($Column_arr[$key].'1');
			
			/*$objFont= $objStyle->getFont(); 
			
			$objFont->setBold(true); //bold*/
			
			//$objFill = $objStyle->getFill(); 
 			
			//$objFill->setFillType(PHPExcel_Style_Fill::FILL_SOLID); 
 
   			//$objFill->getStartColor()->setARGB('#33CC66'); //color
 
   			//$objBorder = $objStyle->getBorders(); 
		 
			//$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN); 
			
			//$objBorder->getTop()->getColor()->setARGB('#666666') ; // 边框color 
		
			//$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN); 
			
			//$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN); 
			
			//$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN); 

			$objActSheet->setCellValue($Column_arr[$key].'1',$value);
	
			//$objActSheet->getColumnDimension($Column_arr[$key])->setAutoSize(true);
			
			}

		if(!empty($data)){
			
			$j=2;

			foreach($data as $key=>$row){
				
				$i=0;
				
				foreach($row as $k=>$v){
					
					$col=$Column_arr[$i].$j;
                    
                    //如果不是文本直接setCell
                    if(!is_array($v)){
                        $objActSheet->setCellValue($col,$v);
                    }elseif($v[1]=='c'){
                    //如果要指定文件
                        $objActSheet->setCellValueExplicit($col,$v[0]);
                    }
					//$objStyle = $objActSheet ->getStyle($col);
					
					//$objBorder = $objStyle->getBorders(); 
			
					//$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN); 
					
					//$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN); 
					
					//$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN); 
					
					//$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN); 
			
					$i++;
					
				}
					
				$j++;
					
			}
			
	    }

		$this->MakeFile($filename);

	}

	//make file
	
	public function MakeFile($filename){
        ob_end_clean();
		header("Pragma: public");
		header("Expires: 0");
		header("Cache-Control:must-revalidate, post-check=0, pre-check=0");
		
		header("Content-Type:application/force-download");	
		header("Content-Type:application/vnd.ms-execl");
		header("Content-Type:application/octet-stream");
		
		header("Content-Type:application/download");
		header('Content-Disposition:attachment;filename="'.$filename.'.xls"');
		header("Content-Transfer-Encoding:binary");
		
		$this->objWriter->save('php://output');

	}

	
}
