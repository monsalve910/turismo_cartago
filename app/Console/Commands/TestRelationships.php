<?php

namespace App\Console\Commands;

use App\Models\Tour;
use Illuminate\Console\Command;

class TestRelationships extends Command
{
    protected $signature = 'test:relationships';

    protected $description = 'Test Eloquent relationships';

    public function handle()
    {
        $tour = Tour::with('comentarios.user')->find(3);

        if (! $tour) {
            $this->error('Tour not found');

            return;
        }

        $this->info('Tour: '.$tour->nombre);
        $this->info('Comments count: '.$tour->comentarios->count());

        foreach ($tour->comentarios as $comment) {
            $this->line('Comment: '.$comment->comentario);
            $this->line('User: '.($comment->user ? $comment->user->name : 'No user'));
            $this->line('Rating: '.$comment->calificacion);
            $this->line('---');
        }
    }
}
