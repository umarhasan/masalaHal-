@extends('company.layouts.app')

@section('content')

<link href='https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css' rel='stylesheet'>

<style>
body {
    background: #f7f8f6;
    padding: 30px 0
}

a {
    text-decoration: none;
}

.pricingTable {
    text-align: center;
    background: #fff;
    margin: 0 -15px;
    box-shadow: 0 0 10px #ababab;
    padding-bottom: 40px;
    border-radius: 10px;
    color: #cad0de;
    transform: scale(1);
    transition: all .5s ease 0s
}

.pricingTable:hover {
    transform: scale(1.05);
    z-index: 1
}

.pricingTable .pricingTable-header {
    padding: 40px 0;
    background: #f5f6f9;
    border-radius: 10px 10px 50% 50%;
    transition: all .5s ease 0s
}

.pricingTable:hover .pricingTable-header {
    background: #ff9624
}

.pricingTable .pricingTable-header i {
    font-size: 50px;
    color: #858c9a;
    margin-bottom: 10px;
    transition: all .5s ease 0s
}

.pricingTable .price-value {
    font-size: 35px;
    color: #ff9624;
    transition: all .5s ease 0s
}

.pricingTable .month {
    display: block;
    font-size: 14px;
    color: #cad0de
}

.pricingTable:hover .month,
.pricingTable:hover .price-value,
.pricingTable:hover .pricingTable-header i {
    color: #fff
}

.pricingTable .heading {
    font-size: 24px;
    color: #ff9624;
    margin-bottom: 20px;
    text-transform: uppercase
}

.pricingTable .pricing-content ul {
    list-style: none;
    padding: 0;
    margin-bottom: 30px
}

.pricingTable .pricing-content ul li {
    line-height: 30px;
    color: #a7a8aa
}

.pricingTable .pricingTable-signup a {
    display: inline-block;
    font-size: 15px;
    color: #fff;
    padding: 10px 35px;
    border-radius: 20px;
    background: #ffa442;
    text-transform: uppercase;
    transition: all .3s ease 0s
}

.pricingTable .pricingTable-signup a:hover {
    box-shadow: 0 0 10px #ffa442
}

.pricingTable.blue .heading,
.pricingTable.blue .price-value {
    color: #4b64ff
}

.pricingTable.blue .pricingTable-signup a,
.pricingTable.blue:hover .pricingTable-header {
    background: #4b64ff
}

.pricingTable.blue .pricingTable-signup a:hover {
    box-shadow: 0 0 10px #4b64ff
}

.pricingTable.red .heading,
.pricingTable.red .price-value {
    color: #ff4b4b
}

.pricingTable.red .pricingTable-signup a,
.pricingTable.red:hover .pricingTable-header {
    background: #ff4b4b
}

.pricingTable.red .pricingTable-signup a:hover {
    box-shadow: 0 0 10px #ff4b4b
}

.pricingTable.green .heading,
.pricingTable.green .price-value {
    color: #40c952
}

.pricingTable.green .pricingTable-signup a,
.pricingTable.green:hover .pricingTable-header {
    background: #40c952
}

.pricingTable.green .pricingTable-signup a:hover {
    box-shadow: 0 0 10px #40c952
}

.pricingTable.blue:hover .price-value,
.pricingTable.green:hover .price-value,
.pricingTable.red:hover .price-value {
    color: #fff
}

.pricing-content p {
    font-size: 16px;
    line-height: 1.6;
    margin-bottom: 20px;
    padding: 10px;
    background-color: #f5f5f5;
    border: 1px solid #ddd;
}

@media screen and (max-width:990px) {
    .pricingTable {
        margin: 0 0 20px
    }
}
</style>

