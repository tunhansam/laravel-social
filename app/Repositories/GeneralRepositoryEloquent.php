<?php

namespace App\Repositories;


/**
 * Class GeneralRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */

trait GeneralRepositoryEloquent {
    function getList($search, $display) {
        return $this->model->searchEmail($search)
            ->paginate($display);
    }
}