<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class AppCommand
 *
 * @package App\Models
 * @version August 12, 2021, 2:11 pm UTC
 * @property string $command
 * @property string $name
 * @property integer $times_used
 * @property int $id
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Database\Factories\AppCommandFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|AppCommand newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AppCommand newQuery()
 * @method static \Illuminate\Database\Query\Builder|AppCommand onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|AppCommand query()
 * @method static \Illuminate\Database\Eloquent\Builder|AppCommand whereCommand($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AppCommand whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AppCommand whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AppCommand whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AppCommand whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AppCommand whereTimesUsed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AppCommand whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|AppCommand withTrashed()
 * @method static \Illuminate\Database\Query\Builder|AppCommand withoutTrashed()
 * @mixin Model
 */
class AppCommand extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'commands';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'command',
        'name',
        'times_used'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'command' => 'string',
        'name' => 'string',
        'times_used' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'command' => 'required|string',
        'name' => 'required|string|max:255',
        'created_at' => 'required',
        'updated_at' => 'required',
        'times_used' => 'required|integer',
        'deleted_at' => 'nullable'
    ];

    
}
