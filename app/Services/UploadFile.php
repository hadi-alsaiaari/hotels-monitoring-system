<?php

namespace App\Services;

class UploadFile
{
    public static function newUploadFile($request, $name, $type = 'file')
    {
        if (!$request->hasFile($name)) {
            return;
        }

        $file = $request->file($name);

        if ($type == 'image') {
            $path = $file->store('uploads/images', [
                'disk' => 'public'
            ]);
            return $path;
        }
        $path = $file->store('uploads/files', [
            'disk' => 'public'
        ]);
        return $path;
    }

    public static function updateUploadFile($request, $name, $old_photo, $type = 'file')
    {
        if (!$request->hasFile($name)) {
            return $old_photo;
        }

        $file = $request->file($name);

        if ($type == 'image') {
            $path = $file->store('uploads/images', [
                'disk' => 'public'
            ]);
            return $path;
        }
        $path = $file->store('uploads/files', [
            'disk' => 'public'
        ]);
        return $path;
    }
}
