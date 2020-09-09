<?php 

class ProjectHelp{
	
	//asort array
	
	public function arr_sort($arr,$keys,$type='asc'){
		 
		$keysvalue = $new_array = array();
		
		foreach ($arr as $k=>$v) $keysvalue[$k] = $v[$keys];
		
		if($type == 'asc') asort($keysvalue);
		
		else arsort($keysvalue);
		
		reset($keysvalue);
		
		foreach ($keysvalue as $k=>$v) $new_array[$k] = $arr[$k];

		return $new_array; 
	
	} 

	//检验身份证有效性
	
	public function validation_idcard($id_card){
		 
		if(strlen($id_card) == 18) { 
		
			return $this->idcard_checksum18($id_card); 
		
		}elseif((strlen($id_card) == 15)){
			 
			$id_card = $this->idcard_15to18($id_card); 
			
			return $this->idcard_checksum18($id_card); 
		
		}else{
			 
			return false; 
		
		} 
	} 
	
	// 计算身份证校验码，根据国家标准GB 11643-1999 
	
	public function idcard_verify_number($idcard_base){ 
	
		if(strlen($idcard_base)!= 17){ 
		
			return false;
		 
		} 

		$factor = array(7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2); //加权因子
		 
		$verify_number_list = array('1', '0', 'X', '9', '8', '7', '6', '5', '4', '3', '2');//校验码对应值
		 
		$checksum = 0; 
		
		for ($i = 0; $i < strlen($idcard_base); $i++){
			 
			$checksum += substr($idcard_base, $i, 1) * $factor[$i]; 
		
		} 
		
		$mod = $checksum % 11; 
		
		$verify_number = $verify_number_list[$mod]; 
		
		return $verify_number; 
		
		} 

	// 将15位身份证升级到18位 
	
	public function idcard_15to18($idcard){ 
		
		if (strlen($idcard) != 15){ 
		
			return false; 
		
		}else{ 
		
		// 如果身份证顺序码是996 997 998 999，这些是为百岁以上老人的特殊编码 
		
				if (array_search(substr($idcard, 12, 3), array('996', '997', '998', '999')) !== false){ 
				
					$idcard = substr($idcard, 0, 6) . '18'. substr($idcard, 6, 9); 
				
				}else{ 
					
					$idcard = substr($idcard, 0, 6) . '19'. substr($idcard, 6, 9); 
				
				} 
		
		} 
		
		$idcard = $idcard . $this->idcard_verify_number($idcard); 
		
		return $idcard; 
		
	} 
	
	// 18位身份证校验码有效性检查 
	
	public function idcard_checksum18($idcard){ 
		
		if (strlen($idcard) != 18){ return false; } 
		
			$idcard_base = substr($idcard, 0, 17); 
			
			if ($this->idcard_verify_number($idcard_base) != strtoupper(substr($idcard, 17, 1))){ 
			
			return false; 
		
			}else{ 
			
			return true; 
			
			} 
			
	} 

	//2013-12-4 for check user_realname
	
	public function check_realname($patient_name){
		
		$old=$patient_name;

		$patient_name =iconv('gbk','utf-8',$patient_name);
		
		preg_match_all('/[\x{4e00}-\x{9fff}]+/u',$patient_name,$matches_name);
		
		$patient_name=join('',$matches_name[0]);
		
		$patient_name = iconv('utf-8','gbk',$patient_name);
		
		if($old!=$patient_name || strlen($patient_name)<4) return false;
		
		else return true;
		
	}


}