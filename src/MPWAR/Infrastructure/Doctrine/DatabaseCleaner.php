<?php

namespace MPWAR\Infrastructure\Doctrine;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\SchemaTool;

final class DatabaseCleaner
{
    public static function clean(EntityManager $entityManager)
    {
        $metadatas = $entityManager->getMetadataFactory()->getAllMetadata();

        $database = new SchemaTool($entityManager);

        $database->dropSchema($metadatas);
        $database->createSchema($metadatas);
    }
}
