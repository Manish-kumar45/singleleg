<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Shopping extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email'));
        $this->load->model(array('Shopping_model'));
        $this->load->helper(array('user', 'birthdate', 'security', 'email'));
    }

    public function index() {
        if (is_logged_in()) {
            $response['products'] = $this->Shopping_model->get_product();
            $this->load->view('Shopping/products', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function product($id) {
        if (is_logged_in()) {
            $response['product'] = $this->Shopping_model->get_single_record('tbl_products', array('id' => $id), '*');
            $response['product_images'] = $this->Shopping_model->get_records('tbl_product_images', array('product_id' => $id), 'image');
            $this->load->view('Shopping/product_view', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function Cart() {
        if (is_logged_in()) {
            $response = array();
            $response['cart_item'] = $this->Shopping_model->cart_items($this->session->userdata['user_id']);
            $response['tax'] = $this->Shopping_model->get_single_record('tbl_tax', array('id' => 1), '*');
            $this->load->view('Shopping/cart', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function add_to_cart($product_id) {
        if (is_logged_in()) {
            $response = array();
            $response['success'] = 0;
            $cart = $this->Shopping_model->get_single_record('tbl_cart', array('user_id' => $this->session->userdata['user_id'], 'product_id' => $product_id), '*');
            if (!empty($cart)) {
                $cartArr = array(
                    'quantity' => $cart['quantity'] + 1,
                );
                $res = $this->Shopping_model->update('tbl_cart', array('user_id' => $this->session->userdata['user_id'], 'product_id' => $product_id), $cartArr);
                if ($res == true) {
                    $response['success'] = 1;
                    $response['message'] = 'cart Updated Successfully';
                } else {
                    $response['message'] = 'Error while Updating Cart';
                }
            } else {
                $cartArr = array(
                    'user_id' => $this->session->userdata['user_id'],
                    'product_id' => $product_id,
                    'quantity' => 1,
                );
                $res = $this->Shopping_model->add('tbl_cart', $cartArr);
                if ($res == true) {
                    $response['success'] = 1;
                    $response['message'] = 'Product Added to cart Successfully';
                } else {
                    $response['message'] = 'Error while Adding product to cart';
                }
            }
            echo json_encode($response);
            exit;
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function decrease_item_from_cart($product_id) {
        if (is_logged_in()) {
            $response = array();
            $response['success'] = 0;
            $cart = $this->Shopping_model->get_single_record('tbl_cart', array('user_id' => $this->session->userdata['user_id'], 'product_id' => $product_id), '*');
            if (!empty($cart)) {
                if ($cart['quantity'] > 1) {
                    $cartArr = array(
                        'quantity' => $cart['quantity'] - 1,
                    );
                    $res = $this->Shopping_model->update('tbl_cart', array('user_id' => $this->session->userdata['user_id'], 'product_id' => $product_id), $cartArr);
                    if ($res == true) {
                        $response['success'] = 1;
                        $response['message'] = 'cart Updated Successfully';
                    } else {
                        $response['message'] = 'Error while Updating Cart';
                    }
                } else {
                    $res = $this->Shopping_model->delete('tbl_cart', array('user_id' => $this->session->userdata['user_id'], 'product_id' => $product_id));
                    if ($res == true) {
                        $response['success'] = 1;
                        $response['message'] = 'Item Removed From Cart';
                    } else {
                        $response['message'] = 'Error while Delete Item from Cart';
                    }
                }
            } else {
                $response['message'] = 'Item Not Available in Cart';
            }
            echo json_encode($response);
            exit;
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function remove_item($product_id) {
        if (is_logged_in()) {
            $response = array();
            $response['success'] = 0;
            $cart = $this->Shopping_model->get_single_record('tbl_cart', array('user_id' => $this->session->userdata['user_id'], 'product_id' => $product_id), '*');
            if (!empty($cart)) {
                $res = $this->Shopping_model->delete('tbl_cart', array('user_id' => $this->session->userdata['user_id'], 'product_id' => $product_id));
                if ($res == true) {
                    $response['success'] = 1;
                    $response['message'] = 'Item Removed From Cart';
                } else {
                    $response['message'] = 'Error while Delete Item from Cart';
                }
            } else {
                $response['message'] = 'Item Not Available in Cart';
            }
            echo json_encode($response);
            exit;
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function place_order($tab = 'shipping') {
        if (is_logged_in()) {
            $response = array();
            $response['tab'] = $tab;
            $response['success'] = 0;
            $response['shipping_address'] = (object) $this->Shopping_model->get_single_record('tbl_address', array('user_id' => $this->session->userdata['user_id'], 'type' => 'shipping'), '*');
            $response['tax'] = (object) $this->Shopping_model->get_single_record('tbl_tax', array('id' => 1), '*');
            $response['e_wallet'] = $this->Shopping_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as sum');
            $response['income_wallet'] = $this->Shopping_model->get_single_record('tbl_income_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as sum');
            $countries = $this->Shopping_model->get_records('countries', array(), '*');
            $response['sstateArr'] = $this->Shopping_model->get_records('states', array('country_id' => $response['shipping_address']->country), '*');
            $response['scityArr'] = $this->Shopping_model->get_records('cities', array('state_id' => $response['shipping_address']->state), '*');
            $countryN = array();
            foreach ($countries as $key => $country)
                $countryN[$country['id']] = $country['name'];
            $response['countries'] = $countryN;
            $response['cart_item'] = $this->Shopping_model->cart_items($this->session->userdata['user_id']);
            $this->load->view('Shopping/place_order', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function checkout() {
        if (is_logged_in()) {
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $response = array();
                $response['success'] = 0;
                $data = $this->security->xss_clean($this->input->post());
                $cart_items = $this->Shopping_model->cart_items($this->session->userdata['user_id']);
                $e_wallet = $this->Shopping_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as sum');
                $income_wallet = $this->Shopping_model->get_single_record('tbl_income_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as sum');
                $tax = $this->Shopping_model->get_single_record('tbl_tax', array('id' => 1), '*');
                $cart_amount = 0;
                $total_bv = 0;
                if (!empty($cart_items)) {
                    foreach ($cart_items as $item) {
                        $cart_amount = $cart_amount + ($item['quantity'] * $item['member_price']);
                        $total_bv = $total_bv + ($item['quantity'] * $item['bv']);
                    }
                    $cart_amount = round($cart_amount * $tax['tax'] / 100);
                    $wallet_amount = 0;
                    if ($data['payment_method'] == 'e_wallet') {
                        $wallet_amount = $e_wallet['sum'];
                    } elseif ($data['payment_method'] == 'income_wallet') {
                        $wallet_amount = $income_wallet['sum'];
                    }
                    if ($wallet_amount >= $cart_amount) {
                        $order_id = $this->generate_order_id();
                        $OrderArr = array(
                            'order_id' => $order_id,
                            'user_id' => $this->session->userdata['user_id'],
                            'amount' => $cart_amount,
                            'payment_method' => $data['payment_method'],
                            'bv' => $total_bv,
                            'status' => 1
                        );
                        $res = $this->Shopping_model->add('tbl_orders', $OrderArr);
                        if ($res == true) {
                            foreach ($cart_items as $item) {
                                $orderDetailArr = array(
                                    'order_id' => $order_id,
                                    'product_id' => $item['id'],
                                    'quantity' => $item['quantity'],
                                    'price' => $item['member_price'],
                                    'bv' => $item['bv'],
                                );
                                $this->Shopping_model->add('tbl_order_details', $orderDetailArr);
                                $this->Shopping_model->delete('tbl_cart', array('id' => $item['cart_id']));
                            }
                            $dedcutionArr = array(
                                'user_id' => $this->session->userdata['user_id'],
                                'type' => 'shopping_amount',
                                'amount' => -$cart_amount,
                            );
                            if ($data['payment_method'] == 'e_wallet') {
                                $dedcutionArr['remark'] = 'Amount Deducted for shopping Orderid #' . $order_id;
                                $this->Shopping_model->add('tbl_wallet', $dedcutionArr);
                            } elseif ($data['payment_method'] == 'income_wallet') {
                                $dedcutionArr['description'] = 'Amount Deducted for shopping Orderid #' . $order_id;
                                $this->Shopping_model->add('tbl_income_wallet', $dedcutionArr);
                            }
                            $response['success'] = 1;
                            $response['message'] = 'Order Placed Successfully #' . $order_id;
                        } else {
                            $response['message'] = 'Error while Placing Order';
                        }
                    } else {
                        $response['message'] = 'Insuffcient Balance Please Try Another Method';
                    }
                } else {
                    $response['message'] = 'Cart is Empty';
                }
                echo json_encode($response);
            }
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function generate_order_id() {
        $order_id = rand(1000, 9999);
        $order = $this->Shopping_model->get_single_record('tbl_orders', array('order_id' => $order_id), '*');
        if (empty($order)) {
            return $order_id;
        } else {
            $this->generate_order_id();
        }
    }

    public function update_business($user_id, $amount, $bv) {
        $response['sponser'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $userinfo->sponser_id), 'id,user_id,package_id,paid_status,sponser_id');
        $response['sponser_package'] = $this->User_model->get_single_record('tbl_package', array('id' => $response['sponser']['package_id']), '*');
        $bonus = ($response['package']['bv'] * $response['sponser_package']['commision'] / 100) * 1.3;
        $updres = $this->User_model->update('tbl_users', array('user_id' => $userinfo->user_id), array('paid_status' => 1));
        $this->User_model->update('tbl_user_positions', array('package' => $response['package']['id']), array('capping' => $response['package']['capping']));
        if ($updres == true) {
            $incomeArr = array(
                'user_id' => $userinfo->sponser_id,
                'amount' => $bonus,
                'type' => 'personal_refferal_network_bonus',
                'description' => 'Personal Refferal Network Bonus from ' . $userinfo->user_id
            );
            $this->User_model->add('tbl_income_wallet', $incomeArr);

            $this->update_business($userinfo->user_id, 1, $response['package']['bv']);
            if ($response['sponser_package']['commision'] == '20') {
                $roll_up_amount = $response['package']['bv'] * 1.3;
                $this->rollup_personal_business($response['sponser']['sponser_id'], $roll_up_amount, $share = 8, $sender_id = $userinfo->user_id, 20);
            } elseif ($response['sponser_package']['commision'] == '22') {
                $roll_up_amount = $response['package']['bv'] * 1.3;
                $this->rollup_personal_business($response['sponser']['sponser_id'], $roll_up_amount, $share = 6, $sender_id = $userinfo->user_id, 22);
            } elseif ($response['sponser_package']['commision'] == '24') {
                $roll_up_amount = $response['package']['bv'] * 1.3;
                $this->rollup_personal_business($response['sponser']['sponser_id'], $roll_up_amount, $share = 4, $sender_id = $userinfo->user_id, 24);
            }

            $response['message'] = 'Product Purchase Successfully';
        } else {
            $response['message'] = 'You cannot purchase this product';
        }
    }

    public function Invoice($order_id) {
        if (is_logged_in()) {
            $response = array();
            $response['success'] = 0;
            $order_details = $this->Shopping_model->order_details($order_id);
            $response['order_id'] = $order_id;
            $response['order'] = $this->Shopping_model->get_single_record('tbl_orders', array('order_id' => $order_id), '*');
            $response['shipping_details'] = $this->Shopping_model->get_single_record('tbl_address', array('user_id' => $this->session->userdata['user_id'], 'type' => 'shipping'), '*');
            $response['country'] = $this->Shopping_model->get_single_record('countries', array('id' => $response['shipping_details']['country']), 'name');
            $response['state'] = $this->Shopping_model->get_single_record('states', array('id' => $response['shipping_details']['state']), 'name');
            $response['city'] = $this->Shopping_model->get_single_record('cities', array('id' => $response['shipping_details']['city']), 'name');
            $response['order_details'] = $order_details;
//            pr($response, true);
            $this->load->view('Shopping/invoice', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function OnlinePayment() {
        $cart_items = $this->Shopping_model->cart_items($this->session->userdata['user_id']);
        $cart_amount = 0;
        $total_bv = 0;
        foreach ($cart_items as $item) {
            $cart_amount = $cart_amount + ($item['quantity'] * $item['member_price']);
            $total_bv = $total_bv + ($item['quantity'] * $item['bv']);
        }
        $order_id = $this->generate_order_id();
        $OrderArr = array(
            'order_id' => $order_id,
            'user_id' => $this->session->userdata['user_id'],
            'amount' => $cart_amount,
            'payment_method' => 'online',
            'bv' => $total_bv,
            'status' => 1
        );
//        $res = $this->Shopping_model->add('tbl_orders', $OrderArr);
//        if ($res == true) {
//            foreach ($cart_items as $item) {
//                $orderDetailArr = array(
//                    'order_id' => $order_id,
//                    'product_id' => $item['id'],
//                    'quantity' => $item['quantity'],
//                    'price' => $item['member_price'],
//                    'bv' => $item['bv'],
//                );
////                $this->Shopping_model->add('tbl_order_details', $orderDetailArr);
////                $this->Shopping_model->delete('tbl_cart', array('id' => $item['cart_id']));
//            }
//        }
        echo'<body onload="document.paymentform.submit()">';
        echo form_open(base_url('payment/'), array('name' => 'paymentform'));
//        echo'<form action="sd" name="paymentform" method="POST">';
        echo'<input type="text" name="user_id" value="' . $this->session->userdata['user_id'] . '">';
        echo'<input type="text" name="package_id" value="' . $order_id . '">';
        echo'<input type="text" name="amount" value="' . $cart_amount . '">';
        echo'<input type="text" name="type" value="s">';
        echo'</form>';
        echo'</body>';
    }

    public function payment_response($id) {
        $data = array();
        $transaction = $this->Shopping_model->get_single_record('tbl_user_payments', array('transaction_id' => $id), $select = '*');
        $tax = $this->Shopping_model->get_single_record('tbl_tax', array('id' => 1), $select = '*');
        $response['transaction'] = $transaction;
        $response['description'] = json_decode($transaction['description'], true);
        if ($response['description']['actionCode'] == 0 && $response['transaction']['type'] == 's') {
            if ($transaction['link_status'] == 0) {
                $cart_items = $this->Shopping_model->cart_items($this->session->userdata['user_id']);
                if ($cart_items)
                    $cart_amount = 0;
                $total_bv = 0;
                foreach ($cart_items as $item) {
                    $cart_amount = $cart_amount + ($item['quantity'] * $item['member_price']);
                    $total_bv = $total_bv + ($item['quantity'] * $item['bv']);
                }
                $cart_amount = round($cart_amount * $tax['tax'] / 100);
                $order_id = $response['transaction']['order_id'];
                $OrderArr = array(
                    'order_id' => $order_id,
                    'user_id' => $this->session->userdata['user_id'],
                    'amount' => $cart_amount,
                    'payment_method' => 'online',
                    'bv' => $total_bv,
                    'status' => 1
                );
                $res = $this->Shopping_model->add('tbl_orders', $OrderArr);
                if ($res == true) {
                    foreach ($cart_items as $item) {
                        $orderDetailArr = array(
                            'order_id' => $order_id,
                            'product_id' => $item['id'],
                            'quantity' => $item['quantity'],
                            'price' => $item['member_price'],
                            'bv' => $item['bv'],
                        );
                        $this->Shopping_model->add('tbl_order_details', $orderDetailArr);
                        $this->Shopping_model->delete('tbl_cart', array('id' => $item['cart_id']));
                    }
                }
                $this->Shopping_model->update('tbl_user_payments', array('transaction_id' => $id), array('link_status' => 1));
                $response['message'] = 'Order Placed Successfully';
            }else{
                $response['message'] = 'This Order Already Placed';
            }
//            pr($this->session->userdata,true);
        } else {
            $response['message'] = 'Error In payment process';
        }
        $this->load->view('payment_response', $response);
    }

}
