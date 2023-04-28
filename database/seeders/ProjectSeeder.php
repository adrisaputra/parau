<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Generator as FakerG;
use Faker\Factory as Faker;
use App\Models\Project as Project;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        for ($i = 0; $i <= 9; $i++) {
            $project = new Project;

            $project->project_name =  $faker->numerify('project-####');
            $project->client_name = $faker->name();
            $project->phone = $faker->PhoneNumber();
            $project->address = $faker->Address();
            $project->outlet_id = rand(1, 2);
            $project->save();
        }
    }
}
