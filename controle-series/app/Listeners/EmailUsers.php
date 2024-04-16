<?php

namespace App\Listeners;

use App\Events\SeriesCreated as EventsSeriesCreated;
use App\Mail\SeriesCreated;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class EmailUsers implements shouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(EventsSeriesCreated $event)
    {
        $users = User::all();
        foreach ($users as $key => $User) {
          $mail = new SeriesCreated($event->name, $event->seasons, $event->id);
          //É possível enviar emails pelo laravel, configurações de smtp pelo .env
          //ao invés de usar send, utilizei queue para adicionar a uma fila. Mudar no env a 
          //variavel de ambiente para setar como assincrono o processo
          $when = now()->addSeconds($key * 2);
          Mail::to($User)->later($when, $mail);     
        }
    }
}
