<?php

if(isset($_GET['files']) || true){

    //file is string
    $files = $_GET['files'];
    $hire_num = $_GET['hirenumber'];

    $path = "Files/$hire_num/";
    //string to array
    $file_r = explode(",",$files) ;

    $zip = new ZipArchive() ;
    //file name is H000xx-xxxxxx.zip
    $zip_name = $hire_num . "-" . time() . ".zip" ;
    //create zip file
    if($zip->open($zip_name , ZipArchive::CREATE) !== TRUE){
        echo "Error";
    }else{
        echo "is OK";
        
        foreach($file_r as $file){
            //addfile(path of file , out path of file)
            $zip->addFile($path.$file ,$file);
        }

        $zip->close();
        header('Content-Type: application/zip');
        header('Content-disposition: attachment; filename='.$zip_name);
        header('Content-Length: ' . filesize($zip_name));
        readfile($zip_name); //auto download
        unlink($zip_name); //delete this file after download
    }



  
}