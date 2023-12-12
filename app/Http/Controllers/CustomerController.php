<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Models\User;
use App\Models\Customer;
use App\Models\CustomerRecord;
use App\Models\Titolo;
use App\Models\Carica;
use App\Models\Categoria;
use App\Models\Sezione;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BaseController as BaseController;
use App\Exports\Export;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class CustomerController extends Controller
{

    public function getAll(Request $request)
    {

        return response()->json([
            'data' => Customer::skip($request->get('first'))->take($request->get('rows'))->get(),
            'totalRecords' =>  Customer::count()
        ], 200);
    }


    private function applyFilters(Request $request) {
        $customers = Customer::query();
        $params = $request->get('params');

        $keys = [
            "Anno_iscrizione",
            "Data_ultimo_pagamento",
            "Id_Titolo",
            "id_Carica",
            "Nominativo",
            "Cognome",
            "Presso",
            "Indirizzo",
            "CAP",
            "Città",
            "PR",
            "Telefono",
            "Cellulare",
            "Email",
            "id_categoria",
            "id_sezioni",
            "socio",
        ];

        foreach ($keys as $key) {
            if (isset($params[$key]) && !empty($params[$key]))
                $customers->whereRaw('UPPER(' . $key . ') LIKE ? ', [trim(strtoupper($params[$key])) . '%']);
        }
        return $customers;
    }

    public function get($id)
    {
        $customer = Customer::where('id', $id)->get();

        return response()->json([
            'data' => $customer
        ], 200);
    }


    public function update(Request $request, $id)
    {
        $body = json_decode($request->getContent(), true);
        if( $id > 0)
            $customer = Customer::find($id);
        else
            $customer = new Customer();

        if (empty($customer)) {
            return "No customer found with id: " . $id;
        }
        
        $customer->fill($body);
        $customer->save();
        return $customer; 
    }

    public function delete($id)
    {
        Customer::where('id', $id)->delete();
        return response()->json(['message' => 'Row deleted successfully']);
    }


    public function excel(Request $request)
    {
        $customers = $this->applyFilters($request);
        $filename =  'Esportazione.xlsx';
        $path = 'uploads/release/' . $filename;

        Excel::store(new Export($customers->get()), $path, 'real_public');
        $pathToFile = asset($path);
        return response()->json(['pathToFile' => $pathToFile]);
    }

    public function pdf(Request $request)     {
        $customers = $this->applyFilters($request);
        $filename =  'Esportazione.pdf';
        $path = 'uploads/release/' . $filename;

        //Excel::store(new Export($customers->get()), $path, 'real_public');
        Excel::store(new Export($customers->get()), $path,'real_public', \Maatwebsite\Excel\Excel::DOMPDF);
        $pathToFile = asset($path);
        return response()->json(['pathToFile' => $pathToFile]);
    }
    
}
