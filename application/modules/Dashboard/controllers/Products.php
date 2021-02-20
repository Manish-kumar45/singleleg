<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Products extends CI_Controller {
    
    function __construct() {
        parent::__construct();
		
		// Load Stripe library & product model
        $this->load->library(array('stripe_lib','session'));
		$this->load->model(array('product','User_model'));
    }
    
    public function index(){
        $data = array();
		
		// Get products data from the database
		$data['products'] = $this->product->getRows();
		
		// Pass products data to the list view
        $this->load->view('products/index', $data);
        
    }
	
	 public function purchase($id){
		$data = array();
		
		// Get product data from the database
        $product = $this->product->getRows($id);
        
		
		// If payment form is submitted with token

		if($this->input->post('stripeToken')){
			


			// Retrieve stripe token, card and user info from the submitted form data
			$postData = $this->input->post();
			
			$postData['product'] = $product;
			
			// Make payment
			$paymentID = $this->payment($postData);
			
			// print_r($paymentID);
			// die('ook');	
			// If payment successful
			if($paymentID){
				// die('oop');
				redirect('Dashboard/Products/payment_status/'.$paymentID);
			}else{
				$apiError = !empty($this->stripe_lib->api_error)?' ('.$this->stripe_lib->api_error.')':'';
				$data['error_msg'] = 'Transaction has been failed!'.$apiError;
			}
		}
        // Pass product data to the details view
		$data['product'] = $product;
        $this->load->view('products/details', $data);
    }
	
	public function payment($postData){
		
		// If post data is not empty
		if(!empty($postData)){
			$email = $this->User_model->get_single_record('tbl_users',['email' => $postData['email']],'email');
			if($postData['email'] == $email['email']){
				$token  = $postData['stripeToken'];
				$name = $postData['name'];
				// $email = $postData['email'];
				$card_number = $postData['card_number'];
				$card_number = preg_replace('/\s+/', '', $card_number);
				$card_exp_month = $postData['card_exp_month'];
				$card_exp_year = $postData['card_exp_year'];
				$card_cvc = $postData['card_cvc'];
				
				// Unique order ID
				$orderID = strtoupper(str_replace('.','',uniqid('', true)));
				
				// Add customer to stripe
				$customer = $this->stripe_lib->addCustomer($email['email'], $token);
				
				if($customer){
				// Retrieve stripe token, card and user info from the submitted form data
					// Charge a credit or a debit card
					$charge = $this->stripe_lib->createCharge($customer->id, $postData['product']['name'], $postData['product']['price'], $orderID);
					
					if($charge){
						// Check whether the charge is successful
						if($charge['amount_refunded'] == 0 && empty($charge['failure_code']) && $charge['paid'] == 1 && $charge['captured'] == 1){
							// Transaction details 
							$transactionID = $charge['balance_transaction'];
							$paidAmount = $charge['amount'];
							$paidAmount = ($paidAmount/100);
							$paidCurrency = $charge['currency'];
							$payment_status = $charge['status'];
			// 				print_r($payment_status );
			// die('payment_status ');
							// die('okk');
							
							
							// Insert tansaction data into the database
							$orderData = array(
								'product_id' => $postData['product']['id'],
								'buyer_name' => $name,
								'buyer_email' => $email['email'],
								'card_number' => $card_number,
								'card_exp_month' => $card_exp_month,
								'card_exp_year' => $card_exp_year,
								'txn_id' => $transactionID,
								'payment_status' => $payment_status,
								'paid_amount_currency' => $paidCurrency,
								'paid_amount' => $paidAmount
							);
							$orderID = $this->product->insertOrder($orderData);
							
							// If the order is successful
							if($payment_status == 'succeeded'){
								return $orderID;
							}
						}
					}
				}
			}else{
				$this->session->set_flashdata('message','Email not matched');
				return false;
			}	
		}
		return false;
    }
	
   public	function payment_status($id){
		$data = array();
		
		// Get order data from the database
        $order = $this->product->getOrder($id);
		
        // Pass order data to the view
		$data['order'] = $order;
        $this->load->view('products/payment-status', $data);
    }
}