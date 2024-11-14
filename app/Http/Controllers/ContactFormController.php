<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use DB; 


class ContactFormController extends Controller
{
    
    public function index(){
        $orderby = Request()->get('orderby', 'id');
            $order = Request()->get('order', 'asc');
            $search = Request()->get('search', '');
        
            $validColumns = ['id', 'title', 'type','review',  'status', 'created_at']; 
        
            // Ensure valid columns for ordering
            if (!in_array($orderby, $validColumns)) {
                $orderby = 'id';
            }
        
            if (!in_array($order, ['asc', 'desc'])) {
                $order = 'asc';
            }
        
            $query = DB::table('reviews');
    
        
            if ($search) {
                $query->where(function($q) use ($search, $validColumns) {
                    foreach ($validColumns as $column) {
                        $q->orWhere($column, 'like', '%' . $search . '%');
                    }
                });
            } 
            $query->where('type', 2);
            $lists = $query->orderBy($orderby, $order)
                ->paginate(config('admin.pagination'));
                 
            $component_content = DB::table('reviews')->where('type', 1)->first(); 
            return view('admin.widgets.reviews.index', compact('lists',  'search', 'component_content'));
    }
    
    public function updateDeleteToggleReview(Request $request, $id)
        { 
            // dd($request->all());
            $action = $request->input('action'); 
            
            if ($action === 'update') { 
                $data = [
                    'title' => $request->input('order_display_title'), 
                    'review' => $request->input('embaded_code'),
                ]; 
                DB::table('reviews')
                    ->where('id', $id)
                    ->update($data);
    
                return redirect()->back()->with('success', 'Item updated successfully');
            }
    
            if ($action === 'delete') {
                 
    
                DB::table('reviews')
                    ->where('id', $id)
                    ->delete();
    
                return redirect()->back()->with('success', 'Item deleted successfully');
            }
    
            if ($action === 'toggle') {
                $currentStatus = DB::table('reviews')
                    ->where('id', $id)
                    ->value('status');
                // $newStatus = ($currentStatus === 'Active') ? 'Inactive' : 'Active'; 
                
                DB::table('reviews')
                    ->where('id', $id)
                    ->update(['status' => !$currentStatus]);
    
                return redirect()->back()->with('success', 'Status updated successfully');
            }
    
            return redirect()->back()->with('error', 'Invalid action');
        }
        
        
        //  insert data
        public function storeFormDataReview(Request $request)
        {
            // dd($request->file('menu_image'));
            
            $request->validate([   
                'title' => 'required|string', 
                'embedded_code' => 'required|string', 
            ]);
     
            $order_display = $request->input('order_display');
             
            $data = [ 
                'type'=> 2, 
                'review' => $request->input('embedded_code'), 
                'title' =>  $request->input('title'),
                'created_at' => now(),
                'updated_at' => now(),
            ];
             
            if(empty($data)){
                 return redirect()->back()->with('error', 'Data not saved successfully');
            }
            DB::table('reviews')->insert($data);
    
            return redirect()->back()->with('success', 'Data saved successfully');
        }
        
        public function updateTitleReview(Request $request, $id){  
            
            $ids = DB::table('reviews')->find($id); 
            if($ids){  
                $result = DB::table('reviews')->where('id', $id)->update([
                'title'=> $request->title
                ]);
                if($result){
                    return back()->with('success', 'Data saved successfully');
                }
            } 
        }
        
    public function getReviews()
    {
        // Fetch reviews from different sources
        $googleReviews = $this->fetchGoogleReviews();
        $glassdoorReviews = $this->fetchGlassdoorReviews();
        $trustpilotReviews = $this->fetchTrustpilotReviews();
        $clutchReviews = $this->fetchClutchReviews();
        $mouthshutReviews = $this->fetchMouthshutReviews();
        $facebookReviews = $this->fetchFacebookReviews();

        // Combine all reviews into a single array
        $allReviews = array_merge($googleReviews, $glassdoorReviews, $trustpilotReviews, $clutchReviews, $mouthshutReviews, $facebookReviews);

        // Pass reviews to the view
        return view('reviews', compact('allReviews'));
    }
     private function fetchGoogleReviews()
    {
        // Example fetch logic, replace with actual API call
        $client = new Client();
        $response = $client->get('https://api.example.com/google-reviews');
        return json_decode($response->getBody(), true);
    }

    private function fetchGlassdoorReviews()
    {
        // Example fetch logic, replace with actual API call
        $client = new Client();
        $response = $client->get('https://api.example.com/glassdoor-reviews');
        return json_decode($response->getBody(), true);
    }

    private function fetchTrustpilotReviews()
    {
        // Example fetch logic, replace with actual API call
        $client = new Client();
        $response = $client->get('https://api.example.com/trustpilot-reviews');
        return json_decode($response->getBody(), true);
    }

    private function fetchClutchReviews()
    {
        // Example fetch logic, replace with actual API call
        $client = new Client();
        $response = $client->get('https://api.example.com/clutch-reviews');
        return json_decode($response->getBody(), true);
    }

    private function fetchMouthshutReviews()
    {
        // Example fetch logic, replace with actual API call
        $client = new Client();
        $response = $client->get('https://api.example.com/mouthshut-reviews');
        return json_decode($response->getBody(), true);
    }

    private function fetchFacebookReviews()
    {
        // Example fetch logic, replace with actual API call
        $client = new Client();
        $response = $client->get('https://api.example.com/facebook-reviews');
        return json_decode($response->getBody(), true);
    }
}
