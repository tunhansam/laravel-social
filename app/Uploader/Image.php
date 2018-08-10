<?php
namespace App\Uploader;

use File;
use Intervention\Image\ImageManagerStatic;
use Illuminate\Support\Facades\Storage;

class Image {
    public static function getInfoImageBeforeUpload ($img = []) {
        $info = [
            'name' => $img->getClientOriginalName(),
            'path' => public_path().'/'.getConfig('config', 'upload_temp_folder', 'uploads/tmp/'),
            'type' => $img->getClientOriginalExtension(),
            'size' => $img->getSize(),
            'tmpPath' => $img->getPath(),
            'realPath' => $img->getRealPath()
        ];
        return $info;
    }

    public static function saveImageToTempFolder($img = []) {
        $tmpPath = getConfig('config', 'upload_temp_folder', 'uploads/tmp/').$img->getClientOriginalName();
        return ImageManagerStatic::make($img->getRealPath())->resize(300,300)->save($tmpPath);
    }

    public static function uploadImage($img = []) {
        $imgName = 'avatar_'.date('YmdHis').'.'.$img['type'];
        $upload = File::move($img['path'].'/'.$img['name'], getConfig('config', 'upload_folder', 'uploads/').$imgName);
        return ($upload) ? $imgName : null;
    }

    public static function deleteImage($imgName) {
        if (!empty($imgName) && file_exists(getConfig('config', 'upload_folder', 'uploads/').$imgName)) {
            unlink(getConfig('config', 'upload_folder', 'uploads/').$imgName);
            return true;
        }
        return false;
    }

    public static function formatTempFolder() {
        $files = glob('./'.getConfig('config', 'upload_temp_folder', 'uploads/tmp/').'*');
        foreach ($files as $file) {
            if (is_file($file)) {
                unlink($file);
            }
        }
    }
}