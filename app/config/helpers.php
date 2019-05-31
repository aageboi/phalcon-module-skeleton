<?php 

use Phalcon\Di;

if (!function_exists('app_path')) {
    /**
     * Get the Application path.
     *
     * @param  string $path
     * @return string
     */
    function app_path($path = '')
    {
        return ROOT_DIR . DIRECTORY_SEPARATOR . 'app' . ($path ? DIRECTORY_SEPARATOR . $path : $path);
    }
}

if (!function_exists('config_path')) {
    /**
     * Get the configuration path.
     *
     * @param  string $path
     * @return string
     */
    function config_path($path = '')
    {
        return app_path('config') . ($path ? DIRECTORY_SEPARATOR . $path : $path);
    }
}

if (!function_exists('content_path')) {
    /**
     * Get the content path.
     *
     * @param  string $path
     * @return string
     */
    function content_path($path = '')
    {
        return app_path('content') . ($path ? DIRECTORY_SEPARATOR . $path : $path);
    }
}

if (!function_exists('logs_path')) {
    /**
     * Get the logs path.
     *
     * @param  string $path
     * @return string
     */
    function logs_path($path = '')
    {
        return content_path('logs') . ($path ? DIRECTORY_SEPARATOR . $path : $path);
    }
}

if (!function_exists('container')) {
    /**
     * Calls the default Dependency Injection container.
     *
     * @param  mixed
     * @return mixed|\Phalcon\DiInterface
     */
    function container()
    {
        $default = Di::getDefault();
        $args = func_get_args();

        if (empty($args)) {
            return $default;
        }

        return call_user_func_array([$default, 'get'], $args);
    }
}

if (!function_exists('content_modules_path')) {
    /**
     * Get the modules path.
     *
     * @param  string $path
     * @return string
     */
    function content_modules_path($path = '')
    {
        return content_path('modules') . ($path ? DIRECTORY_SEPARATOR . $path : $path);
    }
}

if (!function_exists('modules_path')) {
    /**
     * Get the modules path.
     *
     * @param  string $path
     * @return string
     */
    function modules_path($path = '')
    {
        return app_path('modules') . ($path ? DIRECTORY_SEPARATOR . $path : $path);
    }
}

if (!function_exists('env')) {
    /**
     * Gets the value of an environment variable.
     *
     * @param  string $key
     * @param  mixed  $default
     * @return mixed
     */
    function env($key, $default = null)
    {
        $value = getenv($key);

        if ($value === false) {
            return value($default);
        }

        switch (strtolower($value)) {
            case 'true':
                return true;
            case 'false':
                return false;
            case 'empty':
                return '';
            case 'null':
                return null;
        }

        return $value;
    }
}