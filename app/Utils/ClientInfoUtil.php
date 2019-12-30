<?php
/**
 * Created by Jason.
 * Date: 2019/4/11
 * Time: 20:42
 */

namespace App\Utils;


class ClientInfoUtil
{
    public static function getClientInfo($agent = '')
    {
        return array_merge(
            self::getClientOS($agent),
            self::getClientBrowser($agent),
            self::getClientMobileBrand($agent)
        );
    }

    /**
     * 获取客户端浏览器以及版本号
     * @param $agent //$_SERVER['HTTP_USER_AGENT']
     * @return array[browser]       浏览器名称
     * @return array[browser_ver]   浏览器版本号
     */
    public static function getClientBrowser($agent = '')
    {
        $browser = '';
        $browser_ver = '';
        if (preg_match('/OmniWeb\/(v*)([^\s|;]+)/i', $agent, $regs)) {
            $browser = 'OmniWeb';
            $browser_ver = $regs[2];
        }
        if (preg_match('/Netscape([\d]*)\/([^\s]+)/i', $agent, $regs)) {
            $browser = 'Netscape';
            $browser_ver = $regs[2];
        }
        if (preg_match('/safari\/([^\s]+)/i', $agent, $regs)) {
            $browser = 'Safari';
            $browser_ver = $regs[1];
        }
        if (preg_match('/MSIE\s([^\s|;]+)/i', $agent, $regs)) {
            $browser = 'Internet Explorer';
            $browser_ver = $regs[1];
        }
        if (preg_match('/Opera[\s|\/]([^\s]+)/i', $agent, $regs)) {
            $browser = 'Opera';
            $browser_ver = $regs[1];
        }
        if (preg_match('/NetCaptor\s([^\s|;]+)/i', $agent, $regs)) {
            $browser = '(Internet Explorer ' . $browser_ver . ') NetCaptor';
            $browser_ver = $regs[1];
        }
        if (preg_match('/Maxthon/i', $agent, $regs)) {
            $browser = '(Internet Explorer ' . $browser_ver . ') Maxthon';
            $browser_ver = '';
        }
        if (preg_match('/360SE/i', $agent, $regs)) {
            $browser = '(Internet Explorer ' . $browser_ver . ') 360SE';
            $browser_ver = '';
        }
        if (preg_match('/SE 2.x/i', $agent, $regs)) {
            $browser = '(Internet Explorer ' . $browser_ver . ') 搜狗';
            $browser_ver = '';
        }
        if (preg_match('/FireFox\/([^\s]+)/i', $agent, $regs)) {
            $browser = 'FireFox';
            $browser_ver = $regs[1];
        }
        if (preg_match('/Lynx\/([^\s]+)/i', $agent, $regs)) {
            $browser = 'Lynx';
            $browser_ver = $regs[1];
        }
        if (preg_match('/Chrome\/([^\s]+)/i', $agent, $regs)) {
            $browser = 'Chrome';
            $browser_ver = $regs[1];
        }
        if (preg_match('/MicroMessenger\/([^\s]+)/i', $agent, $regs)) {
            $browser = '微信浏览器';
            $browser_ver = $regs[1];
        }
        if ($browser != '') {
            return ['browser' => $browser, 'browser_ver' => $browser_ver];
        } else {
            return ['browser' => 'Unknow', 'browser_ver' => ''];
        }
    }

    /**
     * 获取客户端操作系统
     * @param $agent //$_SERVER['HTTP_USER_AGENT']
     * @return array[os]            操作系统名称
     * @return array[os_ver]        操作系统版本号
     * @return array[equipment]     终端设备类型
     */
    public static function getClientOS($agent = '')
    {
        $os = '';
        $os_ver = '';
        $equipment = '';
        //window系统
        if (stripos($agent, 'window')) {
            $os = 'Windows';
            $equipment = '电脑';
            if (preg_match('/nt 6.0/i', $agent)) {
                $os_ver = 'Vista';
            } elseif (preg_match('/nt 10.0/i', $agent)) {
                $os_ver = '10';
            } elseif (preg_match('/nt 6.3/i', $agent)) {
                $os_ver = '8.1';
            } elseif (preg_match('/nt 6.2/i', $agent)) {
                $os_ver = '8.0';
            } elseif (preg_match('/nt 6.1/i', $agent)) {
                $os_ver = '7';
            } elseif (preg_match('/nt 5.1/i', $agent)) {
                $os_ver = 'XP';
            } elseif (preg_match('/nt 5/i', $agent)) {
                $os_ver = '2000';
            } elseif (preg_match('/nt 98/i', $agent)) {
                $os_ver = '98';
            } elseif (preg_match('/nt/i', $agent)) {
                $os_ver = 'nt';
            } else {
                $os_ver = '';
            }
            if (preg_match('/x64/i', $agent)) {
                $os .= '(x64)';
            } elseif (preg_match('/x32/i', $agent)) {
                $os .= '(x32)';
            }
        } elseif (stripos($agent, 'linux')) {
            if (stripos($agent, 'android')) {
                preg_match('/android\s([\d\.]+)/i', $agent, $match);
                $os = 'Android';
                $equipment = 'Mobile phone';
                $os_ver = $match[1];
            } else {
                $os = 'Linux';
            }
        } elseif (stripos($agent, 'unix')) {
            $os = 'Unix';
        } elseif (preg_match('/iPhone|iPad|iPod/i', $agent)) {
            preg_match('/OS\s([0-9_\.]+)/i', $agent, $match);
            $os = 'IOS';
            $os_ver = str_replace('_', '.', $match[1]);
            if (preg_match('/iPhone/i', $agent)) {
                $equipment = 'iPhone';
            } elseif (preg_match('/iPad/i', $agent)) {
                $equipment = 'iPad';
            } elseif (preg_match('/iPod/i', $agent)) {
                $equipment = 'iPod';
            }
        } elseif (stripos($agent, 'mac os')) {
            preg_match('/Mac OS X\s([0-9_\.]+)/i', $agent, $match);
            $os = 'Mac OS X';
            $equipment = '电脑';
            $os_ver = str_replace('_', '.', $match[1]);
        } else {
            $os = 'Other';
        }
        return ['os' => $os, 'os_ver' => $os_ver, 'equipment' => $equipment];
    }

