<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubscriberRequest;
use App\Models\Subscriber;

class SubscriberController extends Controller
{
    protected $subscriber;

    public function __construct(Subscriber $subscriber)
    {
        $this->subscriber = $subscriber;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubscriberRequest $request)
    {
        try {
            $subscriber = $this->subscriber->firstOrCreate(['email' => $request->email]);

            if ($subscriber->wasRecentlyCreated){
                return response()->json(['success' => 'Você está inscrito para nossas mensagens semanais!'], 200);
            }

            return response()->json(['warning' => 'E-mail já existe']);
        }catch (\Exception $e){
            return response()->json(['error' => $e->getMessage()]);
        }

    }
}
