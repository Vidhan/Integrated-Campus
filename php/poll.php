<?php 
//	require_once ('database.php');
	
class Poll{
	public $_poll_id;
	public $_uid;
	public $_course_id;
	public $_question;
	public $_options = array();
	public $_responses=array();
	public $_active;
	public $_year;
	public $_sem;
	
	
	function __construct($pollid){
		$database = new Database();
		if($database -> connect()){
			$details = $database -> getPollDetails($pollid);
			$database -> disconnect();
			unset($database);
			if ($details != NULL){
				$this->_poll_id= $details['Poll_Id'];
				$this->_uid=  $details['Uid'];
				$this->_course_id = $details['Course_Id'];
				$this->_question = $details['Questions'];
				$this->_options= $details['options'];
				$this->_responses = $details['responses'];
				$this->_activity = $details['Is_Active'];
				$this-> _year = $details['Year'];
				$this->_sem=$details['Sem_Type'];
				
			}		
		}	
	}
	
	function getPollDetails($option){
		switch ($option)
					{
				case 'ALL':
						$details = array();
						$details['PollId'] = $this->_poll_id;
						$details['Uid'] =$this->_uid;
						$details['CourseId'] = $this->_course_id;
						$details['Question'] = $this->_question;
						$details['Options'] =$this->_options;
						$details['Responses'] =$this->_responses;
						$details['ActiveOrNot'] = $this->_activity;
						$details['Year'] =$this->_year ;
						$details['Sem'] =$this->_sem;
						return $details;
						break;
					
					
				case 'PollId':
						$details = array();
						$details ['PollId'] = $this->_poll_id;
						return $details;
						break;
				case 'Uid':
						$details = array();
						$details ['Uid'] = $this->_uid;
						return $details;
						
				case 'CourseId':
						$details = array();
						$details['CourseId'] = $this->_course_id;
						return $details;
						
							
				case 'Question':
						$details = array();
						$details['Question'] = $this->__question;
						return $details;
						
							
				case 'Options':
						$details = array();
						$details['Options'] =$this->_options;
						return $details;
						
		     	case 'Responses':
						$details = array();
						$details['Responses'] =$this->_responses;
						return $details;
						
							
				case 'ActiveOrNot':
						$details = array();
						$details['ActiveOrNot'] = $this->_activity;
						return $details;
						
							
				case 'Year':
						$details = array();
						$details['Year'] =$this->_year ;
						return $details;
								
				case 'Sem':
						$details = array();
						$details['Sem'] =$this->_sem;
						return $details;
			
		
	}
}

function respond($optionid){
		
			$i = $this ->getPollDetails('ALL');
			if ($i['ActiveOrNot'] == 1){
				
				$database = new Database();
				if($database -> connect()){
					$detail['ResponseStatus'] = $database->addResponse($i['PollId'], $optionid, $i['CourseId'],$i['Sem'], $i['Year']);
					$details = $database -> getPollDetails($i['PollId']);
					$database -> disconnect();
					$this->_responses = $details['responses'];
			
				
				}
				}
			else $detail['ResponseStatus'] = "The poll is not active";
			return $detail;
		
		
	}
	
	function close()
		{
			
		$database = new Database();
		if($database -> connect())
		{
			$pollid = $this->getPollDetails('PollId');
			$details['PollCloseStatus'] = $database -> closePoll($pollid['PollId']);
			$database -> disconnect();
			unset($database);
			if ($details != NULL)
			{
				$this->_activity = 0;
			    return $details;
			}
			
		}
			
		}
		
		function delete()
		{
		$database = new Database();
		if($database -> connect())
		{
			$pollid = $this->getPollDetails('PollId');
			$details['PollDeleteStatus'] = $database -> deletePoll($pollid['PollId']);
			$database -> disconnect();
			unset($database);
			if ($details != NULL)
			{
				unset($this);
			    return $details;
			}
			
		}
		}
}
?>