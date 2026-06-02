<?php

namespace App\Policies;

use App\Models\Lead;
use App\Models\Search;
use App\Models\User;

class LeadPolicy
{
    public function view(User $user, Lead $lead): bool
    {
        return $user->id === $lead->user_id;
    }

    public function update(User $user, Lead $lead): bool
    {
        return $user->id === $lead->user_id;
    }

    public function delete(User $user, Lead $lead): bool
    {
        return $user->id === $lead->user_id;
    }
}

class SearchPolicy
{
    public function view(User $user, Search $search): bool
    {
        return $user->id === $search->user_id;
    }

    public function delete(User $user, Search $search): bool
    {
        return $user->id === $search->user_id;
    }
}
