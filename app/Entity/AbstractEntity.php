<?php

declare(strict_types=1);

namespace App\Entity;

use App\DBA\DBA;

/**
 * Class AbstractEntity
 * @package App\Entity
 */
abstract class AbstractEntity
{
    /** @var DBA */
    protected DBA $dm;

    public function __construct()
    {
        $this->dm = DBA::create();
    }
}
