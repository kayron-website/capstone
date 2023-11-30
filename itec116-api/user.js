fetch("http://localhost/itec116-api/products")
  // Converting received data to JSON
  .then((response) => response.json())
  .then((json) => {
    
  // 2. Create a variable to store HTML table headers
    let li = '<tr><th>ID</th><th>Name</th><th>Amount</th><th>Month</th> <th>Week</th></tr>';

    // 3. Loop through each data and add a table row
    json.forEach((user) => {
      li += `<tr>
        <td>${user.id}</td>
        <td>${user.name} </td>
        <td>${user.category}</td>
        <td>${user.price}</td>
        <td>${user.qty}</td>
      </tr>`;
    });

    // 4. DOM Display result
    document.getElementById("users").innerHTML = li;
  });

// main.js

// 5. POST request using fetch()
fetch("https://jsonplaceholder.typicode.com/posts", {
  // 6. Adding method type
  method: "POST",

  // 7. Adding body or contents to send JSON Stringify
  body: JSON.stringify({
    title: "foo",
    body: "bar",
    userId: 1
  }),

  // 8. Adding headers to the request
  headers: {
    "Content-type": "application/json; charset=UTF-8"
  }
})
  // 9. Converting to JSON
  .then((json) => console.log(json));