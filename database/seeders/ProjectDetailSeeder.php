<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Generator as FakerG;
use Faker\Factory as Faker;
use App\Models\Project as Project;
use App\Models\ProjectDetail;

class ProjectDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        $project = Project::all();

        $team = ['A', 'B', 'C', 'D', 'E'];
        $work_name = ['Buat Plafon', 'Buat Kitchen Set', 'Buat Lemari', 'Buat Rak Buku', 'Buat Wallmolding'];

        foreach ($project as $key => $value) {

            $projectdetail = new ProjectDetail;
            $projectdetail->project_id = $value->id; 
            $projectdetail->work_name = $work_name[rand(0, 4)]; 
            $projectdetail->image = "";
            $projectdetail->description = $faker->Text();
            $projectdetail->work_start= $faker->dateTimeBetween('-1 week', '+1 week');
            $projectdetail->work_end = $faker->dateTimeBetween('-1 week', '+1 week');
            $projectdetail->estimation = $faker->numberBetween(1,5);
            $projectdetail->team = $team[rand(0, 4)]; 
            $projectdetail->save();

        }
    }
}
