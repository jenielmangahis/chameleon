<?php
include('cake_session.php');

/*
@ini_set( 'upload_max_size' , '64M' );
@ini_set( 'post_max_size', '64M');
@ini_set( 'max_execution_time', '300' );
@ini_set( 'max_input_nesting_level', '300');
@ini_set( 'max_input_time', '300' );

*/


$image_arr=array();
$app_arr=array();

$image_arr[0]="image/pjpeg";
$image_arr[1]="image/jpeg";
$image_arr[2]="image/jpg";
$image_arr[3]="image/png";
$image_arr[4]="image/gif";
$image_arr[5]="image/x-pjpeg";
$image_arr[6]="image/x-jpeg";
$image_arr[7]="image/x-jpg";
$image_arr[8]="image/x-png";
$image_arr[9]="image/x-gif";

$app_arr[0]="application/pdf";
$app_arr[1]="application/ppt";



$user_type=$_SESSION['User']['User']['usertype'];

if($user_type=="sponsor")
    $project_name=$_SESSION['projectwebsite_name'];      //if sponsor log in
else
    $project_name=$_SESSION['projectwebsite_name_admin'];   //if admin is log in


if($project_name!="" || $project_name!=NULL)
{

$url = 'img/'.$project_name.'/'.time()."_".$_FILES['upload']['name'];

  
 //extensive suitability check before doing anything with the file...
    $err=$_FILES['upload']["error"];
 
    if (($_FILES['upload'] == "none") OR (empty($_FILES['upload']['name'])) )
    {
       $message = "No file uploaded.....".$err;
    }
    else if ($_FILES['upload']["size"] == 0)
    {
       $message = "The file is of zero length.";
    }
    else if (!in_array($_FILES['upload']["type"],$image_arr) and !in_array($_FILES['upload']["type"],$app_arr))
    {             
          $message = "The file must be in either JPG,PNG,JPG,GIF,PPT,PDF format. Please upload a JPG,PNG,JPG,GIF,PPT,PDF file.";
                       
    }
      
    else if (!is_uploaded_file($_FILES['upload']["tmp_name"]))
    {
       $message = "You may be attempting to hack our server. We're on to you; expect a knock on the door sometime soon.";
    }
    else {
      $message = "";
      //chmod($up_dir,0777);
      $move = @ move_uploaded_file($_FILES['upload']['tmp_name'], $url);
      if(!$move)
      {
         $message = "Error moving uploaded file. Check the script is granted Read/Write/Modify permissions.";
      }
      $url = "../" . $url;
    }
    
}
else
{
    $message="Error in Processing";
    $url = "../" . $url;
}
 
$funcNum = $_GET['CKEditorFuncNum'] ;
echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($funcNum, '$url', '$message');</script>";
?>