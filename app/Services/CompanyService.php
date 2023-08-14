<?php
namespace App\Services;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class CompanyService{
    
    public function storeImage($file)
    { 
       
             /* ----Image Storage----- */
           
                 $image_extension = $file->extension();
                 $image_prefix = 'employee-'.md5(time());
                 $image_name = $image_prefix.'.'.$image_extension;
                 Storage::disk('public')->put('companies/'.$image_name, File::get($file));
             
             /* ----End Image Storage----- */
        return $image_name;
    }
    public function updateImage($file,$companyLogo)
    {
        $image_extension = $file->extension();
        $image_prefix = 'employee-'.md5(time());
        $image_name = $image_prefix.'.'.$image_extension;
        Storage::disk('public')->put('companies/'.$image_name, File::get($file));
        Storage::disk('public')->delete('companies/'.$companyLogo);

        return $image_name;

    }
}