<?php

namespace App\Http\Controllers;

use App\Models\matchs;
use App\Models\team;
use App\Models\ticket;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\PDF;

class TicketController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $match =matchs::find($id);
        $ticketsCount = auth()->user()->tickets()->where('match_id', $match->id)->count();

        if ($ticketsCount !== 0) {
            // return redirect()->back();
            abort(401);
        }else{
            
            return view('book')->with('match', $match);
        }


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {

        $door = fake()->bothify('?-##');
        $serialCode = fake()->numerify('##########');
        $rank = fake()->randomLetter();
        $seat = fake()->numberBetween(1, 50);
        $QR_code = fake()->url();
        $price =$request->price;
        $final_price = 0;
       if($request->category == "1") {

              $final_price = $price;
            }elseif($request->category == "2"){
                $final_price = $price * 1.5;
            }elseif($request->category == "3"){
                $final_price = $price * 2;
            }elseif($request->category == "VIP"){
                $final_price = $price * 3;
            }



        $this->validate($request,[
            'name' => 'required|string|max:255',
            'category' => 'required|in:1,2,3,VIP',
            'card_number' => 'required',
            'card_type' => 'required|in:Visa,MasterCard,RuPay',
            'exp_date' => 'required|after_or_equal:today',
            'cvv' => 'required|numeric|digits:3',

        ]);
        $match =matchs::find($request->match_id);
        $match->ticketsNumber = $match->ticketsNumber-1;
        if ($match->ticketsNumber == 0) {
            $match->isTicket = false;
        }
        $match->update();

        $ticket=ticket::create([
            'name'=>$request->name,
            'category'=>$request->category,
            'serial_code'=> $serialCode,
            'QR_code'=> $QR_code,
            'door'=> $door,
            'rank'=> $rank,
            'seat'=> $seat,
            'price' =>$final_price,
            'match_id'=>$request->match_id,
            'user_id'=>auth()->user()->id,

        ]);
        
        return redirect()->route('ticket', ['ticket' => $ticket]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
       $user = Auth()->user();
       $tickets = $user->tickets()->get();
    //    dd($tickets);
    return view('myticket')->with('tickets', $tickets);



    }

    /**
     * Display the specified resource.
     */
    public function show(ticket $ticket)
    {
        return view('ticket')->with('ticket', $ticket);
    }
    public function pdf($id)
    {
        // Get the ticket data from the database
        $ticket = ticket::find($id);

        // Instantiate a new Dompdf instance
        $dompdf = new Dompdf();

        // Generate the PDF content
        $html = view('pdf', compact('ticket'))->render();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Generate the response with the PDF content
        $response = response($dompdf->output());

        $response->header('Content-Type', 'application/pdf');


        // Set the headers to force a download
        $response->header('Content-Type', 'application/pdf');
        $response->header('Content-Disposition', 'attachment;filename='.$ticket->name.'.pdf');

        return $response;
        // return view('pdf')->with('ticket', $ticket);
    }

}
