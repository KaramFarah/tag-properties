<?php

namespace App\Models\Dashboard;

use App\Models\User;
use App\Models\Dashboard\Call;
use App\Models\Dashboard\Contact;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends BaseModel
{
    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class);
    }
    
    public function call(): BelongsTo
    {
        return $this->belongsTo(Call::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author');
    }
}
