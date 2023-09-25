<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit533c35ff6b818efe9fd0800fd12ea7c8
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit533c35ff6b818efe9fd0800fd12ea7c8::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit533c35ff6b818efe9fd0800fd12ea7c8::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit533c35ff6b818efe9fd0800fd12ea7c8::$classMap;

        }, null, ClassLoader::class);
    }
}