<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit2c635981cd6aee01e1ef5a514c024851
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
            0 => __DIR__ . '/../..' . '/DEMO1',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit2c635981cd6aee01e1ef5a514c024851::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit2c635981cd6aee01e1ef5a514c024851::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit2c635981cd6aee01e1ef5a514c024851::$classMap;

        }, null, ClassLoader::class);
    }
}
