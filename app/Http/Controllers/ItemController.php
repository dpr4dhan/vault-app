<?php

namespace App\Http\Controllers;

use App\Enum\ItemType;
use App\Http\Requests\StoreItemRequest;
use App\Http\Services\ItemService;
use App\Models\Item;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ItemController extends Controller
{
    public function __construct(
        protected readonly ItemService $itemService,
        protected readonly Item $model
    ){}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = $this->model->latest()->get();
        return view('items.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $itemTypes = ItemType::cases();
        return view('items.create', compact('itemTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreItemRequest $request)
    {
       $result = $this->itemService->store($request);
       if($result){
           // Display a success toast with no title
           return redirect()->route('items.index')->with('success', 'Item created successfully !');
       }

       return back()->withInput()->with('error', 'Item could not be created !');
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        //
    }

    /**
     * generates and returns password
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function passwordGenerator(Request $request): JsonResponse
    {
        $length = $request->get('length');
        $letters = $request->get('letter');
        $numbers = $request->get('number');
        $symbols = $request->get('character');

        return response()->json([
            'status' => true,
            'password' => Str::password(length: $length, letters: $letters, numbers: $numbers, symbols: $symbols)
        ]);
    }

    /**
     * checks if password has been leaked
     * @param Request $request
     * @return JsonResponse
     * @throws \Illuminate\Http\Client\ConnectionException
     * @throws \JsonException
     */
    public function leakPasswordCheck(Request $request): JsonResponse
    {
        $request->validate([
            'password' => 'required|string'
        ]);

        $response = Http::withHeaders([
                                'X-RapidAPI-Host' => 'leaked-password-checker.p.rapidapi.com',
                                'X-RapidAPI-Key' => env('RAPID_API_KEY'),
                                'password' => 'password',
                            ])
                            ->get('https://leaked-password-checker.p.rapidapi.com/api/v1/check_if_pw_leaked',
                                ['password' => $request->get('password')]);
        if($response->successful()) {
            $resData = json_decode($response->body(), TRUE, 512, JSON_THROW_ON_ERROR);
            return response()->json([
                                    'status' => true,
                                    'leaked' => $resData['leaked']
                                    ]);
        }

        return response()->json([
            'status' => false,
            'leaked' => null
        ]);
    }
}
