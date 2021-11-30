<?php

namespace App\Transformers;

use App\Models\User;
use League\Fractal\TransformerAbstract;
use League\Fractal\Resource\Item;

/**
 * Class UserTransformerTransformer.
 *
 * @package namespace App\Transformers;
 */
class UserTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [
    ];

    protected $availableIncludes = [
    ];

    /**
     * Transform the User entity.
     *
     * @param User $model
     * @return array
     */
    public function transform(User $model): array
    {
        return [
            'id' => $model->id,
            'name' => $model->getName(),
            'email' => $model->getEmail(),
            'created_at' => $model->getCreatedAt(),
            'updated_at' => $model->getUpdatedAt(),
        ];
    }
}
