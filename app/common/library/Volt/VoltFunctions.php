<?php

namespace PhalconApp\Common\Library\Volt;

// use PhalconApp\Models\Services

/***
 * \PhalconApp\Common\Library\Volt\VoltFunctions
 *
 * PHP Functions in Volt
 *
 * @package PhalconApp\Tools
 */
class VoltFunctions
{
    /**
     * Compile any function call in a template
     *
     * @param string $name      function name
     * @param mixed  $arguments function args
     *
     * @return string compiled function
     */
    public function compileFunction($name, $arguments)
    {
        if (function_exists($name)) {
            return $name . '(' . $arguments . ')';
        }

        return null;
    }

    /**
     * Compile some filters
     *
     * @param string $name      The filter name
     * @param mixed  $arguments The filter args
     *
     * @return string|null
     */
    public function compileFilter($name, $arguments)
    {
        switch ($name) {
            case 'isset':
                return '(isset(' . $arguments . ') ? ' . $arguments . ' : false)';
            case 'long2ip':
                return 'long2ip(' . $arguments . ')';
            case 'strlen':
                return "\\Stringy\\create('$arguments')->length()";
        }

        return null;
    }
}