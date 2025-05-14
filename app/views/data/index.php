<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="row mb-4">
    <div class="col-md-12">
        <h1 class="mb-2"><?php echo $data['title']; ?></h1>
        <p class="text-muted mb-0">Displaying API data with MVC pattern</p>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 fw-semibold"><i class="bi bi-funnel-fill"></i> Filter Data</h5>
            </div>
            <div class="card-body py-3">
                <div class="d-flex flex-wrap gap-2">
                    <a href="<?php echo URLROOT; ?>" class="btn <?php echo empty($data['category']) ? 'btn-dark' : 'btn-outline-dark'; ?> rounded-pill px-3">
                        <i class="bi bi-grid-3x3-gap-fill me-1"></i> All Records
                    </a>
                    <?php foreach($data['categories'] as $category) : ?>
                        <a href="<?php echo URLROOT . '?category=' . $category; ?>" 
                           class="btn <?php echo $data['category'] === $category ? 'btn-dark' : 'btn-outline-dark'; ?> rounded-pill px-3">
                            <i class="bi bi-tag-fill me-1"></i> <?php echo ucfirst($category); ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0 fw-semibold">
                    <i class="bi bi-table me-2"></i> Data Table
                </h5>
                <?php if(!empty($data['category'])) : ?>
                    <span class="badge bg-light text-dark border rounded-pill px-3 py-2">
                        Filtered by: <?php echo ucfirst($data['category']); ?>
                    </span>
                <?php endif; ?>
            </div>
            <div class="card-body p-0">
                <?php if(empty($data['records'])) : ?>
                    <div class="alert alert-secondary m-3">
                        <i class="bi bi-info-circle-fill me-2"></i> No records found.
                    </div>
                <?php else : ?>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="ps-4">ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th class="pe-4">Category</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($data['records'] as $index => $record) : ?>
                                    <tr>
                                        <td class="ps-4"><?php echo $record['id']; ?></td>
                                        <td class="fw-medium"><?php echo $record['name']; ?></td>
                                        <td><?php echo $record['email']; ?></td>
                                        <td class="pe-4">
                                            <?php 
                                                $badgeClass = 'text-bg-secondary';
                                                if ($record['category'] === 'admin') {
                                                    $badgeClass = 'bg-danger-subtle text-danger';
                                                } else if ($record['category'] === 'customer') {
                                                    $badgeClass = 'bg-success-subtle text-success';
                                                } else if ($record['category'] === 'employee') {
                                                    $badgeClass = 'bg-info-subtle text-primary';
                                                }
                                            ?>
                                            <span class="badge <?php echo $badgeClass; ?> rounded-pill px-2">
                                                <?php echo ucfirst($record['category']); ?>
                                            </span>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?> 