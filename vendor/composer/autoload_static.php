<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit3290cb5218153c2dfdf9126ef7c8f1ff
{
    public static $prefixLengthsPsr4 = array (
        'D' => 
        array (
            'DRouter\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'DRouter\\' => 
        array (
            0 => __DIR__ . '/..' . '/lukasdev/drouter/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit3290cb5218153c2dfdf9126ef7c8f1ff::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit3290cb5218153c2dfdf9126ef7c8f1ff::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
