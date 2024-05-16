<?php
namespace App\Http\Services;

use App\Http\Requests\StoreItemRequest;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ItemService
{
    public function __construct(private readonly Item $model){}
    public function store(StoreItemRequest $request): Item | bool
    {
        try{
            $result = $this->model->create([
                'type' => $request->get('type'),
                'title' => $request->get('title'),
                'username' => $request->get('username'),
                'password' => $request->get('password'),
                'url' => $request->get('url'),
                'note' => $request->get('note'),
            ]);
            return $result;
        }catch(\Exception $ex){
           Log::error($ex->getMessage());
           return false;
        }

    }
}
