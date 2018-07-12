<?php
/**
	* Component for File handling
	* 
	*
	* PHP versions 5.1.4
	* @filesource
	* @author     Sujeesh.V 
	* @link       http://www.supportresort.com/
	* @link       http://cribhut.com Cribhut
	* @copyright  Copyright ? 2007 Cribhut
	* @version 0.0.1 
	*   - Initial release
	*/
class FileComponent extends Object {
	/**
	* Controller name
	* @access public
	*/
	public $controller;
	public $fileName;
	public $destPath;
	public $useHash = false;
	public $cleanName = false;

	public function startup( &$controller ) {
		$this->controller = &$controller;
    }

	public function getFileName() {
		return $this->fileName;
	}

	public function setFileName($fname) {	
		$this->fileName  = $fname;
	}

	public function setDestPath($path) {
		$this->destPath = $path;
	}
	
	
	public function creatThumb_new($filename,$orgImage='',$imagsize='') {
	
								if($orgImage=='jpg' or $orgImage=='jpeg' or $orgImage=='JPG' or $orgImage=='JPEG'){
										$src = imagecreatefromjpeg($filename);
								}
								else if($orgImage=='gif' or $orgImage=='GIF'){
										$src = imagecreatefromgif($filename);
								}
								else if($orgImage=='png' or $orgImage=='PNG'){
										$src = imagecreatefrompng($filename);
										
								}
								else{
										$src = imagecreatefromjpeg($filename);
								}
		//$src = imagecreatefromjpeg($filename);
		//Capture the original size of the uploaded image
		list($width,$height)=getimagesize($filename);
		
		if($imagsize){
			$expimagedi =  explode('x',$imagsize);
			$newwidth = $expimagedi[0];
			$newheight = $expimagedi[1];
		}else{
			$newwidth=0;
			$newheight=0;
		}
								if($orgImage=='png' or $orgImage=='PNG'){

										$tmp = imagecreatetruecolor($newwidth,$newheight);
										imagesavealpha($tmp, true);
										
										// Create some colors
										$white = imagecolorallocate($tmp, 255, 255, 255);
										$grey = imagecolorallocate($tmp, 128, 128, 128);
										$black = imagecolorallocate($tmp, 0, 0, 0);
										imagefilledrectangle($tmp, 0, 0, 150, 25, $black);
										$trans_colour = imagecolorallocatealpha($tmp, 0, 0, 0, 127);
										imagefill($tmp, 0, 0, $trans_colour);

										imagecopyresampled($tmp, $src ,0,0,0,0,$newwidth,$newheight,$width,$height);
										@imagepng($tmp,$filename);
								}else{
									$tmp = imagecreatetruecolor($newwidth,$newheight);
									// this line actually does the image resizing, copying from the original
									// image into the $tmp image
									imagecopyresampled($tmp, $src ,0,0,0,0,$newwidth,$newheight,$width,$height);
									imagejpeg($tmp,$filename,100);
								}

		return $filename;	
	}
	

public function uploadlogo($originName,$tmp_name,$getRandomName =  TRUE,$dimention='') {	
		
		//echo $tmp_name.'<<<<<<<<<';
		if(is_dir($this->destPath))	{
		
			//$extDot = explode(".",$this->fileName);
			$extension=end(explode(".",$this->fileName));
			
			$ext = $extension;
			if($ext=='')
			{
				$ext= "jpg";
			}
			//$this->fileName = ($getRandomName)?$this->getRandomGroupFileName($ext):$this->fileName;
			$this->fileName = 'Home_header_logo_'.time();
			if(!strstr($this->fileName,".")) {
				$this->fileName .= ".".$ext;
			}

			if($this->cleanName)	{
				$this->fileName = $this->clean_string(substr($this->fileName,0,strlen($this->fileName)-(strlen($ext) + 1))).".".$ext;
			}
			/*if(!$dimention){
				$dimention = "300x50"; //standared for coin
			}*/
			
			$tnewf = $this->creatThumb_new($tmp_name,$ext,$dimention);
			
			//resize($original, $new_filename, $new_width = 0, $new_height = 0, $quality = 100);
		if(!empty($tmp_name)){
			if(copy($tnewf, $this->destPath."/".$this->fileName)){
				return $this->fileName;	
			}else{
				return false;
			}
		   }		
		}else {
			echo 'Destination directory does not exists!';
		}
	}	
	
public function uploadcoin($originName,$tmp_name,$getRandomName =  TRUE) {	
		
		//echo $tmp_name.'<<<<<<<<<';
		if(is_dir($this->destPath))	{
		
			$extDot = explode(".",$this->fileName);
			
			$ext = $extDot[1];
			if($ext=='')
			{
				$ext= "jpg";
			}
			$this->fileName = ($getRandomName)?$this->getRandomGroupFileName($ext):$this->fileName;
			if(!strstr($this->fileName,".")) {
				$this->fileName .= ".".$ext;
			}

			if($this->cleanName)	{
				$this->fileName = $this->clean_string(substr($this->fileName,0,strlen($this->fileName)-(strlen($ext) + 1))).".".$ext;
			}
			
		$dimention = "250x250"; //standared for coin
			$tnewf = $this->creatThumb_new($tmp_name,$ext,$dimention);
			
			//resize($original, $new_filename, $new_width = 0, $new_height = 0, $quality = 100);
		if(!empty($tmp_name)){
			if(copy($tnewf, $this->destPath."/".$this->fileName)){
				return $this->fileName;	
			}else{
				return false;
			}
		   }		
		}else {
			echo 'Destination directory does not exists!';
		}
	}
	
		
public function uploadfavicon($originName,$tmp_name,$getRandomName =  TRUE) {	
		
		//echo $tmp_name.'<<<<<<<<<';
		if(is_dir($this->destPath))	{
		
			$extDot = explode(".",$this->fileName);
			
			$ext = $extDot[1];
			if($ext=='')
			{
				$ext= "ICO";
			}
			$this->fileName = ($getRandomName)?$this->getRandomGroupFileName($ext):$this->fileName;
			if(!strstr($this->fileName,".")) {
				$this->fileName .= ".".$ext;
			}

			if($this->cleanName)	{
				$this->fileName = $this->clean_string(substr($this->fileName,0,strlen($this->fileName)-(strlen($ext) + 1))).".".$ext;
			}
			
			$dimention = "20x20"; //standared for icon
			$tnewf = $this->creatThumb_new($tmp_name,$dimention);
			
			//resize($original, $new_filename, $new_width = 0, $new_height = 0, $quality = 100);
		if(!empty($tmp_name)){
			if(copy($tnewf, $this->destPath."/".$this->fileName)){
				return $this->fileName;	
			}else{
				return false;
			}
		   }		
		}else {
			echo 'Destination directory does not exists!';
		}
	}
	
	
	// By suman singh
	public function uploadEmailUploads($originName,$tmp_name,$getRandomName =  TRUE) {	
		
		if(is_dir($this->destPath))	{
		
			$extDot = explode(".",$this->fileName);
			
			$ext = $extDot[1];
			
			$this->fileName = ($getRandomName)?$this->getRandomGroupFileName($ext):$this->fileName;
			if(!strstr($this->fileName,".")) {
				$this->fileName .= ".".$ext;
			}

			if($this->cleanName)	{
				$this->fileName = $this->clean_string(substr($this->fileName,0,strlen($this->fileName)-(strlen($ext) + 1))).".".$ext;
			}
			
		if(!empty($tmp_name)){
			if(copy($tmp_name, $this->destPath."/".$this->fileName)){
				return $this->fileName;	
			}else{
				return false;
			}
		   }		
		}else {
			echo 'Destination directory does not exists!';
		}
	}

