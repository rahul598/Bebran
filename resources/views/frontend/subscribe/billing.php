<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link href="style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Billing and Cart</title>
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
        body {
            font-family:"poppins";\
            background:#f2f2f2 !important;
            margin: 0;
            padding: 0;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            padding: 20px;
            gap: 20px;
        }
        .form-group select{
            border: 1px solid #062c6d;
    width: 100%;
    padding: 15px;
    border-radius: 10px;
}
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Left Box: Billing Details -->
        <div class="left-box">
            <div class="top-head left-head">
                <img src="./images/online-pay-svgrepo-com.png" alt="abc">
                <h2>Billing Details</h2>
            </div>
            <div class="form-box">
                <form>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="first-name">First Name<span>*</span></label>
                            <input type="text" id="first-name" name="first-name">
                        </div>
                        <div class="form-group">
                            <label for="last-name">Last Name<span>*</span></label>
                            <input type="text" id="last-name" name="last-name">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="phone">Phone<span>*</span></label>
                            <input type="text" id="phone" name="phone">
                        </div>
                        <div class="form-group">
                            <label for="email">Email<span>*</span></label>
                            <input type="email" id="email" name="email">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="business-name">Business Name(Optional)</label>
                            <input type="text" id="business-name" name="business-name">
                        </div>
                        <div class="form-group">
                            <label for="gstin">GSTIN<span>*</span></label>
                            <input type="text" id="gstin" name="gstin">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="country">Country/Religion<span>*</span></label>
    <select id="country" onchange="updateStates()">
        <option value="">Select Country</option>
    </select>
                        </div>
                        <div class="form-group">
                           <label for="state">State<span>*</span></label>
    <select id="state" onchange="updateCities()">
        <option value="">Select State</option>
    </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="address1">Address 1<span>*</span></label>
                            <input type="text" id="address1" name="address1">
                        </div>
                        <div class="form-group">
                            <label for="address2">Address 2<span>*</span></label>
                            <input type="text" id="address2" name="address2">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="city">City<span>*</span></label>
    <select id="city">
        <option value="">Select City</option>
    </select>
                        </div>
                        <div class="form-group">
                            <label for="zip-code">Zip Code<span>*</span></label>
                            <input type="text" id="zip-code" name="zip-code">
                        </div>
                    </div>
                    <button type="submit" class="next-button">Next</button>
                </form>
            </div>
        </div>

        <!-- Right Box: Cart Summary -->
        <div class="cart-container">
            <div class="top-head">
                <h2>Cart</h2>
            </div>
            <div class="cart-item">
                <div class="item-image">
                    <span class="item-quantity">1</span>
                    <img src="placeholder.png" alt="SEO Plan">
                </div>
                <div class="item-info">
                    <p class="item-title">SEO Plan</p>
                    <button class="remove-button">Remove</button>
                </div>
                <div class="item-price">Rs16,200</div>
            </div>
            <div class="cart-item">
                <div class="item-image">
                    <span class="item-quantity">1</span>
                    <img src="placeholder.png" alt="Addons">
                </div>
                <div class="item-info">
                    <p class="item-title">Addons</p>
                    <button class="remove-button">Remove</button>
                </div>
                <div class="item-price">Rs20,000</div>
            </div>
           
            <hr class="divider1">
          
            <div class="cart-summary">
                <div class="summary-item">
                    <p>Subtotal</p>
                    <h5>Rs36,200</h5>
                </div>
                <div class="summary-item">
                    <p>Discount</p>
                    <p>Rs0.00</p>
                </div>
                <hr class="divider">
                <div class="total">
                    <h5>Total</h5>
                    <h5>Rs36,200</h5>
                </div>
            </div>
            <button class="confirm-button">Confirm</button>
        </div>

    </div>
    <script>
        window.onload = function() {
    populateCountries();
};

async function populateCountries() {
    const countrySelect = document.getElementById("country");

    try {
        // Fetch countries from the CountriesNow API
        const response = await fetch('https://countriesnow.space/api/v0.1/countries/positions');
        const data = await response.json();

        data.data.forEach(country => {
            const option = document.createElement("option");
            option.value = country.name;
            option.text = country.name;
            countrySelect.appendChild(option);
        });
    } catch (error) {
        console.error("Error fetching countries:", error);
    }
}

async function updateStates() {
    const countrySelect = document.getElementById("country");
    const stateSelect = document.getElementById("state");
    const citySelect = document.getElementById("city");

    stateSelect.innerHTML = '<option value="">Select State</option>';
    citySelect.innerHTML = '<option value="">Select City</option>';

    const selectedCountry = countrySelect.value;
    if (selectedCountry) {
        try {
            // Fetch states for the selected country
            const response = await fetch('https://countriesnow.space/api/v0.1/countries/states', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ country: selectedCountry })
            });
            const data = await response.json();

            data.data.states.forEach(state => {
                const option = document.createElement("option");
                option.value = state.name;
                option.text = state.name;
                stateSelect.appendChild(option);
            });
        } catch (error) {
            console.error("Error fetching states:", error);
        }
    }
}

async function updateCities() {
    const countrySelect = document.getElementById("country");
    const stateSelect = document.getElementById("state");
    const citySelect = document.getElementById("city");

    citySelect.innerHTML = '<option value="">Select City</option>';

    const selectedCountry = countrySelect.value;
    const selectedState = stateSelect.value;
    if (selectedState) {
        try {
            // Fetch cities for the selected state
            const response = await fetch('https://countriesnow.space/api/v0.1/countries/state/cities', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ country: selectedCountry, state: selectedState })
            });
            const data = await response.json();

            data.data.forEach(city => {
                const option = document.createElement("option");
                option.value = city;
                option.text = city;
                citySelect.appendChild(option);
            });
        } catch (error) {
            console.error("Error fetching cities:", error);
        }
    }
}

    </script>
</body>

</html>
