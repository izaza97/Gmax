<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',

            'tour-category-list',
            'tour-category-create',
            'tour-category-edit',
            'tour-category-delete',

            'tour-list',
            'tour-create',
            'tour-edit',
            'tour-delete',

            'tour-package-list',
            'tour-package-create',
            'tour-package-edit',
            'tour-package-delete',

            'reservation-list',
            'reservation-create',
            'reservation-edit',
            'reservation-delete',

            'employee-list',
            'employee-create',
            'employee-edit',
            'employee-delete',

            'list-package-list',
            'list-package-create',
            'list-package-edit',
            'list-package-delete',

            'report',
        ];

        foreach ($permissions as $permission) {
            \Spatie\Permission\Models\Permission::create(['name' => $permission]);
        }
    }
}
