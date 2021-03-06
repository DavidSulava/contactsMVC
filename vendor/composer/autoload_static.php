<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit2c634b31075d29cca1e4959968123022
{
    public static $files = array (
        'd28456fad676ea3b51ccfc303356379e' => __DIR__ . '/../..' . '/inc/helper/configFunction.php',
        'bc6c2cb73fe0aac6be6cac5dcc889552' => __DIR__ . '/../..' . '/inc/helper/view.php',
        '3c11b89f08069278a354a7044a834f35' => __DIR__ . '/../..' . '/inc/helper/pagination.php',
    );

    public static $prefixLengthsPsr4 = array (
        'i' => 
        array (
            'inc\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'inc\\' => 
        array (
            0 => __DIR__ . '/../..' . '/inc',
        ),
    );

    public static $classMap = array (
        'inc\\classes\\App' => __DIR__ . '/../..' . '/inc/classes/app.php',
        'inc\\classes\\Router' => __DIR__ . '/../..' . '/inc/classes/router.php',
        'inc\\classes\\User' => __DIR__ . '/../..' . '/inc/classes/user.php',
        'inc\\controllers\\Ajax' => __DIR__ . '/../..' . '/inc/controllers/ajax.php',
        'inc\\controllers\\DataCrude' => __DIR__ . '/../..' . '/inc/controllers/crud_data.php',
        'inc\\controllers\\PageController' => __DIR__ . '/../..' . '/inc/controllers/pageController.php',
        'inc\\controllers\\UserController' => __DIR__ . '/../..' . '/inc/controllers/user.php',
        'inc\\database\\DbQuery' => __DIR__ . '/../..' . '/inc/database/DbModel.php',
        'inc\\database\\migrations\\CreateDataBase' => __DIR__ . '/../..' . '/inc/database/migrations/createTable.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit2c634b31075d29cca1e4959968123022::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit2c634b31075d29cca1e4959968123022::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit2c634b31075d29cca1e4959968123022::$classMap;

        }, null, ClassLoader::class);
    }
}
