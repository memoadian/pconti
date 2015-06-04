<?php

namespace App\Http\Controllers;
use App\Category;
use Validator;
use Input;
use Mail;
use App\Config;

/**
* Contact
*/
class ContactController extends Controller{
	
	public function index(){
		$data = array(
			'categorias' => Category::all(),
			'title' => 'Contacto PCONTI',
		);

		return view('front/contact', $data);
	}

	public function send(){
		$validator = Validator::make(
			array(
				'name' => Input::get('name'),
				'email' => Input::get('email'),
				'phone' => Input::get('phone'),
				'subject' => Input::get('subject'),
				'g-recaptcha-response' => Input::get('g-recaptcha-response'),
			),
			array(
				'name' => 'required',
				'email' => 'required|email',
				'phone' => 'required',
				'subject' => 'required',
				'g-recaptcha-response' => 'required|recaptcha',
			),
			array(
				'required' => 'El campo es obligatorio',
			)
		);

		if ($validator->fails()){
			$messages = $validator->messages();
			return redirect('/contacto')
				->withErrors($validator)
				->withInput();
		}else{
			$name = Input::get('name');
			$email = Input::get('email');
			$phone = Input::get('phone');
			$subject = Input::get('subject');

			$config = Config::find(1);

			$view_data = array(
				'name' => $name,
				'email' => $email,
				'phone' => $phone,
				'subject' => $subject
			);

			$email_data = array(
				'email' => $config->mail,
			);

			Mail::send('mails.contact', $view_data, function($message) use ($email_data){
				$message->from('admin@pconti.com', 'PCONTI');
				$message->to($email_data['email'])->subject('Contacto PCONTI');
			});

			return redirect('contacto')->with('mensaje', 'Enviado');
		}
	}
}

?>