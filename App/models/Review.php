<?php

class Review
{
    use Model;

    protected $table = 'reviews';

    protected $allowedColumns = [
        'BookingID',
        'ReviewerID',
        'RevieweeID',
        'ReviewerRole',
        'Rating',
        'Comment',
        'CreatedAt'
    ];

    public function addReview($data)
    {
        return $this->insert($data);
    }

    public function getReviewsForUser($userId)
    {
        $query = "SELECT r.*, u.username as reviewer_name 
                  FROM reviews r
                  LEFT JOIN users u ON r.ReviewerID = u.id
                  WHERE r.RevieweeID = :user_id
                  ORDER BY r.CreatedAt DESC";
        return $this->query($query, ['user_id' => $userId]);
    }

    public function hasReviewed($bookingId, $reviewerId)
    {
        $query = "SELECT * FROM reviews WHERE BookingID = :booking_id AND ReviewerID = :reviewer_id";
        $res = $this->query($query, ['booking_id' => $bookingId, 'reviewer_id' => $reviewerId]);
        return !empty($res);
    }

    public function insertCommunityReview($data)
    {
        return $this->insert($data);
    }

    public function viewReviews($provider_id)
    {
        $query = "SELECT r.*, u.username as reviewer_name 
                  FROM reviews r 
                  LEFT JOIN users u ON r.ReviewerID = u.id 
                  WHERE r.RevieweeID = :provider_id 
                  ORDER BY r.CreatedAt ASC";
        return $this->query($query, ['provider_id' => $provider_id]);
    }
}
