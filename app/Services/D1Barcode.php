<?php

namespace App\Services;
use Illuminate\Support\Str;
class D1Barcode extends \Milon\Barcode\DNS1D
{
    protected function getBarcodePNG($code, $type, $w = 2, $h = 30, $color = array(0, 0, 0),$printtext = false) {
        if (!$this->store_path) {
            $this->setStorPath(app('config')->get("barcode.store_path"));
        }
        $this->setBarcode($code, $type);
        // calculate image size
        $width = ($this->barcode_array['maxw'] * $w)+ 10;
        $height = $h;
        if (function_exists('imagecreate')) {
            // GD library
            $imagick = false;
            $png = imagecreate($width, $height);
            $bgcol = imagecolorallocate($png, 255, 255, 255);
            imagecolortransparent($png, $bgcol);
            $fgcol = imagecolorallocate($png, $color[0], $color[1], $color[2]);
        } elseif (extension_loaded('imagick')) {
            $imagick = true;
            $bgcol = new \imagickpixel('rgb(255,255,255)');
            $fgcol = new \imagickpixel('rgb(' . $color[0] . ',' . $color[1] . ',' . $color[2] . ')');
            $png = new \Imagick();
            $png->newImage($width, $height, 'none', 'png');
            $bar = new \imagickdraw();
            $bar->setfillcolor($fgcol);
        } else {
            return false;
        }
        // print bars
        $x = 5;
        foreach ($this->barcode_array['bcode'] as $k => $v) {
            $bw = round(($v['w'] * $w), 3);
            $bh = round(($v['h'] * $h / $this->barcode_array['maxh']), 3);
            $bh = $bh - 20;
            if ($v['t']) {
                $y = round(($v['p'] * $h / $this->barcode_array['maxh']), 3);
                $y = 5;
                // draw a vertical bar
                if ($imagick) {
                    $bar->rectangle($x, $y, ($x + $bw), ($y + $bh));
                } else {
                    imagefilledrectangle($png, $x, $y, ($x + $bw) - 1, ($y + $bh), $fgcol);
                }
            }
            $x += $bw;
        }
        ob_start();
        // get image out put

        if ($printtext) {
            $len = strlen($code);
            $tw = $len * imagefontwidth(5);
            $xpos = ($width - $tw) / 2;
            imagestring ( $png, 5, $xpos, $bh+5, $code, $fgcol );
        }

        $color = imagecolorallocate($png, 0, 0, 0);
        $thickness = 1;
        $x1 = 0;
        $y1 = 0;
        $x2 = imagesx($png) - 1;
        $y2 = imagesy($png) - 1;

        for($i = 0; $i < $thickness; $i++)
        {

            imagerectangle($png, $x1++, $y1++, $x2--, $y2--, $color);
        }

        if ($imagick) {
            $png->drawimage($bar);
            echo $png;

        } else {
            imagepng($png);
            imagedestroy($png);
        }

        $image = ob_get_clean();
        $image = base64_encode($image);
        $image = 'data:image/png;base64,' . base64_encode($image);
        return $image;
    }

    protected function getBarcodePNGPath($code, $type, $w = 2, $h = 30, $color = array(0, 0, 0), $showCode = false) {
        if (!$this->store_path) {
            $this->setStorPath(app('config')->get("barcode.store_path"));
        }
        $this->setBarcode($code, $type);
        // calculate image size
        $width = ($this->barcode_array['maxw'] * $w);
        $height = $h;
        if (function_exists('imagecreate')) {
            // GD library
            $imagick = false;
            $png = imagecreate($width, $height);
            $bgcol = imagecolorallocate($png, 255, 255, 255);
            imagecolortransparent($png, $bgcol);
            $fgcol = imagecolorallocate($png, $color[0], $color[1], $color[2]);
        } elseif (extension_loaded('imagick')) {
            $imagick = true;
            $bgcol = new imagickpixel('rgb(255,255,255');
            $fgcol = new imagickpixel('rgb(' . $color[0] . ',' . $color[1] . ',' . $color[2] . ')');
            $png = new Imagick();
            $png->newImage($width, $height, 'none', 'png');
            $bar = new imagickdraw();
            $bar->setfillcolor($fgcol);
        } else {
            return false;
        }
        // print bars
        $x = 0;
        foreach ($this->barcode_array['bcode'] as $k => $v) {
            $bw = round(($v['w'] * $w), 3);
            $bh = round(($v['h'] * $h / $this->barcode_array['maxh']), 3);
            if($showCode)
                $bh -= imagefontheight(3) ;
            if ($v['t']) {
                $y = round(($v['p'] * $h / $this->barcode_array['maxh']), 3);
                // draw a vertical bar
                if ($imagick) {
                    $bar->rectangle($x, $y, ($x + $bw), ($y + $bh));
                } else {
                    imagefilledrectangle($png, $x, $y, ($x + $bw) - 1, ($y + $bh), $fgcol);
                }
            }
            $x += $bw;
        }
        if($showCode)
            if ($imagick) {
                $bar->setTextAlignment(\Imagick::ALIGN_CENTER);
                $bar->annotation( 10 , $h - $bh +10 , $code );
            } else {
                $width_text = imagefontwidth(3) * strlen($code);
                $height_text = imagefontheight(3);
                imagestring($png, 3, ($width/2) - ($width_text/2) , ($height - $height_text) , $code, $fgcol);
            }
        $file_name= Str::slug($code);
        $save_file = $this->checkfile($this->store_path . $file_name . ".png");
        if ($imagick) {
            $png->drawimage($bar);
            //echo $png;
        }
        if (ImagePng($png, $save_file)) {
            imagedestroy($png);
            return str_replace(public_path(), '', $save_file);
        } else {
            imagedestroy($png);
            return $code;
        }
    }
}
