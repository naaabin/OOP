<?php

namespace App\Http\Controllers;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PaginationController extends Controller
{
    public function displayPagination($modelName, $totalRows, $dataPerPage = 2)
    {
        try {
            // Resolve the model instance
            $model = app()->make("App\\Models\\{$modelName}");

            $totalPages = ceil($totalRows / $dataPerPage);
            $page = request('page', 1); // Get the 'page' query parameter, default to 1 if not present

            if ($page > $totalPages || $page < 1) 
            {
                echo'<div style="text-align: center; color: red; font-weight: bold; font-size : 40px; " >';
                echo "No records for the selected page, please enter a valid page number";
                echo'</div>'; 
            }

            // Calculate the offset for the database query
            $offset = ($page - 1) * $dataPerPage;

            // Retrieve the data items for the current page
            
            $data = $model::offset($offset)->limit($dataPerPage)->get();

            $html = ''; // Initialize the HTML string for the pagination links

            // Generate the 'Previous' link if not on the first page
            $prevPage = $page - 1;
            if ($prevPage > 0) 
            {
                $html .= '<a href="' . url()->current() . '?page=' . $prevPage . '"> Previous </a>';
            }

            // Generate links for all pages
            for ($i = 1; $i <= $totalPages; $i++) 
            {
                $html .= '<a href="' . url()->current() . '?page=' . $i . '" style="margin-right: 10px;">' . $i . '</a>';

            }

            // Generate the 'Next' link if not on the last page
            $nextPage = $page + 1;
            if ($nextPage <= $totalPages) 
            {
                $html .= '<a href="' . url()->current() . '?page=' . $nextPage . '"> Next </a>';
            }

            // Return the HTML string of pagination links and the data items for the current page
            return ['pagination' => $html, 'data' => $data];
        } 
        catch (ModelNotFoundException $e) 
        {
            // Handle the error
            echo "The model {$modelName} does not exist";
        }
    }
}
