<?php

declare(strict_types=1);

namespace App\Entity;

/**
 * Class AbstractEntity
 * @package App\Entity
 */
abstract class AbstractEntity
{
    /** @var \PDO */
    protected \PDO $dm;

    public function __construct(\PDO $dm)
    {
        $this->dm = $dm;
        $this->dm->exec('SET TRANSACTION ISOLATION LEVEL REPEATABLE READ');
    }
}
