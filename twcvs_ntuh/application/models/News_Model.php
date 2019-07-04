<?php

class News_Model extends CI_Model {


	function __construct()
    {
        parent::__construct();
    }



	function query_newsList($type){
		$sql= "(SELECT *,'' as nsource,'1' as source  FROM news   where isDeleted='N' and isOnline!='N' ";
		if($type=="1")
        {
            $sql.= " and isInner='Y'";
        } else if($type=="2") {
            $sql.= " and isOuter='Y'";
        } 
        $sql.= " ) union (SELECT *,'【學會】 ' as nsource,'2' as source FROM twcvs_www.news   where isDeleted='N' and isOnline!='N' ";
        if($type=="1")
        {
            $sql.= " and isInner='Y'";
        } else if($type=="2") {
            $sql.= " and isOuter='Y'";
        } 
        $sql.= ") ";
		$sql.= "  order by publishdate desc ";
    // echo $sql;
		return $this->db->query($sql);

	}
    function query_newsListManage($type){
        $sql= "SELECT * FROM news   where isDeleted='N'";
        if($type=="1")
        {
            $sql.= " and isInner='Y'";
        } else if($type=="2") {
            $sql.= " and isOuter='Y'";
        }
        $sql.= "  order by publishdate desc ,nid desc";
        
        return $this->db->query($sql);

    }
    function query_news($id){
        $sql= "SELECT * FROM news   where nid=?";
        return $this->db->query($sql,array($id));

    }
        function query_associatenews($id){
              $otherdb = $this->load->database('ad', TRUE);
        $sql= "SELECT * FROM news   where nid=?";
        return $otherdb->query($sql,array($id));

    }
    
	function save_news($newsClass){
		$this->db->insert('news', $newsClass);
        
      $insert_id = $this->db->insert_id();

   return  $insert_id;

	}
	function delete_news($nID){
		$sql= "update  news  set isDeleted='Y' where  nid=?";
		return $this->db->query($sql,array($nID));
	}
    function update_news($nID,$newsClass){
        $this->db->where('nid', $nID);
        $this->db->update('news', $newsClass);
    }
    
	
}

/* End of file News_Model.php */
/* Location: ./system/application/model/News_Model.php */