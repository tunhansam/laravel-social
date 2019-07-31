<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use App\Repositories\GeneralRepositoryEloquent;

/**
 * Class AdminRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class AdminRepositoryEloquent extends BaseRepository implements AdminRepository
{
    use GeneralRepositoryEloquent;
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model(){
        return "App\\Admin";
    }
    /**
     * Check superadmin
     */
    public function isSuperAdmin($roleType) {
        return $this->model->isSuperAdmin($roleType);
    }
}
