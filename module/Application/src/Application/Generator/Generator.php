<?php

namespace Application\Generator;

use Twig_Environment;
use Twig_Loader_Filesystem;

class Generator
{
    protected $skeletonDirectory;

    /**
     * Sets an array of directories to look for templates.
     *
     * The directories must be sorted from the most specific to the most
     * directory.
     *
     * @param string $skeletonDirectory An array of skeleton dirs
     */
    public function setSkeletonDirectory($skeletonDirectory)
    {
        $this->skeletonDirectory = $skeletonDirectory;
    }

    protected function render($template, $parameters)
    {
        $templatePath = $this->skeletonDirectory . '/' . $template;
        var_dump($this->skeletonDirectory);
        $content = file_get_contents($templatePath);

        return str_replace(array_keys($parameters), array_values($parameters), $content);
    }

    protected function renderFile($template, $target, $parameters)
    {
        if (!is_dir(dirname($target))) {
            mkdir(dirname($target), 0777, true);
        }

        return file_put_contents($target, $this->render($template, $parameters));
    }
}