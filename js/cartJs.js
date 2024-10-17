document.querySelectorAll('.quantity-container').forEach(function(container) {
    let decreaseButton = container.querySelector('.decrease');
    let increaseButton = container.querySelector('.increase');
    let quantityInput = container.querySelector('.quantity-amount');
    let productPrice = parseFloat(container.closest('tr').querySelector('.product-price').textContent.replace('$', ''));
    let totalField = container.closest('tr').querySelector('.product-total');
  
    decreaseButton.addEventListener('click', function() {
      let quantity = Math.max(1, parseInt(quantityInput.value) - 1);
      quantityInput.value = quantity;
      totalField.textContent = '$' + (quantity * productPrice).toFixed(2);
    });
  
    increaseButton.addEventListener('click', function() {
      let quantity = parseInt(quantityInput.value) + 1;
      quantityInput.value = quantity;
      totalField.textContent = '$' + (quantity * productPrice).toFixed(2);
    });
  });
  