<?php
	class MpdfComponent
	{
		
	/**
		 * function : generatepdf()
		 * params   : $postarray : array of freeform full data.
		 * description : This function is use generate pdf for each free user
		 */
		function generatepdf($groupdata){
		//echo "<pre>";	
		//print_r($groupdata);	exit;
				$docroot =$_SERVER['DOCUMENT_ROOT'];

		require_once($docroot.'/app/vendors/tcpdf/config/lang/eng.php');
		//require_once('../config/lang/eng.php');
		require_once($docroot.'/app/vendors/tcpdf/tcpdf.php');
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, "UTF-8");
		// set document information
		$pdf->SetCreator(PDF_CREATOR);
			
			$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		
			$pdf->SetMargins(-1, -1, -1);
			
			$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
			$pdf->AliasNbPages();
			$pdf->SetAutoPageBreak(FALSE, "1");
			$pdf->AddPage();
					
		
			$formtop = 'img' . DS . 'pdf_form_imgs'. DS .'form_top.gif';
			$formleft = 'img' . DS . 'pdf_form_imgs'. DS .'form_left.gif';
			$formright = 'img' . DS . 'pdf_form_imgs'. DS .'form_right.gif';
			$formbottom = 'img' . DS . 'pdf_form_imgs'. DS .'form_bot.gif';
			
			
			$srno1 = 'img' . DS . 'pdf_form_imgs'. DS .'no1.jpg';
			$srno2 = 'img' . DS . 'pdf_form_imgs'. DS .'no2.jpg';
			$srno3 = 'img' . DS . 'pdf_form_imgs'. DS .'no3.jpg';
			$srno4 = 'img' . DS . 'pdf_form_imgs'. DS .'no4.jpg';
			$srno5 = 'img' . DS . 'pdf_form_imgs'. DS .'no5.jpg';
			$srno6 = 'img' . DS . 'pdf_form_imgs'. DS .'no6.jpg';
			$crimg = 'img' . DS . 'pdf_form_imgs'. DS .'crosstit.gif';
			
			$tit1 = 'img' . DS . 'pdf_form_imgs'. DS .'tit1.gif';
			$tit2 = 'img' . DS . 'pdf_form_imgs'. DS .'tit2.gif';
			$tit3 = 'img' . DS . 'pdf_form_imgs'. DS .'tit3.gif';
			$tit4 = 'img' . DS . 'pdf_form_imgs'. DS .'tit4.gif';
			$tit5 = 'img' . DS . 'pdf_form_imgs'. DS .'tit5.gif';
			
			
			$titleto = 'img' . DS . 'pdf_form_imgs'. DS .'to.gif';
			$titlegrp = 'img' . DS . 'pdf_form_imgs'. DS .'grp.gif';
			
			$thanks = 'img' . DS . 'pdf_form_imgs'. DS .'thks.gif';
			
			
			//$editorimg = 'img' . DS . 'pdf_form_imgs'. DS .'editor_new_freeform.gif';
			
			$editorimg = 'img' . DS . 'pdf_form_imgs'. DS .'editor_new_freeform_new.gif';
			
			$frameimg = 'img' . DS . 'pdf_form_imgs'. DS .'frame1.png';

			$filePath =  'img' . DS . 'freeformimage'. DS .$groupdata[0]['Freeform']['grouplogo'];
			
			$groupsubtypeid = $groupdata[0]['Freeform']['subgrouptypelogoid'];
			$fromclipartsection = AppController::getfourrandomsubgrouptypeimagesfromclipartsection($groupsubtypeid,'1');
			
			if($fromclipartsection){
			
			if($fromclipartsection[0]['AbolSuppliedClipart']['clip_name']){
					$groupsubtypeimg1 =  'bptool' . DS . 'index_files'. DS . 'cliparts'. DS.$fromclipartsection[0]['AbolSuppliedClipart']['clip_name'];
				}else{
					$groupsubtypeimg1 =  $filePath;
				}
				
				if($fromclipartsection[1]['AbolSuppliedClipart']['clip_name']){
						$groupsubtypeimg2 =  'bptool' . DS . 'index_files'. DS . 'cliparts'. DS.$fromclipartsection[1]['AbolSuppliedClipart']['clip_name'];
					}else{
					$groupsubtypeimg2 =  $filePath;
				}
					
				if($fromclipartsection[2]['AbolSuppliedClipart']['clip_name']){
						$groupsubtypeimg3 =  'bptool' . DS . 'index_files'. DS . 'cliparts'. DS.$fromclipartsection[2]['AbolSuppliedClipart']['clip_name'];
					}else{
					$groupsubtypeimg3 =  $filePath;
				}
					
				if($fromclipartsection[3]['AbolSuppliedClipart']['clip_name']){
						$groupsubtypeimg4 =  'bptool' . DS . 'index_files'. DS . 'cliparts'. DS.$fromclipartsection[3]['AbolSuppliedClipart']['clip_name'];
					}else{
					$groupsubtypeimg4 =  $filePath;
				}
			
			
			}else{
			
			$grouptypeid = $groupdata[0]['Freeform']['grouptypelogoid'];
		
			if($grouptypeid){
				$foursubgrouptype = AppController::getfourrandomsubgrouptypeimages($grouptypeid);
				if($foursubgrouptype[0]['GroupType']['type_logo_clipart_pdf']){
					$groupsubtypeimg1 =  'img' . DS . 'thumbnail'. DS .$foursubgrouptype[0]['GroupType']['type_logo_clipart_pdf'];
				}else{
					$groupsubtypeimg1 =  $filePath;
				}
				
				if($foursubgrouptype[1]['GroupType']['type_logo_clipart_pdf']){
						$groupsubtypeimg2 =  'img' . DS . 'thumbnail'. DS .$foursubgrouptype[1]['GroupType']['type_logo_clipart_pdf'];
					}else{
					$groupsubtypeimg2 =  $filePath;
				}
					
				if($foursubgrouptype[2]['GroupType']['type_logo_clipart_pdf']){
						$groupsubtypeimg3 =  'img' . DS . 'thumbnail'. DS .$foursubgrouptype[2]['GroupType']['type_logo_clipart_pdf'];
					}else{
					$groupsubtypeimg3 =  $filePath;
				}
					
				if($foursubgrouptype[3]['GroupType']['type_logo_clipart_pdf']){
						$groupsubtypeimg4 =  'img' . DS . 'thumbnail'. DS .$foursubgrouptype[3]['GroupType']['type_logo_clipart_pdf'];
					}else{
					$groupsubtypeimg4 =  $filePath;
				}
				
			}else{
				$groupsubtypeimg1 =  $filePath;
				$groupsubtypeimg2 =  $filePath;
				$groupsubtypeimg4 =  $filePath;	
			}
			
			
			}
			
			
			

			$pdf->writeHTMLCell(36, 36, 5, 2, $html='<img src="'.$filePath.'">', 0, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
			
			$pdf->writeHTMLCell(150, 10, 60, 5, $html='<span style="font-size:25"><b>'.substr($groupdata[0]['Freeform']['group_name'],0,33).'</b></span>', 0, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = false);
			
			$pdf->writeHTMLCell(150, 10, 60, 15, $html='<span style="font-size:15"><b>'.substr($groupdata[0]['Freeform']['eventname'],0,50).'</b></span>', 0, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = false);
			
			$pdf->writeHTMLCell(150, 10, 60, 23, $html='<span style="font-size:10">'.$groupdata[0]['Freeform']['groupnote'].'</span>', 0, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = false);
			
			$pdf->writeHTMLCell(200, 25, 3, 30, $html='<img src="'.$formtop.'">', 0, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
			$pdf->Image( $formleft, 4.1, 40, 12.8, 238, $type = '', $link = '', $align = '',$resize = true, $dpi = 300, $palign = '', $ismask = false, $imgmask = false, $border = 0, $fitbox = false, $hidden = false, $fitonpage = false);	
			
			//$pdf->Image( $srno1, 15, 41, 7, 7, $type = '', $link = '', $align = '',$resize = true, $dpi = 300, $palign = '', $ismask = false, $imgmask = false, $border = 0, $fitbox = false, $hidden = false, $fitonpage = false);
			
			
			$pdf->Image( $formright, 200.6, 40, 1.4, 238, $type = '', $link = '', $align = '',$resize = true, $dpi = 300, $palign = '', $ismask = false, $imgmask = false, $border = 0, $fitbox = false, $hidden = false, $fitonpage = false);
			$pdf->writeHTMLCell(200, 25, 3, 278, $html='<img src="'.$formbottom.'">', 0, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = false);
			$pdf->SetFillColor(255,255,255);
			
			
			if($groupdata['0']['Freeform']['is_onlinedirectory']=='1'){
			
			
			
			//++++++++++++========================IF LISTING AVAILABLE============================++++++++++++++++++++//
			
			$pdf->writeHTMLCell(0, 0, 15, 42, $html='<img src="'.$srno1.'">', 0, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
			
			
			$pdf->writeHTMLCell(0, 0, 23, 41.8, $html='<span style="color:#3d4783; font-size:15; font-weight:bold;">AD SIZES</span>', 0, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
			
			//$pdf->writeHTMLCell(0, 0, 23, 42, $html='<img src="'.$tit1.'">', 0, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
			
			$pdf->writeHTMLCell(0, 0, 85, 42, $html='<img src="'.$srno2.'">', 0, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
			
			$pdf->writeHTMLCell(0, 0, 93, 41.8, $html='<span style="color:#3d4783; font-size:15; font-weight:bold;">YOUR AD OR MESSAGE HERE</span>', 0, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
			//$pdf->writeHTMLCell(0, 0, 93, 40.6, $html='<img src="'.$tit2.'">', 0, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
			
			
			$pdf->writeHTMLCell(0, 0, 165, 64.7, $html='<img src="'.$groupsubtypeimg1.'" width="45" height="45">', 0, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
			$pdf->writeHTMLCell(0, 0, 165, 80.7, $html='<img src="'.$groupsubtypeimg3.'" width="45" height="45">', 0, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
			
			$pdf->writeHTMLCell(0, 0, 182, 63.7, $html='<img src="'.$groupsubtypeimg2.'" width="45" height="45">', 0, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
			$pdf->writeHTMLCell(0, 0, 182, 79.7, $html='<img src="'.$groupsubtypeimg4.'" width="45" height="45">', 0, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
			
			
			$pdf->writeHTMLCell(110, 110, 90, 50, $html='<img src="'.$editorimg.'">', 0, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
			$vardue='';
			if($groupdata[0]['Freeform']['duedate']){
				$vardue = $groupdata[0]['Freeform']['duedate'];
			}else{
				$vardue = '______________';
			}
			
			$pdf->writeHTMLCell( 100, 3, 90, 135, '<span style="font-size:10; color:#000000">The Due Date is: '.$vardue.' To upload your ad, go to www.AdBookOnLine.org</span>',0, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
			
				########FULL PAGE GOLD########
			if($groupdata['0']['Freeform']['gold'] !='0.00') { 
				
				$pdf->writeHTMLCell( 55, 50, 20, 52, '<span style="font-size:10; color:#000000"><b></b></span>', array('LTRB' => array('width' => 0.1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0))), 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
				$pdf->setCellHeightRatio(0.3);
				$pdf->writeHTMLCell( 3, 1, 21, 52.5,$html='', array('LTRB' => array('width' => 0.1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0))), 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
				$pdf->setCellHeightRatio(0.3);
				$pdf->writeHTMLCell( 60, 3, 25, 52.5, '<span style="font-size:10; color:#000000">Gold Full Page  $'.$groupdata['0']['Freeform']['gold'].'</span>', 0, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
			########FULL PAGE GOLD END HERE########
			}
			#########FULL PAGE SILVER START HERE###########
			if($groupdata['0']['Freeform']['silver'] !='0.00') { 
				
				$pdf->writeHTMLCell( 55, 50, 22, 58,$html='', array('LTRB' => array('width' => 0.1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0))), 1, $fill = 1, $reseth = true, $align = 'left', $autopadding = true);
				$pdf->setCellHeightRatio(0.3);
				$pdf->writeHTMLCell( 3, 1, 23, 58.5,$html='', array('LTRB' => array('width' => 0.1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0))), 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
				$pdf->setCellHeightRatio(0.3);
				$pdf->writeHTMLCell( 80, 3, 27, 58.5, '<span style="font-size:10; color:#000000">Silver Full Page  $'.$groupdata['0']['Freeform']['silver'].'</span>', 0, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
			#########FULL PAGE SILVER START END HERE###########
			}
			#########FULL PAGE SPONSOR START HERE###########

			if($groupdata['0']['Freeform']['sponsor'] !='0.00') { 
				
				$pdf->writeHTMLCell( 55, 50, 24, 64,$html='', array('LTRB' => array('width' => 0.1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0))), 1, $fill = 1, $reseth = true, $align = 'left', $autopadding = true);
				$pdf->setCellHeightRatio(0.3);
				$pdf->writeHTMLCell( 3, 1, 25, 64.5,$html='', array('LTRB' => array('width' => 0.1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0))), 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
				$pdf->setCellHeightRatio(0.3);
				$pdf->writeHTMLCell( 80, 3, 29, 64.5, '<span style="font-size:10; color:#000000">Paper Full Page  $'.$groupdata['0']['Freeform']['sponsor'].'</span>', 0, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
			}	
			#########FULL PAGE SPONSOR END HERE###########
			########Half page start here#########

		
			if($groupdata['0']['Freeform']['half_sponsor'] !='0.00'){ 
			
				$pdf->writeHTMLCell( 55, 25, 26, 70,$html='', array('LTRB' => array('width' => 0.1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0))), 1, $fill = 1, $reseth = true, $align = 'left', $autopadding = true);
					$pdf->setCellHeightRatio(0.3);
					$pdf->writeHTMLCell( 3, 1, 27, 70.5,$html='', array('LTRB' => array('width' => 0.1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0))), 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
					$pdf->setCellHeightRatio(0.3);
				
					$pdf->writeHTMLCell( 85, 3, 31, 70.5, '<span style="font-size:10; color:#000000">1/2 Page $'.$groupdata['0']['Freeform']['half_sponsor'].'</span>', 0, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
			
			}
			
			
			########Half page end here#########			
			if($groupdata['0']['Freeform']['quarter']!='0.00') {
			
			
				$pdf->writeHTMLCell( 3, 1, 27, 15.5,$html='', array('LTRB' => array('width' => 0.1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0))), 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
	
	
				/******1/4 sponsor**********/
				$pdf->writeHTMLCell( 30, 40, 28, 83.5,$html='', array('LTRB' => array('width' => 0.1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0))), 1, $fill = true, $reseth = true, $align = 'left', $autopadding = true);
				
				$pdf->setCellHeightRatio(0.3);
				$pdf->writeHTMLCell( 3, 1, 29, 85.5,$html='', array('LTRB' => array('width' => 0.1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0))), 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
				$pdf->setCellHeightRatio(0.3);
		
				$pdf->writeHTMLCell( 45, 3, 32, 85.5, '<span style="font-size:8; color:#000000">1/4 Page</span>', 0, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);

				$pdf->writeHTMLCell( 45, 3, 32, 90, '<span style="font-size:8; color:#000000">$'.$groupdata['0']['Freeform']['quarter'].'</span>', 0, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);	
				
			}
			/**************1/4 end here***********/

			#######BIZ card start here#########
			if($groupdata['0']['Freeform']['biz']!='0.00') { 
			
				$pdf->writeHTMLCell( 25, 20, 59, 103.8,$html='', array('LTRB' => array('width' => 0.1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0))), 1, $fill = true, $reseth = true, $align = 'left', $autopadding = true);
				
				$pdf->setCellHeightRatio(0.3);
				$pdf->writeHTMLCell( 3, 1, 60, 105,$html='', array('LTRB' => array('width' => 0.1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0))), 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
				$pdf->setCellHeightRatio(0.3);
				
				$pdf->writeHTMLCell( 45, 3, 62.5, 105, '<span style="font-size:8; color:#000000"> Biz Card</span>', 0, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);

				$pdf->writeHTMLCell( 45, 3, 63.5, 108, '<span style="font-size:8; color:#000000"> $'.$groupdata['0']['Freeform']['biz'].'</span>', 0, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
			
			}
			#######BIZ card end here#########
			/******Message box**********/
			if($groupdata['0']['Freeform']['messagefield']!='0.00') { 
				
				$pdf->writeHTMLCell( 64, 8, 20, 127,$html='', array('LTRB' => array('width' => 0.1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0))), 1, $fill = 1, $reseth = true, $align = 'left', $autopadding = true);
				$pdf->setCellHeightRatio(0.3);
				$pdf->writeHTMLCell( 3, 1, 22, 130,$html='', array('LTRB' => array('width' => 0.1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0))), 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
				$pdf->setCellHeightRatio(0.3);
				
				$pdf->writeHTMLCell( 50, 3, 25, 130, '<span style="font-size:10; color:#000000">1 Line Message (Only) </span>', 0, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
 				$pdf->writeHTMLCell( 50, 3, 62, 130, '<span style="font-size:10; color:#000000">$'.$groupdata['0']['Freeform']['messagefield'].'</span>', 0, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
			
			}
			##############################3
	
	
		$pdf->writeHTMLCell( 80, 3, 18, 138, '<span style="font-size:10; color:#000000">OR  Anonymous $______ (Any amount)</span>',0, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
		
		##############Online directory info box##########
		
		$pdf->writeHTMLCell(150, 5, 16, 146, $html='<img src="'.$srno3.'">', 0, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
		
		$pdf->writeHTMLCell(0, 0, 24, 148.5, $html='<span style="color:#3d4783; font-size:15; font-weight:bold;">OPTIONAL BUSINESS LISTING DIRECTORY</span>', 0, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
		//$pdf->writeHTMLCell(150, 5, 22, 146, $html='<img src="'.$tit3.'">', 0, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
		$onlindiramt="";
		if($groupdata['0']['Freeform']['online_directory_amount']){
			$onlindiramt = '$'.$groupdata['0']['Freeform']['online_directory_amount'];
		}else{
			$onlindiramt = "$0.00";
		}
		$pdf->writeHTMLCell( 3, 1, 168, 172.5,$html='', array('LTRB' => array('width' => 0.1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0))), 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
		$pdf->writeHTMLCell( 178, 20, 18, 158, '<table><tr><td colspan="2">&nbsp;</td></tr>
		<tr>
		<td><label style="font-size:10;">Name:</label>_________________________</td>
		<td><label style="font-size:10;">Profession:</label>_________________________</td>
		</tr>
		
		<tr>
			<td>
				<p>&nbsp;</p><p>&nbsp;</p>
				<p><label style="font-size:10;">Email: </label>_________________________</p></td>
			<td><p>&nbsp;</p><p>&nbsp;</p><p><label  style="font-size:10;">Phone: </label>_________________________</p></td>
		</tr>
		
		<tr>
			<td colspan="2">
			<p>&nbsp;</p><p>&nbsp;</p>
				<p><label style="font-size:10;">Company: </label>________________________________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$onlindiramt.'</p></td>
			
		</tr>
		</table>',array('LTRB' => array('width' => 0.4, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0))), 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
		
		$pdf->writeHTMLCell(100, 3, 16, 180, $html='<img src="'.$srno4.'">', 0, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
		
		$pdf->writeHTMLCell(0, 0, 24, 182.5, $html='<span style="color:#3d4783; font-size:15; font-weight:bold;">DONOR INFORMATION</span>', 0, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
		//$pdf->writeHTMLCell(100, 3, 23, 180, $html='<img src="'.$tit4.'">', 0, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
		$pdf->writeHTMLCell( 178, 20, 18, 190, '<table><tr><td>&nbsp;</td></tr><tr>
		<td>

		<p><label style="font-size:10;">First Name:</label>
		_________________________&nbsp;&nbsp;<label style="font-size:10;">Last Name :&nbsp;&nbsp;</label>_________________________</p><p>&nbsp;</p>
		<p><label style="font-size:10;">Company:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>_________________________
		<label style="font-size:10;">Address:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>_________________________</p><p>&nbsp;</p>
		<p><label  style="font-size:10;">Country:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>____________
		<label  style="font-size:10;">City:&nbsp;&nbsp;</label>____________
		<label  style="font-size:10;">State:&nbsp;&nbsp;</label>____________
		<label  style="font-size:10;">Zip:&nbsp;&nbsp;</label>____________
		</p>
		
		</td>
		</tr></table>',array('LTRB' => array('width' => 0.4, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0))), 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);

		$pdf->writeHTMLCell(100, 3, 16, 212, $html='<img src="'.$srno5.'">', 0, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
		
		$pdf->writeHTMLCell(0, 0, 24, 214.5, $html='<span style="color:#3d4783; font-size:15; font-weight:bold;">BILLING & PLEDGE</span>', 0, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
		//$pdf->writeHTMLCell(100, 3, 23, 212, $html='<img src="'.$tit5.'">', 0, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
		$fillcard = 'img' . DS . 'pdf_form_imgs'. DS .'fill_txt.gif';
		$pdf->writeHTMLCell( 95, 49, 18, 222, '<table>
		<tr><td><p style="color:#DC2D2D"><img src="'.$fillcard.'"></p></td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr>
		<td>
		<p><label style="font-size:10;">Name on Card:</label>
		_________________________</p><p>&nbsp;</p>
		<p><label style="font-size:10;">Card Number:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>_________________________
		</p><p>&nbsp;</p>
		<p><label  style="font-size:10;">Expiration Date:&nbsp;&nbsp;&nbsp;</label>____________
		</p><p>&nbsp;</p>
		<p><label  style="font-size:10;">Sec. Code:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>____________ </p><p>&nbsp;</p>
		<p><label  style="font-size:10;">I pledge to pay the above amount and to abide by all the</label></p><p>&nbsp;</p>
		<p><label  style="font-size:10;">Terms & Conditions of AdBook LLC and the group.</label></p>
		</td>
		</tr></table>',array('LTRB' => array('width' => 0.4, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0))), 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);

		
		$pdf->writeHTMLCell(0, 0, 114, 214, $html='<span style="color:#3d4783; font-size:15; font-weight:bold;">TO</span>', 0, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
		$pdf->writeHTMLCell(0, 0, 130, 214, $html='<span style="color:#3d4783; font-size:15; font-weight:bold;">GROUP</span>', 0, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
		
		//$pdf->writeHTMLCell(60, 3, 114, 212, $html='<img src="'.$titleto.'">', 0, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
		//$pdf->writeHTMLCell(60, 3, 130, 212, $html='<img src="'.$titlegrp.'">', 0, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);


		$usstatename="";
		if($groupdata[0]['Freeform']['state']!='' && is_numeric($groupdata[0]['Freeform']['state'])){
			$usstatename = AppController::getstatename($groupdata[0]['Freeform']['state']);
		}else{
			$usstatename = $groupdata[0]['Freeform']['state'];
		}

		
		//$groupusername = $groupdata['User']['first_name'].' '.$groupdata['User']['middle_name'].'  '.$groupdata['User']['last_name'];
		$groupusername = 'N/A';
		$address1 =$groupdata['0']['Freeform']['city'].', '.$usstatename.' '.$groupdata['0']['Freeform']['zipcode'];
		$emaillength = strlen($groupdata['0']['Freeform']['email']);
		$makebr='';
		if($emaillength > 23){
		$makebr = '<p>&nbsp;</p>';
		}
		$pdf->writeHTMLCell(72, 49, 123, 222, '<table><tr>
		<td ><p>&nbsp;</p>
		<p><label  style="font-size:12;"><strong>&nbsp;&nbsp;&nbsp;&nbsp;Group Information</strong></label></p><p>&nbsp;</p>
		<p><label  style="font-size:10;"><strong>&nbsp;&nbsp;&nbsp;&nbsp;'.$groupdata['0']['Freeform']['group_name'].'</strong></label></p><p>&nbsp;</p>
		<p style="widht:auto;"><label  style="font-size:10;">&nbsp;&nbsp;&nbsp;Address:  '.$groupdata['0']['Freeform']['address'].'</label>
		</p><p>&nbsp;</p>
		<p style="widht:auto;"><label  style="font-size:10;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$address1.'</label>
		</p><p>&nbsp;</p>
		<p><label  style="font-size:10;">&nbsp;&nbsp;&nbsp;Phone: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$groupdata['0']['Freeform']['phone'].'</label>
		</p><p>&nbsp;</p>
		<p><label  style="font-size:10;"><strong>&nbsp;&nbsp;&nbsp;Contact Person </strong></label></p><p>&nbsp;</p>
		<!--p><label  style="font-size:10;">&nbsp;&nbsp;&nbsp;Name: '.$groupusername.'</label></p><p>&nbsp;</p-->
		<p><label  style="font-size:10;">&nbsp;&nbsp;&nbsp;Phone: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$groupdata['0']['Freeform']['phone'].'</label></p><p>&nbsp;</p>
		<p><label  style="font-size:10;">&nbsp;&nbsp;&nbsp;Email: '.$makebr.' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$groupdata['0']['Freeform']['email'].'</label></p>
		
		</td>
		</tr></table>',array('LTRB' => array('width' => 0.4, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0))), 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
		
		$pdf->writeHTMLCell(70, 3, 15, 271.5, $html='<img src="'.$srno6.'">', 0, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
		
		$pdf->writeHTMLCell(0, 0, 22.5, 274, $html='<span style="color:#3d4783; font-size:15; font-weight:bold;">X</span>', 0, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
		//$pdf->writeHTMLCell(70, 3, 22, 272, $html='<img src="'.$crimg.'">', 0, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
		$pdf->writeHTMLCell(70, 3, 30, 273, $html='___________________________', 0, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
		$pdf->writeHTMLCell(70, 3, 50, 277, $html='Signatue', 0, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
		//$pdf->writeHTMLCell(60, 3, 150, 280, $html='<img src="'.$thanks.'">', 0, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
		$pdf->writeHTMLCell(60, 3, 150, 273, $html='<p style="font-weight:bold; font-size:18">Thank You!</p>', 0, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
		
		//++++++++++++================================End if available===============================++++++++++++++++++++//
			
			
			}else{
			
			
			//++++++++++++========================IF LISTING NOT AVAILABLE============================++++++++++++++++++++//
			
			$pdf->writeHTMLCell(0, 0, 15, 42, $html='<img src="'.$srno1.'">', 0, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
			
			
			$pdf->writeHTMLCell(0, 0, 23, 41.8, $html='<span style="color:#3d4783; font-size:15; font-weight:bold;">AD SIZES</span>', 0, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
			
			//$pdf->writeHTMLCell(0, 0, 23, 42, $html='<img src="'.$tit1.'">', 0, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
			
			$pdf->writeHTMLCell(0, 0, 85, 42, $html='<img src="'.$srno2.'">', 0, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
			
			$pdf->writeHTMLCell(0, 0, 93, 41.8, $html='<span style="color:#3d4783; font-size:15; font-weight:bold;">YOUR AD OR MESSAGE HERE</span>', 0, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
			//$pdf->writeHTMLCell(0, 0, 93, 40.6, $html='<img src="'.$tit2.'">', 0, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
			
			
			$pdf->writeHTMLCell(0, 0, 165, 64.7, $html='<img src="'.$groupsubtypeimg1.'" width="45" height="45">', 0, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
			$pdf->writeHTMLCell(0, 0, 165, 80.7, $html='<img src="'.$groupsubtypeimg3.'" width="45" height="45">', 0, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
			
			$pdf->writeHTMLCell(0, 0, 182, 63.7, $html='<img src="'.$groupsubtypeimg2.'" width="45" height="45">', 0, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
			$pdf->writeHTMLCell(0, 0, 182, 79.7, $html='<img src="'.$groupsubtypeimg4.'" width="45" height="45">', 0, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
			
			
			$pdf->writeHTMLCell(110, 110, 90, 50, $html='<img src="'.$editorimg.'">', 0, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
			$vardue='';
			if($groupdata[0]['Freeform']['duedate']){
				$vardue = $groupdata[0]['Freeform']['duedate'];
			}else{
				$vardue = '______________';
			}
			
			$pdf->writeHTMLCell( 100, 3, 90, 135, '<span style="font-size:10; color:#000000">The Due Date is: '.$vardue.' To upload your ad, go to www.AdBookOnLine.org</span>',0, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
			
				########FULL PAGE GOLD########
			if($groupdata['0']['Freeform']['gold'] !='0.00') { 
				
				$pdf->writeHTMLCell( 55, 50, 20, 52, '<span style="font-size:10; color:#000000"><b></b></span>', array('LTRB' => array('width' => 0.1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0))), 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
				$pdf->setCellHeightRatio(0.3);
				$pdf->writeHTMLCell( 3, 1, 21, 52.5,$html='', array('LTRB' => array('width' => 0.1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0))), 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
				$pdf->setCellHeightRatio(0.3);
				$pdf->writeHTMLCell( 60, 3, 25, 52.5, '<span style="font-size:10; color:#000000">Gold Full Page  $'.$groupdata['0']['Freeform']['gold'].'</span>', 0, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
			########FULL PAGE GOLD END HERE########
			}
			#########FULL PAGE SILVER START HERE###########
			if($groupdata['0']['Freeform']['silver'] !='0.00') { 
				
				$pdf->writeHTMLCell( 55, 50, 22, 58,$html='', array('LTRB' => array('width' => 0.1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0))), 1, $fill = 1, $reseth = true, $align = 'left', $autopadding = true);
				$pdf->setCellHeightRatio(0.3);
				$pdf->writeHTMLCell( 3, 1, 23, 58.5,$html='', array('LTRB' => array('width' => 0.1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0))), 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
				$pdf->setCellHeightRatio(0.3);
				$pdf->writeHTMLCell( 80, 3, 27, 58.5, '<span style="font-size:10; color:#000000">Silver Full Page  $'.$groupdata['0']['Freeform']['silver'].'</span>', 0, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
			#########FULL PAGE SILVER START END HERE###########
			}
			#########FULL PAGE SPONSOR START HERE###########

			if($groupdata['0']['Freeform']['sponsor'] !='0.00') { 
				
				$pdf->writeHTMLCell( 55, 50, 24, 64,$html='', array('LTRB' => array('width' => 0.1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0))), 1, $fill = 1, $reseth = true, $align = 'left', $autopadding = true);
				$pdf->setCellHeightRatio(0.3);
				$pdf->writeHTMLCell( 3, 1, 25, 64.5,$html='', array('LTRB' => array('width' => 0.1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0))), 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
				$pdf->setCellHeightRatio(0.3);
				$pdf->writeHTMLCell( 80, 3, 29, 64.5, '<span style="font-size:10; color:#000000">Paper Full Page  $'.$groupdata['0']['Freeform']['sponsor'].'</span>', 0, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
			}	
			#########FULL PAGE SPONSOR END HERE###########
			########Half page start here#########

		
			if($groupdata['0']['Freeform']['half_sponsor'] !='0.00'){ 
			
				$pdf->writeHTMLCell( 55, 25, 26, 70,$html='', array('LTRB' => array('width' => 0.1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0))), 1, $fill = 1, $reseth = true, $align = 'left', $autopadding = true);
					$pdf->setCellHeightRatio(0.3);
					$pdf->writeHTMLCell( 3, 1, 27, 70.5,$html='', array('LTRB' => array('width' => 0.1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0))), 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
					$pdf->setCellHeightRatio(0.3);
				
					$pdf->writeHTMLCell( 85, 3, 31, 70.5, '<span style="font-size:10; color:#000000">1/2 Page $'.$groupdata['0']['Freeform']['half_sponsor'].'</span>', 0, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
			
			}
			
			
			########Half page end here#########			
			if($groupdata['0']['Freeform']['quarter']!='0.00') {
			
			
				$pdf->writeHTMLCell( 3, 1, 27, 15.5,$html='', array('LTRB' => array('width' => 0.1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0))), 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
	
	
				/******1/4 sponsor**********/
				$pdf->writeHTMLCell( 30, 40, 28, 83.5,$html='', array('LTRB' => array('width' => 0.1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0))), 1, $fill = true, $reseth = true, $align = 'left', $autopadding = true);
				
				$pdf->setCellHeightRatio(0.3);
				$pdf->writeHTMLCell( 3, 1, 29, 85.5,$html='', array('LTRB' => array('width' => 0.1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0))), 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
				$pdf->setCellHeightRatio(0.3);
		
				$pdf->writeHTMLCell( 45, 3, 32, 85.5, '<span style="font-size:8; color:#000000">1/4 Page</span>', 0, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);

				$pdf->writeHTMLCell( 45, 3, 32, 90, '<span style="font-size:8; color:#000000">$'.$groupdata['0']['Freeform']['quarter'].'</span>', 0, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);	
				
			}
			/**************1/4 end here***********/

			#######BIZ card start here#########
			if($groupdata['0']['Freeform']['biz']!='0.00') { 
			
				$pdf->writeHTMLCell( 25, 20, 59, 103.8,$html='', array('LTRB' => array('width' => 0.1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0))), 1, $fill = true, $reseth = true, $align = 'left', $autopadding = true);
				
				$pdf->setCellHeightRatio(0.3);
				$pdf->writeHTMLCell( 3, 1, 60, 105,$html='', array('LTRB' => array('width' => 0.1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0))), 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
				$pdf->setCellHeightRatio(0.3);
				
				$pdf->writeHTMLCell( 45, 3, 62.5, 105, '<span style="font-size:8; color:#000000"> Biz Card</span>', 0, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);

				$pdf->writeHTMLCell( 45, 3, 63.5, 108, '<span style="font-size:8; color:#000000"> $'.$groupdata['0']['Freeform']['biz'].'</span>', 0, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
			
			}
			#######BIZ card end here#########
			/******Message box**********/
			if($groupdata['0']['Freeform']['messagefield']!='0.00') { 
				
				$pdf->writeHTMLCell( 64, 8, 20, 127,$html='', array('LTRB' => array('width' => 0.1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0))), 1, $fill = 1, $reseth = true, $align = 'left', $autopadding = true);
				$pdf->setCellHeightRatio(0.3);
				$pdf->writeHTMLCell( 3, 1, 22, 130,$html='', array('LTRB' => array('width' => 0.1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0))), 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
				$pdf->setCellHeightRatio(0.3);
				
				$pdf->writeHTMLCell( 50, 3, 25, 130, '<span style="font-size:10; color:#000000">1 Line Message (Only) </span>', 0, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
 				$pdf->writeHTMLCell( 50, 3, 62, 130, '<span style="font-size:10; color:#000000">$'.$groupdata['0']['Freeform']['messagefield'].'</span>', 0, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
			
			}
			##############################3
	
	
		$pdf->writeHTMLCell( 80, 3, 18, 138, '<span style="font-size:10; color:#000000">OR  Anonymous $______ (Any amount)</span>',0, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
		
		##############Online directory info box##########
		
		
		
		$pdf->writeHTMLCell(150, 5, 15, 150, $html='<img src="'.$srno3.'">', 0, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
		
		$pdf->writeHTMLCell(0, 0, 23, 152.3, $html='<span style="color:#3d4783; font-size:15; font-weight:bold;">DONOR INFORMATION</span>', 0, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
		//$pdf->writeHTMLCell(100, 3, 23, 180, $html='<img src="'.$tit4.'">', 0, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
		$pdf->writeHTMLCell( 178, 20, 18, 160, '<table><tr><td>&nbsp;</td></tr><tr>
		<td>

		<p><label style="font-size:10;">First Name:</label>
		_________________________&nbsp;&nbsp;<label style="font-size:10;">Last Name :&nbsp;&nbsp;</label>_________________________</p><p>&nbsp;</p>
		<p><label style="font-size:10;">Company:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>_________________________
		<label style="font-size:10;">Address:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>_________________________</p><p>&nbsp;</p>
		<p><label  style="font-size:10;">Country:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>____________
		<label  style="font-size:10;">City:&nbsp;&nbsp;</label>____________
		<label  style="font-size:10;">State:&nbsp;&nbsp;</label>____________
		<label  style="font-size:10;">Zip:&nbsp;&nbsp;</label>____________
		</p>
		
		</td>
		</tr></table>',array('LTRB' => array('width' => 0.4, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0))), 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);

		$pdf->writeHTMLCell(100, 3, 16, 188, $html='<img src="'.$srno4.'">', 0, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
		
		$pdf->writeHTMLCell(0, 0, 24, 190.3, $html='<span style="color:#3d4783; font-size:15; font-weight:bold;">BILLING & PLEDGE</span>', 0, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
		//$pdf->writeHTMLCell(100, 3, 23, 212, $html='<img src="'.$tit5.'">', 0, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
		$fillcard = 'img' . DS . 'pdf_form_imgs'. DS .'fill_txt.gif';
		$pdf->writeHTMLCell( 95, 49, 18, 199, '<table>
		<tr><td><p style="color:#DC2D2D"><img src="'.$fillcard.'"></p></td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr>
		<td>
		<p><label style="font-size:10;">Name on Card:</label>
		_________________________</p><p>&nbsp;</p>
		<p><label style="font-size:10;">Card Number:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>_________________________
		</p><p>&nbsp;</p>
		<p><label  style="font-size:10;">Expiration Date:&nbsp;&nbsp;&nbsp;</label>____________
		</p><p>&nbsp;</p>
		<p><label  style="font-size:10;">Sec. Code:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>____________ </p><p>&nbsp;</p>
		<p><label  style="font-size:10;">I pledge to pay the above amount and to abide by all the</label></p><p>&nbsp;</p>
		<p><label  style="font-size:10;">Terms & Conditions of AdBook LLC and the group.</label></p>
		</td>
		</tr></table>',array('LTRB' => array('width' => 0.4, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0))), 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);

		
		$pdf->writeHTMLCell(0, 0, 114, 190, $html='<span style="color:#3d4783; font-size:15; font-weight:bold;">TO</span>', 0, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
		$pdf->writeHTMLCell(0, 0, 130, 190, $html='<span style="color:#3d4783; font-size:15; font-weight:bold;">GROUP</span>', 0, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
		
		//$pdf->writeHTMLCell(60, 3, 114, 212, $html='<img src="'.$titleto.'">', 0, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
		//$pdf->writeHTMLCell(60, 3, 130, 212, $html='<img src="'.$titlegrp.'">', 0, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);


		$usstatename="";
		if($groupdata[0]['Freeform']['state']!='' && is_numeric($groupdata[0]['Freeform']['state'])){
			$usstatename = AppController::getstatename($groupdata[0]['Freeform']['state']);
		}else{
			$usstatename = $groupdata[0]['Freeform']['state'];
		}

		
		//$groupusername = $groupdata['User']['first_name'].' '.$groupdata['User']['middle_name'].'  '.$groupdata['User']['last_name'];
		$groupusername = 'N/A';
		$address1 =$groupdata['0']['Freeform']['city'].', '.$usstatename.' '.$groupdata['0']['Freeform']['zipcode'];
		$emaillength = strlen($groupdata['0']['Freeform']['email']);
		$makebr='';
		if($emaillength > 23){
		$makebr = '<p>&nbsp;</p>';
		}
		$pdf->writeHTMLCell(72, 49, 123, 199, '<table><tr>
		<td ><p>&nbsp;</p>
		<p><label  style="font-size:12;"><strong>&nbsp;&nbsp;&nbsp;&nbsp;Group Information</strong></label></p><p>&nbsp;</p>
		<p><label  style="font-size:10;"><strong>&nbsp;&nbsp;&nbsp;&nbsp;'.$groupdata['0']['Freeform']['group_name'].'</strong></label></p><p>&nbsp;</p>
		<p style="widht:auto;"><label  style="font-size:10;">&nbsp;&nbsp;&nbsp;Address:  '.$groupdata['0']['Freeform']['address'].'</label>
		</p><p>&nbsp;</p>
		<p style="widht:auto;"><label  style="font-size:10;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$address1.'</label>
		</p><p>&nbsp;</p>
		<p><label  style="font-size:10;">&nbsp;&nbsp;&nbsp;Phone: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$groupdata['0']['Freeform']['phone'].'</label>
		</p><p>&nbsp;</p>
		<p><label  style="font-size:10;"><strong>&nbsp;&nbsp;&nbsp;Contact Person </strong></label></p><p>&nbsp;</p>
		<!--p><label  style="font-size:10;">&nbsp;&nbsp;&nbsp;Name: '.$groupusername.'</label></p><p>&nbsp;</p-->
		<p><label  style="font-size:10;">&nbsp;&nbsp;&nbsp;Phone: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$groupdata['0']['Freeform']['phone'].'</label></p><p>&nbsp;</p>
		<p><label  style="font-size:10;">&nbsp;&nbsp;&nbsp;Email: '.$makebr.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$groupdata['0']['Freeform']['email'].'</label></p>
		
		</td>
		</tr></table>',array('LTRB' => array('width' => 0.4, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0))), 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
		
		$pdf->writeHTMLCell(70, 3, 15, 252, $html='<img src="'.$srno5.'">', 0, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
		
		$pdf->writeHTMLCell(0, 0, 23, 254.2, $html='<span style="color:#3d4783; font-size:15; font-weight:bold;">X</span>', 0, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
		//$pdf->writeHTMLCell(70, 3, 22, 272, $html='<img src="'.$crimg.'">', 0, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
		$pdf->writeHTMLCell(70, 3, 30, 254, $html='___________________________', 0, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
		$pdf->writeHTMLCell(70, 3, 50, 260, $html='Signatue', 0, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
		//$pdf->writeHTMLCell(60, 3, 150, 280, $html='<img src="'.$thanks.'">', 0, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
		$pdf->writeHTMLCell(60, 3, 150, 260, $html='<p style="font-weight:bold; font-size:18">Thank You!</p>', 0, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
		
		//++++++++++++============================if listing not available========================================++++++++++++++++++++//
			
			
			
			
			}
			
			
		
		
		$copyright1 = 'img' . DS . 'pdf_form_imgs'. DS .'copyrte.gif';
		$copyright2 = 'img' . DS . 'pdf_form_imgs'. DS .'abol_logo.jpg';
		$copyright3 = 'img' . DS . 'pdf_form_imgs'. DS .'dot_com.gif';
		
		$pdf->writeHTMLCell(70, 3, 12, 283, $html='<img src="'.$copyright1.'">', 0, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
		
		$pdf->writeHTMLCell(70, 3, 85, 283, $html='<img src="'.$copyright2.'">', 0, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
		
		$pdf->writeHTMLCell(70, 3, 130, 283, $html='<img src="'.$copyright3.'">', 0, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
		
		

		$pdf->AddPage();

		$pdf->setCellHeightRatio(0.5);
		$pdf->writeHTMLCell( 180, 3, 35, 60, '------------------------------------------<span style="font-size:9"
		>Folder Here</span> ------------------------------------------',0, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
		$pdf->setCellHeightRatio(0.5);
		$pdf->writeHTMLCell( 180, 3, 35, 140, '------------------------------------------<span style="font-size:9"
		>Folder Here</span> ------------------------------------------',0, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);	

		$pdf->setCellHeightRatio(0.5);
		$pdf->writeHTMLCell( 180, 3, 35, 150, '_______________________________',0, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);

		$pdf->setCellHeightRatio(0.5);
		$pdf->writeHTMLCell( 180, 3, 35, 157, '_______________________________',0, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
		$pdf->setCellHeightRatio(0.5);
		$pdf->writeHTMLCell( 180, 3, 35, 164, '_______________________________',0, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);				

		
		//$pdf->setCellHeightRatio(0.5);
		$pdf->writeHTMLCell( 20, 20, 140, 150, '',1, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);				

		$pdf->setCellHeightRatio(0.5);
		$pdf->writeHTMLCell( 20, 3, 142, 152, '<span style="font-size:8">Apply</span>',0, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);

		$pdf->setCellHeightRatio(0.5);
		$pdf->writeHTMLCell( 20, 3, 142, 159, '<span style="font-size:8">Postage</span>',0, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);



		$pdf->setCellHeightRatio(0.5);
		$pdf->writeHTMLCell( 150, 3, 80, 200, 'To: &nbsp;'.$groupdata['0']['Freeform']['group_name'],0, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);

		$pdf->setCellHeightRatio(0.5);
		$pdf->writeHTMLCell( 180, 3, 80, 205, "<p>".$groupdata['0']['Freeform']['address']."</p>",0, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);

		$pdf->setCellHeightRatio(0.5);
		$pdf->writeHTMLCell( 180, 3, 80, 210, "<p>".$groupdata['0']['Freeform']['city']." ".$usstatename.','.$groupdata['0']['Freeform']['zipcode']."</p>",0, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);																
		$pdf->setCellHeightRatio(0.5);
		$pdf->writeHTMLCell( 120, 3, 75, 265, '<span style="font-size:10"><i>Powered by www.AdBookOnLine.org</i></span>',0, 1, $fill = false, $reseth = true, $align = 'left', $autopadding = true);
		ob_end_clean();
		//Close and output PDF document
		$formname = $groupdata['0']['Freeform']['id'].'_addbookorderform.pdf';
		$repnm = 'freeformpdf/'.$formname;
		$pdf->Output($repnm, 'F');
		
		 App::import("Model", "Freeform");
			  $this->Freeform   = & new Freeform();
		          $gid =$groupdata[0]['Freeform']['id'];
		          
		          $this->Freeform->id = $gid;
			  $this->data['Freeform']['pdfname'] = $formname;		  
		  
				  if($this->Freeform->save($this->data)){
				  
				   	return 'ok';
				  }
									
		}
		
	function generatecontentpdf($string,$filename){
		$this->layout = false;		
		$string ='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title>Untitled Document</title></head>
		<body>
		<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
		<tr>
		<td align="left" valign="top">'.$string.'</td>
		</tr>
		</table>
		</body>
		</html>
		';
		
		$httppath ='http://'.$_SERVER['HTTP_HOST'];
		$docroot =$_SERVER['DOCUMENT_ROOT']; 
		define('_MPDF_PATH',$docroot.'/app/vendors/mpdf3_2/');

		App::import('Vendor', 'mpdf3_2', array('file' => 'mpdf.php'));
		//$filename = time();
		//$filename ='sample';
		$mpdf=new mPDF('en-GB','A4','','',10,10,10,10,6,3); 
			
		$mpdf->use_embeddedfonts_1252 = false;	// false is default
			
		$mpdf->SetDisplayMode('fullpage');
			
		$mpdf->SetTitle('AdBookOnline');
			
		$mpdf->list_indent_first_level = 0;	// 1 or 0 - whether to indent the first level of a list

		//$stylesheet =$docroot."/app/webroot/css/userstyles.css";
		
		//$mpdf->WriteHTML($stylesheet,1);
		
		$mpdf->WriteHTML($string);
						
		$repnm = 'img/docs/donor/'.$filename.'.pdf';
		$mpdf->Output($repnm,'F');			
						
		}

	
	function generatedonorformpdf($string1){


		$string ='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title>Untitled Document</title></head>
		<body>
		<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
		<tr>
		<td align="left" valign="top"> '.$string1.'
		</td>
		</tr>
		</table>
		</body>
		</html>
		';
		
		$httppath ='http://'.$_SERVER['HTTP_HOST'];
		$docroot =$_SERVER['DOCUMENT_ROOT']; 
		define('_MPDF_PATH',$docroot.'/app/vendors/mpdf3_2/');

		App::import('Vendor', 'mpdf3_2', array('file' => 'mpdf.php'));
		//$filename = time();
		//$filename ='sample';
		$mpdf=new mPDF('en-GB','A3','','',10,10,10,10,6,3); 
			
		$mpdf->use_embeddedfonts_1252 = false;	// false is default
		//$mpdf->keep_table_proportions = true;
		$mpdf->SetDisplayMode('fullpage');
			
		$mpdf->SetTitle('AdBookOnline');
			
		$mpdf->list_indent_first_level = 0;	// 1 or 0 - whether to indent the first level of a list

		//$stylesheet =$docroot."/app/webroot/css/userstyles.css";
		
		//$mpdf->WriteHTML($stylesheet,1);
		
		$mpdf->WriteHTML($string);
						
		$repnm = 'donorsadpdf/testa.pdf';
		$mpdf->Output($repnm,'F');
		
		
		}	
	}
		
	
?>