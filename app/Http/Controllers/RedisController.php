<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\StoreRequest;
use App\Http\Requests\UpdateRequest;
use Illuminate\Support\Collection;


class RedisController extends Controller
{
    public function index()
    {
        // Retrieve all records from Redis
        $rows = Redis::hvals('employee_data');

        $row = array_map('json_decode', $rows);

        $record = new Collection($row);

        $records = $record->sortBy('id');

        return view('index', compact('records'));
    }
    
    public function create()
    {
        return view('create');
    }
    
    public function store(StoreRequest $request)
    {
        // creates new id of employees
        $id = Redis::incr('employee_id');
        $data = [
            'id' => $id,
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'place' => $request->input('place'),
        ];

        Redis::hset('employee_data', $id, json_encode($data));

        return redirect('/');
    }

    public function show($id)
    {
        //get the information of employee
        $record = Redis::hget('employee_data', $id);
        $record = json_decode($record);

        return view('show', compact('record'));
    }

    public function edit($id)
    {
        $record=Redis::hget('employee_data', $id);
        $record=json_decode($record); 

        return view('edit',compact('record'));
    }

    public function update(UpdateRequest $request, $id)
    { 
        //update the information of the employee 
        $record = Redis::hget('employee_data', $id);
        $record = json_decode($record);

        $record->name = $request->input('name');
        $record->email = $request->input('email');
        $record->phone = $request->input('phone');
        $record->place = $request->input('place');

        Redis::hset('employee_data', $id, json_encode($record));

        return redirect('/');
    }

    public function delete($id)
    {
        //delete the employee using id
        Redis::hdel('employee_data', $id);

        return redirect('/');
    }

}