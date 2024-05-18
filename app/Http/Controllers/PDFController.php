<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Dompdf\Dompdf;
use Dompdf\Options;

class PDFController extends Controller
{
    public function generatePDF()
    {
        // Fetch your table data here
        $users = User::all(); // Example: Fetching all users

        // HTML content for the PDF
        $html = '
            <style>
                body {
                    font-family: Arial, sans-serif;
                }
                table {
                    border-collapse: collapse;
                    width: 100%;
                }
                th, td {
                    border: 1px solid #ddd;
                    padding: 8px;
                    text-align: left;
                }
            </style>
            <h1>Users List</h1>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>';
        foreach ($users as $user) {
            $html .= '<tr><td>'.$user->name.'</td><td>'.$user->email.'</td></tr>';
        }
        $html .= '</tbody></table>';

        // Create PDF
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);

        // (Optional) Set paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render PDF
        $dompdf->render();

        // Output the generated PDF
        return $dompdf->stream('users_list.pdf');
    }
}
