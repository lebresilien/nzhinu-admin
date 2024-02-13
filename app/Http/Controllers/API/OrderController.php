<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\OrderRepository;
use App\Repositories\UserRepository;
use App\Http\Requests\CreateOrderRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderMailer;
use Illuminate\Support\Facades\DB;
use App;

class OrderController extends Controller
{
    /** @var OrderRepository */
    private $orderRepository;
    private $userRepository;

    public function __construct(OrderRepository $orderRepository, UserRepository $userRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateOrderRequest $request)
    {
        $input = $request->all();

        $user = $this->userRepository->searchByEmail($input['email']);
        
        App::setLocale($input['lang']);

        $data = DB::transaction(function () use ($user, $input) {
            if(!$user) {
                $user = $this->userRepository->create([
                    'name' => $input['name'],
                    'surname' => $input['surname'],
                    'email' => $input['email'],
                    'password' => '123456780',
                    'phone' => $input['phone'],
                    'city' => $input['city'],
                    'address' => $input['address'],
                ]);
            }
            
            $order = $this->orderRepository->create([
                'price' => $input['price'],
                'user_id' => $user->id
            ])->products()->attach($input['products']);

            Mail::to($input['email'])->send(new OrderMailer($input));

            return $order;
        });

        return response()->json($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
