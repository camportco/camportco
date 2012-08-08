<?
	$url = $html->webroot.$url.'?'.$cond.'&num_rows='.$num_rows;	
	$showeachside = 9;
	$eitherside = ($showeachside + 1)/2;
	
	if (!$zpage) { 
		$zpage = 1; 
	}

	$prev_page = $zpage - 1; 
	$next_page = $zpage + 1; 

	// Set up specified page 
	$page_start = ($per_page * $zpage) - $per_page; 

	if ($num_rows <= $per_page) { 
		$num_pages = 1; 
	} else if (($num_rows % $per_page) == 0) { 
		$num_pages = ($num_rows / $per_page);
	} else { 
		$num_pages = ($num_rows / $per_page) + 1; 
	} 
	$num_pages = (int) $num_pages; 
	
	echo "<div align=\"center\">Page $zpage of $num_pages<br>( $num_rows records )<br>";
	
	// First Page
	echo "<a href=\"$url&zpage=1\">First</a> ";
	
	// 
    // Now the pages are set right, we can 
    // perform the actual displaying... 
    if ($prev_page) {
    	echo "<a href=\"$url&zpage=$prev_page\">Prev</a>";
    }
    // Page # direct links 
    // If you don't want direct links to eac
    //     h page, you should be able to
    // safely remove this chunk.
    
    if($zpage > $eitherside) {
    	echo " .... ";
    	$start = $zpage - $eitherside + 1;
    	if ($start > $num_pages - $showeachside) $start = $num_pages - $showeachside + 1;
    }
    else {
    	$start = 1;
    }
    
    if($zpage+$eitherside <= $num_pages) {
    	$end = $zpage + $eitherside - 1;
    	if ($end < $showeachside) $end = $showeachside;
    }
    else {
    	$end = $num_pages;
    }
    
    for ($i = $start; $i <= $end; $i++) { 
		if ($i != $zpage) {
			echo " <a href=\"$url&zpage=$i\">$i</a> "; 
		} else { 
			echo " $i "; 
		}
    }
    if($end != $num_pages) {
    	echo " .... ";
    }
    
    // Next 
    if ($zpage != $num_pages) { 
    	echo "<a href=\"$url&zpage=$next_page\">Next</a> ";
    }
    
    // Last Page
	echo "<a href=\"$url&zpage=$num_pages\">Last</a> ";
	
	echo "</div>\n";
	return $page_start;
?>