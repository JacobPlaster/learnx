<div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close visible-xs" data-dismiss="modal">&times;</button>
    <button type="button" class="close close2 hidden-xs" data-dismiss="modal">&times;</button>
  </div>

  <div id="paymentForm" class="modal-body">
    <form role="form" method="POST" action="/checkout/payment.php">
      <div class="form-group">
        <label for="text">Card:</label>
        <input type="text" class="form-control" name="card_number">
      </div>
      <button type="submit" name="submit-register" value="sign up" class="btn btn-default btn-block">Pay</button>
    </form>
  </div>
</div><!-- Close modal form -->
