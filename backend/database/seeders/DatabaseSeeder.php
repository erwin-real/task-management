<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('admin123'),
            'is_admin' => true
        ]);

        $admin->forceFill(['access_token' => $admin->createToken('Personal Access Token')->plainTextToken])->save();

        $john = User::factory()->create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => bcrypt('john123')
        ]);

        $john->forceFill(['access_token' => $john->createToken('Personal Access Token')->plainTextToken])->save();

        $erwin = User::factory()->create([
            'name' => 'Erwin Capati',
            'email' => 'erwin@example.com',
            'password' => bcrypt('john123')
        ]);

        $erwin->forceFill(['access_token' => $erwin->createToken('Personal Access Token')->plainTextToken])->save();

        Task::factory(4)->create([
            'user_id' => $admin->id
        ]);

        Task::factory(count: 8)->create([
            'user_id' => $john->id
        ]);

        Task::factory(count: 7)->create([
            'user_id' => $erwin->id
        ]);
    }
}
