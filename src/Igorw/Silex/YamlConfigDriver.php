<?php

namespace Igorw\Silex;

use Symfony\Component\Yaml\Yaml;

class YamlConfigDriver implements ConfigDriver
{
    public function load($filename)
    {
        if (!class_exists('Symfony\\Component\\Yaml\\Yaml')) {
            throw new \RuntimeException('Unable to read yaml as the Symfony Yaml Component is not installed.');
        }
        if(!file_exists($filename)){
            throw new \RuntimeException(sprintf('file not found: %s', $filename));
        }
        $config = Yaml::parse(file_get_contents($filename));
        return $config ?: array();
    }

    public function supports($filename)
    {
        return (bool) preg_match('#\.ya?ml(\.dist)?$#', $filename);
    }
}
