<?php

namespace SymfonyTestManager\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\RouterInterface;

class TestManagerController extends AbstractController
{
    public function __construct(private readonly RouterInterface $router){}
    #[Route('/test-manager', name: 'test_manager')]
    public function index(): Response
    {
        $srcFiles = $this->scanDirectory('src');
        $testFiles = $this->scanDirectory('tests');
        dump($this->router->getRouteCollection());

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