	//end of function for upload docs



	//function for image background 
	public function uploadbackgroundimage($originName,$tmp_name,$getRandomName =  TRUE){	
		
		//echo $tmp_name.'<<<<<<<<<';
		if(is_dir($this->destPath))	{
		
			$extDot = explode(".",$this->fileName);
			
			$ext = $extDot[1];
			if($ext=='')
			{
				$ext= "JPEG";
			}
			$this->fileName = ($getRandomName)?$this->getRandomGroupFileName($ext):$this->fileName;
			if(!strstr($this->fileName,".")) {
				$this->fileName .= ".".$ext;
			}

			if($this->cleanName)	{
				$this->fileName = $this->clean_string(substr($this->fileName,0,strlen($this->fileName)-(strlen($ext) + 1))).".".$ext;
			}
			
			/*$dimention = "800x1500"; //stanared for icon*/
			$tnewf = $this->creatThumb_new($tmp_name,$ext);
			
			//resize($original, $new_filename, $new_width = 0, $new_height = 0, $quality = 100);
		if(!empty($tmp_name)){
			if(copy($tnewf, $this->destPath."/".$this->fileName)){
				return $this->fileName;	
			}else{
				return false;
			}
		   }		
		}else {
			echo 'Destination directory does not exists!';
		}
	}
	






