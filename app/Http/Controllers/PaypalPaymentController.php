<?php

namespace App\Http\Controllers;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;

use App\Config;
use Session;
use Input;
use App\Http\Controllers\CartController as Cart;

/**
* Paypal
*/
class PaypalPaymentController extends Controller{
	
	private $_api_context;

	public function __construct(){
		// setup PayPal api context
		$paypal_conf = config('paypal');
		$config = Config::find(1);
		$this->_api_context = new ApiContext(new OAuthTokenCredential($config->paypalClientId, $config->paypalSecretId));
		$this->_api_context->setConfig($paypal_conf['settings']);
	}

	public function postPayment(){
		$cart = new Cart;
		$total = $cart->total();

		if($total == 0){
			return redirect('/pagar/');
		}else{
			$payer = new Payer();
			$payer->setPaymentMethod('paypal');

			$array = $cart->content();

			$i = 0;
			$item = array();
			foreach($array as $a){
				$item[$i] = new Item();
				$item[$i]->setName($a->name) // item name
					->setCurrency('MXN')
					->setQuantity($a->qty)
					->setPrice($a->price); // unit price
				$i++;
			}

			// add item to list
			$item_list = new ItemList();
			$item_list->setItems($item);

			$amount = new Amount();
			$amount->setCurrency('MXN')
				->setTotal($total);

			$transaction = new Transaction();
			$transaction->setAmount($amount)
				->setItemList($item_list)
				->setDescription('Your transaction description');

			$redirect_urls = new RedirectUrls();
			$redirect_urls->setReturnUrl(url('payment/status'))
						  ->setCancelUrl(url('payment/status'));

			$payment = new Payment();
			$payment->setIntent('Sale')
				->setPayer($payer)
				->setRedirectUrls($redirect_urls)
				->setTransactions(array($transaction));

			try {
				$payment->create($this->_api_context);
			} catch (\PayPal\Exception\PPConnectionException $ex) {
				if (\config('app.debug')) {
					echo "Exception: " . $ex->getMessage() . PHP_EOL;
					$err_data = json_decode($ex->getData(), true);
					exit;
				} else {
					die('Some error occur, sorry for inconvenient');
				}
			}

			foreach($payment->getLinks() as $link) {
				if($link->getRel() == 'approval_url') {
					$redirect_url = $link->getHref();
					break;
				}
			}

			// add payment ID to session
			Session::put('paypal_payment_id', $payment->getId());

			if(isset($redirect_url)) {
				// redirect to paypal
				return redirect($redirect_url);
			}

			return redirect('/')
				->with('error', 'Unknown error occurred');

		}
	}

	public function getPaymentStatus(){
		// Get the payment ID before session clear
		$payment_id = Session::get('paypal_payment_id');

		// clear the session payment ID
		Session::forget('paypal_payment_id');
        $payer_id = Input::get('PayerID');
        $token = Input::get('token');
		if ( empty($payer_id) || empty($token) ) {
			return redirect('/')
				->with('error', 'Payment failed');
		}

		$payment = Payment::get($payment_id, $this->_api_context);

		// PaymentExecution object includes information necessary 
		// to execute a PayPal account payment. 
		// The payer_id is added to the request query parameters
		// when the user is redirected from paypal back to your site
		$execution = new PaymentExecution();
		$execution->setPayerId(Input::get('PayerID'));

		//Execute the payment
		$result = $payment->execute($execution, $this->_api_context);

		//echo '<pre>';print_r($result);echo '</pre>';exit; // DEBUG RESULT, remove it later

		if ($result->getState() == 'approved') { // payment made
			return redirect('/')
				->with('success', 'Payment success');
		}
		return redirect('/')
			->with('error', 'Payment failed');
	}

}

?>