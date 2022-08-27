<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Question;


class QuestionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $questions = [
            [
                'en' => 'happy',
                'sr' => 'srecan'
            ],
            [
                'en' => 'nice',
                'sr' => 'lijepo'
            ],
            [
                'en' => 'friend',
                'sr' => 'prijatelju'
            ],
            [
                'en' => 'explosion',
                'sr' => 'eksplozija'
            ],
            [
                'en' => 'carrot',
                'sr' => 'sargarepa'
            ],
            [
                'en' => 'car',
                'sr' => 'auto'
            ],
            [
                'en' => 'soldier',
                'sr' => 'vojnik'
            ],
            [
                'en' => 'fear',
                'sr' => 'strah'
            ],
            [
                'en' => 'relativity',
                'sr' => 'relativnost'
            ],
            [
                'en' => 'book',
                'sr' => 'knjiga'
            ],
            [
                'en' => 'earth',
                'sr' => 'zemlja'
            ],
            [
                'en' => 'speed limit',
                'sr' => 'ogranicenje brzine'
            ]
        ];

        foreach ($questions as $question){
            Question::create([
                'en' => $question['en'],
                'sr' => $question['sr']
            ]);
        }
    }
}
