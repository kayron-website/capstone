// Function to show the add form
function showAddForm() {
  document.getElementById("formContainer").style.display = "block";
}

// Function to handle form submission (add/update)
function submitForm() {
  const productName = document.getElementById("productName").value;
  const productCategory = document.getElementById("productCategory").value;
  const productPrice = document.getElementById("productPrice").value;
  const productQuantity = document.getElementById("productQuantity").value;

  const formData = {
    name: productName,
    category: productCategory,
    price_per_unit: parseFloat(productPrice),
    quantity: parseInt(productQuantity)
  };

  // Simulate an API POST request to add a new product
  fetch("http://localhost/itec116-api/products", {
    method: "POST",
    body: JSON.stringify(formData),
    headers: {
      "Content-type": "application/json; charset=UTF-8"
    }
  })
  .then(response => response.json())
  .then(data => {
    // Once the product is added, hide the form and refresh the table
    document.getElementById("formContainer").style.display = "none";
    refreshTable();
  })
  .catch(error => {
    console.error('Error adding product:', error);
  });
}

// Function to handle delete for each row
function deleteProduct(productId) {
  // Simulate an API DELETE request to delete a product
  fetch(`http://localhost/itec116-api/products/${productId}`, {
    method: "DELETE"
  })
  .then(response => {
    // Once the product is deleted, refresh the table
    refreshTable();
  })
  .catch(error => {
    console.error('Error deleting product:', error);
  });
}

// Function to refresh the table (fetch updated data and re-render the table)
function refreshTable() {
  // Fetch updated product data from the API
  fetch("http://localhost/itec116-api/products")
    .then(response => response.json())
    .then(products => {
      // Generate the HTML for the table based on the fetched product data
      let tableHTML = '<tr><th>ID</th><th>Name</th><th>Category</th><th>Price per Unit</th><th>Quantity</th><th>Actions</th></tr>';
      products.forEach(product => {
        tableHTML += `<tr>
          <td>${product.id}</td>
          <td>${product.name}</td>
          <td>${product.category}</td>
          <td>${product.price_per_unit}</td>
          <td>${product.quantity}</td>
          <td>
            <button onclick="showUpdateForm(${product.id})">Update</button>
            <button onclick="deleteProduct(${product.id})">Delete</button>
          </td>
        </tr>`;
      });

      // Update the HTML table with the new data
      document.getElementById("users").innerHTML = tableHTML;
    })
    .catch(error => {
      console.error('Error fetching data:', error);
    });
}

// Function to show the update form
function showUpdateForm(productId) {
  // Fetch product details by ID and populate the form for updating
  fetch(`http://localhost/itec116-api/products/${productId}`)
    .then(response => response.json())
    .then(product => {
      document.getElementById("productName").value = product.name;
      document.getElementById("productCategory").value = product.category;
      document.getElementById("productPrice").value = product.price_per_unit;
      document.getElementById("productQuantity").value = product.quantity;

      // Display the form for updating
      document.getElementById("formContainer").style.display = "block";
    })
    .catch(error => {
      console.error('Error fetching product details:', error);
    });
}

// Load the table data when the page loads
refreshTable();
