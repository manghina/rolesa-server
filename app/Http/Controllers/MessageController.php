<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Message;

class MessageController extends Controller
{
    public function create(Request $request)
    {
        $data = $request->only(['msg', 'post']);
        $validator = Validator::make($data, [
            'msg' => [
                'required',
                'string'
            ],
            'post' => [
                'required',
                'string'
            ]
        ]);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->getMessageBag()
                    ->toArray()
            ], Response::HTTP_BAD_REQUEST);
        }        
        $record = Message::create([
            'msg' => $data['msg'],
            'post' => $data['post'],
            'author' => auth('api')->user()->id,
        ]);
        return response()->json($record, 200);
    }

    public function update(Request $request)
    {
        $data = $request->only(['id', 'msg']);
        $validator = Validator::make($data, [
            'msg' => [
                'required',
                'string'
            ]
        ]);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->getMessageBag()
                    ->toArray()
            ], Response::HTTP_BAD_REQUEST);
        }        
        $record = Message::find($data['id'])->get()[0];
        $record->fill($request->all());
        $record->save();
        return response()->json($record, 200);
    }

    public function all($id)
    {
        $records = Message::where('post', $id)->with(['user'])->get();
        return response()->json([
            'data' => $records
        ], 200);
    }

}