<?php

namespace App\Http;

use Alexusmai\LaravelFileManager\Services\ACLService\ACLRepository;
use Illuminate\Support\Str;

class UsersACLRepository implements ACLRepository
{
    /**
     * Get user ID
     *
     * @return mixed
     */
    public function getUserID()
    {
        return \Auth::id();
    }

    /**
     * Get ACL rules list for user
     *
     * @return array
     */
    public function getRules(): array
    {
        if (\Auth::id() === 4) {
            return [
                ['public'],
                ['disk' => 'public', 'path' => '*', 'access' => 1],
            ];
        }

        return [
            ['disk' => 'user', 'path' => '/', 'access' => 1],                                  // main folder - read
            ['disk' => 'user', 'path' =>  'user_' . \Auth::user()->id . '_' . Str::slug(\Auth::user()->name), 'access' => 1],        // only read
            ['disk' => 'user', 'path' =>  'user_' . \Auth::user()->id . '_' . Str::slug(\Auth::user()->name) .'/*', 'access' => 2],  // read and write
        ];
    }
}
