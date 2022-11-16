<?php

namespace Modules\Reviews\Database\factories;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Modules\Reviews\Entities\Review;
use Modules\Reviews\Entities\ReviewMessage;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewContentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected  $model = \Modules\Reviews\Entities\ReviewContent::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $targetPassible = ['review' => Review::all()->random()->id, 'reviewMessage' => ReviewMessage::all()->random()->id];
                $target = $this->faker->randomKey($targetPassible);

        return [
            'url' => $this->faker->imageUrl(),
            'file' => 'upload/'.$this->faker->file('storage/img', 'storage/img/upload', false),
            'contentable_type' => $target,
            'contentable_id' =>$targetPassible[$target],
//            'review_id' => $this->faker->numberBetween(1, $reviews->count()),
        ];
    }
}

