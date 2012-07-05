<?php
class player{
	protected $DB;
	protected $properties = array();
	
	function player($DBobject= null) {
		$this->DB=$DBobject;
		$this->init();
	}
	

	public function init(){
		$this->DB->query("DESC tbl_players");
		foreach($this->DB->returnRows as $row){
			if(stripos($row['Type'],'int')!==false){
			$this->properties[$row['Field']]=0;
			}
			else{
			$this->properties[$row['Field']]='';
			}
		}
	}
        
        public function getPlayer($pid){

		$this->DB->query("SELECT * FROM tbl_employee WHERE id =". $pid." LIMIT 1");
		$this->properties = $this->DB->$returnRows[0];		
	}
	
	/*
	public function getFields(){
		return array_keys($this->properties);
	}
	
	public function getProperty($fieldName){
		return $this->properties[$fieldName];
	}
	
	public function setProperty($fieldName, $setValue){
		$this->properties[$fieldName] = $setValue;
	}
	
	public function getEmployee($pid){

		$this->DB->query("SELECT * FROM tbl_employee WHERE id =". $pid." LIMIT 1");
		$this->properties = $this->DB->Rowsprot[0];		
	}
	
	public function getEmployeeByName($first_name){

		$this->DB->query("SELECT * FROM tbl_employee WHERE first_name ='".$first_name."' LIMIT 1");
		$this->properties = $this->DB->Rowsprot[0];		
	}
	
	public function getEmployees($orderby = 'enabled', $orderhow = 'ASC'){
		$sql = "SELECT * FROM tbl_employee";
		$sql.= " ORDER BY ".$orderby." ". $orderhow;
		$this->DB->query($sql);	
		$rows = array();
		foreach ($this->DB->Rowsprot as $row){
			$rows[] = $row["id"];
		}
		return $rows;
	}
	
	public function getEmployeeNames(){	//($curAdmin = "All"){
		$sql = "SELECT * FROM tbl_employee ";
		//if (($curAdmin=="Ryan")||($curAdmin=="All")){
		//$sql .= "";
		//}else{
		//	$sql .= "WHERE first_name='".$curAdmin."'";
		//}
		$this->DB->query($sql);
		$rows = array();
		foreach ($this->DB->Rowsprot as $row){
			if ($row["enabled"]==0){				
			}else{
			$rows[] = $row["first_name"];
			}
		}
		return $rows;
	}
	
	public function getFirstEmployee(){
		$this->DB->query("SELECT * FROM tbl_employee LIMIT 1");
		$this->properties = $this->DB->Rowsprot[0];		
	}
	
	public function getNextID($currentID){
		$sql="SELECT id FROM tbl_employee WHERE ID >".$currentID." LIMIT 1";
		$this->DB->query($sql);
		$result = $this->DB->Rowsprot[0];
		return (is_null($result['id'])?false:$result['id']);
	}
	
	public function getPreviousID($currentID){
		$sql="SELECT id FROM tbl_employee WHERE ID <".$currentID." ORDER BY ID DESC LIMIT 1";
		$this->DB->query($sql);
		$result = $this->DB->Rowsprot[0];
		return (is_null($result['id'])?false:$result['id']);
	}
	
	
	public function insertNewEmployee(){
		$sql = "INSERT INTO tbl_employee ";
		$counter =0;
		$fields = '';
		$values = '';
		foreach($this->properties as $key=>$value){
			if($key!='id'){
				if($counter++>0){$fields.= ",";$values.= ",";}
					if ($key == 'enabled'){
						$fields.=$key;
						$values.=$value;
					}else{
						$fields.=$key;
						$values.="'".$value."'";
					}	
			}
		}
		$sql.="(".$fields.") VALUES (".$values.")";
		//var_dump($sql);
		//exit;
		$this->DB->query($sql);
		$new_ID = mysql_insert_id();
		if ($new_ID > 0)
		{
		$this->setProperty("id", $new_ID);
		return true;
		}else{
			echo "insert error";
			return false;
		}		
	}
	
	public function saveEmployee(){
		$sql = "UPDATE tbl_employee SET ";
		$counter=0;
		foreach($this->properties as $key=>$value){
			if($key!= 'id'){
				if ($counter++>0){
					$sql.= ",";
				}
				$sql.=$key."='".$value."'";
			}
		}
		$sql.=" WHERE id =".$this->properties['id'];
		
		return($this->DB->query($sql)); //returns true if query executes correctly
		
	}
	
	public function deleteEmployee($emp_ID){
		$sql = "UPDATE tbl_employee SET enabled = 0";
		//$sql='DELETE FROM tbl_employee';
		$sql.= " WHERE id =".$emp_ID;
		return($this->DB->query($sql));
	}
        */
}
?>