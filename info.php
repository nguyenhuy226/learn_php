<?php
// bài 1
// hàm để tìm tổng, hiệu, tích và thương của hai số nguyên và in kết quả ra màn hình.
function resultsOfCalculations($number1, $number2, $cal)
{
    if (is_int($number1) && is_int($number2)) {
        switch ($cal) {
            case '+':
                echo "Tổng của hai số  là: " . $number1 + $number2 . "</br>";
                break;
            case "-":
                echo "Hiệu của hai số  là: " . $number1 - $number2 . "</br>";
                break;
            case '*':
                echo "Tích của hai số  là: " . $number1 * $number2 . "</br>";
                break;
            case "/":
                echo "Thương của hai số  là: " . $number1 / $number2 . "</br>";
                break;
            default:
                echo "nhập phép tính không hợp lệ";
        }
    } else {
        echo "cần nhập đúng kiểu dữ liệu là số nguyên";
    }
}
resultsOfCalculations(3, 5, '*');


// bài 2
// Hàm để nhập số nguyên từ bàn phím
function getIntInput($prompt)
{
    echo $prompt;
    $handle = fopen("php://stdin", "r");
    $input = trim(fgets($handle));
    fclose($handle);

    // Kiểm tra xem giá trị nhập vào có phải là số nguyên không
    if (!is_numeric($input) || intval($input) != $input) {
        echo "Giá trị nhập vào không phải là số nguyên. Vui lòng thử lại.\n";
        return getIntInput($prompt); // Nhập lại nếu không phải số nguyên
    }

    return intval($input);
}

// Hàm để tính tổng và trung bình của hai số nguyên
function calculateSumAndAverage()
{
    // Nhập hai số nguyên từ bàn phím
    $num1 = getIntInput("Nhập số nguyên thứ nhất: ");
    $num2 = getIntInput("Nhập số nguyên thứ hai: ");

    // Tính tổng
    $sum = $num1 + $num2;

    // Tính trung bình
    $average = $sum / 2;

    // In ra màn hình tổng và trung bình
    echo "Tổng của $num1 và $num2 là: $sum\n";
    echo "Trung bình của $num1 và $num2 là: $average\n";
}

// Gọi hàm để thực hiện công việc
// calculateSumAndAverage();

// bài 3
function findTheFinalVelocity($initialVelocity, $acceleration, $time)
{
    if (is_numeric($initialVelocity) && is_numeric($acceleration) && is_numeric($time)) {
        $finalVelocity =  $initialVelocity + $acceleration * $time;
        echo "Vận tốc cuối cùng là: " . $finalVelocity . "m/s";
    } else {
        echo "cần nhập đúng kiểu dữ liệu là số ";
    }
}
findTheFinalVelocity(3, 5, 9);
echo '<br>';

//bài 4 
echo "<form action='' method='post'>
<label for='d'>Nhập biểu thức:</label>
<input type='text' id='d' name='bieuthuc' required><br><br>
<input type='submit' value='Tính toán'>
</form>";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bieuthuc = str_replace(' ', '', $_POST['bieuthuc']);
    $patternOperator = '/[\-\+\*\/]/';
    preg_match_all($patternOperator, $bieuthuc, $matches);
    $arrayOperator = $matches[0];
    $patternNumber = '/[\-\+\*\/]/';
    $arrayNumber = preg_split($patternNumber, $bieuthuc);
    function expression()
    {
        global $arrayOperator;
        global $arrayNumber;

        if (count($arrayOperator) == 0) {
            echo "Kết quả của biểu thức là: " . $arrayNumber[0];
            return;
        }

        // Trường hợp có nhân chia
        if (in_array("*", $arrayOperator) || in_array("/", $arrayOperator)) {
            for ($i = 0; $i < count($arrayOperator); $i++) {
                if ($arrayOperator[$i] == '*') {
                    $result = $arrayNumber[$i] * $arrayNumber[$i + 1];
                } elseif ($arrayOperator[$i] == '/') {
                    $result = $arrayNumber[$i] / $arrayNumber[$i + 1];
                } else {
                    continue;
                }

                // Cập nhật mảng số và toán tử
                $arrayNumber[$i] = $result;
                unset($arrayNumber[$i + 1]);
                $arrayNumber = array_values($arrayNumber);
                unset($arrayOperator[$i]);
                $arrayOperator = array_values($arrayOperator);

                // Gọi đệ quy để tiếp tục xử lý
                expression();

                return;
            }
        } else {
            // Trường hợp chỉ có cộng trừ
            for ($i = 0; $i < count($arrayOperator); $i++) {
                if ($arrayOperator[$i] == '+') {
                    $result = $arrayNumber[$i] + $arrayNumber[$i + 1];
                } elseif ($arrayOperator[$i] == '-') {
                    $result = $arrayNumber[$i] - $arrayNumber[$i + 1];
                } else {
                    continue;
                }

                // Cập nhật mảng số và toán tử
                $arrayNumber[$i] = $result;
                unset($arrayNumber[$i + 1]);
                $arrayNumber = array_values($arrayNumber);
                unset($arrayOperator[$i]);
                $arrayOperator = array_values($arrayOperator);

                // Gọi đệ quy để tiếp tục xử lý
                expression();
                return;        
            }
        }
    }


    // Gọi hàm để thực hiện công việc
    expression();
};

//baì 5 
      