<?php
require __DIR__. '/__connect_dp.php';

$perPage = 5;
$page = isset($_GET['page']) ? intval($_GET['page']) : 1 ;

$totalRows = $pdo->query("SELECT COUNT(1) FROM `adress_book`")
                ->fetch(PDO::FETCH_NUM)[0];

$totalPages = ceil($totalRows/$perPage);

$sql = sprintf("SELECT * FROM `adress_book` LIMIT %s, %s", ($page-1)*$perPage, $perPage);

$stmt = $pdo->query($sql);

?>

<?php include __DIR__. '/part-to-php/head.php'; ?>
<?php include __DIR__. '/part-to-php/nav.php'; ?>

<div class="container">
    <div class="row">
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">name</th>
            <th scope="col">address</th>
            <th scope="col">mail</th>
            <th scope="col">birthday</th>
            <th scope="col">number</th>
        </tr>
        </thead>
        <tbody>
        <?php while ($r=$stmt->fetch()): ?>
            <tr>
                <td><?=$r['sid']?></td>
                <td><?=$r['name']?></td>
                <td><?=$r['address']?></td>
                <td><?=$r['mail']?></td>
                <td><?=$r['birthday']?></td>
                <td><?=$r['number']?></td>
            </tr>
        <?php endwhile ?>
        </tbody>
    </table>
    </div>
    <div class="row">
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <?php for($i=1; $i<=$totalPages; $i++): ?>
            <li class="page-item <?= $i===$page ? 'active': "" ?>">
                <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
            </li>
            <?php endfor; ?>
        </ul>
    </nav>
    </div>
</div>