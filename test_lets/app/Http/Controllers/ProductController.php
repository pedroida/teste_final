<?php 

namespace App\Http\Controllers;


use Request;

use App\Http\Requests;

use Validator;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Input; 

use App\Product;

use Illuminate\Support\Facades\Auth;

class ProductController extends Controller{

    public $message = null;

	public function showIndex(){// carrega a index
		if(view()->exists('index') && Auth::check()){
			$product = Product::all();

			return view('index')->with('product', $product)->with('message',$this->message);
		}else{
			return view('auth.login');
		}
	}

	public function register(){
		if(view()->exists('register') && Auth::check()){

			return view('register');
		}else{
			return view('auth.login');
		}
	}

    public function showItem($id){
        if(view()->exists('showItem') && Auth::check()){
            $product = Product::find($id);

            if(empty($product)){
                return redirect()->action('ProductController@invalidURL');
            }else{
                return view('showItem')->with('product',$product);
            }
        }else{
            return view('auth.login');
        }
    }

    public function save(){

        $title = ucfirst(Request::input('title'));
        $description = ucfirst(Request::input('description'));
        $price = Request::input('price');
        $image = Input::file('image');

        $source = array('.', ',');
        $replace = array('', '.');
        $price = str_replace($source, $replace, $price); //remove os pontos e substitui a virgula pelo ponto

        $validator = Validator::make(
        	[
        		'título' => $title,
        		'descrição' => $description,
        		'imagem' => $image
        	],
        	[
        		'título' => 'required|min:1',
        		'descrição' => 'required|min:1',
        		'imagem' => 'required|image|max:5120'
        	],
        	[
        		'required' => ':attribute é obrigatório!',
        		'image' => ':attribute deve ser arquivo de imagem!',
                'max' => ':attribute deve possuir menos de 5Mb'
            ]
        );

        if($validator->fails()){
        	return redirect()->action('ProductController@register')->withErrors($validator)->withInput();
        }

        $product = new Product;
        $product->title = $title;
        $product->description = $description;
        $product->price = $price;

        $image->move(public_path()."/", trim($product->title).".".$image->getClientOriginalExtension());
        $product->image = trim($product->title).".".$image->getClientOriginalExtension();
        $product->save();

        return redirect()->action('ProductController@showIndex');
    }

    public function edit($id){
    	if(view()->exists('edit') && Auth::check()){

    		$product = Product::find($id);

    		if(empty($product)){
    			return redirect()->action('ProductController@invalidURL');
    		}

    		return view('edit')->with('product',$product);
    	}else{
    		return view('auth.login');
    	}
    }

    public function update($id){
    	$title = ucfirst(Request::input('title'));
    	$description = ucfirst(Request::input('description'));
    	$price = Request::input('price');
    	$image = Input::file('image');

    	$source = array('.', ',');
    	$replace = array('', '.');
        $price = str_replace($source, $replace, $price); //remove os pontos e substitui a virgula pelo ponto

        $validator = Validator::make(//validação dos campos
        	[
        		'título' => $title,
        		'descrição' => $description,
        		'imagem' => $image
        	],
        	[
        		'título' => 'required|min:1',
        		'descrição' => 'required|min:1',
        		'imagem' => 'required|image|max:5120'
        	],
        	[
        		'required' => ':attribute é obrigatório!',
        		'numeric' => ':attribute deve ser numérico!',
        		'image' => ':attribute deve ser arquivo de imagem!'	
        	]
        );

        if($validator->fails()){
        	return redirect()->action('ProductController@edit',$id)->withErrors($validator)->withInput();
        }

        $product = Product::find($id);
        $product->title = $title;
        $product->description = $description;
        $product->price = $price;

        $image->move(public_path()."/", trim($product->title).".".$image->getClientOriginalExtension());
        $product->image = trim($product->title).".".$image->getClientOriginalExtension();
        $product->save();

        return redirect()->action('ProductController@showIndex');
    }

    public function delete($id){

    	$product = Product::find($id);

    	if(empty($product)){
    		return redirect()->action('ProductController@invalidURL');
    	}else{
    		$product->delete();

    		return redirect()->action('ProductController@showIndex');
    	}
    }

    public function invalidURL(){

        $this->message = "Você Digitou uma url inválida!";
        
        return $this->showIndex();
    }


    public function searchItem(){
        if(view()->exists('resultSearch') && Auth::check()){

            $search = Request::input('search');

            $itens = Product::where('title','like','%'.$search.'%')->orWhere('description','like','%'.Request::input('search').'%')->get();

            if(!empty($itens)){
                return view('resultSearch')->with('itens', $itens)->with('search', $search);   
            }
            
        }else{
            return view('auth.login');
        }
    }

}

?>