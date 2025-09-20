<?php

namespace App\Services;

use App\Models\Supplement;
use Illuminate\Database\Eloquent\Builder;

class SupplementReadService
{
    /**
     * Compute average rating for a supplement.
     */
    public function calculateAverageRating(Supplement $supplement): float
    {
        $reviews = $supplement->getReviews();
        if ($reviews->isEmpty()) {
            return 0.0;
        }

        $total = $reviews->sum('rating');

        return round($total / $reviews->count(), 2);
    }

    /**
     * Add average rating and sort by it (desc) on a query.
     */
    public function applySortByRating(Builder $query): Builder
    {
        return $query->withAvg('reviews', 'rating')
            ->orderBy('reviews_avg_rating', 'desc');
    }
}
