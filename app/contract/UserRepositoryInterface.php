<?php
namespace App\Contract;
use App\User;

interface UserRepositoryInterface {
    public function updateOrCreate(array $user_data = []);
    public function update(User $user, array $user_data = []);
    public function deauthUser($fb_id);
}
