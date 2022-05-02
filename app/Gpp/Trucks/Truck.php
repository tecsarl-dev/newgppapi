<?php
namespace App\Gpp\Trucks;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Truck extends Model
{
    use HasFactory;

    protected $fillable = [
        "type",
        "capacity",
        "registration_number",
        "transporter_id",
        "is_active",
        "is_submit",
    ];

    public function transporter(): BelongsTo
    {
        return $this->belongsTo("App\Gpp\Companies\Company");
    }
    
}
