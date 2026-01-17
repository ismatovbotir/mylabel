<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PriceType;
use App\Models\Company;
use App\Models\Role;
use App\Models\Category;
use App\Models\User;
use App\Models\Channel;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
            $categories=[
                [
                    'name'=>'Scanner'
                ],
                [
                    'name'=>'Label Printer'
                ],
                [
                    'name'=>'Recept Printer'
                ],
                [
                    'name'=>'Rewinder'
                ],
                [
                    'name'=>'Label'
                ],
                [
                    'name'=>'Receipt Roll'
                ],
                [
                    'name'=>'Ribbon'
                ],
                [
                    'name'=>'Textile Label'
                ],
                [
                    'name'=>'Other'
                ]

            ];
            
            foreach($categories as $category){
                Category::upsert(
                    $category,
                    ["name"],
                    ["name"]
                );

            }
        
            $priceTypes=[
                [
                    'name'=>'Chakana'
                ],
                [
                    'name'=>'Ulgurji'
                ],
                [
                    'name'=>'Hamkor'
                ]

            ];
            
            foreach($priceTypes as $priceType){
                PriceType::upsert($priceType,["name"],["name"]);

            }

           





            Company::upsert(
                [
                    'name'=>'BDB Commerce',
                    'address'=>'Navnihol 7',
                    'mob'=>'+998951412040',
                    'stir'=>'309738079',
                    'main'=>1
                ],['stir'],['name','address','mob']
            );
            //dd($bdb);
            $roles=
            [
                ['name'=>'Admin'],
                ['name'=>'Owner'],
                ['name'=>'Accountant'],
                ['name'=>'Finance'],
                ['name'=>'Operator'],
                ['name'=>'Collector'],
                ['name'=>'Delivery'],
                ['name'=>'Partner'],
                ['name'=>'Reseller'],
                ['name'=>'Client']
            ];
            foreach($roles as $role){
                    Role::upsert($role,['name'],['name']);

            }

            $channels=
            [
                ['name'=>'olx'],
                ['name'=>'instagram'],
                ['name'=>'referral'],
                ['name'=>'facebook'],
                ['name'=>'youtube'],
                ['name'=>'telegram']
                
            ];
            foreach($channels as $channel){
                    Channel::upsert($channel,['name'],['name']);

            }
            $bdb=Company::first();
            User::upsert(
                [
                    "email"=>"info@pos.uz",
                    "name"=>"Admin",
                    "role_id"=>1,
                    "company_id"=>$bdb->id,
                    "password"=>Hash::make('123456789')
                ],
                [
                    "email"
                ],
                [
                    "password"=>Hash::make('123456789')
                ]
            
            );
            User::upsert(
                [
                    "email"=>"davron@gmail.com",
                    "name"=>"Davron",
                    "role_id"=>1,
                    "company_id"=>$bdb->id,
                    "password"=>Hash::make('123456789')
                ],
                [
                    "email"
                ],
                [
                    "password"=>Hash::make('123456789')
                ]
            
            );
            User::upsert(
                [
                    "email"=>"bdb.commerce.service@gmail.com",
                    "name"=>"Bobojon",
                    "role_id"=>1,
                    "company_id"=>$bdb->id,
                    "password"=>Hash::make('123456789')
                ],
                [
                    "email"
                ],
                [
                    "password"=>Hash::make('123456789')
                ]
            
            );
            User::upsert(
                [
                    "email"=>"finance@bdb.uz",
                    "name"=>"Accountant",
                    "role_id"=>3,
                    "company_id"=>$bdb->id,
                    "password"=>Hash::make('123456789')
                ],
                [
                    "email"
                ],
                [
                    "password"=>Hash::make('123456789')
                ]
            
            );
            

            




            //$orderStatus=OrderStatus::upsert();
           
    }
}
