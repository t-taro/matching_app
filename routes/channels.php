<?php

use Illuminate\Support\Facades\Broadcast;
use App\Project;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

// Broadcast::channel('notification-channel.{organizer_id}', function ($user, $organizer_id) {
//   return (int) $user->id === (int) $organizer_id;

Broadcast::channel('notification-channel.{project_id}', function ($user, $project_id) {
  $project = Project::findOrFail($project_id);

  $organizer = $project->organizer_id;
  $entryUsers = $project->users()->get();
  
  if ((int) $user->id === (int) $organizer) {
    return ['id' => $user->id, 'name' => $user->name];
  } else {
    foreach ($entryUsers as $entryUser) {
      if ((int) $user->id === (int) $entryUser->id) {
        return ['id' => $entryUser->id, 'name' => $entryUser->name];
      }
    };
  };
});
