<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Order;
use App\Models\WalletLog;
use App\Models\Withdrawal;
use App\Models\DownloadLog;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public const ROLE_BUYER = 'buyer';
    public const ROLE_SELLER = 'seller';
    public const ROLE_ADMIN = 'admin';



    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'wallet',
        'is_approved',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'wallet' => 'decimal:2',
            'is_approved' => 'boolean',
        ];
    }

    /** Get the user's initials. */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->take(2)
            ->map(fn ($word) => Str::substr($word, 0, 1))
            ->implode('');
    }

    // Relationships
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function walletLogs()
    {
        return $this->hasMany(WalletLog::class);
    }

    // Backward compatibility
    public function transactions()
    {
        return $this->walletLogs();
    }

    public function downloads()
    {
        return $this->hasMany(DownloadLog::class);
    }

    public function withdrawals()
    {
        return $this->hasMany(Withdrawal::class);
    }
}
