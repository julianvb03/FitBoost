<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateReviewRequest;
use App\Http\Requests\UpdateReviewRequest;
use App\Models\Review;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function __construct() {}

    public function store(CreateReviewRequest $request): RedirectResponse
    {
        $review = new Review;
        $review->setRating($request->input('rating'));
        $review->setComment($request->input('comment'));
        $review->setUserId(Auth::user()->getId());
        $review->setSupplementId($request->input('supplement_id'));
        $review->setStatus(true);
        $review->save();

        $viewData = [];
        $viewData['success'] = trans('user/review.success_store_review');

        return redirect()->back()->with('viewData', $viewData);
    }

    public function update(int $id, UpdateReviewRequest $request): RedirectResponse
    {
        $review = Review::find($id);
        $viewData = [];

        if (! $review) {
            $viewData['error'] = trans('user/review.error_review_not_found');

            return redirect()->back()->with('viewData', $viewData);
        }

        if ($review->getUserId() !== Auth::user()->getId()) {
            return redirect()->back()->with('error', trans('auth.unauthorized'));
        }

        if ($request->input('rating')) {
            $review->setRating($request->input('rating'));
        }

        if ($request->input('comment')) {
            $review->setComment($request->input('comment'));
        }

        $review->save();
        $viewData['success'] = trans('user/review.success_update_review');

        return redirect()->back()->with('viewData', $viewData);
    }

    public function delete(int $id): RedirectResponse
    {
        $review = Review::find($id);
        $viewData = [];

        if (! $review) {
            $viewData['error'] = trans('user/review.error_review_not_found');

            return redirect()->back()->with('viewData', $viewData);
        }

        if ($review->getUserId() !== Auth::user()->getId()) {
            $viewData['error'] = trans('auth.unauthorized');

            return redirect()->back()->with('viewData', $viewData);
        }

        $review->delete();
        $viewData['success'] = trans('user/review.success_delete_review');

        return redirect()->back()->with('viewData', $viewData);
    }

    public function report(int $id): RedirectResponse
    {
        $review = Review::find($id);
        $viewData = [];

        if (! $review) {
            $viewData['error'] = trans('user/review.error_review_not_found');

            return redirect()->back()->with('viewData', $viewData);
        }

        $review->setReported(true);
        $review->save();
        $viewData['success'] = trans('user/review.success_report_review');

        return redirect()->back()->with('viewData', $viewData);
    }
}
