<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Electricity Bill Calculator</title>

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .calculator-card {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
        }
        h2 { text-align: center; color: #333; }
        label { font-weight: bold; margin-top: 10px; display: block; color: #555; }
        
        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            -moz-appearance: textfield; 
        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s;
        }
        button:hover { background-color: #0056b3; }

        .receipt {
            margin-top: 20px;
            padding: 15px;
            background-color: #e9ecef;
            border-left: 5px solid #28a745;
            border-radius: 4px;
        }
    </style>
</head>
<body>

    <div class="calculator-card">
        <h2>Electric Bill Calculator</h2>

        <form method="POST" onsubmit="return validateForm()">
            <label>Previous Number (Kw):</label>
            <input type="number" id="oldnum" name="oldnum" min="0" required 
                   value="<?php echo isset($_POST['oldnum']) ? $_POST['oldnum'] : ''; ?>">

            <label>Current Number (Kw):</label>
            <input type="number" id="newnum" name="newnum" min="0" required 
                   value="<?php echo isset($_POST['newnum']) ? $_POST['newnum'] : ''; ?>">

            <button type="submit" name="calculate">Calculate Bill</button>
        </form>

        <?php
        if (isset($_POST['calculate'])) {
            $oldnum = $_POST['oldnum'];
            $newnum = $_POST['newnum'];
            
            $last = $newnum - $oldnum;

            if ($last <= 10) {
                $total = $last * 700;
            } elseif ($last <= 20) {
                $total = $last * 800;
            } elseif ($last <= 30) {
                $total = $last * 900;
            } else {
                $total = $last * 1000;
            }

            $formatMoney = number_format($total, 2, '.', ',');

            echo "<div class='receipt'>";
            echo "<strong>Previous Number:</strong> " . $oldnum . " Kw<br>";
            echo "<strong>Current Number:</strong> " . $newnum . " Kw<br>";
            echo "<strong>You have been used :</strong> " . $last . " Kw<br><hr>";
            echo "<h3 style='margin:10px 0 0 0; color:#28a745;'>Total Payment: " . $formatMoney . " ៛</h3>";
            echo "</div>";
        }
        ?>
    </div>

    <script>
        function validateForm() {
            let oldnum = parseFloat(document.getElementById('oldnum').value);
            let newnum = parseFloat(document.getElementById('newnum').value);

            if (newnum < oldnum) {
                alert("Error៖ The new number cannot be smaller than the old number.!");
                return false;
            }
            return true;
        }
    </script>

</body>
</html>