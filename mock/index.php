<!DOCTYPE html>
<html lang="en">
<head>
    <title>MedTracker</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://unpkg.com/html5-qrcode"></script> <!-- QR code scanning library -->
    <style>
        body {
            background-color: #e5d9d9; /* Soft neutral background */
            font-family: Arial, sans-serif;
            color: #333; /* Dark gray for text */
        }

        .top-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            background: rgba(192, 192, 192, 0.8); /* Semi-transparent background */
            border-radius: 15px; /* Rounded edges */
            margin-bottom: 20px; /* Space between header and content */
        }

        .brand-name {
            font-size: 24px;
            color: white; /* White text */
        }

        .navigation {
            display: flex;
            gap: 20px; /* Space between links */
        }

        .navigation a {
            text-decoration: none;
            color: white; /* White links */
            font-size: 18px;
        }

        .bell-icon {
            font-size: 24px;
            color: white; /* White bell icon */
            cursor: pointer;
        }

        .content {
            display: flex;
            justify-content: space-between; /* Spread content horizontally */
            padding: 20px;
        }

        .scanner-container {
            flex: 1; /* Allow QR scanner to grow */
            display: flex;
            flex-direction: column; /* Stack vertically */
            justify-content: center;
            align-items: center; /* Centered QR scanner */
        }

        .med-details {
            flex: 1; /* Allow equal space for medicine details */
            padding-left: 40px; /* Space between scanner and form */
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .btn-primary {
            background-color: #2980b9;
            border: none;
            border-radius: 4px;
            color: white; /* White button text */
            padding: 10px 15px;
            cursor: pointer;
        }

        .btn-primary:hover {
            background-color: #216a94; /* Darker shade on hover */
        }
    </style>
</head>
<body>
    <div class="top-container">
        <div class="brand-name">MedTracker</div>
        <div class="navigation">
            <a href="#">Home</a>
            <a href="#">Contact</a>
            <a href="#">Family History</a>
        </div>
        <div class="bell-icon">
            <i class="fas fa-bell"></i> <!-- Bell icon for notifications -->
        </div>
    </div>

    <div class="content">
        <!-- QR code scanner -->
        <div class="scanner-container">
            <div id="reader" style="width: 500px; height: 300px;"></div> <!-- Adjust width and height -->
        </div>

        <!-- Medicine details and form -->
        <div class="med-details">
            <h5>MedTracker</h5> <!-- Simplified header -->
            <h3>Medicine Detail:</h3>
            <form id="medicineForm" action="insert.php" method="post">
                <textarea name="start" class="input" id="result" rows="10" cols="40" readonly></textarea>
                <input type="hidden" name="name" id="name">
                <input type="hidden" name="dom" id="dom">
                <input type="hidden" name="doe" id="doe">
                <button type="button" id="saveMedicineBtn" class="btn-primary">Save Medicine</button>
            </form>
        </div>
    </div>

    <script>
        function onScanSuccess(qrCodeMessage) {
            document.getElementById("result").value = qrCodeMessage;
            var parts = qrCodeMessage.split("\n");
            var name = "", dom = "", doe = "";

            parts.forEach(part => {
                var [key, value] = part.split(":");
                key = key.trim().toLowerCase();

                if (key === "name") name = value.trim();
                if (key === "dom") dom = value.trim();
                if (key === "doe") doe = value.trim();
            });

            document.getElementById("name").value = name;
            document.getElementById("dom").value = dom;
            document.getElementById("doe").value = doe;
        }

        var html5QrcodeScanner = new Html5QrcodeScanner(
            "reader", {
                fps: 10,
                qrbox: 220
            }
        );

        html5QrcodeScanner.render(onScanSuccess, function (errorMessage) {
            console.error("Scan error:", errorMessage); // Handle scan error
        });

        document.getElementById("saveMedicineBtn").addEventListener("click", function () {
            document.getElementById("medicineForm").submit(); // Submit the form
        });
    </script>
</body>
</html>
