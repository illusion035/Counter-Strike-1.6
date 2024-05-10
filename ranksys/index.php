<?php
// Вкарваме database.php
require_once 'database.php';

// Име на таблицата в базата данни
$dbTable = "CRXRanks";

// Брой записи на страница
$records_per_page = 10;

// Инициализация на променливата за търсене
$search = '';

// Проверка за търсене
if (isset($_GET['search'])) {
    $search = $_GET['search'];
}

// Проверка за номера на текущата страница
if (isset($_GET['page']) && is_numeric($_GET['page'])) {
    $page = (int)$_GET['page'];
} else {
    $page = 1;
}

try {
    // Връзка с базата данни
    $pdo = pdo_connect();

    // Подготовка на SQL заявката с търсене и странициране
    $sql = "SELECT * FROM $dbTable WHERE name LIKE :search OR xp LIKE :search OR level LIKE :search OR next_xp LIKE :search OR rank LIKE :search OR next_rank LIKE :search";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':search', "%$search%", PDO::PARAM_STR);
    $stmt->execute();

    // Връща броя на резултатите
    $total_results = $stmt->rowCount();

    // Изчисляване на общия брой страниците
    $total_pages = ceil($total_results / $records_per_page);

    // Изчисляване на offset за заявката
    $offset = ($page - 1) * $records_per_page;

    // Подготовка на SQL заявката със странициране и търсене
    $sql = "SELECT * FROM $dbTable WHERE name LIKE :search OR xp LIKE :search OR level LIKE :search OR next_xp LIKE :search OR rank LIKE :search OR next_rank LIKE :search LIMIT :offset, :records_per_page";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':search', "%$search%", PDO::PARAM_STR);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->bindValue(':records_per_page', $records_per_page, PDO::PARAM_INT);
    $stmt->execute();
} catch (PDOException $e) {
    // Обработка на грешки, ако възникне проблем с изпълнението на заявката
    echo "Error: " . $e->getMessage();
}
?>

<!doctype html>
<html lang="bg" data-bs-theme="dark">

<head>
    <title>OciXCrom's Rank System WEB</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.3.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <div class="container">
        <div class="row mt-3">
            <div class="col-md-6">
                <!-- Търсачка -->
                <form method="get" class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Търси..." aria-label="Търси" name="search" value="<?php echo htmlspecialchars($search); ?>">
                    <button class="btn btn-outline-success" type="submit">Търси</button>
                </form>
            </div>
        </div>
        <div class="table-responsive mt-3">
            <table class="table table-primary table-dark">
                <thead>
                    <tr>
                        <th><i class="bi bi-person me-2 text-warning"></i>Player</th>
                        <th><i class="bi bi-stars me-2 text-warning"></i>XP</th>
                        <th><i class="bi bi-chevron-double-up me-2 text-warning"></i>Level</th>
                        <th><i class="bi bi-list-stars me-2 text-warning"></i>Next XP</th>
                        <th><i class="bi bi-star-fill me-2 text-warning"></i>Rank</th>
                        <th><i class="bi bi-star-half me-2 text-warning"></i> Next Rank</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Проверка дали има резултати
                    if ($stmt->rowCount() > 0) {
                        // Извеждане на данните от всеки ред
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo "<tr>";
                            echo "<td>" . $row["name"] . "</td>";
                            echo "<td>" . $row["xp"] . "</td>";
                            echo "<td>" . $row["level"] . "</td>";
                            echo "<td>" . $row["next_xp"] . "</td>";
                            echo "<td>" . $row["rank"] . "</td>";
                            echo "<td>" . $row["next_rank"] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>No data found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Bootstrap Pagination -->
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <?php
                // Генериране на линк за "Първа" страница
                if ($page > 1) {
                    echo '<li class="page-item"><a class="page-link" href="?page=1&search=' . urlencode($search) . '">Първа</a></li>';
                }

                // Генериране на линкове за страници
                for ($i = max(1, $page - 1); $i <= min($total_pages, $page + 1); $i++) {
                    echo '<li class="page-item ' . ($page == $i ? 'active' : '') . '"><a class="page-link" href="?page=' . $i . '&search=' . urlencode($search) . '">' . $i . '</a></li>';
                }

                // Генериране на линк за "Последна" страница
                if ($page < $total_pages) {
                    echo '<li class="page-item"><a class="page-link" href="?page=' . $total_pages . '&search=' . urlencode($search) . '">Последна</a></li>';
                }
                ?>
            </ul>
        </nav>
    </div>

    <!-- Some Script Includes -->
    <script src="./assets/javascript/jquery-3.6.0.min.js?assets_version=71"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