	public function getRandomFileName($exten = null) {	
		if($this->useHash===true) {
			$fileName  = md5($this->controller->misc->generate_unique_string(10));
		}else {
			
			$fileName  = rand(1000,1000000);
		}		
		
		if($this->is_exists($fileName.'.'.$exten)) {	
			$this->getRandomFileName($exten);	
		}else {
			return $fileName;			
		}
	}


	public function getRandomGroupFileName($exten = null) {	
		#############33
	    $random_id_length = 10;
		//generate a random id encrypt it and store it in $rnd_id
		$rnd_id = crypt(uniqid(rand(),1));
		//to remove any slashes that might have come
		$rnd_id = strip_tags(stripslashes($rnd_id));
		//Removing any . or / and reversing the string
		$rnd_id = str_replace(".","",$rnd_id);
		$rnd_id = strrev(str_replace("/","",$rnd_id));
		//finally I take the first 10 characters from the $rnd_id
		$fileName = substr($rnd_id,0,$random_id_length);
		
			return $fileName.'.'.$exten;	
		
	}	
	
	public function is_exists($filename) {
		//echo $this->destPath."/".$filename."<br>";
		if(file_exists($this->destPath."/".$filename)) {
			return true;
		} else {
			return false;
		}
	}

	public function createHashValue($fileName) {
		return md5(file_get_contents($fileName)+filesize($fileName));
	} 

	public function getFileExt($fileName) {
		return substr($fileName,strpos($fileName,"/")+1);
	}

	/* allow letters, numbers and underscore(-) only. removing anything else with underscore.
	for ex "myname is : No -- 007 i.e. Mr. Bond" will be changed to "myname_is_no_007_ie_mr_bond"
	*/
	public function clean_string($text)	{
		$text = preg_replace('/[^\w]/', '_', $text);
		$text = preg_replace('/[\_\-]{1,}/', '_', $text);
		$text = preg_replace('/^\_?(.*?)\_?$/', '\1', $text);
		return strtolower($text);
	}
	
	
	/* RESIZE IMAGE       */

	public function resize($original, $new_filename, $new_width = 0, $new_height = 0, $quality = 100) {
        if(!($image_params = getimagesize($original))) {
            $this->__errors[] = 'Original file is not a valid image: ' . $orignal;
            return false;
        }

        $width = $image_params[0];
        $height = $image_params[1];

        if(0 != $new_width && 0 == $new_height) {
            $scaled_width = $new_width;
            $scaled_height = floor($new_width * $height / $width);
        } elseif(0 != $new_height && 0 == $new_width) {
            $scaled_height = $new_height;
            $scaled_width = floor($new_height * $width / $height);
        } elseif(0 == $new_width && 0 == $new_height) { //assume we want to create a new image the same exact size
            $scaled_width = $width;
            $scaled_height = $height;
        } else { //assume we want to create an image with these exact dimensions, most likely resulting in distortion
            $scaled_width = $new_width;
            $scaled_height = $new_height;
        }

        //create image       
        $ext = $image_params[2];
        switch($ext) {
            case IMAGETYPE_GIF:
                $return = $this->__resizeGif($original, $new_filename, $scaled_width, $scaled_height, $width, $height, $quality);
                break;
            case IMAGETYPE_JPEG:
                $return = $this->__resizeJpeg($original, $new_filename, $scaled_width, $scaled_height, $width, $height, $quality);
                break;
            case IMAGETYPE_PNG:
                $return = $this->__resizePng($original, $new_filename, $scaled_width, $scaled_height, $width, $height, $quality);
                break;   
            default:
                $return = $this->__resizeJpeg($original, $new_filename, $scaled_width, $scaled_height, $width, $height, $quality);
                break;
        }
              return $return;
    }

