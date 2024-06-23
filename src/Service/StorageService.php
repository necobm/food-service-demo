<?php

namespace App\Service;

use Symfony\Component\DependencyInjection\Attribute\Autowire;

class StorageService
{
    protected const DATA_SOURCE_PATH = "request.json";
    protected string $request = '';

    public function __construct(
        #[Autowire('%kernel.project_dir%')]
        private string $basePath,
    )
    {
        $this->request = file_get_contents($this->basePath . '/' . self::DATA_SOURCE_PATH);
    }

    public function getRequest(): string
    {
        return $this->request;
    }

    public function updateRequest(string $request): void
    {
        $this->request = $request;
        file_put_contents($this->basePath . '/' . self::DATA_SOURCE_PATH, $request);
    }
}
