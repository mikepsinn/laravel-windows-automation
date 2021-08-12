<?php
namespace App\Repositories;
use Illuminate\Container\Container as Application;
use Illuminate\Database\Eloquent\Model;
abstract class BaseRepository
{
    /**
     * @var Model
     */
    protected $model;
    /**
     * @var Application
     */
    protected $app;
    /**
     * @param Application $app
     *
     * @throws \Exception
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->makeModel();
    }
    /**
     * Get searchable fields array
     *
     * @return array
     */
    abstract public function getFieldsSearchable(): array;
    /**
     * Configure the Model
     *
     * @return string
     */
    abstract public function model(): string;
    /**
     * Make Model instance
     *
     * @throws \Exception
     *
     * @return Model
     */
    public function makeModel(): Model{
        $model = $this->app->make($this->model());
        if (!$model instanceof Model) {
            throw new \Exception("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }
        return $this->model = $model;
    }
    /**
     * Paginate records for scaffold.
     * @param int $perPage
     * @param array $columns
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate(int $perPage, array $columns = ['*']): \Illuminate\Contracts\Pagination\LengthAwarePaginator{
        $query = $this->allQuery();
        return $query->paginate($perPage, $columns);
    }
    /**
     * Build a query for retrieving all records.
     * @param array $search
     * @param int|null $skip
     * @param int|null $limit
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function allQuery(array $search = [], int $skip = null, int $limit = null): \Illuminate\Database\Eloquent\Builder{
        $query = $this->model->newQuery();
        if (count($search)) {
            foreach($search as $key => $value) {
                if (in_array($key, $this->getFieldsSearchable())) {
                    $query->where($key, $value);
                }
            }
        }
        if (!is_null($skip)) {
            $query->skip($skip);
        }
        if (!is_null($limit)) {
            $query->limit($limit);
        }
        return $query;
    }
    /**
     * Retrieve all records with given filter criteria
     * @param array $search
     * @param int|null $skip
     * @param int|null $limit
     * @param array $columns
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function all(array $search = [], int $skip = null, int $limit = null, array $columns = ['*'])
    {
        $query = $this->allQuery($search, $skip, $limit);
        return $query->get($columns);
    }
    /**
     * Create model record
     * @param array $input
     * @return Model
     */
    public function create(array $input): Model{
	    $model = $this->model->newInstance($input);
        $model->save();
        return $model;
    }
    /**
     * Find model record for given id
     * @param int $id
     * @param array $columns
     * @return Model|null
     */
    public function find(int $id, array $columns = ['*']): ?Model{
        $query = $this->model->newQuery();
        return $query->find($id, $columns);
    }
    /**
     * Update model record for given id
     * @param array $input
     * @param int $id
     * @return Model
     */
    public function update(array $input, int $id): Model{
	    $query = $this->model->newQuery();
        $model = $query->findOrFail($id);
        $model->fill($input);
        $model->save();
        return $model;
    }
    /**
     * @param int $id
     * @return bool|mixed|null
     *@throws \Exception
     */
    public function delete(int $id)
    {
	    $query = $this->model->newQuery();
        $model = $query->findOrFail($id);
        return $model->delete();
    }
}