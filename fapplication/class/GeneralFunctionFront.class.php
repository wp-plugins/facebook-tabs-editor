<?php 
class GeneralFunction {
	  
	function pagewise($categorymajor,$numrows,$LIMIT,$offset,$CSS,$lnkParam="",$lnkScr="")
	{
		$pagination = "";
		if(empty($lnkScr))
			$lnkScr=$_SERVER['PHP_SELF'];
		if($numrows>0){
			$pages=ceil($numrows/$LIMIT);

			$pagination .= "<div align=center>";
			$pagination .= "<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\">";
			$currenthit = $offset + 1;
			
			if (($numrows - $currenthit) >= $LIMIT ){
				$lasthit = $currenthit + ($LIMIT - 1); 
			}else{ 
				$lasthit=$numrows; 
			}
			if($LIMIT > 0)
				$quo = ceil($currenthit/$LIMIT); 

			$selectedPg = sprintf("%.0f", $quo);
			$pagination .= "<tr><td width=\"100%\" valign=\"top\" align=\"center\" class=\"blogmid_link\"> <ul class='blogmid_link'>";
			$st_page = ((floor($selectedPg/10)-(($selectedPg%10)?0:1))*10)+1;
			if(!empty($lnkParam))
				$pagination .= "<a class=\"blogprev\" href=\"".$lnkScr."?category=".$categorymajor."&keyword=".$_REQUEST['keyword']."&department=".$_REQUEST['department']."&offset=0&limit=$LIMIT&".$lnkParam."\">First</a>";
			else
				$pagination .= "<a class=\"blogprev\" href=\"".$lnkScr."?category=".$categorymajor."&keyword=".$_REQUEST['keyword']."&department=".$_REQUEST['department']."&offset=0&limit=$LIMIT\">First</a>";
			
			if($selectedPg>1){
				$newoffset = $LIMIT * ($selectedPg - 2);
				if(!empty($lnkParam))
					$pagination .= "<a class=\"blogprev\" href=\"".$lnkScr."?category=".$categorymajor."&keyword=".$_REQUEST['keyword']."&department=".$_REQUEST['department']."&offset=$newoffset&limit=$LIMIT&".$lnkParam."\">Prev</a>";
				else
					$pagination .= "<a class=\"blogprev\" href=\"".$lnkScr."?category=".$categorymajor."&keyword=".$_REQUEST['keyword']."&department=".$_REQUEST['department']."&offset=$newoffset&limit=$LIMIT\">Prev</a>";
			}
			
			for ($i=0; $i<10; $i++){
				$page = $st_page+$i;
				$newoffset = $LIMIT * ($page - 1);
				if($selectedPg == $page){
					$pagination .= "<li><a class='active'>  $page </a></li>";
				}elseif($page<=$pages){
					if(!empty($lnkParam))
						$pagination .= "<li><a class=\"\" href=\"".$lnkScr."?category=".$categorymajor."&keyword=".$_REQUEST['keyword']."&department=".$_REQUEST['department']."&offset=$newoffset&limit=$LIMIT&".$lnkParam."\">$page</a></li>";
					else
						$pagination .= "<li> <a class=\"\" href=\"".$lnkScr."?category=".$categorymajor."&keyword=".$_REQUEST['keyword']."&department=".$_REQUEST['department']."&offset=$newoffset&limit=$LIMIT\">$page</a></li>";
				}
			}
			
			if($selectedPg!=$pages){
				$newoffset = $LIMIT * ($selectedPg);
				if(!empty($lnkParam))
					$pagination .= "<a class=\"blognext\" href=\"".$lnkScr."?category=".$categorymajor."&keyword=".$_REQUEST['keyword']."&department=".$_REQUEST['department']."&offset=$newoffset&limit=$LIMIT&".$lnkParam."\">Next</a>";
				else
					$pagination .= "<a class=\"blognext\" href=\"".$lnkScr."?category=".$categorymajor."&keyword=".$_REQUEST['keyword']."&department=".$_REQUEST['department']."&offset=$newoffset&limit=$LIMIT\">Next</a>";
			}
			
			$lastOffset = ($pages-1) * $LIMIT;
			if(!empty($lnkParam))
				$pagination .= "<a class=\"blognext\" href=\"".$lnkScr."?category=".$categorymajor."&keyword=".$_REQUEST['keyword']."&department=".$_REQUEST['department']."&offset=".$lastOffset."&limit=$LIMIT&".$lnkParam."\">Last</a>";
			else
				$pagination .= "<a class=\"blognext\" href=\"".$lnkScr."?category=".$categorymajor."&keyword=".$_REQUEST['keyword']."&department=".$_REQUEST['department']."&offset=".$lastOffset."&limit=$LIMIT\">Last</a>";
			
			$pagination .= "</ul></td></tr>";
			$pagination .= "</table>";
			$pagination .= "</div>";
		}
		
		 if($numrows==0){
		 
			 $pagination .= "<b align='center'>No Record Found.</b>";
		 }
		 
		return $pagination;
		 	
	}

	 
}
 
