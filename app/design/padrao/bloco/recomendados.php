<?php
// Garantir que o login_user_id exista e seja inteiro
$login_user_id = isset($login_user_id) ? intval($login_user_id) : 0;

// Inicializa variáveis
$ids = [];
$sql_cond = "";
$category_ids = "";

// Executa consulta somente se o usuário estiver logado (id > 0)
if ($login_user_id > 0) {
    $sql1 = "
        SELECT COUNT(category_id) AS total, category_id
        FROM user_category_recomendados
        WHERE user_id = " . $login_user_id . "
        GROUP BY category_id
        ORDER BY total DESC
        LIMIT 4
    ";

    $rs1 = mysqli_query(DB::$mConnection, $sql1);

    if ($rs1 === false) {
        // Debug em HTML comentado — remover em produção ou logar apropriadamente
        echo "<!-- ERRO SQL rs1: " . mysqli_error(DB::$mConnection) . " -->";
    } else {
        if (mysqli_num_rows($rs1) > 0) {
            while ($row1 = mysqli_fetch_assoc($rs1)) {
                if (isset($row1['category_id'])) {
                    $ids[] = intval($row1['category_id']);
                }
            }

            if (!empty($ids)) {
                $category_ids = implode(",", $ids);
                $sql_cond = " AND group_id IN (" . $category_ids . ")";
            }
        }
    }
}

// Consulta principal de anúncios (usa $sql_cond se houver)
$current_time = time();
$sql = "
    SELECT id, title, image, team_price, mostrarpreco
    FROM team
    WHERE (status IS NULL OR status = 1)
      AND (pago = 'sim' OR anunciogratis = 's')
      AND begin_time < '" . $current_time . "'
      AND end_time > '" . $current_time . "'
      " . $sql_cond . "
    ORDER BY RAND()
";

$rs = mysqli_query(DB::$mConnection, $sql);
?>

<div class="container pt-5 pb-5">
    <div style="display:none;height:36px;" class="tips"><?php echo __FILE__; ?></div>

    <div class="row galeria-wrapper">

        <div class="col-12 d-flex flex-md-row flex-column justify-content-md-between">
            <div class="d-flex align-items-center">
                <h2 class="recommendation-title">Recomendados para você</h2>
            </div>
        </div>

        <div class="col-12">
            <div class="MultiCarousel" data-items="1,3,5,6" data-slide="1" id="MultiCarousel" data-interval="1000">
                <div class="MultiCarousel-inner">

                    <?php if ($rs && mysqli_num_rows($rs) > 0): ?>
                        <?php while ($row = mysqli_fetch_assoc($rs)): ?>
                            <?php
                                // Proteções básicas
                                $rowId = isset($row['id']) ? intval($row['id']) : 0;
                                $rowTitle = isset($row['title']) ? utf8_decode($row['title']) : '';
                                $rowImage = isset($row['image']) ? $row['image'] : '';
                                $rowTeamPrice = isset($row['team_price']) ? $row['team_price'] : 0;
                                $rowMostrarPreco = isset($row['mostrarpreco']) ? intval($row['mostrarpreco']) : 0;

                                // Link do anúncio
                                $link = rtrim($INI['system']['wwwprefix'], '/') . "/anuncio/" . $rowId . "/" . URLify::filter($rowTitle);

                                // Definir imagem fallback
                                $imagem = !empty($rowImage) ? (rtrim($INI['system']['wwwprefix'], '/') . "/media/" . $rowImage) : ($PATHSKIN . "/images/semfoto.jpg");
                            ?>
                            <div class="item">
                                <div class="pad15">
                                    <div class="gallery-image">
                                        <div class="gallery-image-box">
                                            <a title="<?php echo htmlspecialchars($rowTitle, ENT_QUOTES); ?>" href="<?php echo htmlspecialchars($link, ENT_QUOTES); ?>">
                                                <img class="image"
                                                     title="<?php echo htmlspecialchars($rowTitle, ENT_QUOTES); ?>"
                                                     alt="<?php echo htmlspecialchars($rowTitle, ENT_QUOTES); ?>"
                                                     src="<?php echo htmlspecialchars($imagem, ENT_QUOTES); ?>" />
                                            </a>
                                        </div>
                                    </div>

                                    <h3 class="gallery-title">
                                        <a title="<?php echo htmlspecialchars($rowTitle, ENT_QUOTES); ?>" href="<?php echo htmlspecialchars($link, ENT_QUOTES); ?>" class="gallery-link">
                                            <?php echo htmlspecialchars($rowTitle); ?>
                                        </a>
                                    </h3>

                                    <?php if ($rowMostrarPreco === 1): ?>
                                        <p class="gallery-price">
                                            R$ <?php echo number_format($rowTeamPrice, 2, ",", "."); ?>
                                        </p>
                                    <?php else: ?>
                                        <p class="gallery-price">A combinar</p>
                                    <?php endif; ?>

                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <!-- Sem resultados ou erro SQL: <?php echo htmlspecialchars(mysqli_error(DB::$mConnection)); ?> -->
                    <?php endif; ?>

                </div>

                <button class="btn btn-default leftLst">&lt;</button>
                <button class="btn btn-default rightLst">&gt;</button>
            </div>
        </div>

    </div>
</div>
