
    var menuItems = {
        hot: [
          { id: 1, name: "เอสเพรสโซ (espresso)", image: "https://coffeepressthailand.com/wp-content/uploads/2020/10/Blog-%E0%B8%AB%E0%B8%A1%E0%B8%A7%E0%B8%942-%E0%B9%80%E0%B8%A1%E0%B8%99%E0%B8%B9%E0%B8%81%E0%B8%B2%E0%B9%81%E0%B8%9F_201007_4_resize.jpg" },
          { id: 2, name: "คาปูชิโน (cappuccino)", image: "https://coffeepressthailand.com/wp-content/uploads/2020/10/Blog-%E0%B8%AB%E0%B8%A1%E0%B8%A7%E0%B8%942-%E0%B9%80%E0%B8%A1%E0%B8%99%E0%B8%B9%E0%B8%81%E0%B8%B2%E0%B9%81%E0%B8%9F_201007_1_resize.jpg" },
          { id: 3, name: "ลาเต้ (Latte)", image: "https://coffeepressthailand.com/wp-content/uploads/2020/10/coffeelatte_resize.jpg" },
          { id: 4, name: "มอคค่า (Mocha)", image: "https://coffeepressthailand.com/wp-content/uploads/2020/10/Blog-%E0%B8%AB%E0%B8%A1%E0%B8%A7%E0%B8%942-%E0%B9%80%E0%B8%A1%E0%B8%99%E0%B8%B9%E0%B8%81%E0%B8%B2%E0%B9%81%E0%B8%9F_201007_5_resize.jpg" },
          { id: 5, name: "อเมริกาโน (Americano)", image: "https://coffeepressthailand.com/wp-content/uploads/2020/10/88984090_638301056740708_3188132572890660864_n_resize.jpg" },
          { id: 6, name: "แมคเคียโต้ (Macchiato)", image: "https://coffeepressthailand.com/wp-content/uploads/2020/10/Macchiato_resize.jpg" }
        ],
        cold: [
          { id: 7, name: "ชาไทย", image: "https://inwfile.com/s-gf/2vtp7m.jpg" },
          { id: 8, name: "ชาเขียวเย็น", image: "https://www.bluemochatea.com/wp-content/uploads/2019/12/%E0%B8%8A%E0%B8%B2%E0%B9%80%E0%B8%82%E0%B8%B5%E0%B8%A2%E0%B8%A7%E0%B8%9F%E0%B8%AD%E0%B8%87%E0%B8%99%E0%B8%A1.jpg" },
          { id: 9, name: "แดงมะนาวโซดา", image: "https://d.line-scdn.net/lcp-prod-photo/20210806_101/1628224818855UVqSU_JPEG/DPOIVEUKCEGS3HQCG49MCLM1K80SYZ.jpeg" },
          { id: 10, name: "ลาเต้เย็น", image: "https://s359.kapook.com/pagebuilder/95bcea87-d77c-4236-9cb2-39229c61b15c.jpg" },
          { id: 11, name: "คาปูชิโน่เย็น", image: "https://d.line-scdn.net/lcp-prod-photo/20210817_260/16291706207376Gqcz_JPEG/BGW974YKFT5V0SLCY3FY5XAJHZ0AHU.jpg" },
          { id: 12, name: "น้ำผึ้งมะนาวโซดา", image: "https://f.ptcdn.info/040/069/000/q8z6znjot7q7zFo22uA-o.jpg" },
        ],
        smoothie: [
          { id: 13, name: "ช็อคโกแลตมูซส์ปั่น", image: "https://www.pholfoodmafia.com/wp-content/uploads/2018/03/HomemadeHotChocolateAdver-1200x718.jpg" },
          { id: 14, name: "อเมริกาโน่ปั่น", image: "https://img.salehere.co.th/p/600x0/2021/06/24/eaibyvoba3nr.jpg" },
          { id: 15, name: "คาปูชิโน่ปั่น", image: "https://bakerysw.com/wp-content/uploads/2021/09/Bluecup00011-scaled-1-1536x1536-1.jpg" },
          { id: 16, name: "ชาเขียวปั่น", image: "https://hilight.kapook.com/img_cms2/user/surauch/Test/erwrewwe4.jpg" },
          { id: 17, name: "ชาเย็นปั่น", image: "https://เมนู.net/media/images/recipe/%E0%B8%8A%E0%B8%B2%E0%B9%84%E0%B8%97%E0%B8%A2%E0%B8%9B%E0%B8%B1%E0%B9%88%E0%B8%99.jpg" },
          { id: 18, name: "มันม่วงลาเต้ปั่น ", image: "https://www.falconforprofessional.com/wp-content/uploads/2023/10/thumbnail_-_laaetmanmwng-scaled.jpg" }
        ]
      };
  
      var selectedItems = [];
  
      function displayMenu(menuType) {
        var menuList = document.getElementById("menuList");
        var items = menuItems[menuType] || [];
      
        // Clear previous menu items
        menuList.innerHTML = "";
      
        // Update styles for menuList
        menuList.style.display = "grid";
        menuList.style.gridTemplateColumns = "repeat(3, 1fr)";
        menuList.style.gap = "20px";
        menuList.style.justifyContent = "center";
      
        // Display the menu items with images
        items.forEach(function (item) {
          var menuItem = document.createElement("div");
          menuItem.classList.add("menu-item");
          menuItem.style.width = "250px"; // Adjust the width of the menu item
          menuItem.style.padding = "10px"; // Adjust the padding
          menuItem.style.backgroundColor = "#fff";
          menuItem.style.borderRadius = "8px";
          menuItem.style.boxShadow = "0 4px 8px rgba(0, 0, 0, 0.1)";
          menuItem.style.textAlign = "center";
          
          menuItem.addEventListener("click", function () {
            toggleSelectItem(item);
          });
      
          var image = document.createElement("img");
          image.src = item.image;
          image.alt = item.name;
          image.style.width = "100px"; // Make the image fill the container
          image.style.height = "100px";
          image.style.borderRadius = "5px";
          image.style.marginBottom = "10px";
          menuItem.appendChild(image);
      
          var itemName = document.createElement("div");
          itemName.textContent = item.name;
          menuItem.appendChild(itemName);
      
          menuList.appendChild(menuItem);
        });
      }
  
      function toggleSelectItem(item) {
        var index = selectedItems.findIndex(selectedItem => selectedItem.id === item.id);
  
        if (index === -1) {
          selectedItems.push(item);
        } else {
          selectedItems.splice(index, 1);
        }
  
        updateSelectedMenu();
      }
      // ... (previous code) ...
  
  function updateSelectedMenu() {
    var selectedMenuItem = document.getElementById("selectedMenuItem");
    selectedMenuItem.innerHTML = "";
  
    selectedItems.forEach(function (item) {
      var selectedItem = document.createElement("div");
      selectedItem.classList.add("selected-item");
  
      var image = document.createElement("img");
      image.src = item.image;
      image.alt = item.name;
      
      
      var itemName = document.createElement("div");
      itemName.textContent = item.name;
      itemName.style.color = "#333"; // Set text color
      itemName.style.fontWeight = "bold"; // Set font weight
      itemName.style.marginBottom = "5px"; // Add some margin
      itemName.style.fontSize = "10px";
      var quantityInput = document.createElement("input");
      quantityInput.type = "number";
      quantityInput.min = "1";
      quantityInput.value = "1";
      quantityInput.style.width = "50px"; // Adjust width
      quantityInput.addEventListener("change", function () {
        updateQuantity(item, parseInt(quantityInput.value));
      });
      var sweetnessSelect = document.createElement("select");
    sweetnessSelect.style.marginTop = "5px"; // Add margin at the top
    var sweetnessLevels = ["100%", "75%", "50%", "25%", "0%"];
    sweetnessLevels.forEach(function (level) {
      var option = document.createElement("option");
      option.value = level;
      option.text = level;
      sweetnessSelect.add(option);
    });
  
    // Add event listener for sweetness level change
    sweetnessSelect.addEventListener("change", function () {
      // Handle sweetness level change here
      alert("Sweetness level selected: " + sweetnessSelect.value);
    });
    var deleteButton = document.createElement("button");
    deleteButton.textContent = "Delete";
    deleteButton.addEventListener("click", function () {
      deleteSelectedItem(item);
    });
    deleteButton.style.backgroundColor = "#ff4747";
    deleteButton.style.color = "#fff";
    deleteButton.style.border = "none";
    deleteButton.style.padding = "3px 8px"; // Adjust the padding
    deleteButton.style.cursor = "pointer";
    deleteButton.style.fontSize = "12px"; // Adjust the font size
    
    var selectedItem = document.createElement("div");
    selectedItem.classList.add("selected-item");
    selectedItem.style.backgroundColor = "#f9f9f9"; // Set background color
    selectedItem.style.padding = "15px"; // Add padding
    selectedItem.style.borderRadius = "8px"; // Add border radius
    selectedItem.style.boxShadow = "0 4px 8px rgba(0, 0, 0, 0.1)"; // Add box shadow
    selectedItem.style.display = "flex"; // Set display to flex
    selectedItem.style.alignItems = "center"; // Align items in the center
    selectedItem.style.justifyContent = "space-between"; // Space between items
    
    selectedItem.appendChild(deleteButton);
      
      selectedItem.appendChild(image);
      selectedItem.appendChild(itemName);
      selectedItem.appendChild(quantityInput);
      selectedItem.appendChild(sweetnessSelect);
      selectedItem.appendChild(deleteButton);
      
      var selectedMenuItem = document.getElementById("selectedMenuItem");
      selectedMenuItem.appendChild(selectedItem);
      
    });
    var checkoutButton = document.createElement("button");
    checkoutButton.textContent = "Checkout";
    checkoutButton.style.backgroundColor = "#4CAF50"; // Green background color
    checkoutButton.style.color = "#fff"; // White text color
    checkoutButton.style.border = "none"; // Remove border
    checkoutButton.style.padding = "10px 20px"; // Adjust padding
    checkoutButton.style.fontSize = "16px"; // Set font size
    checkoutButton.style.marginTop = "20px"; // Add margin at the top
    checkoutButton.style.display = "block"; // Set display to block
    checkoutButton.style.margin = "0 auto"; // Set margin to auto for centering
    checkoutButton.addEventListener("click", function () {
      window.location.href = "../admin/order.html"; 
    });
  
    selectedMenuItem.appendChild(checkoutButton);
  
  }
  
  function deleteSelectedItem(item) {
    var index = selectedItems.findIndex(selectedItem => selectedItem.id === item.id);
  
    if (index !== -1) {
      selectedItems.splice(index, 1);
      updateSelectedMenu();
    }
  }
  
  function updateQuantity(item, quantity) {
    var selectedItem = selectedItems.find(selectedItem => selectedItem.id === item.id);
  
    if (selectedItem) {
      selectedItem.quantity = quantity;
      updateSelectedMenu();
    }
  }
  