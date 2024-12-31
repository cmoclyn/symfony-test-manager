<?php

namespace SymfonyTestManager\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TestManagerController extends AbstractController
{
    #[Route('/test-manager', name: 'test_manager')]
    public function index(): Response
    {
        $srcFiles = $this->scanDirectory('src');
        $testFiles = $this->scanDirectory('tests');

        return $this->render('@SymfonyTestManager/index.html.twig', [
            'srcFiles' => $srcFiles,
            'testFiles' => $testFiles,
        ]);
    }

    private function scanDirectory(string $directory): array
    {
        $files = [];
        $iterator = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($directory));

        foreach ($iterator as $file) {
            if ($file->isFile()) {
                $files[] = $file->getPathname();
            }
        }

        return $files;
    }
}
