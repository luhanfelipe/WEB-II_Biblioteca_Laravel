<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Book;

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    // Constante com os papéis disponíveis
    public const ROLES = [
        'admin' => 'admin',
        'bibliotecario' => 'bibliotecario',
        'cliente' => 'cliente',
    ];

    // Adicionar role no fillable
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'debit',
    ];

    // Métodos auxiliares para verificar papéis
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isBibliotecario(): bool
    {
        return $this->role === 'bibliotecario';
    }

    public function isCliente(): bool
    {
        return $this->role === 'cliente';
    }

    // Método para verificar se o usuário tem débito
    public function hasDebit(): bool
    {
        return $this->debit > 0;
    }

    // Relacionamento N para N com livros via tabela borrowings
    public function books()
    {
        return $this->belongsToMany(Book::class, 'borrowings')
                    ->withPivot('id', 'borrowed_at', 'returned_at')
                    ->withTimestamps();
    }

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
        ];
    }
}
