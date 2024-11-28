function showDetails(menuID) {
    var menuItem = document.querySelector('.menu-item-' + menuID);
    var menuName = menuItem.querySelector('h2').innerText;
    var menuPriceElement = menuItem.querySelector('.menu-price p.price');
    var menuPrice = parseFloat(menuPriceElement.innerText.replace('ราคา: ฿', ''));
    var menuImage = menuItem.querySelector('.menu-img img').src;
    var menuDetail = document.getElementById('menu-details');

    // Check if the menu item already exists in menu-details
    var existingMenuItems = menuDetail.querySelectorAll('.menu-item');
    for (var i = 0; i < existingMenuItems.length; i++) {
        var existingMenuID = existingMenuItems[i].getAttribute('data-menu-id');
        if (existingMenuID === menuID.toString()) {
            alert('รายการเมนูนี้อยู่ในตระกร้าแล้ว');
            return; // Exit the function if the menu item already exists
        }
    }

    var newDetails = "<div class='menu-item' data-menu-id='" + menuID + "' style=' padding: 10px; margin-bottom: 10px; display: flex; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);'>"+
    "<div style='flex-grow: 1;'>" +
    "<h4 style='margin: 0; display: flex; justify-content: space-between;'>" + menuName + "<span id='menu-price-" + menuID + "'>" + menuPrice.toFixed(2) + " ฿</span></h4>"+
    "<label for='quantity' style='margin-right: 5px;'>จำนวน:</label>" + 
    "<input type='number' id='quantity' name='quantity' value='1' min='1' style='width: 50px;'> แก้ว<br>" +
    "<label for='type' style='margin-right: 5px; margin-top: 5px;'>ประเภท:</label>" +
    "<select id='type' name='type' style='margin-top: 5px;'>" +
    "<option value='ร้อน'>ร้อน</option>" +
    "<option value='เย็น'>เย็น + 5 บาท</option>" +
    "<option value='ปั่น'>ปั่น + 10 บาท</option>" +
    "</select><br>" +
    "<label for='sweet-option' style='margin-right: 5px; margin-top: 5px;'>เลือกความหวาน:</label>" +
    "<select id='sweet-option' name='sweet-option' style='margin-top: 5px;'>" +
    "<option value='100%'>100%</option>" +
    "<option value='75%'>75%</option>" +
    "<option value='50%'>50%</option>" +
    "<option value='25%'>25%</option>" +
    "<option value='0%'>0%</option>" +
    "</select><br>" +
    "<button onclick='deleteMenu(" + menuID + ")' style='background-color: #f44336; color: white; border: none; padding: 5px 10px; border-radius: 5px; cursor: pointer; margin-top: 5px;'>ลบเมนู</button>" +
    "</div>" +
    "</div>";

    menuDetail.innerHTML += newDetails;
}

    function deleteMenu(menuID) {
        var menuDetail = document.getElementById('menu-details');
        var menuToDelete = menuDetail.querySelector("[data-menu-id='" + menuID + "']");
        menuToDelete.remove();  
    }
    function insertMenu(menuID, quantity, type, sweetOption) {
        if (!isNaN(quantity) && quantity > 0) {
            var url = "insert_order.php"; // Change this to the actual file handling the insertion.
            var data = {
                orderID: orderID, // Include the orderID
                menuID: menuID,
                quantity: quantity,
                type: type,
                sweetOption: sweetOption,
            };
    
            fetch(url, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify(data),
            })
            .then(response => response.json())
            .then(data => {
            })
            .catch(error => {
                console.error("Error:", error);
                alert("Error inserting order. Please try again.");
            });
        } else {
            alert("ปริมาณไม่ถูกต้อง กรุณากรอกตัวเลขที่ถูกต้อง.");
        }
    }
    
    function checkout() {
        // Get the menu details container
        var menuDetailsContainer = document.getElementById('menu-details');
    
        // Get all details elements with class 'menu-item'
        var menuItems = menuDetailsContainer.querySelectorAll('.menu-item');
    
        // Check if there are any menu details
        if (menuItems.length > 0) {
            // Counter for the number of items
            var itemCount = 0;
    
            // Check if orderID is defined
            if (typeof orderID !== 'undefined' && orderID !== null && orderID !== '') {
                // Loop through each menu details element and perform checkout (insert into database)
                menuItems.forEach(function (menuDetails) {
                    var menuID = menuDetails.getAttribute('data-menu-id');
                    var quantityInput = menuDetails.querySelector('#quantity');
                    var typeSelect = menuDetails.querySelector('#type');
                    var sweetSelect = menuDetails.querySelector('#sweet-option');
                    var quantity = quantityInput.value;
                    var type = typeSelect.value;
                    var sweetOption = sweetSelect.value;
    
                    // Call the insertMenu function for each menu details element
                    insertMenu(menuID, quantity, type, sweetOption);
    
                    // Increment the item count
                    itemCount++;
                });
    
                // Display success message based on the number of items
                if (itemCount === 1) {
                    alert("เพิ่มคำสั่งซื้อสำเร็จ.");
                } else {
                    alert("เพิ่มคำสั่งซื้อทั้งหมดสำเร็จ");
                }
    
                // Optionally, you can clear the displayed menu details after checkout
                menuDetailsContainer.innerHTML = "";
            } else {
                // If orderID is not defined, prompt the user to select a valid order
                alert("โปรดเลือกใบสั่งซื้อก่อนดำเนินการชำระเงิน");
            }
        } else {
            alert("ไม่มีรายการที่จะชำระเงิน เพิ่มรายการในคำสั่งซื้อของคุณก่อน");
        }
    }
    