<?php


use Phinx\Seed\AbstractSeed;

class UserSeed extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                'username' => 'admin',
                'password' => password_hash('@#$RF@!718', PASSWORD_DEFAULT)
            ]
        ];

        $users = $this->table('users');
        $users->insert($data)
            ->saveData();
    }
}
