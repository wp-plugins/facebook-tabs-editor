<?php 
class GeneralFunction {
	  
	function pagewise($numrows,$LIMIT,$offset,$CSS,$lnkParam="",$lnkScr="")
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
			$pagination .= "<tr><td width=\"100%\" valign=\"top\" align=\"center\" class=\"".$CSS."\"><b>Page $selectedPg of $pages</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
			$st_page = ((floor($selectedPg/10)-(($selectedPg%10)?0:1))*10)+1;
			if(!empty($lnkParam))
				$pagination .= "<a class=\"".$CSS."\" href=\"".$lnkScr."?offset=0&limit=$LIMIT&".$lnkParam."\">First</a>&nbsp;|&nbsp;";
			else
				$pagination .= "<a class=\"".$CSS."\" href=\"".$lnkScr."?offset=0&limit=$LIMIT\">First</a>&nbsp;|&nbsp;";
			
			if($selectedPg>1){
				$newoffset = $LIMIT * ($selectedPg - 2);
				if(!empty($lnkParam))
					$pagination .= "<a class=\"".$CSS."\" href=\"".$lnkScr."?offset=$newoffset&limit=$LIMIT&".$lnkParam."\">Prev</a>&nbsp;|&nbsp;";
				else
					$pagination .= "<a class=\"".$CSS."\" href=\"".$lnkScr."?offset=$newoffset&limit=$LIMIT\">Prev</a>&nbsp;|&nbsp;";
			}
			
			for ($i=0; $i<10; $i++){
				$page = $st_page+$i;
				$newoffset = $LIMIT * ($page - 1);
				if($selectedPg == $page){
					$pagination .= "<b><FONT color=red>$page</FONT></b>&nbsp;";
				}elseif($page<=$pages){
					if(!empty($lnkParam))
						$pagination .= "<a class=\"".$CSS."\" href=\"".$lnkScr."?offset=$newoffset&limit=$LIMIT&".$lnkParam."\">$page</a>&nbsp;";
					else
						$pagination .= "<a class=\"".$CSS."\" href=\"".$lnkScr."?offset=$newoffset&limit=$LIMIT\">$page</a>&nbsp;";
				}
			}
			
			if($selectedPg!=$pages){
				$newoffset = $LIMIT * ($selectedPg);
				if(!empty($lnkParam))
					$pagination .= "|&nbsp;<a class=\"".$CSS."\" href=\"".$lnkScr."?offset=$newoffset&limit=$LIMIT&".$lnkParam."\">Next</a>";
				else
					$pagination .= "|&nbsp;<a class=\"".$CSS."\" href=\"".$lnkScr."?offset=$newoffset&limit=$LIMIT\">Next</a>";
			}
			
			$lastOffset = ($pages-1) * $LIMIT;
			if(!empty($lnkParam))
				$pagination .= "&nbsp;|&nbsp;<a class=\"".$CSS."\" href=\"".$lnkScr."?offset=".$lastOffset."&limit=$LIMIT&".$lnkParam."\">Last</a>";
			else
				$pagination .= "&nbsp;|&nbsp;<a class=\"".$CSS."\" href=\"".$lnkScr."?offset=".$lastOffset."&limit=$LIMIT\">Last</a>";
			
			$pagination .= "</td></tr>";
			$pagination .= "</table>";
			$pagination .= "</div>";
		}
		
		if($numrows==0){
			$pagination .= "<b>No Record Found.</b>";
		}
		return $pagination;
	}

	 
}
class dbinfo
{

   function createThumbnailImage($src_img_file, $width, $height, $auto, $dest_img_file)
	{
		 
			require_once('../class/phpthumb.class.php');
			//echo "asdasdasd";
			//die;
			$phpThumb = new phpThumb();
			$phpThumb->setSourceData(file_get_contents($src_img_file));
		 
		 		
			$phpThumb->setParameter('w', $width);
			$phpThumb->setParameter('h', $height);
			$phpThumb->setParameter('zc', $auto);
			if ($phpThumb->GenerateThumbnail()) 
			{ // this line is VERY important, do not remove it!
				$phpThumb->RenderToFile($dest_img_file);
			}
		 
	}
}   
?>