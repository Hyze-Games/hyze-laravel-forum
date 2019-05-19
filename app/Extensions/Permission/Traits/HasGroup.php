<?php

namespace App\Extensions\Permission\Traits;

use App\Extensions\Permission\Group;
use Illuminate\Support\Collection;

trait HasGroup
{
    public function hasStrictGroup(Group $group): bool
    {
        return $this->groups->contains('key', $group->key);
    }

    public function hasGroup(Group $group): bool
    {
        return !$group->isHigher($this->getHighestGroup());
    }

    public function getHighestGroup(): Group
    {
        return $this->groups->sortBy('value')->first() ?? Group::DEFAULT();
    }

    public function getGroupsAttribute(): Collection
    {
        if (isset($this->attributes['groups'])) {
            return $this->attributes['groups'];
        }

        $result = $this->getConnection()->table('user_groups')
            ->where('user_id', $this->id)
            ->get();

        $groups = $result->map(function ($item) {
            if (isset(Group::getInstances()[$item->group_id])) {
                return Group::getInstances()[$item->group_id];
            }

            return null;
        })
            ->filter()
            ->unique(function ($item) {
                return $item->key;
            });

        $this->attributes['groups'] = $groups;

        return $this->attributes['groups'];
    }
}
