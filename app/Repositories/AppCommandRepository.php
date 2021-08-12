<?php

namespace App\Repositories;

use App\Models\AppCommand;
use App\Repositories\BaseRepository;

/**
 * Class AppCommandRepository
 * @package App\Repositories
 * @version August 12, 2021, 2:11 pm UTC
*/

class AppCommandRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'command',
        'name',
        'times_used'
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
        return AppCommand::class;
    }
}
