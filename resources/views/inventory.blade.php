<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Inventory</title>
</head>

<body>
    <div class="container">
        <h1>Inventory</h1>
        <div class="row">
            <div class="col-md-6">
                <form action="/products" method="POST" id="inventoryForm" class="p-2 bg-light shadow-sm">
                    @csrf()
                    @method('POST')
                    <h2>Add Items</h2>
                    <div class="mb-3">
                        <label for="product_name" class="form-label">Product name</label>
                        <input type="text" class="form-control" id="product_name" name="product_name"
                            placeholder="Enter product name">
                    </div>
                    <div class="mb-3">

                        <label for="quantity_in_stock" class="form-label">Quantity in stock</label>
                        <input type="number" class="form-control" id="quantity_in_stock" name="quantity_in_stock"
                            placeholder="Quantity In Stock">
                    </div>

                    <div class="mb-3">

                        <label for="price_per_item" class="form-label">Price per item</label>
                        <input type="number" class="form-control" id="price_per_item" name="price_per_item"
                            placeholder="$">
                    </div>

                    <button type="submit" class="btn btn-lg btn-dark">Add</button>
                </form>

            </div>
        </div>
    </div>
    <script>
        window.addEventListener('DOMContentLoaded', () => {
            const inventoryForm = document.getElementById('inventoryForm');

            inventoryForm.addEventListener('submit', (evt) => {
                evt.preventDefault();

                let productName = inventoryForm[0].value;
                let quantityInStock = inventoryForm[1].value;
                let pricePerItem = inventoryForm[2].value

                let data = {
                    product_name: productName,
                    quantity_in_stock: quantityInStock,
                    price_per_item: pricePerItem
                }


                postData("http://localhost:8000/products", data).then((data) => {
                    console.log(data); // JSON data parsed by `data.json()` call
                });

            })
        })


        // Source: MDN - Mozilla Developer Network
        async function postData(url = "", data = {}) {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            // Default options are marked with *
            const response = await fetch(url, {
                method: "POST", // *GET, POST, PUT, DELETE, etc.
                mode: "cors", // no-cors, *cors, same-origin
                cache: "no-cache", // *default, no-cache, reload, force-cache, only-if-cached
                credentials: "same-origin", // include, *same-origin, omit
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": csrfToken
                },
                redirect: "follow", // manual, *follow, error
                referrerPolicy: "no-referrer", // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
                body: JSON.stringify(
                    data), // body data type must match "Content-Type" header
            });
            return response.json(); // parses JSON response into native JavaScript objects
        }
    </script>
</body>

</html>