class GeneralFunctionTop {
	  
	function pagewise2($numrows,$LIMIT,$offset,$CSS,$lnkParam="",$lnkScr="")
	{
		$pagination = "";
		if(empty($lnkScr))
			$lnkScr=$_SERVER['PHP_SELF'];
		if($numrows>0){
			$pages=ceil($numrows/$LIMIT);

			 
			$currenthit = $offset + 1;
			
			if (($numrows - $currenthit) >= $LIMIT ){
				$lasthit = $currenthit + ($LIMIT - 1); 
			}else{ 
				$lasthit=$numrows; 
			}
			if($LIMIT > 0)
				$quo = ceil($currenthit/$LIMIT); 

			$selectedPg = sprintf("%.0f", $quo);
			$pagination .= "Page $selectedPg of $pages";
	 	 
		}
	  
		return $pagination;
	}
  
}

class Utility {

   function  showNew($type,$num='one')
   {
       switch($type)
				{
					case 'major':
						 return $this->selectNewMajor($num);
					break;
					case 'school':
					     return $this->selectNewSchool($num);
					break;
					case 'career':
					     return $this->selectNewCareer($num);
					break;
					case 'people':
					     return $this->selectNewPeople($num);
					break;
				}	 
  
   }
   function  selectNewMajor($num)
   {
        include_once("major.class.php");
		$major = new Major();
		$major->getLandingVal(1);
		$limit = $major->dis_num;
        $sql= "select * from major order  by create_date desc limit 0,$limit";
		$result = dbQuery($sql);
		
		if($num == 'all'){
		  return $result;
		}
		else
		{
		  $row = dbFetchAssoc($result) ;
		  return $row;
		}   
   }
   function  selectNewSchool($num)
   {
        $sql= "select * from school order  by create_date desc limit 0,10";
		$result = dbQuery($sql);
		$row = dbFetchAssoc($result) ;
		if($num == 'all')
		return $result;
		else
		return $row;     
   }
   function  selectNewCareer($num)
   {
        $sql1= "select dis_num  from career_landing";
		$result1 = dbQuery($sql1);
		$row1 = dbFetchAssoc($result1);
		$limit = $row1['dis_num'];
        
        $sql= "select * from career order  by create_date desc limit 0,$limit";
		$result = dbQuery($sql);
		
		//echo mysql_num_rows($result);
		//echo $num;
		if($num == 'all')
		   return $result;
		else
		{
		   $row = dbFetchAssoc($result) ;
		   return $row;    
		}   
   }
   function  selectNewPeople($num)
   {
        $sql= "select * from people order  by account_create_date";
		$result = dbQuery($sql);
		$row = dbFetchAssoc($result) ;
		if($num == 'all')
		return $result;
		else
		return $row;   
   }
   function  showInterestingLike($type,$num='one')
   {
       switch($type)
				{
					case 'major':
						 return $this->selectLikeMajor($num);
					break;
					case 'school':
					     return $this->selectLikeSchool($num);
					break;
					case 'career':
					     return $this->selectLikeCareer($num);
					break;
					case 'people':
					     return $this->selectLikePeople($num);
					break;
				}	 
  
   }
   
