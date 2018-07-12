<?php

class BackupComponent {

    
     /**
     *  Component to take Database back and folder back up for perticular projet
     */
     
     var $helpers = array('Html');
    /**
    * Function to do recursive zip of source directiory  to destination derectory
    *  
    * @param mixed $src     - Source directory path
    * @param mixed $zip     - Destination Directory Path
    * @param mixed $path    - 
    */
    function recurse_zip($src,&$zip,$path) {
        $dir = opendir($src);
        while(false !== ( $file = readdir($dir)) ) {
            if (( $file != '.' ) && ( $file != '..' )) {
                if ( is_dir($src . '/' . $file) ) {
                    $this->recurse_zip($src . '/' . $file,$zip,$path);
                }
                else {
                    $zip->addFile($src . '/' . $file,substr($src . '/' . $file,$path));
                }
            }
        }
        closedir($dir);
    }
    
   /**
   * Fuction to compress source directory to destination directory
   *  
   * @param string $src      - Source directory path  
   * @param string $dst      -  Optional - destination directory path  
   * @return string
   */
    public function compress($src,$dst='')
    {
        if(substr($src,-1)==='/'){$src=substr($src,0,-1);}
        if(substr($dst,-1)==='/'){$dst=substr($dst,0,-1);}
        $path=strlen(dirname($src).'/');
        $filename=substr($src,strrpos($src,'/')+1).'.zip';
        $dst=empty($dst)? $filename : $dst.'/'.$filename;
        @unlink($dst);
        $zip = new ZipArchive;
        $res = $zip->open($dst, ZipArchive::CREATE);
        if($res !== TRUE){
            return 0;
               // echo 'Error: Unable to create zip file';
              //  exit;
        }
        if(is_file($src)){$zip->addFile($src,substr($src,$path));}
        else{
                if(!is_dir($src)){
                     $zip->close();
                     @unlink($dst);
                     return 0;
                    // echo 'Error: File not found';
                    // exit;
                }
        $this->recurse_zip($src,$zip,$path);}
        $zip->close();
        return $dst;
    }

      function getDatabaseBackUP($path, $projectid){
      //    echo "database back function...";       
        App::import('Model', 'CakeSchema');
        $dataSourceName = 'default';
        $Folder = new Folder($path, true, 777);
         chmod($path, 0777); 
        $fileSufix = date('Ymd\_His') . '.sql';
        $file = $path ."/". $fileSufix;
        if (!is_writable($path)) {
            trigger_error('The path "' . $path . '" isn\'t writable!', E_USER_ERROR);
        }
        
         
      //  echo "Backuping...\n";
        $File = new File($file);
        $count=0;
        $lsttables=ConnectionManager::getInstance()->getDataSource($dataSourceName)->listSources();
          $tot=sizeof($lsttables);
          
     //   $this->out("Backuping...\n"); 
   //     foreach (ConnectionManager::getInstance()->getDataSource($dataSourceName)->listSources() as $table) {
       for($c=0; $c< sizeof($lsttables); $c++ )      {
           $table=   $lsttables[$c];
            $ModelName = Inflector::classify($table);
            $Model = ClassRegistry::init($ModelName);
            $DataSource = $Model->getDataSource();
            $tblschema=array($Model->_schema);
            $tblfields=$tblschema[0];
            if(array_key_exists('project_id',$tblfields)){
                    $CakeSchema = new CakeSchema();
                    $CakeSchema->tables = array($table => $Model->_schema);
                    
                    $File->write("\n/* Backuping table schema {$table} */\n");                 
                    $File->write($DataSource->createSchema($CakeSchema, $table) . "\n");
                    $File->write("\n/* Backuping table data {$table} */\n");
                    
                    unset($valueInsert, $fieldInsert);
                    $conditions=" project_id='".$projectid."'";
                   // $commenttypearr =  $this->CommentType->find("first",array('conditions'=>$conditions)); 
                    $rows = $Model->find('all', array('conditions'=>$conditions, 'recursive' => -1));
                    $quantity = 0;
                    if (sizeOf($rows) > 0) {
                        $fields = array_keys($rows[0][$ModelName]);
                        $values = array_values($rows);    
                        $count = count($fields);

                        for ($i = 0; $i < $count; $i++) {
                            $fieldInsert[] = $DataSource->name($fields[$i]);
                        }
                        $fieldsInsertComma = implode(', ', $fieldInsert);

                        foreach ($rows as $k => $row) {
                            unset($valueInsert);
                            for ($i = 0; $i < $count; $i++) {
                                $valueInsert[] = $DataSource->value($row[$ModelName][$fields[$i]], $Model->getColumnType($fields[$i]), false);
                            }
                            $query = array(
                                'table' => $DataSource->fullTableName($table),
                                'fields' => $fieldsInsertComma,
                                'values' => implode(', ', $valueInsert)
                            );            
                            $File->write($DataSource->renderStatement('create', $query) . ";\n");
                            $quantity++;
                        }
                    }
                    
                 //   Echo 'Model "' . $ModelName . '" (' . $quantity . ')';
                    $count++;
                   
            }
              if($c==40){  $c=$tot-4;
                // $c=123; 
                break; 
              } 
           
        }
        $File->close();
       //  DebugBreak();
       
       // Create Sip file 
       if (class_exists('ZipArchive') && filesize($file) > 100) {
            //  Zipping... 
            $zip = new ZipArchive();
            $zip->open($file . '.zip', ZIPARCHIVE::CREATE);
            $zip->addFile($file, $fileSufix);
            $zip->close();
       
            //    Removing original file...
            if (file_exists($file . '.zip') && filesize($file) > 10) {
                unlink($file);
            }
       
        }
        
        return $fileSufix;
    }
    
