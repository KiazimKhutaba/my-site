<?php


namespace Castels\Core\Routing;

use Castels\Config;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use RegexIterator;

/**
 * Class AnnotatedClassLoader
 * @package Castels\Routing
 *
 * Loads files by mask recursively
 */
class AnnotatedClassLoader
{
    /**
     * @param $path
     * @param string $namespace_prefix
     * @return array|false
     */
    public function load($path, $namespace_prefix = '')
    {
        $it = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path));
        $ite = new RegexIterator($it, '/Controller\.php$/i', RegexIterator::MATCH);

        $files = [];
        foreach ($ite as $file) {
            $class = $namespace_prefix . str_replace(
                    '.php',
                    '',
                    $ite->getSubPathname()
                );

            $class = str_replace(['\\','/'],'\\',$class);

            $files[] = $class;
        }

        return $files;
    }
}