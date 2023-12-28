<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dynamic Bootstrap Masonry Layout</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.css">
</head>
<body>

<div class="container">
  <div class="row" id="masonry-container">
    @foreach($pageDetail as $details)
      @php
        $items = json_decode($details['field_data']);  
      @endphp
      <div class="col-md-{{ $rowColumn['noOfColumn'] ?? 4 }} masonry-item">
        <div class="card">
          <img src="{{ asset('storage/'.$items->image) }}" class="card-img-top" alt="Image">
          <div class="card-body">
            <h5 class="card-title">Card Title</h5>
            <p class="card-text">Some text goes here.</p>
          </div>
        </div>
      </div>
    @endforeach
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    var masonryContainer = document.getElementById('masonry-container');
    var columns = {{ $rowColumn['noOfColumn'] ?? 4 }};
    var columnClass = 'col-md-' + Math.floor(12 / columns); // Calculate Bootstrap column class dynamically

    // Add Bootstrap column class to each masonry item
    var masonryItems = masonryContainer.getElementsByClassName('masonry-item');
    for (var i = 0; i < masonryItems.length; i++) {
      masonryItems[i].classList.add(columnClass);
    }

    var masonry = new Masonry(masonryContainer, {
      itemSelector: '.masonry-item',
      columnWidth: '.masonry-item', // Set the column width directly
      gutter: 20
    });
  });
</script>
</body>
</html>
