<?php

namespace Application\Generator;

use Symfony\Component\Finder\Finder;

class ModuleGenerator extends Generator
{
    protected $rootDir;

    /**
     * Constructor.
     *
     * @param string $rootDir The root dir
     */
    public function __construct($rootDir)
    {
        $this->rootDir = $rootDir;
    }

    public function generate(array $fullyQualifiedModuleName)
    {
        $finder = new Finder();
        $finder->files()->in($this->skeletonDirectory);

        foreach ($finder as $file) {
            $relativePathname = $file->getRelativePathname();

            $this->renderFile(
                $relativePathname,
                $this->buildPath($fullyQualifiedModuleName, $relativePathname),
                array(
                    // php files
                    'namespace Module' => 'namespace ' . implode("", $fullyQualifiedModuleName),
                    'class Module' => 'class ' . implode("", $fullyQualifiedModuleName),

                    // module.config.php
                    'Controller\Module' => 'Controller\\' . implode("", $fullyQualifiedModuleName),
                    '%module%' => strtolower(implode("-", $fullyQualifiedModuleName))
                )
            );
        }
    }

    protected function buildPath($fullyQualifiedModuleName, $relativePathname)
    {
        $moduleRootPath = implode('/', $fullyQualifiedModuleName);

        $path = implode('/', array($this->rootDir, 'module', $moduleRootPath, str_replace('.twig', '', $relativePathname)));

        if (!in_array($relativePathname, array('Module.php.twig'))) {
            $path = str_replace('Module', implode('', $fullyQualifiedModuleName), $path);
            $path = str_replace('skeleton/module', strtolower($moduleRootPath), $path);
        }

        return $path;
    }
}