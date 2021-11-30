<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\User\UpdatePasswordAPIRequest;
use App\Http\Requests\API\User\UpdateProfileAPIRequest;
use App\Transformers\UserTransformer;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use League\Fractal\Manager;
use League\Fractal\Resource\Item;
use League\Fractal\Serializer\DataArraySerializer;

/**
 * Class UserController
 * @package App\Http\Controllers\API
 */
class UserAPIController extends Controller
{
    /**
     * GET api/profile
     *
     * @return JsonResponse
     */
    public function profile(): JsonResponse
    {
        $user = Auth::user();

        $manager = new Manager();
        $manager->setSerializer(new DataArraySerializer());
        $resource = new Item($user, new UserTransformer());

        return $this->sendResponse($manager->createData($resource)->toArray());
    }

    /**
     * Update the specified User in storage.
     * PUT/PATCH api/profile
     *
     * @param UpdateProfileAPIRequest $request
     * @return JsonResponse
     */
    public function profileUpdate(UpdateProfileAPIRequest $request): JsonResponse
    {
        $user = $request->user();
        $requestSanitized = $request->validated();
        $user->update($requestSanitized);

        $manager = new Manager();
        $manager->setSerializer(new DataArraySerializer());
        $resource = new Item($user, new UserTransformer());

        return $this->sendResponse($manager->createData($resource)->toArray());
    }

    /**
     * Update the specified User in storage.
     * PUT/PATCH api/profile/password
     *
     * @param UpdatePasswordAPIRequest $request
     * @return JsonResponse
     */
    public function passwordUpdate(UpdatePasswordAPIRequest $request): JsonResponse
    {
        $user = $request->user();
        $requestSanitized = $request->validated();
        $user->update($requestSanitized);

        $manager = new Manager();
        $manager->setSerializer(new DataArraySerializer());
        $resource = new Item($user, new UserTransformer());

        return $this->sendResponse($manager->createData($resource)->toArray());
    }
}
