<?php

namespace App\Http\Controllers;

use App\Events\MyEvent;
use App\Events\TicketEvent;
use App\Jobs\SecondJobs;
use App\Jobs\TestJob;
use App\Listeners\SendDelegatePassword;
use App\Mail\SendTestMail;
use App\Models\Admin;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Mail;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     */


     public function index()
     {
         dd(auth()->user()->userable_id);

        // $user = $admin->user()->create([
        //     'name' => 'Admin User',
        //     'email' => 'admin@example.com',
        //     'password' => bcrypt('password'),
        // ]);
        //   event(new MyEvent('welcom event'));
        // $tikets = Ticket::with('ticketable')->get();
        // event(new TicketEvent($tikets));

        return view('welcome');
     }

     public function test()
     {
           TestJob::dispatch();
           return "job test done";
     }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
