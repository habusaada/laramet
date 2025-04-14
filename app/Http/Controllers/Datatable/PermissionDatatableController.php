<?php

namespace App\Http\Controllers\Datatable;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

class PermissionDatatableController extends Controller
{
    // Default columns to be used
    protected $columnsDefault = [
        'id'                     => true,
        'name'                   => true,
        'created_at'             => true,
    ];

    public function __construct()
    {
        // Set headers for the API response
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers: *');
    }

    public function index(Request $request)
    {
        // Handle custom columns definition
        $columnsDefault = $this->columnsDefault;
        if ($request->has('columnsDef') && is_array($request->columnsDef)) {
            foreach ($request->columnsDef as $field) {
                $columnsDefault[$field] = true;
            }
        }

        // Get all raw data
        $alldata = $this->getJsonDecode();

        // return $alldata;
        // Filter columns based on $columnsDefault
        $data = array_map(function ($d) use ($columnsDefault) {
            // Filter the main object
            $filtered = $this->filterArray($d, $columnsDefault);
            return $filtered;
        }, $alldata);

        // return $data;

        // Filter by general search keyword
        if ($request->has('search') && $request->search['value']) {
            $data = $this->arraySearch($data, $request->search['value']);
        }

        // Count data
        $totalRecords = $totalDisplay = count($data);

        // Sorting
        if ($request->has('order') && isset($request->order[0]['column']) && isset($request->order[0]['dir'])) {
            $column = $request->order[0]['column'];
            $dir = $request->order[0]['dir'];
            usort($data, function ($a, $b) use ($column, $dir) {
                $a = array_slice($a, $column, 1);
                $b = array_slice($b, $column, 1);
                $a = array_pop($a);
                $b = array_pop($b);

                if ($dir === 'asc') {
                    return $a > $b ? 1 : -1;
                }

                return $a < $b ? 1 : -1;
            });
        }

        // Pagination length
        if ($request->has('length')) {
            $data = array_slice($data, $request->start, $request->length);
        }

        $data = $this->reformat($data);

        // Return JSON response
        return response()->json([
            'recordsTotal'    => $totalRecords,
            'recordsFiltered' => $totalDisplay,
            'data'            => $data,
        ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    }

    // Helper functions
    protected function filterArray($array, $allowed = [])
    {
        return array_filter(
            $array,
            function ($val, $key) use ($allowed) {
                return isset($allowed[$key]) && ($allowed[$key] === true || $allowed[$key] === $val);
            },
            ARRAY_FILTER_USE_BOTH
        );
    }

    protected function getJsonDecode()
    {
        $user = Auth::user(); // Get the authenticated user

        if (!$user || !$user->profile || !$user->profile->user_id) {
            return []; // Return an empty array if no valid region_id is found
        }

        // Get JSON data (assuming it's stored in a file)
        // return json_decode(File::get(storage_path('app/customers.json')), true);
        $data = Permission::select(array_keys($this->columnsDefault))->get();
        // return response()->json($data);
        return json_decode($data, true);
    }

    protected function arraySearch($array, $keyword)
    {
        return array_filter($array, function ($a) use ($keyword) {
            return (boolean) preg_grep("/$keyword/i", (array) $a);
        });
    }

    protected function reformat($data)
    {
        return array_map(function ($item) {


            $item['created_at'] = date('d M Y, g:i a', strtotime($item['created_at']));

            return $item;
        }, $data);
    }
}
