<?php
namespace App\Models;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use PowerShell;
/**
 * Class Command
 * @package App\Models
 * @property string $command
 * @property string $name
 * @property integer $times_used
 * @property int $id
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Database\Factories\AppCommandFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Command newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Command newQuery()
 * @method static \Illuminate\Database\Query\Builder|Command onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Command query()
 * @method static \Illuminate\Database\Eloquent\Builder|Command whereCommand($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Command whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Command whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Command whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Command whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Command whereTimesUsed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Command whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Command withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Command withoutTrashed()
 * @mixin Model
 */
class Command extends Model
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
	public function execute(){
		$ps = new PowerShell();
		return $ps->execute($this->command);
	}
}