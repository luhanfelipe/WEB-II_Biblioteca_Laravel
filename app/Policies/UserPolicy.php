<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    // Admin pode fazer tudo
    public function before(User $user, string $ability): bool|null
    {
        if ($user->isAdmin()) {
            return true;
        }
        return null;
    }

    // Apenas admin pode editar papéis
    public function editRole(User $user, User $targetUser): bool
    {
        return $user->isAdmin();
    }

    // Bibliotecário pode gerenciar livros, autores, editoras, categorias
    public function manageBooks(User $user): bool
    {
        return $user->isAdmin() || $user->isBibliotecario();
    }

    // Apenas admin e bibliotecário podem criar/editar
    public function create(User $user): bool
    {
        return $user->isAdmin() || $user->isBibliotecario();
    }

    public function update(User $user, User $targetUser): bool
    {
        return $user->isAdmin() || $user->isBibliotecario();
    }

    public function delete(User $user, User $targetUser): bool
    {
        return $user->isAdmin();
    }

    // Cliente pode visualizar
    public function view(User $user, User $targetUser): bool
    {
        return true; // Todos podem visualizar
    }

    public function viewAny(User $user): bool
    {
        return true; // Todos podem listar
    }
}
