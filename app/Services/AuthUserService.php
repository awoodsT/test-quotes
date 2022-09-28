<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

class AuthUserService
{
    /**
     * Create user
     *
     * @return User
     */
    public function createUser(array $data): User
    {
        $data['password'] = Hash::make($data['password']);

        DB::beginTransaction();
        try{
            $user = User::create($data);

            DB::commit();
            return $user;
        } catch(\Exception $e){
            DB::rollBack();
            Log::error($e->getMessage());
        }

    }

    /**
     * Check credentaials of the user
     *
     * @param array $data
     * @return App\Models\User&&bool
     */
    public function checkCredentials($data)
    {
        $user = User::where('email', $data['email'])->first();

        if(!Hash::check($data['password'], $user['password'])){
            return false;
        }

        return $user;
    }
}
