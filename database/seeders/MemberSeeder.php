<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Member as Member;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        Member::create([
            "member_name"   => "UMUM",
            "phone" => "-",
            "address"   => "-",
            "description"   => "-",
        ]);

        for ($i = 1; $i <= 14; $i++) {
            $new_member = new Member();

            $new_member->member_name = $faker->Name();
            $new_member->phone = $faker->PhoneNumber();
            $new_member->address = $faker->Address();
            $new_member->description = $faker->Text();
            $new_member->save();
        }
    }
}