   function  selectLikeMajor($num)				// this will changed aftr voating and view 
   {
        
		 
		$pagename = basename($_SERVER['PHP_SELF']);
		if($pagename == 'index.php'){
			$sql= "select * from major where interesting =1 ";
			$result = dbQuery($sql);
			if($num == 'all')
			{
			  return $result;
			}
			else
			{
			 $row = dbFetchAssoc($result) ;
			 return $row;    
			} 
		}else{
		
		   $sql = "select * 
		       from mightlike_major as lm,
			   major as m
			   where lm.major_id = m.major_id limit 0,20";
		   $result = dbQuery($sql);
		   return $result;
		
		}
   }
    function  selectLikeCareer($num)				// this will changed aftr voating and view 
   {
        
		 
		$pagename = basename($_SERVER['PHP_SELF']);
		if($pagename == 'index.php'){
			$sql= "select * from career where interesting =1 ";
			$result = dbQuery($sql);
			if($num == 'all')
			{
			  return $result;
			}
			else
			{
			 $row = dbFetchAssoc($result) ;
			 return $row;    
			} 
		}else{
		
		   $sql = "select * 
		       from mightlike_career as lm,
			   career as m
			   where lm.career_id = m.career_id limit 0,20";
		   $result = dbQuery($sql);
		   
		   //echo mysql_num_rows($result);
		   return $result;
		}
   }
   
   function  showInteresting($type,$num='one')
   {
       switch($type)
				{
					case 'major':
						 return $this->selectInterestingMajor($num);
					break;
					case 'school':
					     return $this->selectInterestingSchool($num);
					break;
					case 'career':
					     return $this->selectInterestingCareer($num);
					break;
					case 'people':
					     return $this->selectInterestingPeople($num);
					break;
				}	 
  
   }
   
   
   function  selectInterestingMajor($num)
   {
        $pagename = basename($_SERVER['PHP_SELF']);
		if($pagename == 'index.php'){
			$sql= "select * from major where interesting =1 limit 0,10";
			$result = dbQuery($sql);
			if($num == 'all')
			{
			  return $result;
			}
			else
			{
			 $row = dbFetchAssoc($result) ;
			 return $row;    
			} 
		}else{
		
		   $sql = "select * 
		       from interesting_major as im,
			   major as m
			   where im.major_id = m.major_id limit 0,10";
		   $result = dbQuery($sql);
		   return $result;
		
		}	
   }
   
   function  selectInterestingSchool($num)
   {
        $sql= "select * from school where interesting =1";
		$result = dbQuery($sql);
		$row = dbFetchAssoc($result) ;
		if($num == 'all')
		return $result;
		else
		return $row;   
   }
   function  selectInterestingCareer($num)
   {
        //$sql= "select * from career where interesting =1";
		$sql = "select * 
		       from interesting_career as im,
			   career as m
			   where im.career_id  = m.career_id limit 0,10";
		$result = dbQuery($sql);
		if($num == 'all')
		return $result;
		else
		{
		$row = dbFetchAssoc($result) ;
		return $row;   
		}
   }
   function  selectInterestingPeople($num)
   {
        $sql= "select * from people where featured_people = 1";
		$result = dbQuery($sql);
		$row = dbFetchAssoc($result) ;
		if($num == 'all')
		return $result;
		else
		return $row;   
   }
   function  getExcerpt($string,$length,$from=0)
   {
        
		 //echo strlen($string);
		if(strlen($string) > $length)
		 echo substr($string,0,$length)."...";
		else
		 echo  $string;   
		
   }
   
