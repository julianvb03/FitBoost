<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Models\Review;
use App\Models\Supplement;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;

final class SupplementTest extends TestCase
{
    public function test_get_average_rating_returns_zero_when_no_reviews(): void
    {
        $supplement = new Supplement;
        $supplement->setAttribute('id', 1);

        $reviews = new Collection;
        $supplement->setRelation('reviews', $reviews);

        $result = $supplement->getAverageRating();

        $this->assertEquals(0.0, $result);
    }

    public function test_get_average_rating_calculates_correctly(): void
    {
        $supplement = new Supplement;
        $supplement->setAttribute('id', 1);

        $review1 = new Review;
        $review1->setRating(5);
        $review2 = new Review;
        $review2->setRating(4);
        $review3 = new Review;
        $review3->setRating(3);

        $reviews = new Collection([$review1, $review2, $review3]);
        $supplement->setRelation('reviews', $reviews);

        $result = $supplement->getAverageRating();

        $this->assertEquals(4.0, $result);
    }

    public function test_get_average_rating_rounds_to_two_decimals(): void
    {
        $supplement = new Supplement;
        $supplement->setAttribute('id', 1);

        $review1 = new Review;
        $review1->setRating(5);
        $review2 = new Review;
        $review2->setRating(4);
        $review3 = new Review;
        $review3->setRating(3);
        $review4 = new Review;
        $review4->setRating(2);

        $reviews = new Collection([$review1, $review2, $review3, $review4]);
        $supplement->setRelation('reviews', $reviews);

        $result = $supplement->getAverageRating();

        $this->assertEquals(3.5, $result);
        $this->assertIsFloat($result);
    }
}
