<?php
namespace App\Http\Traits;

trait DefaultImage{


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
            public_path('assets/admin/fonts/Sukar-Black.otf'),
            public_path('assets/admin/fonts/Sukar-Bold.otf'),
            public_path('assets/admin/fonts/GrifonBlackPersonalUse-BWA7l.otf'),
            public_path('assets/admin/fonts/Sukar-Regular.otf'),
            public_path('assets/admin/fonts/Kahlil-a2b9.woff')
        );

        $fontKey = array_rand($fonts);

        $img = \DefaultProfileImage::create("$name", 256, $colors[$key1], $colors[$key2], $fonts[$fontKey]);
        $imageName = "uploads/$path/".time().'--'.base64_encode(time().'-'.base64_encode($name)).'.png';
        \Storage::put('public/'.$imageName, $img->encode());
        return 'storage/'.$imageName;

    }//end fun

}//end trait
