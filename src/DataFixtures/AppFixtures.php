<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\DBAL\Connection;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $pageSize = 13100;
        $totalCount = 1_008_700;

        /** @var Connection $connection */
        $connection = $manager->getConnection();
        $connection->getConfiguration()->setSQLLogger(null);
        $connection->getConfiguration()->setMiddlewares([]);

        $connection->executeQuery("TRUNCATE TABLE product;");

        for ($i = 1; $i <= ($totalCount / $pageSize); $i++) {
            $this->createFakeData($connection, $i, $pageSize);;
            echo "Memory usage after #{$i}: " . memory_get_usage() . PHP_EOL;
        }
    }

    private function createFakeData(Connection $connection, int $startFrom, int $pageSize): void {


        $sql = "INSERT INTO product (code, name, description, color, size) VALUES "
            . str_repeat("(?,?,?,?,?),", $pageSize);

        $sql = substr($sql, 0, -1) . ';';

        $color = ['red', 'green', 'blue'];

        $data = [];

        for($i = 0; $i < $pageSize; $i++) {
            $val = $i + $startFrom;
            array_push($data, "c{$val}");
            array_push($data, "sample product {$val}");
            array_push($data, "sample product description {$val}");
            array_push($data, $color[$i % 3]);
            array_push($data, $i % 10);
            unset($val);
        }

        $statement = $connection->prepare($sql);
        $statement->executeQuery($data);

        unset($data);
        unset($statement);
        unset($sql);
    }
}
