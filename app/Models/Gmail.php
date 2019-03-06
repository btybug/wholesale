<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 1/28/2019
 * Time: 3:31 PM
 */

namespace App\Models;


class Gmail extends \LaravelGmail
{

//"access_token": "ya29.GlufBgzJACl8lpTDdmsjhkI3phItsCfqo5VHWwvJGuNcRVYceArxMGeYLLyw-2_vWtMQCoHaw-CmhBixPPdmcG636J7W3FrMcf2jrdShN6E_kSHe6FPEP1MbWT0F",
//"expires_in": 3600,
//"scope": "https:\/\/mail.google.com\/",
//"token_type": "Bearer",
//"created": 1548674460,
//"refresh_token": "1\/Oo0gt9tesHyF71lryZFfI_TwIQuUxXltHNTWRo552EY"
    public static function refreshToken($refreshToken = null)
    {
        $token = self::getToken();
        if (!$token || !count($token) || !isset($token['access_token']) || !isset($token['expires_in']) || !isset($token['created']) || !isset($token['refresh_token'])) {
            return [];
        }
        return parent::refreshToken($refreshToken);
    }

  public static function getFreshToken()
  {
    return isset(self::refreshToken()['access_token'])?static::refreshToken()['access_token']:null;
  }

    public static function isAccessTokenExpired()
    {
        return parent::isAccessTokenExpired();
    }

    public static function getDecodedBody($content)
    {
        $content = str_replace('_', '/', str_replace('-', '+', $content));
        return base64_decode($content);
    }
    public static function getEncodedBody($content)
    {
        $content= base64_encode($content);
        return str_replace('/', '_', str_replace('+', '-', $content));
    }
}