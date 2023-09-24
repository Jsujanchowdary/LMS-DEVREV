<?php
	/*
		loop through array of $_SESSION['cart'][book_isbn] => number
		get isbn => take from database => take book price
		price * number (quantity)
		return sum of price
	*/
	function total_price($cart){
		$price = 0.0;
		if(is_array($cart)){
			foreach($cart as $isbn => $qty){
				$bookprice = getbookprice($isbn);
				if(is_numeric($bookprice) && is_numeric($qty)){
					$price += $bookprice * $qty;
				}
			}
		}
		return $price;
	}

	/*
		loop through array of $_SESSION['cart'][book_isbn] => number
		$_SESSION['cart'] is associative array which is [book_isbn] => number of books for each book_isbn
		calculate sum of books 
	*/
	function total_items($cart){
		$items = 0;
		if(is_array($cart)){
			foreach($cart as $isbn => $qty){
				$qty = intval($qty); // Convert $qty to an integer
				if(is_numeric($qty)){
					$items += $qty;
				}
			}
		}
		return $items;
	}
	
?>