    public function getErrors() {
        return $this->__errors;
    }

    private function __resizeGif($original, $new_filename, $scaled_width, $scaled_height, $width, $height) {
        $error = false;

        if(!($src = imagecreatefromgif($original))) {
            $this->__errors[] = 'There was an error creating your resized image (gif).';
            $error = true;
        }

        if(!($tmp = imagecreatetruecolor($scaled_width, $scaled_height))) {
            $this->__errors[] = 'There was an error creating your true color image (gif).';
            $error = true;
        }

        if(!imagecopyresampled($tmp, $src, 0, 0, 0, 0, $scaled_width, $scaled_height, $width, $height)) {
            $this->__errors[] = 'There was an error creating your true color image (gif).';
            $error = true;
        }

        if(!($new_image = imagegif($tmp, $new_filename))) {
            $this->__errors[] = 'There was an error writing your image to file (gif).';
            $error = true;
        }

        imagedestroy($tmp);

        if(false == $error) {
            return $new_image;
        }
        return false;
    }

    private function __resizeJpeg($original, $new_filename, $scaled_width, $scaled_height, $width, $height, $quality) {
        $error = false;

        if(!($src = imagecreatefromjpeg($original))) {
            $this->__errors[] = 'There was an error creating your resized image (jpg).';
            $error = true;
        }

        if(!($tmp = imagecreatetruecolor($scaled_width, $scaled_height))) {
            $this->__errors[] = 'There was an error creating your true color image (jpg).';
            $error = true;
        }

        if(!imagecopyresampled($tmp, $src, 0, 0, 0, 0, $scaled_width, $scaled_height, $width, $height)) {
            $this->__errors[] = 'There was an error creating your true color image (jpg).';
            $error = true;
        }

        if(!($new_image = imagejpeg($tmp, $new_filename, $quality))) {
            $this->__errors[] = 'There was an error writing your image to file (jpg).';
            $error = true;
        }

        imagedestroy($tmp);

        if(false == $error) {
            return $new_image;
        }

        return false;
    }
   
    private function __resizePng($original, $new_filename, $scaled_width, $scaled_height, $width, $height, $quality) {
        $error = false;
        /**
         * we need to recalculate the quality for imagepng()
         * the quality parameter in imagepng() is actually the compression level,
         * so the higher the value (0-9), the lower the quality. this is pretty much
         * the opposite of how imagejpeg() works.
         */
        $quality = ceil($quality / 10); // 0 - 100 value
        if(0 == $quality) {
            $quality = 9;
        } else {
            $quality = ($quality - 1) % 9;
        }


        if(!($src = imagecreatefrompng($original))) {
            $this->__errors[] = 'There was an error creating your resized image (png).';
            $error = true;
        }

        if(!($tmp = imagecreatetruecolor($scaled_width, $scaled_height))) {
            $this->__errors[] = 'There was an error creating your true color image (png).';
            $error = true;
        }

        imagealphablending($tmp, false);

        if(!imagecopyresampled($tmp, $src, 0, 0, 0, 0, $scaled_width, $scaled_height, $width, $height)) {
            $this->__errors[] = 'There was an error creating your true color image (png).';
            $error = true;
        }
        imagesavealpha($tmp, true);
	if(!($new_image = imagepng($tmp, $new_filename, $quality))) {
            $this->__errors[] = 'There was an error writing your image to file (png).';
            $error = true;
        }

        imagedestroy($tmp);

        if(false == $error) {
            return $new_image;
        }

        return false;
    }
	
		
public function uploadImageCategory($originName,$tmp_name,$getRandomName =  TRUE,$dimention='') {	
		
		//echo $tmp_name.'<<<<<<<<<';
		if(is_dir($this->destPath))	{
		
			//$extDot = explode(".",$this->fileName);
			$extension=end(explode(".",$this->fileName));
			
			$ext = $extension;
			if($ext=='')
			{
				$ext= "jpg";
			}
			//$this->fileName = ($getRandomName)?$this->getRandomGroupFileName($ext):$this->fileName;
			$this->fileName = 'category_'.time();
			if(!strstr($this->fileName,".")) {
				$this->fileName .= ".".$ext;
			}

			if($this->cleanName)	{
				$this->fileName = $this->clean_string(substr($this->fileName,0,strlen($this->fileName)-(strlen($ext) + 1))).".".$ext;
			}
			/*if(!$dimention){
				$dimention = "300x50"; //standared for coin
			}*/
			
			$tnewf = $this->creatThumb_new($tmp_name,$ext,$dimention);
			
			//resize($original, $new_filename, $new_width = 0, $new_height = 0, $quality = 100);
			
		if(!empty($tmp_name)){
			if(copy($tnewf, $this->destPath."/".$this->fileName)){
				return $this->fileName;	
			}else{
				return false;
			}
		   }		
		}else {
			echo 'Destination directory does not exists!';
		}
	}
	