    /**
     * 获取客户端手机型号
     * @param $agent //$_SERVER['HTTP_USER_AGENT']
     * @return array[mobile_brand]      手机品牌
     * @return array[mobile_ver]        手机型号
     */
    public static function getClientMobileBrand($agent = '')
    {
        $mobile_brand = '';
        $mobile_ver = '';
        if (preg_match('/iPhone\s([^\s|;]+)/i', $agent, $regs)) {
            $mobile_brand = '苹果';
            $mobile_ver = $regs[0];
        } elseif (preg_match('/SAMSUNG|Galaxy|GT-|SCH-|SM-\s([^\s|;]+)/i', $agent, $regs)) {
            $mobile_brand = '三星';
            $mobile_ver = $regs[0];
        } elseif (preg_match('/Huawei|Honor|H60-|H30-\s([^\s|;]+)/i', $agent, $regs)) {
            $mobile_brand = '华为';
            $mobile_ver = $regs[0];
        } elseif (preg_match('/Mi note|mi one\s([^\s|;]+)/i', $agent, $regs)) {
            $mobile_brand = '小米';
            $mobile_ver = $regs[0];
        } elseif (preg_match('/HM NOTE|HM201\s([^\s|;]+)/i', $agent, $regs)) {
            $mobile_brand = '红米';
            $mobile_ver = $regs[0];
        } elseif (preg_match('/Coolpad|8190Q|5910\s([^\s|;]+)/i', $agent, $regs)) {
            $mobile_brand = '酷派';
            $mobile_ver = $regs[0];
        } elseif (preg_match('/ZTE|X9180|N9180|U9180\s([^\s|;]+)/i', $agent, $regs)) {
            $mobile_brand = '中兴';
            $mobile_ver = $regs[0];
        } elseif (preg_match('/OPPO|X9007|X907|X909|R831S|R827T|R821T|R811|R2017\s([^\s|;]+)/i', $agent, $regs)) {
            $mobile_brand = 'OPPO';
            $mobile_ver = $regs[0];
        } elseif (preg_match('/HTC|Desire\s([^\s|;]+)/i', $agent, $regs)) {
            $mobile_brand = 'HTC';
            $mobile_ver = $regs[0];
        } elseif (preg_match('/Nubia|NX50|NX40\s([^\s|;]+)/i', $agent, $regs)) {
            $mobile_brand = '努比亚';
            $mobile_ver = $regs[0];
        } elseif (preg_match('/M045|M032|M355\s([^\s|;]+)/i', $agent, $regs)) {
            $mobile_brand = '魅族';
            $mobile_ver = $regs[0];
        } elseif (preg_match('/Gionee|GN\s([^\s|;]+)/i', $agent, $regs)) {
            $mobile_brand = '金立';
            $mobile_ver = $regs[0];
        } elseif (preg_match('/HS-U|HS-E\s([^\s|;]+)/i', $agent, $regs)) {
            $mobile_brand = '海信';
            $mobile_ver = $regs[0];
        } elseif (preg_match('/Lenove\s([^\s|;]+)/i', $agent, $regs)) {
            $mobile_brand = '联想';
            $mobile_ver = $regs[0];
        } elseif (preg_match('/ONEPLUS\s([^\s|;]+)/i', $agent, $regs)) {
            $mobile_brand = '一加';
            $mobile_ver = $regs[0];
        } elseif (preg_match('/vivo\s([^\s|;]+)/i', $agent, $regs)) {
            $mobile_brand = 'vivo';
            $mobile_ver = $regs[0];
        } elseif (preg_match('/K-Touch\s([^\s|;]+)/i', $agent, $regs)) {
            $mobile_brand = '天语';
            $mobile_ver = $regs[0];
        } elseif (preg_match('/DOOV\s([^\s|;]+)/i', $agent, $regs)) {
            $mobile_brand = '朵唯';
            $mobile_ver = $regs[0];
        } elseif (preg_match('/GFIVE\s([^\s|;]+)/i', $agent, $regs)) {
            $mobile_brand = '基伍';
            $mobile_ver = $regs[0];
        } elseif (preg_match('/Nokia\s([^\s|;]+)/i', $agent, $regs)) {
            $mobile_brand = '诺基亚';
            $mobile_ver = $regs[0];
        } else {
            $mobile_brand = '其他';
        }
        return ['mobile_brand' => $mobile_brand, 'mobile_ver' => $mobile_ver];
    }
}