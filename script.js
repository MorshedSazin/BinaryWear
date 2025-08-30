document.addEventListener('DOMContentLoaded', function () {
    const menuBtn = document.getElementById('menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    const searchBar = document.getElementById('search-bar');
    const orderNowBtn = document.getElementById('order-now-btn');
    const userId = document.getElementById('user-id').value;

    if (menuBtn) {
        menuBtn.addEventListener('click', function () {
            mobileMenu.classList.toggle('hidden');
        });
    }

    if (searchBar) {
        searchBar.addEventListener('keypress', function (event) {
            if (event.key === 'Enter') {
                console.log('Search query:', searchBar.value);
                alert('Search functionality is not yet implemented. Query: ' + searchBar.value);
            }
        });
    }

    if (orderNowBtn) {
        orderNowBtn.addEventListener('click', function (event) {
            event.preventDefault();

            if (!userId) {
                window.location.href = 'login.php';
                return;
            }

            const productCards = document.querySelectorAll('.product-card');
            const selectedItems = [];
            let hasError = false;

            productCards.forEach(card => {
                const checkbox = card.querySelector('.product-select');
                if (checkbox.checked) {
                    const productName = checkbox.dataset.productName;
                    const productPrice = parseFloat(checkbox.dataset.price);
                    const selectedSize = card.querySelector('.product-size').value;

                    if (selectedSize === 'Size') {
                        alert(`Please select a size for "${productName}" before proceeding.`);
                        hasError = true;
                        return;
                    }

                    const productImg = card.querySelector('img').src;
                    const quantity = parseInt(card.querySelector('.product-quantity').value, 10);
                    const selectedColor = card.querySelector('.product-color:checked');
                    const colorValue = selectedColor ? selectedColor.value : null;

                    selectedItems.push({
                        name: productName,
                        price: productPrice,
                        size: selectedSize,
                        quantity: quantity,
                        image: productImg,
                        color: colorValue
                    });
                }
            });

            if (hasError) return;

            if (selectedItems.length > 0) {
                localStorage.setItem('selectedItems', JSON.stringify(selectedItems));
                window.location.href = 'order.php';
            } else {
                alert('Please select at least one item to order.');
            }
        });
    }

    // Real-time stock checking
    const quantityInputs = document.querySelectorAll('.product-quantity');
    quantityInputs.forEach(input => {
        input.addEventListener('input', function () {
            const requestedQuantity = parseInt(this.value, 10);
            const availableStock = parseInt(this.dataset.stock, 10);
            
            const card = this.closest('.product-card');
            const statusSpan = card.querySelector('.stock-status');
            const checkbox = card.querySelector('.product-select');

            if (isNaN(requestedQuantity) || requestedQuantity <= 0) {
                this.value = 1; // Reset to 1 if input is invalid
            }

            if (requestedQuantity > availableStock) {
                statusSpan.textContent = 'Not enough stock';
                statusSpan.classList.remove('text-green-500');
                statusSpan.classList.add('text-red-500');
                checkbox.disabled = true;
                checkbox.checked = false; // Uncheck if it was checked
            } else {
                statusSpan.textContent = 'Available';
                statusSpan.classList.remove('text-red-500');
                statusSpan.classList.add('text-green-500');
                checkbox.disabled = false;
            }
        });
    });

    const modal = document.getElementById('image-preview-modal');
    const modalImg = document.getElementById('modal-image');
    const closeModal = document.getElementById('close-modal');
    const zoomResult = document.getElementById('zoom-result');

    if(modal) {
        document.querySelectorAll('.previewable').forEach(img => {
            img.addEventListener('click', () => {
                modal.style.display = "flex";
                modalImg.src = img.src;
                modalImg.onload = () => {
                    imageZoom("modal-image", "zoom-result");
                }
            });
        });

        closeModal.addEventListener('click', () => {
            modal.style.display = "none";
            zoomResult.style.display = "none";
            const lens = document.querySelector('.img-zoom-lens');
            if (lens) {
                lens.remove();
            }
        });

        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.style.display = "none";
                zoomResult.style.display = "none";
                const lens = document.querySelector('.img-zoom-lens');
                if (lens) {
                    lens.remove();
                }
            }
        });
    }
});

function imageZoom(imgID, resultID) {
  var img, lens, result, cx, cy;
  img = document.getElementById(imgID);
  result = document.getElementById(resultID);

  // If a lens already exists, remove it
  const existingLens = document.querySelector('.img-zoom-lens');
  if (existingLens) {
    existingLens.remove();
  }

  /*create lens:*/
  lens = document.createElement("DIV");
  lens.setAttribute("class", "img-zoom-lens");
  /*insert lens:*/
  img.parentElement.insertBefore(lens, img);
  /*calculate the ratio between result DIV and lens:*/
  cx = result.offsetWidth / lens.offsetWidth;
  cy = result.offsetHeight / lens.offsetHeight;
  /*set background properties for the result DIV:*/
  result.style.backgroundImage = "url('" + img.src + "')";
  result.style.backgroundSize = (img.width * cx) + "px " + (img.height * cy) + "px";
  /*execute a function when someone moves the cursor over the image, or the lens:*/
  lens.addEventListener("mousemove", moveLens);
  img.addEventListener("mousemove", moveLens);
  /*and also for touch screens:*/
  lens.addEventListener("touchmove", moveLens);
  img.addEventListener("touchmove", moveLens);

  img.parentElement.addEventListener("mouseenter", () => {
    lens.style.display = "block";
    result.style.display = "block";
  });

  img.parentElement.addEventListener("mouseleave", () => {
    lens.style.display = "none";
    result.style.display = "none";
  });

  function moveLens(e) {
    var pos, x, y;
    /*prevent any other actions that may occur when moving over the image:*/
    e.preventDefault();
    /*get the cursor's x and y positions:*/
    pos = getCursorPos(e);
    /*calculate the position of the lens:*/
    x = pos.x - (lens.offsetWidth / 2);
    y = pos.y - (lens.offsetHeight / 2);
    /*prevent the lens from being positioned outside the image:*/
    if (x > img.width - lens.offsetWidth) {x = img.width - lens.offsetWidth;}
    if (x < 0) {x = 0;}
    if (y > img.height - lens.offsetHeight) {y = img.height - lens.offsetHeight;}
    if (y < 0) {y = 0;}
    /*set the position of the lens:*/
    lens.style.left = x + "px";
    lens.style.top = y + "px";
    /*display what the lens "sees":*/
    result.style.backgroundPosition = "-" + (x * cx) + "px -" + (y * cy) + "px";
  }

  function getCursorPos(e) {
    var a, x = 0, y = 0;
    e = e || window.event;
    /*get the x and y positions of the image:*/
    a = img.getBoundingClientRect();
    /*calculate the cursor's x and y coordinates, relative to the image:*/
    x = e.pageX - a.left;
    y = e.pageY - a.top;
    /*consider any page scrolling:*/
    x = x - window.pageXOffset;
    y = y - window.pageYOffset;
    return {x : x, y : y};
  }
}
