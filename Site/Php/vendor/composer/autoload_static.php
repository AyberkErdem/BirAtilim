<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitb721697997aaae98bd1504e82b0a7573
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitb721697997aaae98bd1504e82b0a7573::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitb721697997aaae98bd1504e82b0a7573::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
