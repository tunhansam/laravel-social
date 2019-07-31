<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface GeneralRepository.
 *
 * @package namespace App\Repositories;
 */
interface GeneralRepository extends RepositoryInterface
{
    function getList($search, $display);
}
