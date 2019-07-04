<?php

class News_Model extends CI_Model {


	function __construct()
    {
        parent::__construct();
    }



	function query_newsList($type){
		$sql= "SELECT * FROM news   where isDeleted='N' and isOnline!='N' ";
		if($type=="1")
        {
            $sql.= " and isInner='Y'";
        } else if($type=="2") {
            $sql.= " and isOuter='Y'";
        }
		$sql.= "  order by publishdate desc ";
        
		return $this->db->query($sql);

	}
    function query_news($id){
        $sql= "SELECT * FROM news   where nid=?";
        return $this->db->query($sql,array($id));

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
    
	  function query_newsListManage($type){
        $sql= "SELECT * FROM news   where isDeleted='N'";
        if($type=="1")
        {
            $sql.= " and isInner='Y'";
        } else if($type=="2") {
            $sql.= " and isOuter='Y'";
        }
        $sql.= "  order by publishdate desc,nid desc ";
        
        return $this->db->query($sql);

    }
}

/* End of file News_Model.php */
/* Location: ./system/application/model/News_Model.php */