  /* function ratingStar(){
	   $ratingsql = "SELECT * FROM rating where userId=1";
	   $ratingQuery=dbQuery($ratingsql);
	   $rationrow = dbFetchAssoc($ratingQuery) ;
	   return $rationrow;
   }*/
   function loginMajorRatingStar($id){
	   if(isset($_SESSION['sessionRegister']['people_id'])){
		   $ratingsql = "SELECT * FROM rating where majorId='".$id."' && userId='".$_SESSION['sessionRegister']['people_id']."'";
		   $ratingQuery=dbQuery($ratingsql);
		   $row = dbFetchAssoc($ratingQuery);
		   $rateVal = $row['rating'] ;
	   }else{
		   
		   $rateVal = ""; 
	   }
	   return $rateVal;
	   
	   
   }
   
   function majorRatingStar($id){
	   $ratingsql = "SELECT * FROM rating where majorId='".$id."'";
	   $ratingQuery=dbQuery($ratingsql);
	   $totalRow = dbNumRows($ratingQuery);
	   $rateTotalVal = 0;
	   while($row = dbFetchAssoc($ratingQuery)){
		   $rateVal = $row['rating'] ;
		   $rateTotalVal += $rateVal;
	   }
	   
	   if($totalRow != 0){
		   $rateAvgVal = intval($rateTotalVal/ $totalRow);
		   $rateAvgVal; 
	 	   return $rateAvgVal;
	   }
	   else{	  
		  return $rateAvgVal = 0;
	   }
   }
   
 	 function careerRatingStar($id){
	   $ratingsql = "SELECT * FROM rating where careerId='".$id."'";
	   $ratingQuery=dbQuery($ratingsql);
	   $totalRow = dbNumRows($ratingQuery);
	   $rateTotalVal = 0;
	   while($row = dbFetchAssoc($ratingQuery)){
		   $rateVal = $row['rating'] ;
		   $rateTotalVal += $rateVal;
	   }
	  
	  if($totalRow != 0){
		   $rateAvgVal = intval($rateTotalVal/ $totalRow);
		   $rateAvgVal; 
	 	   return $rateAvgVal;
	   }
	   else{	  
		  return $rateAvgVal = 0;
	   }
   }
   
   function loginCareerRatingStar($id){
	   if(isset($_SESSION['sessionRegister']['people_id'])){
	   $ratingsql = "SELECT * FROM rating where careerId='".$id."' && userId='".$_SESSION['sessionRegister']['people_id']."'";
	   $ratingQuery=dbQuery($ratingsql);
	   $row = dbFetchAssoc($ratingQuery);
	   $rateVal = $row['rating'] ;
	   }
	   else{
		  $rateVal = ''; 
	   }
	   return $rateVal;
	   
   }
   
   
   
    function schoolRatingStar($id){
	   $ratingsql = "SELECT * FROM rating where schoolId='".$id."'";
	   $ratingQuery=dbQuery($ratingsql);
	   $totalRow = dbNumRows($ratingQuery);
	   $rateTotalVal = 0;
	   while($row = dbFetchAssoc($ratingQuery)){
		   $rateVal = $row['rating'] ;
		   $rateTotalVal += $rateVal;
	   }
	   
	   if($totalRow != 0){
		   $rateAvgVal = intval($rateTotalVal/ $totalRow);
		   $rateAvgVal; 
	 	   return $rateAvgVal;
	   }
	   else{	  
		  return $rateAvgVal = 0;
	   }
   }
   
