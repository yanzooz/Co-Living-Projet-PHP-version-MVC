<!-- filepath: c:\wamp64\www\Projet4MVC\templates\mes_reservations.php -->
<?php
require_once("block/header/guest_header.php");
?>
<style>
    /* Table des réservations */
.table {
    border-collapse: collapse;
    width: 100%;
    margin-top: 1rem;
}

.table th, .table td {
    text-align: left;
    padding: 0.75rem;
    vertical-align: middle;
}

.table th {
    background-color: #f8f9fa;
    font-weight: bold;
}

.table-hover tbody tr:hover {
    background-color: #f1f1f1;
}

.btn-sm {
    padding: 0.25rem 0.5rem;
    font-size: 0.875rem;
}
</style>

<div class="container my-5">
    <h2 class="mb-4">Mes Réservations</h2>

    <?php if (empty($reservations)): ?>
        <div class="alert alert-info">
            Vous n'avez aucune réservation pour le moment.
        </div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Titre de l'annonce</th>
                        <th>Date de réservation</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($reservations as $index => $reservation): ?>
                        <tr>
                            <td><?= $index + 1; ?></td>
                            <td><?= htmlspecialchars($reservation['title']); ?></td>
                            <td><?= htmlspecialchars($reservation['reservation_date']); ?></td>
                            <td>
                                <a href="index.php?action=detailListing&id=<?= $reservation['listing_id']; ?>" class="btn btn-info btn-sm">
                                    Voir l'annonce
                                </a>
                                <a href="index.php?action=cancelReservation&id=<?= $reservation['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir annuler cette réservation ?');">
                                    Annuler
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<?php
require_once("block/footer.php");
?>