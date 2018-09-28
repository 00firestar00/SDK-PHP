<?php

namespace OntraportAPI\Tests;

class testsAutoLoader

{
    public static function loader($className)
    {
        $libraryBaseDir = __DIR__;
        $namespace = "OntraportAPI\Tests";
        $className = str_replace("\\\\", "\\", $className);

        if ($className[0] === "\\")
        {
            $className = substr($className, 1);
        }

        // Does the fully-qualified classname start with our namespace?
        if (strlen($className) <= strlen($namespace) || strncmp($className, $namespace, strlen($namespace)) !== 0)
        {
            return false;
        }

        $classPart = substr($className, strlen($namespace) + 1);
        $classComponents = explode("\\", $classPart);
        $classFile = $libraryBaseDir . "/" . implode("/", $classComponents);

        // Determine the namespace root file.
        $namespaceComponents = explode("\\", $namespace);
        array_pop($classComponents);
        $namespaceFile = $libraryBaseDir . "/";

        if (empty($classComponents))
        {
            $namespaceFile .= end($namespaceComponents);
        }

        $found = false;
        foreach (array($classFile, $namespaceFile) as $file)
        {
            $proposed = $file . ".php";
            if (is_file($proposed))
            {
                require_once($proposed);
                $found = true;
                break;
            }
        }

        return $found;
    }
}

spl_autoload_register('\OntraportAPI\Tests\testsAutoloader::loader');