     function loginSchoolRatingStar($id){
		 if(isset($_SESSION['sessionRegister']['people_id'])){
		   $ratingsql = "SELECT * FROM rating where schoolId='".$id."' && userId='".$_SESSION['sessionRegister']['people_id']."'";
		   $ratingQuery=dbQuery($ratingsql);
		   $row = dbFetchAssoc($ratingQuery);
		   $rateVal = $row['rating'] ;
		 }
		 else{
			$rateVal = "";
		 }
	return $rateVal;
	   
   }


   
   public function getRatingID($id,$ratingVal,$status)
	{
	/*echo $id; echo "<br/>";
	echo $userId;echo "<br/>";
	echo $ratingVal;echo "<br/>";
	echo $status;*/
	
	if(isset($_SESSION['sessionRegister']['register'])){
	
	$userId = $_SESSION['sessionRegister']['people_id'];
		if($status=="major"){		
		$sql="select * from rating where userId='".$userId."' and majorId = '".$id."'";
		$result=dbQuery($sql);
			if(dbNumRows($result) == 0)
				{
					$sqlRating = "INSERT INTO rating set rating='".$ratingVal."', majorId='".$id."', userId='".$userId."'";
					$result=dbQuery($sqlRating);
					return 1;
				}
			else{
					$sqlRating = "UPDATE rating set rating='".$ratingVal."' where majorId='".$id."' and userId='".$userId."'";
					$result=dbQuery($sqlRating);
					//return 1;
				}			
			
		}		
		else if($status=="career"){		
			$sql="select * from rating where userId='".$userId."' and careerId = '".$id."'";
			$result=dbQuery($sql);
			if(dbNumRows($result)==0)
			{
				$sqlRating = "INSERT INTO rating set rating='".$ratingVal."', careerId='".$id."', userId='".$userId."'";
				$result=dbQuery($sqlRating);
				return 1;
			}
			else{
				$sqlRating = "UPDATE rating set rating='".$ratingVal."' where careerId='".$id."' and userId='".$userId."'";
				$result=dbQuery($sqlRating);
			}
		}
		else{		
			$sql="select * from rating where userId='".$userId."' and schoolId = '".$id."'";
			$result=dbQuery($sql);
			if(dbNumRows($result)==0)
			{
				$sqlRating = "INSERT INTO rating set rating='".$ratingVal."', schoolId='".$id."', userId='".$userId."'";
				$result=dbQuery($sqlRating);
				return 1;
			}
			else{
				$sqlRating = "UPDATE rating set rating='".$ratingVal."' where schoolId='".$id."' and userId='".$userId."'";
				$result=dbQuery($sqlRating);
			}
		}
	}	
	}
	
	
   public function showPopualar($type)
   {
        switch($type)
				{
					case 'major':
						  $sql = "SELECT mpa.id,mpa.major_id, count( id ) AS c,m.major_id,m.major_name,m.picture  
							  FROM major_people_myaccount as mpa
						   inner join 
							   major as m
						   where m.major_id = mpa.major_id
							  GROUP BY mpa.major_id
						   ORDER BY c DESC
							  LIMIT 0 , 1 ";
					       $result = dbQuery($sql);	
		                   $row = dbFetchAssoc($result);	
		                   return $row; 
					break;
					case 'school':
					      $sql = "SELECT mpa.id,mpa.school_id, count( id ) AS c,m.school_id,m.school_name,m.picture  
							  FROM school_people_myaccount as mpa
						   inner join 
							   school as m
						   where m.school_id = mpa.school_id
							  GROUP BY mpa.school_id
						   ORDER BY c DESC
							  LIMIT 0 , 1 ";
					       $result = dbQuery($sql);	
		                   $row = dbFetchAssoc($result);	
		                   return $row; 
					     //return $this->selectNewSchool($num);
					break;
					case 'career':
					       $sql = "SELECT mpa.id,mpa.career_id, count( id ) AS c,m.career_id,m.career_name,m.picture  
							  FROM career_people_myaccount as mpa
						   inner join 
							   career as m
						   where m.career_id = mpa.career_id
							  GROUP BY mpa.career_id
						   ORDER BY c DESC
							  LIMIT 0 , 1 ";
					       $result = dbQuery($sql);	
		                   $row = dbFetchAssoc($result);	
		                   return $row; 
					     //return $this->selectNewCareer($num);
					break;
					case 'people':
					        $sql = "SELECT ad.id,ad.mentor_id, count( mentor_id ) AS c,p.people_id,p.peoplefname,p.peoplelname,p.picture  
							  FROM admire as ad
						   inner join 
							   people as p
						   where p.people_id = ad.mentor_id
							  GROUP BY ad.mentor_id
						   ORDER BY c DESC
							  LIMIT 0 , 1 ";
					       $result = dbQuery($sql);	
		                   $row = dbFetchAssoc($result);	
		                   return $row; 
					     //return $this->selectNewPeople($num);
					break;
				}	 
				
		
 	   
   
   }	
}

?>