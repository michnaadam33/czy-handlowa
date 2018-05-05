<?php

namespace App\DataProvider;


use ApiPlatform\Core\DataProvider\CollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Entity\Sunday;

class SundayCollectionDataProvider implements CollectionDataProviderInterface,
    RestrictedDataProviderInterface
{
    /**
     * @var string
     */
    private $dataFile;

    public function __construct(string $dataFile)
    {
        $this->dataFile = $dataFile;
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Sunday::class === $resourceClass;
    }

    public function getCollection(string $resourceClass, string $operationName = null): \Generator
    {
        $dataArray = json_decode(file_get_contents($this->dataFile),true);
        foreach ($dataArray as $key => $item) {
            $sunday = Sunday::fromString($item['date']);
            $sunday->setId($key);
            $sunday->setTraded($item['traded']);
            yield $sunday;
        }
    }
}