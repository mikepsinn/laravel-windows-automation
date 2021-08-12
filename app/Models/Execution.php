<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @SWG\Definition(
 *      definition="Execution",
 *      required={"command_id", "command", "created_at", "updated_at", "user_id", "success", "output"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="command_id",
 *          description="command_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="command",
 *          description="command",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="created_at",
 *          description="created_at",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="updated_at",
 *          description="updated_at",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="user_id",
 *          description="user_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="success",
 *          description="success",
 *          type="boolean"
 *      ),
 *      @SWG\Property(
 *          property="output",
 *          description="output",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="deleted_at",
 *          description="deleted_at",
 *          type="string",
 *          format="date-time"
 *      )
 * )
 */
class Execution extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'executions';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'command_id',
        'command',
        'user_id',
        'success',
        'output'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'command_id' => 'integer',
        'command' => 'string',
        'user_id' => 'integer',
        'success' => 'boolean',
        'output' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'command_id' => 'required|integer',
        'command' => 'required|string',
        'created_at' => 'required',
        'updated_at' => 'required',
        'user_id' => 'required|integer',
        'success' => 'required|boolean',
        'output' => 'required|string',
        'deleted_at' => 'nullable'
    ];

    
}
