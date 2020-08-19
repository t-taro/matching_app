<?php

use Illuminate\Database\Seeder;

class ProjectsTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('projects')->truncate();
    $projects = [
      ['organizer_id' => 1,
       'place' => '石神井体育館',
       'min_member' => 2,
       'level' => 1,
       'open_at' => new DateTime('2020-08-20 10:00')
      ],
      ['organizer_id' => 2,
       'place' => '関町北小学校',
       'min_member' => 6,
       'level' => 2,
       'open_at' => new DateTime('2020-08-20 11:00')
      ],
      ['organizer_id' => 3,
       'place' => '上石神井体育館',
       'min_member' => 4,
       'level' => 3,
       'open_at' => new DateTime('2020-08-21 13:00')
      ],
      ['organizer_id' => 1,
       'place' => '田無小学校',
       'min_member' => 4,
       'level' => 3,
       'open_at' => new DateTime('2020-08-25 16:00')
      ],
      ['organizer_id' => 1,
       'place' => '練馬体育館',
       'min_member' => 5,
       'level' => 3,
       'open_at' => new DateTime('2020-08-25 17:00')
      ],
      ['organizer_id' => 2,
       'place' => '関町南小学校',
       'min_member' => 4,
       'level' => 1,
       'open_at' => new DateTime('2020-08-29 18:00')
      ],
      ['organizer_id' => 3,
       'place' => '関町東小学校',
       'min_member' => 7,
       'level' => 2,
       'open_at' => new DateTime('2020-08-23 15:00')
      ],
      ['organizer_id' => 1,
       'place' => '関町西小学校',
       'min_member' => 9,
       'level' => 1,
       'open_at' => new DateTime('2020-08-25 17:00')
      ],
    ];
    
    foreach($projects as $project) {
      \App\Project::create($project);
    }
  }
}
