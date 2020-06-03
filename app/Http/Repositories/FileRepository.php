<?php
/**
 * Created by PhpStorm.
 * User: lufficc
 * Date: 2016/9/17
 * Time: 19:43
 */

namespace App\Http\Repositories;


use App\File;
use Illuminate\Http\UploadedFile;
use Lufficc\FileUploadManager;

abstract class FileRepository extends Repository
{
    protected $fileUploadManager;

    /**
     * ImageRepository constructor.
     * @param FileUploadManager $fileUploadManager
     */
    public function __construct(FileUploadManager $fileUploadManager)
    {
        $this->fileUploadManager = $fileUploadManager;
    }

    public function delete($key, $disk)
    {
        $result = $this->fileUploadManager->deleteFile($key, $disk);
        if ($result) {
            $this->clearCache();
            $this->clearCache('files');
            File::where('key', $key)->delete();
        }
        return $result;
    }

    public function getAllFiles()
    {
        $files = $this->remember('file.all', function () {
            return File::where('type', '<>', ImageRepository::$tag)->orderBy('type', 'desc')->get();
        }, 'files');
        return $files;
    }

    public function getAllFilesByType()
    {
        $js = $this->remember($this->type() . '.all.type', function () {
            return File::where('type', $this->type())->get();
        });
        return $js;
    }

    public function get($key)
    {
        $map = $this->remember($this->type() . '.one.' . $key, function () use ($key) {
            return File::where('key', $key)->firstOrFail();
        });
        return $map;
    }

    public function deleteAllByType()
    {
        $files = File::where('type', $this->type())->get();
        foreach ($files as $file) {
            $this->delete($file->key, $file->disk);
        }
    }

    public function uploadFile(UploadedFile $file, $key = null)
    {
        if ($key == null) {
            $key = $this->type() . '/' . $file->hashName();
        } else {
            $key = $this->type() . '/' . $key;
        }
        list($upload_result, $disk_name) = $this->fileUploadManager->uploadFile($key, $file->getRealPath());
        if ($upload_result) {
            $fileModel = File::firstOrNew([
                'name' => $file->getClientOriginalName(),
                'key' => $key,
                'size' => $file->getSize(),
                'type' => $this->type(),
                'url' => $this->fileUploadManager->url($key, $disk_name),
                'disk' => $disk_name,
            ]);
            if ($fileModel->save()) {
                $result = $fileModel->url;
            } else {
                $result = false;
            }
        } else {
            $result = false;
        }
        $this->clearCache();
        $this->clearCache('files');
        return $result;
    }

    public abstract function type();

    public function model()
    {
        app(File::class);
    }
}