<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Note;
use Illuminate\Support\Str;


class NoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        for($i= 0; $i < 20; $i++) {
            Note::create([
                'title' => 'Nota ' . ($i+1),
                'content' => Str::random(56),
            ]);
        }
    }
}
