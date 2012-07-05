<?php
class DB {
	public $returnRows = array();//protected
	public $numRows= 0; 

function DB(){
		$this->connect();
}

public function connect(){
		$this->conn = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASS) or die("Mysql error" . mysql_error());		
		mysql_select_db(DB_NAME, $this->conn);
	}	
	
//*** Function: query, Purpose: Execute a database query ***	
public function query($sqlstatement = "") {	
		$result = mysql_query($sqlstatement) or die("query fault : " . mysql_error()."... QUERY : ".$sqlstatement);
		$rows = array();
		$this->numRows = mysql_num_rows($result);
		
		if(($this->numRows > 0)||(mysql_affected_rows()>0)){
			while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
				$rows[] = $row;
			}
			$this->returnRows = $rows;
			return true;
		}else{
			$this->returnRows = $rows;
			return false;
		}		
	}

// Get array of query results
function fetchArray($result) {
	return mysql_fetch_array($result);
}	
	
//Return row count, MySQL version
function getNumRows($result){
	return mysql_num_rows($result);
}

public function close(){
	mysql_close();
	//mysql_close($this->conn);
}
}//class DB
?>