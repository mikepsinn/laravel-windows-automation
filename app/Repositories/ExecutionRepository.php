<?php

namespace App\Repositories;

use App\Models\Execution;
use App\Repositories\BaseRepository;

/**
 * Class ExecutionRepository
 * @package App\Repositories
 * @version August 12, 2021, 3:44 pm UTC
*/

class ExecutionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'command_id',
        'command',
        'user_id',
        'success',
        'output'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Execution::class;
    }
}