    /**
     * Delete a file or recursively delete a directory
     *
     * @param string $str Path to file or directory
     */
    function recursiveDelete($str){
        if(is_file($str)){
            return @unlink($str);
        }
        elseif(is_dir($str)){
            $scan = glob(rtrim($str,'/').'/*');
            foreach($scan as $index=>$path){
                $this->recursiveDelete($path);
            }
            return @rmdir($str);
        }
    }
   /**
   * Fuction to generate compressed Project back with database and images and avatar files
   *  
   * @param mixed $projectid
   * @param mixed $projectname
   * @return string
   */
    function getProjectBackup($projectid, $projectname){
        
        // STEP : Create New Back Directory  for project with projectname and current timestamp   at webroot/backup folder
        $currettime= date('Ymd_His'); 
        $backupDir="backup".DS."backup_".$projectid;
        $backupSrc="backup/backup_".$projectid; 
        // delete if already exists back directory for project 
        $this->recursiveDelete($backupSrc);
        
        $Folder = new Folder($backupDir, true, 777); 
        chmod($backupDir, 0777);
         if (is_writable($backupDir)) { 
        // STEP : Copy User Avatar's for selected project  from - webroot/avatar/projectid folder  -   TO New Directory
            //Source file or directory to be compressed.
            $avatarSrc="img/avatar/".$projectid;
          
            //Destination folder where we create Zip file.
            $dst=$backupDir;
            
            $avatarstr=$this->compress($avatarSrc,$dst); 
        
        // STEP : Copy Img folder of select project     from - webroot/img/projectname folder      -   TO New Directory
                $imgSrc="img/".strtolower($projectname);       //Source file or directory to be compressed. 
                $imgStr=$this->compress($imgSrc,$dst);   
                
        // STEP : Generate and Save DATABASE Backup File to New Directory 
               //commnet by suman date 21 june 2012
			   //$this->getDatabaseBackUP($backupDir,$projectid);

        // STEP : Now compress New directory to    NewDirectory.zip      
             $finalStr=$this->compress($backupSrc, 'backup');  
                 
               return "backup_".$projectid;
         }else{
             return false;
         }
    }
}
?>