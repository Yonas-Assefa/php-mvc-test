<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="row mb-4">
    <div class="col-md-12">
        <h1><?php echo $data['title']; ?></h1>
        <p class="lead">Displaying JSON data with MVC pattern</p>
    </div>
</div>

<div class="row mb-3">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Filter Options</h5>
            </div>
            <div class="card-body">
                <div class="btn-group" role="group">
                    <a href="<?php echo URLROOT; ?>" class="btn <?php echo empty($data['category']) ? 'btn-primary' : 'btn-outline-primary'; ?>">All</a>
                    <?php foreach($data['categories'] as $category) : ?>
                        <a href="<?php echo URLROOT . '?category=' . $category; ?>" 
                           class="btn <?php echo $data['category'] === $category ? 'btn-primary' : 'btn-outline-primary'; ?>">
                            <?php echo ucfirst($category); ?>
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
            <div class="card-header">
                <h5>
                    Data <?php echo !empty($data['category']) ? '(Filtered by: ' . ucfirst($data['category']) . ')' : ''; ?>
                </h5>
            </div>
            <div class="card-body">
                <?php if(empty($data['records'])) : ?>
                    <p>No records found.</p>
                <?php else : ?>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Category</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($data['records'] as $record) : ?>
                                <tr>
                                    <td><?php echo $record['id']; ?></td>
                                    <td><?php echo $record['name']; ?></td>
                                    <td><?php echo $record['email']; ?></td>
                                    <td><?php echo ucfirst($record['category']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?> 