<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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