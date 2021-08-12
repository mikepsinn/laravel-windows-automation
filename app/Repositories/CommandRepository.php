<?php

namespace App\Repositories;

use App\Models\Command;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
/**
 * Class AppCommandRepository
 * @package App\Repositories
 * @version August 12, 2021, 2:11 pm UTC
*/

class CommandRepository extends BaseRepository
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
    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model(): string
    {
        return Command::class;
    }
	/**
	 * Make Model instance
	 * @return Model
	 * @throws \Exception
	 */
	public function makeModel(): Model{
		return parent::makeModel();
	}
	/**
	 * Retrieve all records with given filter criteria
	 * @param array $search
	 * @param int|null $skip
	 * @param int|null $limit
	 * @param array $columns
	 * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
	 */
	public function all(array $search = [], int $skip = null, int $limit = null, array $columns = ['*']){
		return parent::all($search, $skip, $limit, $columns);
	}
	/**
	 * Create model record
	 * @param array $input
	 * @return Command
	 */
	public function create(array $input): Command{
		return parent::create($input);
	}
	/**
	 * Find model record for given id
	 * @param int $id
	 * @param array $columns
	 * @return Command
	 */
	public function find(int $id, array $columns = ['*']): Command{
		return parent::find($id, $columns);
	}
	/**
	 * Update model record for given id
	 * @param array $input
	 * @param int $id
	 * @return Command
	 */
	public function update(array $input, int $id): Command{
		return parent::update($input, $id);
	}
	/**
	 * @param int $id
	 * @return bool|mixed|null
	 * @throws \Exception
	 */
	public function delete(int $id){
		return parent::delete($id);
	}
}
