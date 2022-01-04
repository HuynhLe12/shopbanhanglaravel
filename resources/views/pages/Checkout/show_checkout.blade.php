@extends('welcome')
@section('content')

<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="{{'/'}}">Home</a></li>
				  <li class="active">Check out</li>
				</ol>
			</div><!--/breadcrums-->

			<div class="register-req col-sm-9">
				<p>Please use Register And Checkout to easily get access to your order history, or use Checkout as Guest</p>
			</div><!--/register-req-->

			<div class="shopper-informations">
				<div class="row">
					<div class="col-sm-8">
						<div class="shopper-info">
							<p>Shopper Information</p>
							<form action="{{URL::to('/save-checkout-customer')}}" method="POST">
								{{ csrf_field() }}
								<input type="text" placeholder="Your Email" name="shipping_email">
								<input type="text" placeholder="User Name" name="shipping_name">
								<input type="text" placeholder="Your Address" name="shipping_address">
								<input type="text" placeholder="Your Phone" name="shipping_phone">
								<textarea name="shipping_note"  placeholder="Notes about your order, Special Notes for Delivery" rows="16"></textarea>
								<input type="submit" name="send_order" class="btn btn-primary btn-sm" value="Submit">
							</form>
						</div>
					</div>				
				</div>
			</div>
			 
		</div>
	</section> <!--/#cart_items-->

@endsection