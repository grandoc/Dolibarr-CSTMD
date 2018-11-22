<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit8aa2a21cd05218060d0d01b85e0e720b
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'Michelf\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Michelf\\' => 
        array (
            0 => __DIR__ . '/..' . '/michelf/php-markdown/Michelf',
        ),
    );

    public static $prefixesPsr0 = array (
        'E' => 
        array (
            'Enrise\\' => 
            array (
                0 => __DIR__ . '/..' . '/enrise/urihelper/src',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit8aa2a21cd05218060d0d01b85e0e720b::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit8aa2a21cd05218060d0d01b85e0e720b::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit8aa2a21cd05218060d0d01b85e0e720b::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}
