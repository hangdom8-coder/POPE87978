<!DOCTYPE html>
<html lang="km">
<head>
<meta charset="UTF-8">
<title>ក្បួនទស្សន៍ទាយលេខទូរស័ព្ទ</title>
<link rel="stylesheet" href="style.css"/>
<style>
@font-face{
    font-family:'Khmer OS Bokor';
    src:url('fonts/KhmerOSbokor.ttf') format('truetype');
}

/* Default English font */
body{
    font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    margin:0;
    background:url('bbu.jpg') no-repeat center center fixed;
    background-size:cover;
    color:#fff;
    padding-top:80px;
}

/* Khmer only */
:lang(km){
    font-family:'Khmer OS Bokor';
}

/* Dark overlay */
body::before{
    content:"";
    position:fixed;
    width:100%;
    height:100%;
    background:rgba(251, 28, 28, 0.6);
    z-index:-1;
}

.nav-action {
    display: flex;
    align-items: center;
}
.main-navbar {
    position: fixed;
    top: 0;
    width: 100%;
    z-index: 1000;
    backdrop-filter: blur(12px);
    background: rgba(255, 255, 255, 0);
    border-bottom: 1px solid rgba(255,255,255,0.1);
}

.nav-container {
    max-width: 1200px;
    margin: auto;
    padding: 15px 40px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.logo {
    font-size: 1.4em;
    font-weight: bold;
    color: #000000;
    letter-spacing: 1px;
}

.nav-links {
    display: flex;
    gap: 30px;
}

.nav-links a {
    text-decoration: none;
    color: #e0e0e0;
    font-weight: 500;
    transition: 0.3s;
    position: relative;
}

.nav-links a:hover {
    color: #00d4ff;
}

.nav-links a::after {
    content: "";
    position: absolute;
    left: 0;
    bottom: -5px;
    width: 0%;
    height: 2px;
    background: #00d4ff;
    transition: 0.3s;
}

.nav-links a:hover::after {
    width: 100%;
}

.nav-btn {
    background: linear-gradient(135deg, #ffffff, #6a11cb);
    padding: 8px 18px;
    border-radius: 20px;
    color: #ff0000;
    text-decoration: none;
    font-weight: bold;
    transition: 0.3s;
}

.nav-btn:hover {
    transform: scale(1.05);
    box-shadow: 0 5px 15px rgba(0,0,0,0.4);
}


/* Dropdown */
.dropdown {
    position: relative;
}

.dropdown-content {
    display: none;
    position: absolute;
    top: 100%;
    left: 0;
    background: rgba(255, 0, 0, 0.7);
    backdrop-filter: blur(10px);
    min-width: 180px;
    border-radius: 12px;
    box-shadow: 0 8px 25px rgba(225, 219, 219, 0.4);
    overflow: hidden;
    transition: all 0.3s ease;
    z-index: 1000;
}

.dropdown-content a {
    display: block;
    padding: 12px 18px;
    color: #e0e0e0;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s ease;
}

.dropdown-content a:hover {
    background: linear-gradient(135deg, #2575fc, #6a11cb);
    color: #fff;
}

.dropdown:hover .dropdown-content {
    display: block;
}


/* CARD */
.overlay{
    display:flex;
    justify-content:center;
    align-items:center;
    min-height:100vh;
}

.card{
    background:rgba(255,255,255,0.1);
    backdrop-filter:blur(12px);
    padding:40px;
    border-radius:20px;
    width:90%;
    max-width:600px;
    text-align:center;
}

/* Input */
input{
    width:80%;
    padding:12px;
    border:none;
    border-radius:10px;
    margin-top:15px;
}

/* Button */
button{
    padding:12px 25px;
    border:none;
    border-radius:10px;
    background:linear-gradient(135deg,#2575fc,#6a11cb);
    color:white;
    margin-top:15px;
    cursor:pointer;
}

/* Result */
.result{
    margin-top:20px;
    font-size:20px;
    color:#00ffff;
}
.result{
    margin-top:25px;
    padding:20px;
    border-radius:12px;
    background:rgba(0,0,0,0.4);
    backdrop-filter:blur(10px);
    font-size:18px;
    line-height:1.6;
}

/* Good result */
.good{
    color:#00ffcc;
    font-weight:bold;
}

/* Normal result */
.normal{
    color:#ffd166;
    font-weight:bold;
}

/* Bad result */
.bad{
    color:#ff6b6b;
    font-weight:bold;
}
</style>
</head>
<body>
   

<div class="overlay">
    <div class="card">
        <h1><span lang="km"><div class="logo">ក្បួនទស្សន៍ទាយលេខទូរស័ព្ទ</div></span></h1>
        <form method="post">
            <input type="tel"
                name="phone"
                placeholder="បញ្ចូលលេខទូរស័ព្ទ"
                maxlength="10"
                onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                oninput="this.value=this.value.replace(/[^0-9]/g,'')"
                value="<?= isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : '' ?>">
            <button type="submit">គណនា</button>
        </form>

        <div class="result">
        <?php
        if(isset($_POST['phone'])){
            $phone = $_POST['phone'];
            if(!ctype_digit($phone)){
                echo "<span style='color:red'>សូមបញ្ចូលលេខតែប៉ុណ្ណោះ!</span>";
            } else if(strlen($phone) < 6){
                echo "<span style='color:red'>លេខត្រូវមានយ៉ាងហោចណាស់ 6 ខ្ទង់!</span>";
            } else{
                $lastSix = substr($phone, -6);
                $divide = $lastSix / 80;
                $decimal = $divide - floor($divide);
                $final = round($decimal * 80);
                if($final == 0){ $final = 80; }
                echo "<h3>លទ្ធផលលេខ</h3>";
                echo "លេខទស្សន៍ទាយ: <span class='good'>$final</span><br><br>";
                $messages = [
                    1=>"ល្អណាស់ = រីកចម្រើន និងជ័យជំនះ",
                    2=>"ធម្មតា = មានលាភមធ្យម",
                    3=>"ល្អណាស់ = សម្រេចដូចបំណង",
                    4=>"អាក្រក់ = ឧបសគ្គច្រើន",
                    5=>"ល្អណាស់ = កិត្តិយស និងផលប្រយោជន៍",
                    6=>"ល្អណាស់ = សំណាងធំ",
                    7=>"ល្អ = ជោគជ័យធំ",
                    8=>"ល្អ = មានឱកាសល្អ",
                    9=>"អាក្រក់ = ឯកោ ពិបាក",
                    10=>"អាក្រក់ = ខិតខំឥតផល",

                    11=>"ល្អ = មានលំនឹងល្អ",
                    12=>"អាក្រក់ = ទន់ខ្សោយ",
                    13=>"ល្អណាស់ = សំណាងល្អ",
                    14=>"ធម្មតា = ពឹងផ្អែកលើការតាំងចិត្ត",
                    15=>"ល្អ = ជ័យជំនះច្រើន",
                    16=>"ល្អណាស់ = សម្រេចកិច្ចការធំ",
                    17=>"ល្អ = មានអ្នកធំជួយ",
                    18=>"ល្អ = រីកចម្រើន",
                    19=>"អាក្រក់ = ទំនាស់ច្រើន",
                    20=>"អាក្រក់ = ឧបសគ្គ និងឈឺចាប់",

                    21=>"ល្អ = ធ្វើការល្អ",
                    22=>"អាក្រក់ណាស់ = ខាតបង់",
                    23=>"ល្អណាស់ = កិត្តិយសធំ",
                    24=>"ល្អ = ពឹងលើសមត្ថភាពខ្លួន",
                    25=>"ល្អណាស់ = មានអ្នកជួយ",
                    26=>"អាក្រក់ណាស់ = ឧបសគ្គច្រើន",
                    27=>"ល្អ = សំណាង និងជ័យជំនះ",
                    28=>"ល្អណាស់ = រាសីឡើងខ្ពស់",
                    29=>"អាក្រក់ = ល្អនិងអាក្រក់កើតព្រមគ្នា",
                    30=>"ល្អណាស់ = លាភសំណាង",

                    31=>"ល្អណាស់ = សំណាង និងជោគជ័យ",
                    32=>"ល្អ = មានប្រាជ្ញា",
                    33=>"អាក្រក់ណាស់ = ឧបសគ្គមិនចេះអស់",
                    34=>"ធម្មតា = ត្រូវមានលំនឹងចិត្ត",
                    35=>"អាក្រក់ = ជួបភាពលំបាក",
                    36=>"ល្អ = ឧបសគ្គក្លាយជាសំណាង",
                    37=>"ធម្មតា = មានកិត្តិយស តែពិបាកលាភ",
                    38=>"ល្អណាស់ = អនាគតភ្លឺស្វាង",
                    39=>"ធម្មតា = សំណាងមិនទៀង",
                    40=>"ល្អណាស់ = អនាគតល្អ",
                    41=>"អាក្រក់ = ខាតបង់",
                    42=>"ល្អ = អត់ធ្មត់នាំមកលាភ",
                    43=>"អាក្រក់ = ពិបាកសម្រេច",
                    44=>"ល្អ = រីកចម្រើន",
                    45=>"ល្អណាស់ = ឧបសគ្គមិនចេះអស់",
                    46=>"ល្អណាស់ = មានអ្នកជួយច្រើន",
                    47=>"ល្អណាស់ = កិត្តិយស និងទ្រព្យ",
                    48=>"ធម្មតា = មានឧបសគ្គ តែមានសំណាង",
                    49=>"ធម្មតា = មានឧបសគ្គ តែមានសំណាង",
                    50=>"ធម្មតា = លាភ និងឧបសគ្គមិនទៀង",

                    51=>"ល្អ = ខិតខំបានជោគជ័យ",
                    52=>"អាក្រក់ = សំណាងតែមានឧបសគ្គ",
                    53=>"ធម្មតា = ខិតខំប៉ុន្តែលទ្ធផលតិច",
                    54=>"អាក្រក់ = មើលល្អតែពិតមានបញ្ហា",
                    55=>"អាក្រក់ណាស់ = ឧបសគ្គ និងគ្រោះថ្នាក់",
                    56=>"ល្អ = អាចប្តូរវាសនា",
                    57=>"ធម្មតា = ឧបសគ្គច្រើន តែសំណាងក្រោយ",
                    58=>"អាក្រក់ = ពិបាកសម្រេចចិត្ត",
                    59=>"ធម្មតា = ចិត្តរវល់",
                    60=>"អាក្រក់ = ឧបសគ្គច្រើន",

                    61=>"អាក្រក់ = ស្មុគស្មាញ",
                    62=>"ល្អ = ទទួលផលប្រយោជន៍",
                    63=>"អាក្រក់ = ខិតខំឥតផល",
                    64=>"ល្អ = សំណាងធំ",
                    65=>"ធម្មតា = ខ្វះទំនុកចិត្ត",
                    66=>"ល្អណាស់ = សម្រេចជោគជ័យ",
                    67=>"ល្អ = ចាប់ឱកាសបានជោគជ័យ",
                    68=>"អាក្រក់ = ចាញ់ និងឧបសគ្គ",
                    69=>"អាក្រក់ = ខាតបង់",
                    70=>"ធម្មតា = ពឹងលើភាពក្លាហាន",

                    71=>"អាក្រក់ = បានហើយបាត់វិញ",
                    72=>"ល្អ = សុភមង្គល និងសំណាង",
                    73=>"ធម្មតា = ពិបាកជោគជ័យ",
                    74=>"ធម្មតា = ល្អនិងអាក្រក់",
                    75=>"អាក្រក់ = ខាតបង់ទ្រព្យ",
                    76=>"ល្អ = មានមនុស្សគាំទ្រ",
                    77=>"ធម្មតា = មិនអាចសម្រេចល្អ",
                    78=>"ធម្មតា = អនាគតមិនភ្លឺ",
                    79=>"អាក្រក់ = ខិតខំឥតប្រយោជន៍",
                    80=>"ល្អណាស់ = ជោគជ័យច្រើន"
                ];
                if(isset($messages[$final])){
                    $msg = $messages[$final];

                    if(strpos($msg,"ល្អណាស់") !== false || strpos($msg,"ល្អ") !== false){
                        echo "<span class='good'>$msg</span>";
                    }
                    else if(strpos($msg,"ធម្មតា") !== false){
                        echo "<span class='normal'>$msg</span>";
                    }
                    else{
                        echo "<span class='bad'>$msg</span>";
                }
                }
            }
        }
        ?>
        </div>
    </div>
</div>

</body>
</html>