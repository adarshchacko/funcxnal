<?php

/**
 * Api/SearchController is used for the "smart" search throughout the site.
 * it returns and array of items (with type and icon specified) so that the selectize.js plugin 
 * can render the search results properly
 **/


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class ApiController extends Controller
{
    
	public function __construct()
    {
        $this->middleware('auth');
    }


	public function index(Request $request) {


		// Retrieve the user's input and escape it
		$query = e($request->input('q',''));

		// If the input is empty, return an error response
		if(!$query && $query == '') return response()->json(array(), 400);

		$users = User::where('name','like','%'.$query.'%')
			->where('id', '!=', Auth::user()->id)
			->orderBy('name','asc')
			->take(5)
			->get(array('id','name','email'))->toArray();

		// Data normalization
		/*$categories = $this->appendValue($categories, url('img/icons/category-icon.png'),'icon');

		$products 	= $this->appendURL($products, 'products');
		$categories  = $this->appendURL($categories, 'categories');

		// Add type of data to each item of each set of results
		$products = $this->appendValue($products, 'product', 'class');
		$categories = $this->appendValue($categories, 'category', 'class');

		// Merge all data into one array
		$data = array_merge($products, $categories);*/

		$users = $this->appendURL($users, 'user');
		$users = $this->appendValue($users, 'user', 'class');

		//$data = $users;


		return response()->json(array(
			'data'=>$users
		));
	}



	public function appendValue($data, $type, $element) {
		// operate on the item passed by reference, adding the element and type
		foreach ($data as $key => & $item) {
			$item[$element] = $type;
		}
		return $data;		
	}

	public function appendURL($data, $prefix) {
		// operate on the item passed by reference, adding the url based on slug
		foreach ($data as $key => & $item) {
			$item['url'] = url($prefix.'/'.$item['id']);
		}
		return $data;		
	}

	public function get_user($id){
		$user = User::find($id);

		return view('users.edit')->with('user', $user);
	}

}
