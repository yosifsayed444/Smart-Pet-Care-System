<?php

class Review
{
    use Model;

    protected $table = 'provider_reviews';

    protected $allowedColumns = [
        'provider_id',
        'user_id',
        'rating',
        'comment',
        'parent_id',
        'created_at'
    ];

    public function addReview($data)
    {
        return $this->insert($data);
    }

    public function viewReviews($provider_id)
    {
        
        $query = "SELECT r.*, u.username as user_name 
                  FROM provider_reviews r 
                  LEFT JOIN users u ON r.user_id = u.id 
                  WHERE provider_id = :provider_id 
                  ORDER BY created_at ASC";
        $all_reviews = $this->query($query, ['provider_id' => $provider_id]);
        
        return $this->buildReviewTree($all_reviews);
    }

    private function buildReviewTree($reviews, $parent_id = null)
    {
        $branch = [];
        if (!empty($reviews)) {
            foreach ($reviews as &$review) {
                if ($review['parent_id'] == $parent_id) {
                    $children = $this->buildReviewTree($reviews, $review['id']);
                    if ($children) {
                        $review['replies'] = $children;
                    } else {
                        $review['replies'] = [];
                    }
                    $branch[] = $review;
                }
            }
        }
        return $branch;
    }
}
