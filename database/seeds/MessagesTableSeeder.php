<?php

use Illuminate\Database\Seeder;

class MessagesTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('messages')->truncate();
    $messages = [
      ['project_id' => 1,
       'message' => 'project1 user1',
       'user_id' => 1
      ],
      ['project_id' => 1,
       'message' => 'project1 user2',
       'user_id' => 2
      ],
      ['project_id' => 1,
       'message' => 'project1 user3',
       'user_id' => 3
      ],
      ['project_id' => 1,
       'message' => 'project1 user4',
       'user_id' => 4
      ],
      ['project_id' => 1,
       'message' => 'project11 user2',
       'user_id' => 2
      ],
      ['project_id' => 2,
       'message' => 'project2 user1',
       'user_id' => 1
      ],
      ['project_id' => 2,
       'message' => 'project2 user2',
       'user_id' => 2
      ],
      ['project_id' => 2,
       'message' => 'project2 user3',
       'user_id' => 3
      ],
      ['project_id' => 2,
       'message' => 'project2 user4',
       'user_id' => 4
      ],
      ['project_id' => 2,
       'message' => 'project22 user2',
       'user_id' => 2
      ],
      ['project_id' => 3,
       'message' => 'project3 user1',
       'user_id' => 1
      ],
      ['project_id' => 3,
       'message' => 'project3 user2',
       'user_id' => 2
      ],
      ['project_id' => 3,
       'message' => 'project3 user3',
       'user_id' => 3
      ],
      ['project_id' => 3,
       'message' => 'project3 user4',
       'user_id' => 4
      ],
      ['project_id' => 3,
       'message' => 'project33 user2',
       'user_id' => 2
      ],
      ['project_id' => 4,
       'message' => 'project4 user2',
       'user_id' => 2
      ]
    ];
    
    foreach($messages as $message) {
      \App\Message::create($message);
    }
  }
}