<!-- Subscription Modal -->
<div class="modal fade" id="subscriptionModal" tabindex="-1" aria-labelledby="subscriptionModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="subscriptionModalLabel">Subscribe Now</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        @if (Session::has('success'))
            <div class="alert alert-success text-center">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <p>{{ Session::get('success') }}</p>
            </div>
        @endif

        <form role="form" action="{{ route('company.stripe.post') }}" method="post" class="require-validation"
              data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form">
            @csrf

            <div class="mb-3">
                <label for="price" class="form-label">Amount</label>
                <input type="text" name="amount" id="price" class="form-control" placeholder="Amount">
                <input type="hidden" name="lead_id" id="lead_id" class="form-control">
                <input type="hidden" name="package_id" id="package_id" class="form-control">
                <input type="hidden" name="credit" id="credit" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Name on Card</label>
                <input class="form-control" type="text" size="4">
            </div>
            <div class="mb-3">
                <label class="form-label">Card Number</label>
                <input autocomplete="off" class="form-control card-number" type="text" size="20">
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">CVC</label>
                    <input autocomplete="off" class="form-control card-cvc" placeholder="ex. 311" size="4" type="text">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Expiration Month</label>
                    <input class="form-control card-expiry-month" placeholder="MM" size="2" type="text">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Expiration Year</label>
                    <input class="form-control card-expiry-year" placeholder="YYYY" size="4" type="text">
                </div>
            </div>
            <div class="error form-group d-none">
                <div class="alert alert-danger">Please correct the errors and try again.</div>
            </div>
            <div class="text-center">
                <button class="btn btn-primary btn-lg" type="submit">Pay Now (100)</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="container">
    <div class="row">
        @foreach($package as $pck)
            <div class="col-md-3 col-sm-6">
                <div class="pricingTable">
                    <div class="pricingTable-header">
                        <div class="price-value"> ${{$pck->amount}} <span class="month">{{$pck->period}}</span> </div>
                        <div class="price-value"><span class="month">Number Of Credits : {{$pck->credit}}</span></div>
                    </div>
                    <h3 class="heading">{{$pck->name}}</h3>
                    <div class="pricing-content">
                        <!-- Optional description: <p>{{ $pck->description }}</p> -->
                    </div>
                    <div class="pricingTable-signup">
                        <a href="#" class="subscription-btn" data-bs-toggle="modal" data-bs-target="#subscriptionModal"
                           data-package-amount="{{$pck->amount}}" data-credit-id="{{$pck->credit}}"
                           data-lead-id="{{$leads->id}}" data-package-id="{{$pck->id}}">Subscription</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- Core JS -->
<script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
<script src="{{ asset('assets/vendor/js/bootstrap.bundle.js') }}"></script>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript">

$(document).ready(function(){
        $('.subscription-btn').on('click', function(){
            var package_id = $(this).data('package-id');
            var packageAmount = $(this).data('package-amount');
            var lead_id = $(this).data('lead-id');
            var credit = $(this).data('credit-id');
            $('#package_id').val(package_id);
            $('#price').val(packageAmount);
            $('#lead_id').val(lead_id);
            $('#credit').val(credit);
        });
    });

$(function() {
  var $form = $(".require-validation");
  $('form.require-validation').bind('submit', function(e) {
    var $form = $(".require-validation"),
    inputSelector = ['input[type=email]', 'input[type=password]', 'input[type=text]', 'input[type=file]', 'textarea'].join(', '),
    $inputs = $form.find('.required').find(inputSelector),
    $errorMessage = $form.find('div.error'),
    valid = true;
    $errorMessage.addClass('hide');
    $('.has-error').removeClass('has-error');
    $inputs.each(function(i, el) {
        var $input = $(el);
        if ($input.val() === '') {
            $input.parent().addClass('has-error');
            $errorMessage.removeClass('hide');
            e.preventDefault();
        }
    });
    if (!$form.data('cc-on-file')) {
      e.preventDefault();
      Stripe.setPublishableKey($form.data('stripe-publishable-key'));
      Stripe.createToken({
          number: $('.card-number').val(),
          cvc: $('.card-cvc').val(),
          exp_month: $('.card-expiry-month').val(),
          exp_year: $('.card-expiry-year').val()
      }, stripeResponseHandler);
    }
  });

  function stripeResponseHandler(status, response) {
      if (response.error) {
          $('.error')
              .removeClass('hide')
              .find('.alert')
              .text(response.error.message);
      } else {
          /* token contains id, last4, and card type */
          var token = response['id'];
          $form.find('input[type=text]').empty();
          $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
          $form.get(0).submit();
      }
  }
});

</script>
@endsection



