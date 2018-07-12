<?php 
/**
 * 
 * @author        David Westfall
 * @link        http://www.reflashed.com/
 * @license        MIT
 *
 */
class ImageresizingComponent extends Object {



public $name = 'Image';
    private $__errors = array();

    /**
     * Determines image type, calculates scaled image size, and returns resized image. If no width or height is
     * specified for the new image, the dimensions of the original image will be used, resulting in a copy
     * of the original image.
     *
     * @param string $original absolute path to original image file
     * @param string $new_filename absolute path to new image file to be created
     * @param integer $new_width (optional) width to scale new image (default 0)
     * @param integer $new_height (optional) height to scale image (default 0)
     * @param integer $quality quality of new image (default 100, resizePng will recalculate this value)
     *
     * @access public
     *
     * @return returns new image on success, false on failure. use ImageComponent::getErrors() to get an array
     * of errors on failure
     */
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


    function createthumnail_imagic($sourceimg,$destinationimg,$newwidth,$newheight){
    
    		
     // Specify your file details
    $current_file = $sourceimg;
    $max_width = $newwidth;

    // Get the current info on the file
    $current_size = getimagesize($current_file);
    $current_img_width = $current_size[0];
    $current_img_height = $current_size[1];
    $image_base = explode('.', $current_file);

   
    $thumb_name = $destinationimg;

  
      $too_big_diff_ratio = $current_img_width/$max_width;
      $new_img_width = $max_width;
      $new_img_height = round($current_img_height/$too_big_diff_ratio);
      // Convert the file
      $make_magick = exec(USER_BIN_CONVERT_PATH."convert -geometry $new_img_width x $new_img_height $current_file $thumb_name", $retval);
 
    
    }
    


/*
    // Resize any specified jpeg, gif, or png image
    function resize($imagePath, $destinationpath,$destinationWidth, $destinationHeight) {
        // The file has to exist to be resized
        if(file_exists($imagePath)) {
            // Gather some info about the image
            $imageInfo = getimagesize($imagePath);
            
            // Find the intial size of the image
            $sourceWidth = $imageInfo[0];
            $sourceHeight = $imageInfo[1];
            
            // Find the mime type of the image
            $mimeType = $imageInfo['mime'];
            
            // Create the destination for the new image
            $destination = imagecreatetruecolor($destinationWidth, $destinationHeight);

            // Now determine what kind of image it is and resize it appropriately
            if($mimeType == 'image/jpeg' || $mimeType == 'image/pjpeg') {
                $source = imagecreatefromjpeg($imagePath);
                imagecopyresampled($destination, $source, 0, 0, 0, 0, $destinationWidth, $destinationHeight, $sourceWidth, $sourceHeight);
                imagejpeg($destination, $destinationpath);
            } else if($mimeType == 'image/gif') {
                $source = imagecreatefromgif($imagePath);
                imagecopyresampled($destination, $source, 0, 0, 0, 0, $destinationWidth, $destinationHeight, $sourceWidth, $sourceHeight);
                imagegif($destination, $destinationpath);
            } else if($mimeType == 'image/png' || $mimeType == 'image/x-png') {
                $source = imagecreatefrompng($imagePath);
                imagecopyresampled($destination, $source, 0, 0, 0, 0, $destinationWidth, $destinationHeight, $sourceWidth, $sourceHeight);
                imagepng($destination, $destinationpath);
            } else {
                $this->_error('This image type is not supported.');
            }
            
            // Free up memory
            imagedestroy($source);
            imagedestroy($destination);
        } else {
            $this->_error('The requested file does not exist.');
        }
    }
    
    // Outputs errors...
    function _error($message) {
        trigger_error('The file could not be resized for the following reason: ' . $message);
    }
    */
}
?>