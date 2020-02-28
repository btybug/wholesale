<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\TicketFiles
 *
 * @property string $name
 * @property string $original_name
 * @property string $path
 * @property string $type
 * @property string $extension
 * @property int $ticket_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $file_path
 * @property-read \App\Models\Ticket $ticket
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TicketFiles newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TicketFiles newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TicketFiles query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TicketFiles whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TicketFiles whereExtension($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TicketFiles whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TicketFiles whereOriginalName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TicketFiles wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TicketFiles whereTicketId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TicketFiles whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TicketFiles whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class TicketFiles extends Model
{
    protected $table = 'ticket_files';

    protected $fillable = [
        'name', 'original_name','path','type', 'extension', 'ticket_id'
    ];

    protected $appends = array('file_path');


    public function getFilePathAttribute()
    {
        return asset("storage/app/{$this->path}/{$this->name}.{$this->extension}");
    }

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
}