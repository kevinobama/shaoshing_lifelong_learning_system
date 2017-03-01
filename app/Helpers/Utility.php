<?php
/**
 * Author: HiHooray IT
 * Date: 2016/08/29
 * Time: 18:00
 * Email: amlan@hihooray.com
 * Curl Helper File
 */
namespace App\Helpers;

use Carbon\Carbon;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redis;

class Utility
{
    /**
     * 检测手机号码
     * @param $mobile
     * @return bool
     */
    public static function validateMobile($mobile)
    {
        $phone_parttern = '/^1(?:3[\d]|5[012356789]|8[\d]|7[015678]|4[57])(-?)\d{4}\1\d{4}$/';
        return preg_match($phone_parttern, $mobile);
    }

    public static function prt($arrayToPrint)
    {
        print "<pre>";
        print_r($arrayToPrint);
        die;
    }

    public static function buildTree(array $elements, $parentId = 0)
    {
        $branch = [];

        foreach ($elements as $element) {
            if ($element['parent_id'] === $parentId) {
                $children = self::buildTree($elements, $element['id']);
                if ($children) {
                    $element['children'] = $children;
                }
                $branch[$element['id']] = $element;
                unset($elements[$element['id']]);
            }
        }
        return $branch;
    }

    public static function bytesToHuman($bytes)
    {
        $units = ['bytes', 'KB', 'MB', 'GB', 'TB', 'PB'];

        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, 2) . ' ' . $units[$i];
    }

    public static function classActivePath($path)
    {
        if (strlen(request()->segment(1)) === 0) {
            return 'active';
        } else {
            return request()->is($path) ? ' active' : '';
        }
    }

    public static function classActiveSegment($segment, $value)
    {
        if (!is_array($value)) {
            return request()->segment($segment) === $value ? 'active' : '';
        }

        foreach ($value as $v) {
            if (request()->segment($segment) === $v) {
                return 'active';
            }
        }
    }

    public static function cleanPage($data)
    {
        if ($data instanceof Arrayable) {
            $data = $data->toArray();
            unset($data['prev_page_url'], $data['next_page_url']);
            if (count($data['data']) === 0) {
                $data['from'] = 0;
                $data['to']   = 0;
            }
            $data['media_host'] = Config::get('shaoshing_lifelong_learning_system.media_host');
        }
        return $data;
    }

    public static function setUnread($data, $userId)
    {
        if ($data['total'] === 0) {
            return $data;
        }
        if ($data instanceof Arrayable) {
            $data = $data->toArray();
        }
        foreach ((array)$data['data'] as $idx => $item) {
            $expire = Carbon::parse($item['created_at'])->addWeek();
            if ($expire > Carbon::now()) {
                $seconds = $expire->diffInSeconds(Carbon::now());
                $key     = 'user:' . $userId . ':unread:' . $item['id'];
                $record  = Redis::get($key);
                if (null === $record) {
                    Redis::setex($key, $seconds, 'unread');
                    $data['data'][$idx]['is_unread'] = 1;
                } else {
                    $data['data'][$idx]['is_unread'] = (int)($record === 'unread');
                }
            } else {
                $data['data'][$idx]['is_unread'] = 0;
            }
        }
        return $data;
    }

    public static function setRead($data, $userId)
    {
        if ($data instanceof Arrayable) {
            $data   = $data->toArray();
            $expire = Carbon::parse($data['created_at'])->addWeek();
            if ($expire > Carbon::now()) {
                $key = 'user:' . $userId . ':unread:' . $data['id'];
                Redis::set($key, 'read');
            }
        }
    }

    public static function mb_replace($needle, $replacement, $haystack)
    {
        return implode($replacement, mb_split($needle, $haystack));
    }
}
