<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tasks;

class TaskController extends Controller
{
    public function addtask(Request $request)
    {
        $user = $request->user();
        Tasks::create([
            'user_id' => $user->id,
            'title' => $request->title,
            'description' => $request->description,
            'deadline' => $request->deadline
        ]);

        return [
            'seccessful' => true
        ];
    }


    public function gettask(Request $request)
    {
        return tasks::where('user_id', $request->user()->id)->select('id', 'title', 'description', 'deadline', 'active')->get();
    }

    public function updatetask(Request $request, Tasks $task)
    {
        return $task;
    }

    public function deletetask(Request $request, Tasks $task)
    {
        return Tasks::where('id', '=', $task)->UPDATE(['active' => 1]);
    }

}



//UPDATE `users` SET `name` = 'Radikk', `email` = 'radik.official@gmail.com', `email_verified_at` = NULL, `password` = '321' WHERE `users`.`id` = 1;

