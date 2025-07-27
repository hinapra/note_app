<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bootstrap Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <form class="row g-3">
            <div class="col-4">
                <input type="text" name="first_name" class="form-control" placeholder="Enter Name..." />
            </div>

            <div class="col-4">
                <input type="email" name="email" class="form-control" placeholder="Enter Email..." />
            </div>

            <div class="col-4">
                <input type="text" name="last_name" class="form-control" placeholder="Enter Last Name..." />
            </div>

            <div class="col-4">
                <select name="country" id="country" class="form-select">
                    <option value="">Select Country</option>
                    <option value="India">India</option>
                    <option value="Other">Other</option>
                </select>
            </div>

            <div class="col-4">
               <input type="text" name="state" class="form-control" placeholder="Enter state..." />
            </div>

            <div class="col-4">
               <input type="text" name="other_state" class="form-control" placeholder="Enter state..." />
            </div>

            <div class="col-4">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
   <script>
    document.addEventListener('change', function () {
        const countrySelect = document.getElementById('country');
       
            console.log(this.value); // Logs selected country when changed
       
    });
</script>

</body>
</html>
