<script type="text/javascript"
src="https://app.sandbox.midtrans.com/snap/snap.js"
data-client-key="{{ config('midtrans.clientKey') }}"></script>

<x-app_user title="Payment Checkout" bodyClass='p-3'>
    <div class="">
        No Pesanan: {{ $transaction->id }}
    </div>
      <x-button id="pay-button">Pay</x-button>
</x-app_user>

<script type="text/javascript">
    // For example trigger on button clicked, or any time you need
    var payButton = document.getElementById('pay-button');
    payButton.addEventListener('click', function () {

      // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
            window.snap.pay('{{ $snapToken }}', {
                onSuccess: function(result){
                /* You may add your own implementation here */
                // alert("payment success!"); 
                window.location.href = '/profile';
                console.log(result);
                },
                onPending: function(result){
                /* You may add your own implementation here */
                alert("wating your payment!"); console.log(result);
                },
                onError: function(result){
                /* You may add your own implementation here */
                alert("payment failed!"); console.log(result);
                },
                onClose: function(){
                /* You may add your own implementation here */
                alert('you closed the popup without finishing the payment');
                }
            })
    });
</script>