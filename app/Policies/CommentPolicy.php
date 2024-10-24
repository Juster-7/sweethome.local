<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Session;

class CommentPolicy
{
    use HandlesAuthorization;

    public function delete(User $user, Comment $comment) {
        // return $user->isAdmin() || $user->id === $comment->user->id;
        return $user->id === $comment->user->id;
    }
}
