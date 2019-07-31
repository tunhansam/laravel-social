<?php

namespace App\Repositories;

use App\Repositories\GeneralRepository;

/**
 * Interface AdminRepository.
 *
 * @package namespace App\Repositories;
 */
interface AdminRepository extends GeneralRepository
{
    public function isSuperAdmin($roleType);
}
