<?php
/**
 * Created by Jason.
 * Date: 2019/4/11
 * Time: 12:07
 */

namespace App\Manager;

use Laravolt\Avatar\Avatar;
use Storage;
use App\Model\Portrait;

class PortraitManager
{

    public static function generatePortrait(int $userId, string $userNickname)
    {
        $imgName = uniqid().'.png';
        //绘制图片并存入临时文件
        $tmpPath = storage_path('tmp');
        is_dir($tmpPath) OR mkdir($tmpPath, 0777, true);
        $tmpFile = $tmpPath.'/'.$imgName;
        $avatar = new Avatar(config('laravolt.avatar'));
        $avatar->create($userNickname)->save($tmpFile);
        //将图片存入Storage
        $imgPath = 'portrait/'.$userId;
        $imgFile = $imgPath.'/'.$imgName;
        Storage::disk('local')->put($imgFile,file_get_contents($tmpFile));
        Portrait::whereUserId($userId)->wherePortraitIsActive(true)->update([
            'portrait_is_active' => false,
        ]);
        //移除临时文件
        unlink($tmpFile);
        //将Portrait插入数据库
        $portrait = Portrait::create([
            'user_id' => $userId,
            'portrait_path' => $imgFile,
            'portrait_type' => Portrait::PORTRAIT_TYPE_TEXT,
            'portrait_is_active' => true,
        ]);
        return $portrait->portrait_id;
    }
}