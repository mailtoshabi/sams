<?php

namespace Database\Seeders;

use App\Http\Utilities\Utility;
use App\Models\Category;
use App\Models\Component;
use App\Models\Customer;
use App\Models\Kitchen;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $adminRole = Role::create(['name' => 'Administrator']);

        $managerRole = Role::create(['name' => 'Manager']);
        $hrRole = Role::create(['name' => 'HR']);
        $executiveRole = Role::create(['name' => 'Executive']);
        $officeStaffRole = Role::create(['name' => 'OfficeStaff']);

        $all_Permission = Permission::create(['name' => 'All Permission']);
        $user_managment = Permission::create(['name' => 'User Managment']);
        $customer_management = Permission::create(['name' => 'Customer Management']);
        $category_management = Permission::create(['name' => 'Category Management']);
        $product_management = Permission::create(['name' => 'Product Management']);
        $enquiry_management = Permission::create(['name' => 'Enquiry Management']);
        $estimate_management = Permission::create(['name' => 'Estimate Management']);

        $adminRole->givePermissionTo([$all_Permission]);
        $managerRole->givePermissionTo([$customer_management, $category_management,$product_management,$enquiry_management,$estimate_management]);
        $hrRole->givePermissionTo([$enquiry_management,$estimate_management]);


        $user1=User::create(['name' => 'Super Admin','email' => 'webmahal@gmail.com','phone'=>'9809373738','password' => Hash::make('123456'),'email_verified_at'=>now(),'avatar' => 'avatar-1.jpg', 'created_at' => now()]);
        $user1->assignRole('Administrator');
        $user2=User::create(['name' => 'Shafeer','email' => 'shafeer@gmail.com','phone'=>'9895310132','password' => Hash::make('123456'),'email_verified_at'=>now(),'avatar' => 'avatar-1.jpg','created_at' => now()]);
        $user2->assignRole('Administrator');
        // $user3=User::create(['name' => 'Shada Mariyam','email' => 'shada@gmail.com','phone'=>'9809373737','password' => Hash::make('123456'),'email_verified_at'=>now(),'avatar' => 'avatar-1.jpg','created_at' => now()]);
        // $user3->assignRole('Manager');

        $this->call([
            CategorySeeder::class,
            DivisionSeeder::class,
            ChapterSeeder::class,
            FormulationSeeder::class,
            TitleSeeder::class,
            MedicineSeeder::class,
            DiseaseSeeder::class,
            ProceedureSeeder::class,
        ]);

    }
}
