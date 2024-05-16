<?php

namespace App\Helpers;
use Illuminate\Support\Str;
use Image;
use Storage;
use Log;
use QrCode;

class UploadHelper{

    public static function upload_file($requestFile,string $folder,array $allowExt = [],$allowSize=2097152,bool $public = true,bool $resize = false,mixed $resizeWidth = null,mixed $resizeHeight = null,bool $resizeAcpectRatio = false)
    {
      
      $data = [];
      try {
        //Path
        $path = 'public';

        //File Extension
        $fileExtension = $requestFile->getClientOriginalExtension();

        //File Size
        $fileSize = $requestFile->getSize();

        //Public Option
        $publicOptions = $public ? "public" : "private";

        //If file large than 
        if($fileSize > $allowSize){
          $data["IsError"] = TRUE;
          $data["Message"] = "Maximum file size is 5 MB";
          goto ResultData;
        }

        //If extension is not valid
        if(count($allowExt) > 0){
          if(!in_array(strtolower($fileExtension), $allowExt)){
              $data["IsError"] = TRUE;
              $data["Message"] = "The file format allowed is ".implode(" , ",$allowExt);
              goto ResultData;
          }
        }

        //New File Name
        $newFileName = Str::random(100). "." . $fileExtension;

        if(!is_dir(storage_path("app/$path/$folder/"))){
          mkdir(storage_path("app/$path/$folder/"),0777,true);
        }

        if($resize){
            $image = Image::make($requestFile);
            $image->resize($resizeWidth,$resizeHeight,function($constraint) use($resizeAcpectRatio){
              if($resizeAcpectRatio){
                $constraint->aspectRatio();
              }
            });
            $image->save(storage_path("app/$path/$folder/$newFileName"));
        }
        else{
            Storage::putFileAs("$path/$folder/",$requestFile,$newFileName,$publicOptions);
        }

        $data["IsError"] = FALSE;
        $data["Message"] = "Successfully uploaded file";
        $data["Path"] = "storage/".$folder."/".$newFileName; 
        goto ResultData;

      }catch(\Throwable $th){
        Log::emergency($th->getMessage());
        $data["IsError"] = TRUE;
        $data["Message"] = $th->getMessage();
        goto ResultData;
      }
      
      ResultData:
      return $data;
    }

    public static function generateAndSaveQRCode($ordernum)
    {
        $data = [];
        try {
          $qrCode = QrCode::size(150)->format("png")->generate($ordernum);
          $filename = Str::random(125) . '.png';

          if(!is_dir(storage_path("app/public/qrcodes"))){
            mkdir(storage_path("app/public/qrcodes"),0777,true);
          }  

          $filePath = storage_path('app/public/qrcodes/' . $filename);
          file_put_contents($filePath, $qrCode);

          $data["IsError"] = FALSE;
          $data["Message"] = "Successfully uploaded file";
          $data["Path"] = "storage/qrcodes/".$filename; 
          goto ResultData;
        }catch(\Throwable $th){
          Log::emergency($th->getMessage());
          $data["IsError"] = TRUE;
          $data["Message"] = $th->getMessage();
          goto ResultData;
        }
        
        ResultData:
        return $data;
    }
}
