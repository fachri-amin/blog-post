</div>

      <!-- Sidebar Widgets Column -->
      <div class="col-md-4">

        <!-- Categories Widget -->
        <div class="card my-4">
          <h5 class="card-header">Categories</h5>
          <div class="card-body">
            <div class="row">
              <div class="col-lg-6">
                <ul class="list-unstyled mb-0">
                  <?php while($category = $stmt_categories->fetch()): ?>
                  <li>
                    <a href="<?= BASE_URL.'?category='.$category['category_id'] ?>"><?= $category['category'] ?></a>
                  </li>
                  <?php endwhile;?>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->