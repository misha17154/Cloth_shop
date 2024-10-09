<?php
session_start();
class CoffeeProducts
{
    protected $brand;
    protected $tradeName;
    function __construct($brand, $tradeName)
    {
        $this->brand = $brand;
        $this->tradeName = $tradeName;
    }
    //два метода записала в один
    function getProductInfo()
    {
        echo "brand = $this->brand, tradeName = $this->tradeName <br>";
    }


    // function getBrand() {
    //     echo "brand = $this->brand <br>";

    // }
    // function getTradeName() {
    //     echo "tradeName = $this->tradeName <br>";
    // }
}

$coffeeProduct_1 = new CoffeeProducts("LavAzza", "Rossa");
$coffeeProduct_2 = new CoffeeProducts("LavAzza", "Oro");
$coffeeProduct_3 = new CoffeeProducts("LavAzza", "Super Crema");
// var_dump($coffeeProduct_1);
//  $coffeeProduct_1->getProductInfo();
//  $coffeeProduct_2->getProductInfo();
//  $coffeeProduct_3->getProductInfo();

//сохранение переменных в сессию. где мы записываем в сессию переменную?
// $_SESSION['arr'] === Null;    для чего эта строка?
// ! значение не установлено
if (!isset($_SESSION["array"])) {
    $_SESSION["array"] = [];
}

// $_SESSION ["array"] = [$coffeeProduct_1, $coffeeProduct_2, $coffeeProduct_3];
// print_r($_SESSION["array"]);
?>

<!-- не прописываем в форме метод? -->
<form action="">
    <input type="text" placeholder="coffee brand" name="brand">
    <input type="text" placeholder="trade name" name="tradeName">
    <button>Add</button>
</form>

<?php
//получение данных из сессии?

if (isset($_GET["brand"]) && isset($_GET["tradeName"])) {
    $newCoffeeProduct = new CoffeeProducts ($_GET["brand"], $_GET["tradeName"]);
    array_push($_SESSION["array"], $newCoffeeProduct);
    print_r($_SESSION["array"]);
}

?>

<!-- ?добавляет по несколько раз одно и тоже -->




