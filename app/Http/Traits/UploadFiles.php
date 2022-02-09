<?php
namespace App\Http\Traits;
use Illuminate\Support\Facades\File;

trait UploadFiles{


    public function storeDefaultImage($path,$name){
        $colors = array(
            "#162F44",
            "#2F97D0",
            "#670948",
            "#612248",
            "#19C44C",
            "#7A3A0E",
            "#FD9F1F",
            "#031D16",
            "#439CAF",
            "#818BC6",
            "#852A44",
            "#03D8EA",
            "#E4727E",
            "#ED7D6C",
            "#A8D4CE",
            "#1A958D",
            "#72AF4F",
            "#C75663",
            "#AC3F88",
            "#B8170A",
            "#CBA47D",
        );
        $key1 = array_rand($colors);
        $key2 = array_rand($colors);

        while ($key1 == $key2){
            $key1 = array_rand($colors);
            $key2 = array_rand($colors);
        }

        $fonts = array(
            public_path('assets/fonts/Sukar-Black.otf'),
            public_path('assets/fonts/Sukar-Bold.otf'),
            public_path('assets/fonts/GrifonBlackPersonalUse-BWA7l.otf'),
            public_path('assets/fonts/Sukar-Regular.otf'),
            public_path('assets/fonts/Kahlil-a2b9.woff')
        );

        $fontKey = array_rand($fonts);

        $img = \DefaultProfileImage::create("$name", 256, $colors[$key1], $colors[$key2], $fonts[$fontKey]);
        $imageName = "uploads/$path/".time().'--'.base64_encode(time().'-'.base64_encode($name)).'.png';
        \Storage::put('public/'.$imageName, $img->encode());
        return 'storage/'.$imageName;

    }//end fun
    /**
     * @param $folder_name
     * @param $file
     * @param $is_updated_file
     * @return string|null
     */
    //---------------Upload Files----------------
    public function uploadFiles($folder_name,$file,$is_updated_file=null){
        //upload_excel_files or update
        $fileNameToStore=null;

        if ($file){
            if ($is_updated_file!=null) {
                //   $fileNameToStore=$is_updated_file;
                File::delete(public_path($is_updated_file));
            }
            $fileName_original =$file->getClientOriginalName();
            $fileNameWithExt =$file->getClientOriginalExtension();
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //$ext =$file->getClientOriginalExtension();
            $newName = base64_encode($fileName_original) . '_'.time() . '.' . $fileNameWithExt;
            $newName = str_replace('/','',$newName);
            $fileNameToStore = "$folder_name/".$newName;
            $file->storeAs('public/uploads/', $fileNameToStore);
        }else{
            $fileNameToStore=$is_updated_file;
        }

        return $fileNameToStore!=null?'/storage/uploads/'.$fileNameToStore:null;
    }//end


}//end trait
