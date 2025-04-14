<?php

namespace App\Http\Controllers\Datatable;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDatatableController extends Controller
{
    // Default columns to be used
    protected $columnsDefault = [
        'id'                     => true,
        'name'                  => true,
        'email'                 => true,
        'created_at'                 => true,
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
        // Filter columns based on $columnsDefault
        $data = array_map(function ($d) use ($columnsDefault) {
            // Filter the main object
            $filtered = $this->filterArray($d, $columnsDefault);

            // Include the 'region' relation if it exists
            if (isset($d['profile'])) {
                $filtered['profile_id'] = $d['profile']['profile_id']?? 'N/A';
                $filtered['is_verified'] = $d['profile']['verified']?? 'N/A';
                $filtered['is_active'] = $d['profile']['is_active']?? 'N/A';
                $filtered['status'] = $d['profile']['status']?? 'N/A';
            }


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

        $data = User::with('profile')->get();
        // return response()->json($data);
        return json_decode($data, true);
    }

    protected function arraySearch($items, $keyword)
    {
        // Safely escape the keyword for regex
        $escapedKeyword = preg_quote($keyword, '/');

        // Filter each item
        return array_filter($items, function ($item) use ($escapedKeyword) {
            // Flatten the item (it may contain nested arrays/objects)
            $flattened = $this->flattenToScalars($item);

            // Use regex to see if the keyword matches anywhere in the flattened array
            return (bool) preg_grep("/{$escapedKeyword}/i", $flattened);
        });
    }

/**
 * Recursively traverse an array/object to collect *only* scalar values.
 * Returns an array of strings that can be safely searched with regex.
 */
protected function flattenToScalars($data)
{
    $result = [];

    // Define a recursive closure
    $recurse = function ($value) use (&$result, &$recurse) {
        if (is_array($value)) {
            // If it's an array, iterate
            foreach ($value as $v) {
                $recurse($v);
            }
        } elseif (is_object($value)) {
            // If it's an object (like a stdClass), convert to array and recurse
            $recurse((array) $value);
        } elseif (is_scalar($value)) {
            // If scalar (string, int, bool, float), cast to string and store
            $result[] = (string) $value;
        }
    };

    // Start recursion
    $recurse($data);

    return $result;
}



    protected function reformat($data)
    {
        return array_map(function ($item) {


            $item['created_at'] = date('d M Y, g:i a', strtotime($item['created_at']));
            // $item['is_active'] = ($item['is_active'] == 1) ? 'Active' : 'Deactive';
            return $item;
        }, $data);
    }
}
