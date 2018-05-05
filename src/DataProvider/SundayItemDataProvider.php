<?php

namespace App\DataProvider;

use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Entity\Sunday;
use DateTime;

class SundayItemDataProvider implements ItemDataProviderInterface,
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

    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = []): ?Sunday
    {
        $date = new DateTime($id);
        $dataArray = json_decode(file_get_contents($this->dataFile), true);
        foreach ($dataArray as $key => $item) {
            if ($date->format('Y-m-d') === $item['date']) {
                $sunday = Sunday::fromString($item['date']);
                $sunday->setId($key);
                $sunday->setTraded($item['traded']);
                return $sunday;
            }
        }
        return null;
    }

}