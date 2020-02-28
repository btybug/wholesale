<?php
namespace App\Services;


class EAN13render
{
    static $Rcodes =
        [
            '1110010', '1100110', '1101100', '1000010', '1011100',
            '1001110', '1010000', '1000100', '1001000', '1110100'

        ];
    static $groups = [
        'LLLLLL', 'LLGLGG', 'LLGGLG', 'LLGGGL', 'LGLLGG',
        'LGGLLG', 'LGGGLL', 'LGLGLG', 'LGLGGL', 'LGGLGL'
    ];

    public static function Render($barcode,$w,$h)
    {

        $im = ImageCreateTrueColor($w, $h);
        ImageFilledRectangle($im, 0, 0, $w, $h, 0xFFFFFF);
        $w=$w*2;
        $h=$h*2;
        $xpos = 38;
        $synth = function ($pattern, $transformation, $height) use (&$im, &$xpos) {
            $b = strlen($pattern);
            for ($a = 0; $a < $b; ++$a) {
                $index = $a;
                if ($transformation == 'G') $index = ($b - 1) - $index;
                $bit = (int)$pattern[$index];

                if ($transformation == 'L') $bit = 1 - $bit;

                if ($bit == 1)
                    imageLine($im, $xpos, 0, $xpos, $height, 0x000000);
                ++$xpos;

            }
        };
        $normal_height = $h - 24;
        $seperator_height = $h-14 ;
        $font = public_path('fonts/arial.ttf');
        $synth('101', 'R', $seperator_height);

        for ($n = 0; $n < 13; ++$n) {
            $digit = (int)$barcode[$n];
            if ($n == 0) {
                if($digit!=0){
                ImageTTFtext($im, 16, 0, $xpos - 20, $h - 2, 0x000000, $font, $digit);
                }
            } else {
                ImageTTFtext($im, 16, 0, $xpos, $h - 2, 0x000000, $font, $digit);

                $code = self::$Rcodes[$digit];
                $select = 'R';
                if ($n <= 6) {
                    $select = self::$groups[(int)$barcode[0]][$n - 1];
                }
                $synth($code, $select, $normal_height);
                if ($n == 6) {
                    $synth('01010', 'R', $seperator_height);
                }
            }

        }

        return $im;

    }

    public static function get($code,$path,$w=123,$h=78)
    {
//        $barcode = sprintf('64%s', base_convert($code, 36, 10));
        $image = self::Render($code,$w,$h);
        imagepng($image, $path,9);
        return $path;
    }
}