	public function uploadCompanyGraphic($originName,$tmp_name,$getRandomName =  TRUE,$dimention='', $type='') {
	
		//echo $tmp_name.'<<<<<<<<<';
		if(is_dir($this->destPath))	{
	
			//$extDot = explode(".",$this->fileName);
			$extension=end(explode(".",$this->fileName));
				
			$ext = $extension;
			if($ext=='')
			{
				$ext= "jpg";
			}
			//$this->fileName = ($getRandomName)?$this->getRandomGroupFileName($ext):$this->fileName;
			$this->fileName = 'graphic_'.$type.'_'.time();
			if(!strstr($this->fileName,".")) {
				$this->fileName .= ".".$ext;
			}
	
			if($this->cleanName)	{
				$this->fileName = $this->clean_string(substr($this->fileName,0,strlen($this->fileName)-(strlen($ext) + 1))).".".$ext;
			}
			/*if(!$dimention){
			 $dimention = "300x50"; //standared for coin
			}*/
				
			$tnewf = $this->creatThumb_new($tmp_name,$ext,$dimention);
				
			//resize($original, $new_filename, $new_width = 0, $new_height = 0, $quality = 100);
				
			if(!empty($tmp_name)){
				if(copy($tnewf, $this->destPath."/".$this->fileName)){
					return $this->fileName;
				}else{
					return false;
				}
			}
		}else {
			echo 'Destination directory does not exists!';
		}
	}
	
	
	public function uploadCouponGraphic($originName,$tmp_name,$getRandomName =  TRUE,$dimention='', $type='') {
	
			if(is_dir($this->destPath))	{
			$extension=end(explode(".",$this->fileName));
			$ext = $extension;
			if($ext=='')
			{
				$ext= "jpg";
			}
			//$this->fileName = ($getRandomName)?$this->getRandomGroupFileName($ext):$this->fileName;
			$this->fileName = 'graphic_'.$type.'_'.time();
			if(!strstr($this->fileName,".")) {
				$this->fileName .= ".".$ext;
			}
	
			if($this->cleanName)	{
				$this->fileName = $this->clean_string(substr($this->fileName,0,strlen($this->fileName)-(strlen($ext) + 1))).".".$ext;
			}
			/*if(!$dimention){
			 $dimention = "300x50"; //standared for coin
			}*/
	
			$tnewf = $this->creatThumb_new($tmp_name,$ext,$dimention);
	
			//resize($original, $new_filename, $new_width = 0, $new_height = 0, $quality = 100);
	
			if(!empty($tmp_name)){
				if(copy($tnewf, $this->destPath."/".$this->fileName)){
					return $this->fileName;
				}else{
					return false;
				}
			}
		}else {
			echo 'Destination directory does not exists!';
		}
	}
	

	
} ?>
