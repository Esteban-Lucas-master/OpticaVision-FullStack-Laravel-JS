<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Product;
use App\Models\Purchase;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'rol', // 👈 añadimos el rol para poder asignarlo
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // 🔑 Helpers para roles
    public function esAdmin(): bool
    {
        return $this->rol === 'admin';
    }

    public function esVendedor(): bool
    {
        return $this->rol === 'vendedor';
    }

    public function esCliente(): bool
    {
        return $this->rol === 'cliente';
    }

    // 📦 Relación con productos (solo si es vendedor)
    public function productos()
    {
        return $this->hasMany(Product::class, 'seller_id');
    }

    // 🛒 Relación con órdenes (solo si es cliente)
    public function ordenes()
    {
        return $this->hasMany(Purchase::class, 'buyer_id');
    }
}
