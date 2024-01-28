<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SeriesCreated extends Mailable
{
    use Queueable, SerializesModels;
    public $serieName;
    public $qtdSeason;
    public $id;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($serieName, $qtdSeason, $id)
    {   
        $this->qtdSeason = $qtdSeason;
        $this->serieName = $serieName;
        $this->id = $id;
        $this->subject = "Nova Série criada: {$serieName}";

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.series-created')
                    ->with([
                        'serieName' => $this->serieName,
                        'qtdSeason' => $this->qtdSeason,
                        'id' => $this->id,
                    ]);
    }
}
