<?php
session_start();
        $ran=substr(sha1(microtime()),0,6);
        $_SESSION['captcha']=$ran;
        $newImage=imagecreatefromjpeg("images.jpg");
        $txtColor=imagecolorallocate($newImage,0,0,200);
        imagestring($newImage,5,30,8,$ran,$txtColor);
        header("Content-type: image/jpeg");
        imagejpeg($newImage);
?>
